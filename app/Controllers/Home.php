<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // connexion à la base de données
        $db      = \Config\Database::connect();
        $builder = $db->table('contents');
        // récupération des 3 dernières entrées en base
        $query = $builder->orderBy('created_at', 'DESC')->get(3);
        $data['pictures'] = $query->getResult(); 
        
        $user = \auth()->user();
        $data['user'] = $user;
        return view('templates/header', $data) 
        .view('home', $data)
        .view('templates/footer');
    }
}
