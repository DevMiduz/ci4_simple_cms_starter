<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController {
	public function index() {

		if(session()->authenticated) {
			return redirect('auth/account');
		}

		$data = [
			'page_title' => 'Login'
		];

		return view('auth/login', $data);
	}

	public function login() {

		$data = $this->request->getPost(['username', 'password']);

		if (!$this->validate([
			'username' => 'required|max_length[255]',
			'password' => 'required|max_length[255]|min_length[8]',
		])) {
			return redirect()->back()->withInput();
		}

		$model = new UserModel();
		$user = $model->where('username', $data['username'])->first();

		if (!$user || !password_verify($data['password'], $user['password'])) {
			session()->setFlashdata('error', 'Username or Password Incorrect.');
			end_session();
			return redirect()->back()->withInput();
		}

		begin_session($user);
		return redirect('auth/account');
	}
}