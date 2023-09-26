<?php

namespace App\Controllers;

use App\Libraries\HttpStatusCodes;
use App\Models\TagModel;
use App\Models\ContentModel;

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
        $tag = $model->find_tag_with_content($id);

        if(!$tag) {
            return $this->response->setStatusCode(404)->setBody(HttpStatusCodes::get_message(404));
        }

        $data = [
            'page_title' => 'Tags - Show item',
            'tag' => $tag,
            'table_keys' => ['id', 'title', 'description'],
            'table_rows' => $tag['content'],
        ];

        return view('tags/show', $data);
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
        $model = new TagModel();

        //$this->response->setContentType('application/json');

        if (!$model->find($id)) {
            session()->setFlashdata('error', 'Item with that ID not found.');
            $this->response->setStatusCode(404, HttpStatusCodes::get_message(404));
            return $this->response->setJSON(['error' => 'Item with that ID not found.']);
        }

        if($model->delete($id)) {
            session()->setFlashdata('message', 'Tag Deleted Successfully.');
            return $this->response->setJSON(['message' => 'Tag Deleted Successfully.']);
        } else {
            session()->setFlashdata('error', implode('<br/>', $model->errors()));
            return $this->response->setJSON(['error' => implode('<br/>', $model->errors())]);
        }

    }
}