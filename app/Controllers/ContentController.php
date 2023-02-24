<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContentModel;

class ContentController extends BaseController
{
    public function index()
    {
        // instanciation du model contentModel
        $model = model(ContentModel::class);
        // utilisation de la methode getContents du model ContentModel et stockage du resultat dans un tableau associatif
        $data = [
            'contents' => $model->getContents(),
            'title' => 'Contents Archive',
        ];

        return view('templates/header', $data)
            . view('contents/index')
            . view('templates/footer');
    }

    public function view($slug = null)
    {
        $model = model(ContentModel::class);
        $data['contents'] = $model->getContents($slug);
    }
}
