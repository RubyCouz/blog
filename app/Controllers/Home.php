<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $user = \auth()->user();
        $data['user'] = $user;
        return view('templates/header', $data) 
        .view('home')
        .view('templates/footer');
    }
}
