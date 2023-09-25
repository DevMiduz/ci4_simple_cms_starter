<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AccountController extends BaseController {
	public function index() {
		$session = session();

		$data = [
			'page_title' => 'Profile - ' . $session->username,
			'username' => $session->username
		];

		return view('auth/account', $data);
	}

	public function update() {

		$data = $this->request->getPost(['old_password', 'new_password', 'confirm_password']);

		if (!$this->validate([
			'old_password' => 'required|max_length[255]|min_length[8]|alpha_numeric_punct',
			'new_password' => 'required|max_length[255]|min_length[8]|alpha_numeric_punct',
			'confirm_password' => 'required|max_length[255]|min_length[8]|alpha_numeric_punct|matches[new_password]',
		])) {
			return redirect()->back()->withInput();
		}

		$session = session();
		$model = new UserModel();
		$user = $model->where('username', $session->username)->first();

		if (!$user || !password_verify($data['old_password'], $user['password'])) {
			session()->setFlashdata('update_form_error', 'Old Password Incorrect.');
			return redirect()->back()->withInput();
		}

		$password = password_hash($data['new_password'], PASSWORD_DEFAULT);

		if ($model->update($user['id'], [
			'password' => $password,
			'password_confirm' => $password,
		]) === false) {
			session()->setFlashdata('update_form_error', implode('<br/>', $model->errors()));
			return redirect()->back()->withInput();
		}

		session()->setFlashdata("update_form_message", "User successfully updated.");

		return redirect('auth/account');
	}

	public function delete() {
		$data = $this->request->getPost(['confirm_username', 'password']);

		$session = session();

		if ($data['confirm_username'] !== $session->username) {
			session()->setFlashdata('delete_form_error', 'Username Incorrect.');
			return redirect()->back()->withInput();
		}
		
		$model = new UserModel();
		$user = $model->where('username', $session->username)->first();
		
		if (!$user || !password_verify($data['password'], $user['password'])) {
			session()->setFlashdata('delete_form_error', 'Password Incorrect.');
			return redirect()->back()->withInput();
		}

		if ($model->delete($user['id']) === false) {
			session()->setFlashdata('delete_form_error', implode('<br/>', $model->errors()));
			return redirect()->back()->withInput();
		}

		session()->setFlashdata("message", "User successfully deleted.");

		return redirect('auth/login');
	}

	public function logout() {
		end_session();
		session()->setFlashdata("message", "User successfully logged out.");
		return redirect('auth/login');
	}
}
