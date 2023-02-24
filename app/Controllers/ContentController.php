<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContentModel;
use CodeIgniter\Files\File;

class ContentController extends BaseController
{
    /**
     * Affichage des posts
     */
    public function index()
    {
        // récupération des données user
        $user = \auth()->user();
        // instanciation du model contentModel
        $model = model(ContentModel::class);
        // utilisation de la methode getContents du model ContentModel et stockage du resultat dans un tableau associatif
        $data = [
            'user' => $user,
            'contents' => $model->getContents(),
            'title' => 'Les derniers posts d\'Aby et Roxanne',
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
        // récupération des données user
        $user = \auth()->user();
        $data['user'] = $user;
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

        helper('form');
        session()->getFlashdata('error');
        validation_list_errors();
        // récupération des données user
        $user = \auth()->user();
        $data = [
            'title' => 'Nouveau post',
            'user' => $user,
        ];
        // si le formulaire n'est pas soumis
        if (!$this->request->is('post')) {
            return view('templates/header', $data)
                . view('contents/addContent')
                . view('templates/footer');
        }

        $post = $this->request->getPost(['content_title', 'content_text', 'content_pic']);
        $pic = $this->request->getFile('content_pic');
        if (!$pic->isValid()) {
            throw new \RuntimeException($pic->getErrorString() . '(' . $pic->getError() . ')');
        }
        var_dump($post);
        var_dump($pic);
        $picValidation =
            [
                'content_pic' => [
                    'label' => 'Image File',
                    'rules' => [
                        'uploaded[content_pic]',
                        'is_image[content_pic]',
                        'mime_in[content_pic,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    ],
                ],
            ];
        if (!$this->validate($picValidation)) {
            $data = [
                'errors' => $this->validator->getErrors(),
                'title' => 'un titre',
            ];

            return view('templates/header', $data)
                . view('contents/addContent')
                . view('templates/footer');
        }
        // si la validation échoue
        if (!$this->validateData(
            $post,
            [
                'content_title' => 'required',
                'content_text'  => 'required',
            ]
        )) {
            $data = [
                'user' => $user,
                'title' => 'Problème validation',
                'errors' => $this->validator->getErrors()
            ];
            // affichage du formulaire
            return view('templates/header', $data)
                . view('contents/addContent')
                . view('templates/footer');
        }

        if (!$pic->hasMoved()) {
            $filepath = WRITEPATH . 'uploads/' . $pic->store();
            $data = ['uploaded_fileinfo' => new File($filepath)];
        }
        $model = model(ContentModel::class);
        $model->save([
            'content_title' => $post['content_title'],
            'content_text' => $post['content_text'],
            'content_pic' => $filepath,
            'user_id' => 1,
        ]);
        $data = [
            'user' => $user,
            'title' => 'Envoie effectué',
            'uploaded_fileinfo' => new File($filepath)
        ];
        return view('templates/header', $data)
            . view('contents/index')
            . view('templates/footer');
    }
}
