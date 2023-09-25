<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
	protected $DBGroup = 'default';
	protected $table = 'users';
	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
	protected $returnType = 'array';
	protected $useSoftDeletes = false;
	protected $protectFields = true;
	protected $allowedFields = ['username', 'password'];

	// Dates
	protected $useTimestamps = false;
	protected $dateFormat = 'datetime';
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';

	// Validation
	protected $validationRules = [
		'username' => 'required|max_length[255]|alpha_numeric|is_unique[users.username,id,{id}]',
		'password' => 'required|max_length[255]|min_length[8]',
		'password_confirm' => 'required|max_length[255]|matches[password]',
	];

	protected $validationMessages = [];
	protected $skipValidation = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks = true;
	protected $beforeInsert = [];
	protected $afterInsert = [];
	protected $beforeUpdate = [];
	protected $afterUpdate = [];
	protected $beforeFind = [];
	protected $afterFind = [];
	protected $beforeDelete = [];
	protected $afterDelete = [];
}
