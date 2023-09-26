<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tags';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'title'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'title' => 'required|max_length[80]|alpha_numeric_space|is_unique[tags.title,id,{id}]',
    ];

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


    public function find_tag_with_content($id) {
        $tag = $this->find($id);

        $builder = $this->db->table('content');
        $builder->select('content.*');
        $builder->join('content_tags', 'content.id = content_tags.content_id', 'inner');
        $builder->join('tags', 'tags.id = content_tags.tag_id', 'inner');
        $builder->where('content_tags.tag_id', $id);
        $tag['content'] = $builder->get()->getResultArray();

        return $tag;
    }
}
