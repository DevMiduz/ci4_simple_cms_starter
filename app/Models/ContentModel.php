<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'content';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'slug', 'description', 'content_body', 'published', 'created_at', 'updated_at'];

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

    public function find_content_with_tags_and_type($id) {
        $content = $this->find($id);

        $builder = $this->db->table('tags');
        $builder->select('tags.*');
        $builder->join('content_tags', 'tags.id = content_tags.tag_id', 'inner');
        $builder->where('content_tags.content_id', $id);
        $content['tags'] = $builder->get()->getResultArray();

        $content_type = new ContentTypeModel();
        $content['content_type'] = $content_type->find($content['content_type_id']);

        return $content;
    }
}
