<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContentModel;
use CodeIgniter\Files\File;
use CodeIgniter\I18n\Time;

class ContentController extends BaseController
{

    /**
     * Affichage des posts
     */
    public function index()
    {
        if (auth()->user() === null || !auth()->user()->can('user.access')) {
            return redirect()->route('login');
        }
        // démarage session pour flash data
        $session = \Config\Services::session();
        // récupération message flash et stockage dans une variable
        $flash = $session->getFlashdata('isValid');
        // récupération des données user connecté
        $user = \auth()->user();
        // connexion à la base de données
        $db      = \Config\Database::connect();
        $builder = $db->table('contents');
        // récupération des 3 dernières entrées en base
        $query = $builder->orderBy('created_at', 'DESC')->get(3);
       
        // instanciation du model contentModel
        $model = model(ContentModel::class);
        // utilisation de la methode getContents du model ContentModel et stockage du resultat dans un tableau associatif
        $data = [
            'user' => $user,
            'contents' => $model->getContents(),
            'title' => 'Les derniers posts d\'Aby et Roxanne',
            'flash' => $flash,
        ];
        // on retourne les vues pour affichage
        return view('templates/header', $data)
            . view('contents/index')
            . view('templates/footer');
    }
    /**
     * Affichage d'un post en fonction de son slug
     */
    public function view($id = null)
    {
        if (auth()->user() === null || !auth()->user()->can('user.access')) {
            return redirect()->route('login');
        }
        // récupération des données user
        $user = \auth()->user();
        $data['user'] = $user;
        // instanciation du model ContentModel
        $model = model(ContentModel::class);
        $data = [
            'user' => $user,
            'contents' => $model->getContents($id),
        ];

        return view('templates/header', $data)
            . view('contents/view')
            . view('templates/footer');
    }

    /**
     * Ajout d'un post
     */
    public function addContent()
    {
        // vérification du role de l'utilisateur et de ses permissions
        if (auth()->user() === null || !auth()->user()->can('admin.access')) {
            return redirect()->route('contents');
        }
        // instanciation session pour flashdata
        $session = \Config\Services::session();
        // récupération de la dâte du jour
        $today = Time::createFromDate()->toDateString();
        $page = 'addContent';
        // appel helper formulaire et gestion des erreurs
        helper('form');
        session()->getFlashdata('error');
        $validation = \Config\Services::validation();
        validation_list_errors();
        // récupération des données user
        $user = \auth()->user();
        // contrainte de validation pour l'image
        $picValidation =
            [
                'content_pic' => [
                    'rules' => [
                        'uploaded[content_pic]',
                        'is_image[content_pic]',
                        'mime_in[content_pic,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    ],
                    'errors' => [
                        'is_image' => 'Ce type de fichier n\'est pas pris en charge',
                        'uploaded' => 'Il y a eu un soucis lors du téléchargement du fichier'
                    ]
                ],
            ];
        $data = [
            'title' => 'Nouveau post',
            'user' => $user,
        ];
        // si le formulaire est envoyé
        if ($this->request->is('post')) {
            // récupération des données fournies par l'utilisateur
            $post = $this->request->getPost(['content_title', 'content_text', 'content_pic']);
            // récupération des informations de l'image
            $pic = $this->request->getFile('content_pic');
            // validation image
            if (!$this->validate($picValidation)) {
                $data['errors'] = $this->validator->getErrors();
            }
            //validation formulaire
            if (!$validation->run($post, 'content')) {
                $data['errors'] = $validation->getErrors();
            }
            // s'il n'y a pas d'erreur de form
            if (!isset($data['errors']) && !isset($data['errorUpload'])) {
                // stockage de l'image
                if (!$pic->hasMoved()) {
                    // définition d'un nom de fichier random
                    $newName = $pic->getRandomName();
                    $pic->move(ROOTPATH . 'public/images/uploads/posts', $newName);
                }
                // instanciation du model ContentModel
                $model = model(ContentModel::class);
                // envoie des donnés en base de données
                $model->save([
                    'content_title' => $post['content_title'],
                    'content_text' => $post['content_text'],
                    'content_pic' => 'images/uploads/posts/' . $newName,
                    'created_at' => $today,
                    'user_id' => 1,
                ]);

                $session->setFlashdata('isValid', 'Post ajouté à la base');
                return redirect()->route('contents');
            }
        }
        return view('templates/header', $data)
            . view('contents/' . $page)
            . view('templates/footer');
    }
}
