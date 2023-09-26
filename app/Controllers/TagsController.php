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
        //
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
        
    }
}
