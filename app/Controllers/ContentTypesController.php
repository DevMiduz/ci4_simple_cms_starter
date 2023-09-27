<?php

namespace App\Controllers;

use App\Libraries\HttpStatusCodes;
use App\Controllers\BaseController;
use App\Models\ContentTypeModel;

class ContentTypesController extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new ContentTypeModel();
        $content_types = $model->findAll();

        $data = [
            'page_title' => 'Content Types',
            'table_keys' => $model->allowedFields,
            'table_rows' => $content_types,
        ];

        return view('content_types/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new ContentTypeModel();
        $content_type = $model->find_content_type_with_content($id);

        if(!$content_type) {
            return $this->response->setStatusCode(404)->setBody(HttpStatusCodes::get_message(404));
        }

        $data = [
            'page_title' => 'Content Type - Show item',
            'content_type' => $content_type,
            'table_keys' => ['id', 'title', 'description'],
            'table_rows' => $content_type['content'],
        ];

        return view('content_types/show', $data);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $data = [
            'page_title' => 'Content Types - New Item',
        ];

        return view('content_types/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $model = new ContentTypeModel();
        $data = $this->request->getPost(['title']);

		if (!$this->validate([
			'title' => 'required|max_length[100]|alpha_numeric_space',
		])) {
			return redirect()->back()->withInput();
		}

        if (!$model->save($data)) {
			session()->setFlashdata('error', implode('<br/>', $model->errors()));
			return redirect()->back()->withInput();
        }

        session()->setFlashdata("message", "Content Type Created Successfully.");
        return redirect()->to('content_types/new');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $model = new ContentTypeModel();
        $content_type = $model->find_content_type_with_content($id);

        if(!$content_type) {
            return $this->response->setStatusCode(404)->setBody(HttpStatusCodes::get_message(404));
        }
        
        $data = [
            'page_title' => 'Content Types - Edit item',
            'content_type' => $content_type,
            'table_keys' => ['id', 'title', 'description'],
            'table_rows' => $content_type['content'],
        ];

        return view('content_types/edit', $data);
        
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $model = new ContentTypeModel();
        $data = $this->request->getPost(['title']);

		if (!$this->validate([
			'title' => 'required|max_length[100]|alpha_numeric_space',
		])) {
			return redirect()->back()->withInput();
		}

        if (!$model->update($id, $data)) {
			session()->setFlashdata('error', implode('<br/>', $model->errors()));
			return redirect()->back()->withInput();
        }

        session()->setFlashdata("message", "Content Type Updated Successfully.");    
        
        return redirect()->to('content_types/edit/' . $id);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new ContentTypeModel();

        if (!$model->find($id)) {
            session()->setFlashdata('error', 'Item with that ID not found.');
            $this->response->setStatusCode(404, HttpStatusCodes::get_message(404));
            return $this->response->setJSON(['error' => 'Item with that ID not found.']);
        }

        if($model->delete($id)) {
            session()->setFlashdata('message', 'Content Type Deleted Successfully.');
            return $this->response->setJSON(['message' => 'Content Type Deleted Successfully.']);
        } else {
            session()->setFlashdata('error', implode('<br/>', $model->errors()));
            return $this->response->setJSON(['error' => implode('<br/>', $model->errors())]);
        }

    }
}
