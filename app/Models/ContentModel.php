<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'contents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'content_title', 'content_text', 'content_pic', 'user_id', 'created_at', 'updated_at'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    /**
     * Get all contents
     */
    public function getContents($id = false)
    {
        // si pas de slug
        if ($id === false) {
            // on recupere toutes les donnees
            return $this->findAll();
        }
        // recuperation de la derniere donnee selon son slug
        return $this->where(['content_id' => $id])->first();
    }
}
