<?php

function begin_session($data) {
	$session = session();
	$authData = [
		'username' => $data['username'],
		'authenticated' => true,
	];

	$session->set($authData);
}

function end_session() {
	$session = session();
	$authData = ['authenticated' => false];

	$session->set($authData);
}
