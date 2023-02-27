<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AboutController extends BaseController
{

    public function index()
    {

        $data = [
            'title' => 'À propos'
        ];

        return view('templates/header', $data)
            . view('about/about')
            . view('templates/footer');
    }
}
