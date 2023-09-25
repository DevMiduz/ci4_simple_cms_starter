<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class RegisterController extends BaseController {
	public function index() {
		if(session()->authenticated) {
			return redirect('auth/account');
		}
		
		$data = [
			'page_title' => 'Register'
		];

		return view('auth/register', $data);
	}

	public function register() {

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

	}
}