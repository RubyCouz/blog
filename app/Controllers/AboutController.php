<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AboutController extends BaseController
{

    public function index()
    {
   // récupération des données user
        $user = \auth()->user();
        $data['user'] = $user;
        $data = [
            'title' => 'À propos',
            'user' => $user,
        ];

        return view('templates/header', $data)
            . view('about/about')
            . view('templates/footer');
    }
}
