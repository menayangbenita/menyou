<?php

class Login extends Controller
{
	protected $model_name = "User_model";

	public function index()
	{
		$this->auth('guest');
		csrf_generate();

		$data['title'] = 'Sign In';

		$this->view('auth/login', $data);
	}

	public function process()
	{
		$this->auth('guest');
		csrf_validate('/login');

		if (isset($_POST['username']) && isset($_POST['password'])) {
			$user = $this->model($this->model_name)->getUser($_POST['username'], hash('sha256', $_POST['password']));

			if ($user) {
				if ($this->model($this->model_name)->login($user['id']) > 0) {
					$payload = [
						'sub' => $user['id'],
						'name' => $user['username'],
						'password' => $user['password'],
						'exp' =>  time() + (7 * 24 * 60 * 60) // Token expired after 1 day
					];

					Cookie::create_jwt($payload, $payload['exp']);

					Flasher::setFlash('Login&nbsp<b>SUCCESS</b>', 'success');

				} else {
                    Flasher::setFlash('Login&nbsp<b>FAILED</b>', 'danger');
                }
			} else {
				Flasher::setFlash('Username or Password&nbsp<b>INCORRECT</b>!', 'danger');
			}
		} else {
			Flasher::setFlash('Fill all the column first!', 'danger');
		}
        
        redirectTo('/');
	}
}
