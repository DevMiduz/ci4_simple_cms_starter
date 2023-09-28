<?php

namespace App\Controllers;

use App\Libraries\HttpStatusCodes;
use App\Controllers\BaseController;
use App\Models\ContentModel;
use App\Models\ContentTypeModel;
use App\Models\ContentTagModel;
use App\Models\TagModel;


class ContentController extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new ContentModel();
        $content = $model->findAll();

        $data = [
            'page_title' => 'Content',
            'table_keys' => ['id', 'title', 'created_at', 'updated_at'],
            'table_rows' => $content,
        ];

        return view('content/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $content_model = new ContentModel();
        $content_type_model = new ContentTypeModel();
        $tag_model = new TagModel();

        $content = $content_model->find_content_with_tags_and_type($id);

        if(!$content) {
            return $this->response->setStatusCode(404)->setBody(HttpStatusCodes::get_message(404));
        }

        $data = [
            'page_title' => 'Content - Show item',
            'content' => $content,
            'content_types' => $content_type_model->findAll(),
            'tags' => $tag_model->findAll(),
        ];

        return view('content/show', $data);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $content_type_model = new ContentTypeModel();
        $tag_model = new TagModel();

        $data = [
            'page_title' => 'Content - New Item',
            'content_types' => array_column($content_type_model->findAll(), 'title', 'id'),
            'tags' => array_column($tag_model->findAll(), 'title', 'id'),
        ];

        return view('content/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $model = new ContentModel();
        $data = $this->request->getPost(['title', 'description', 'content_body', 'content_type_id', 'content_tags', 'published']);
        $data['slug'] = url_title($data['title'],'-',true);
        $data['published'] = (!isset($data['published'])) ?  0 : $data['published'];

		if (!$this->validate([
            'title' => 'required|max_length[180]',
            'content_type_id' => 'required',
        ])) {
			return redirect()->back()->withInput();
		}
        
        if (!$model->save($data)) {
			session()->setFlashdata('error', implode('<br/>', $model->errors()));
			return redirect()->back()->withInput();
        }

        $data['id'] = $model->getInsertID();

        $data['content_tags'] = array_map(fn($value): array => ['content_id' => $data['id'], 'tag_id' => $value], $data['content_tags']);

        $content_tag_model = new ContentTagModel();
        $content_tag_model->where('content_id', $data['id'])->delete();

        foreach ($data['content_tags'] as $row) {
            $content_tag_model->insert($row);
        }

        session()->setFlashdata("message", "Content Created Successfully.");
        return redirect()->to('content/new');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $model = new ContentModel();
        $content_type_model = new ContentTypeModel();
        $tag_model = new TagModel();

        $content = $model->find_content_with_tags_and_type($id);

        if(!$content) {
            return $this->response->setStatusCode(404)->setBody(HttpStatusCodes::get_message(404));
        }


        $data = [
            'page_title' => 'Content - Edit item',
            'content' => $content,
            'content_types' => array_column($content_type_model->findAll(), 'title', 'id'),
            'tags' => array_column($tag_model->findAll(), 'title', 'id'),
            'content_tag_ids' => array_column($content['tags'],'id'),
        ];

        return view('content/edit', $data);
        
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $model = new ContentModel();
        $data = $this->request->getPost(['title', 'description', 'content_body', 'content_type_id', 'content_tags', 'published']);
        $data['slug'] = url_title($data['title'],'-',true);
        $data['published'] = (!isset($data['published'])) ?  0 : $data['published'];

		if (!$this->validate([
            'title' => 'required|max_length[180]',
            'content_type_id' => 'required',
        ])) {
			return redirect()->back()->withInput();
		}
        
        if (!$model->update($id, $data)) {
			session()->setFlashdata('error', implode('<br/>', $model->errors()));
			return redirect()->back()->withInput();
        }

        $data['content_tags'] = array_map(fn($value): array => ['content_id' => $id, 'tag_id' => $value], $data['content_tags']);

        $content_tag_model = new ContentTagModel();
        $content_tag_model->where('content_id', $id)->delete();

        foreach ($data['content_tags'] as $row) {
            $content_tag_model->insert($row);
        }

        session()->setFlashdata("message", "Content Updated Successfully.");    
        
        return redirect()->to('content/edit/' . $id);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new ContentModel();

        if (!$model->find($id)) {
            session()->setFlashdata('error', 'Item with that ID not found.');
            $this->response->setStatusCode(404, HttpStatusCodes::get_message(404));
            return $this->response->setJSON(['error' => 'Item with that ID not found.']);
        }

        $content_tag_model = new ContentTagModel();

        if(!$model->delete($id) || !$content_tag_model->where('content_id', $id)->delete()) {
            session()->setFlashdata('error', implode('<br/>', $model->errors()));
            return $this->response->setJSON(['error' => implode('<br/>', $model->errors())]);
        }

        session()->setFlashdata('message', 'Content Deleted Successfully.');
        return $this->response->setJSON(['message' => 'Content Deleted Successfully.']);

    }
}
