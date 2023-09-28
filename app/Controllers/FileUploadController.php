<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Files\File;
use ZipArchive;

class FileUploadController extends BaseController
{

    public function index()
    {
        $data = [
            'page_title' => 'Upload Files'
        ];

        return view('file_upload/index', $data);
    }

    public function upload()
    {
        $file = $this->request->getFile('zipfile');

        if (! $file->isValid()) {
            session()->setFlashdata('error', $file->getErrorString());
        }

        $validationRule = [
            'zipfile' => [
                'label' => 'Zip File',
                'rules' => [
                    'uploaded[zipfile]',
                    //'mime_in[zip]'
                ],
            ],
        ];

        if (! $this->validate($validationRule)) {
            session()->setFlashdata('error', implode('<br/>', $this->validator->getErrors()));
            return redirect()->to('file_upload');
        }

        if ($file->hasMoved()) {
            session()->setFlashdata('error', 'The file has already been moved.');
            return redirect()->to('file_upload');
        }

        $filepath = WRITEPATH . 'uploads/' . $file->store();

        $zip = new ZipArchive;
        $zip->open($filepath);
        $zip->extractTo("uploads");

        unlink($filepath);

        session()->setFlashdata('message', 'File successfully uploaded.');        
        return redirect()->to('file_upload');
    }
}
