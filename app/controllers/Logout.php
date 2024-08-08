<?php

class Logout extends Controller
{
	protected $model_name = 'User_model';

	public function index()
	{
		$this->auth('user');

		try {
			$this->model($this->model_name)->logout($this->user['id']);
			Cookie::delete_jwt();
			Flasher::setFlash('Logout&nbsp<b>SUCCESS</b>', 'success');
		} catch (Exception) {
			Flasher::setFlash('<b>FAILED</b> to logout. Try again later.', 'danger');
		}
		
		redirectTo('/');
	}
}
