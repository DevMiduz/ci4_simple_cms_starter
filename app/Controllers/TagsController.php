<?php

namespace App\Controllers;

use App\Libraries\HttpStatusCodes;
use App\Models\TagModel;

class TagsController extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new TagModel();
        $tags = $model->findAll();

        $data = [
            'page_title' => 'Tags',
            'table_keys' => $model->allowedFields,
            'table_rows' => $tags,
        ];

        return view('tags/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new TagModel();
        $tag = $model->find($id);

        if(!$tag) {
            return $this->response->setStatusCode(404)->setBody(HttpStatusCodes::get_message(404));
        }

        $data = [
            'page_title' => 'Show Tag with ID: ' . $id,
        ];

        return view('tags/index', $data);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $data = [
            'page_title' => 'Tags - New Item',
        ];

        return view('tags/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $model = new TagModel();
        $data = $this->request->getPost(['title']);

		if (!$this->validate([
			'title' => 'required|max_length[80]|alpha_numeric_space',
		])) {
			return redirect()->back()->withInput();
		}

        if (!$model->save($data)) {
			session()->setFlashdata('error', implode('<br/>', $model->errors()));
			return redirect()->back()->withInput();
        }

        session()->setFlashdata("message", "Tag Created Successfully.");
        return redirect('tags/new');
    }

    /*

		$model = new UserModel();

		$data = $this->request->getPost(['username', 'password', 'password_confirm']);

		if (!$this->validate([
			'username' => 'required|max_length[255]|alpha_numeric',
			'password' => 'required|max_length[255]|min_length[8]|alpha_numeric_punct',
			'password_confirm' => 'required|max_length[255]|matches[password]',
		])) {
			return redirect()->back()->withInput();
		}

		$password = password_hash($data['password'], PASSWORD_DEFAULT);

		if ($model->save([
			'username' => $data['username'],
			'password' => $password,
			'password_confirm' => $password,
		]) === false) {
			session()->setFlashdata('error', implode('<br/>', $model->errors()));
			return redirect()->back()->withInput();
		}

		session()->setFlashdata("message", "User successfully registered.");
		return redirect('auth/login');

    */

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        
    }
}
