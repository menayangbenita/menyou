<?php 

class Profile extends Controller
{
	protected $model_name = 'User_model';

	public function index()
	{
		$this->auth('user');
		csrf_generate();

		$data['title'] = 'Profile';
		$data['user'] = $this->user;

		$this->view('auth/profile', $data);
	}

	public function changePassword()
	{
		try {
			$this->auth('user');
			csrf_validate('/profile');

			$res = $this->model("User_model")->changePassword($_POST['id'], $_POST);
			if ($res) throw new Exception('Haha eror');

			$payload = [
				'sub' => $this->user['id'],
				'name' => $this->user['username'],
				'password' => hash('sha256', $_POST['new_password']),
				'exp' =>  time() + (7 * 24 * 60 * 60) // Token expired after 1 day
			];
			Cookie::create_jwt($payload, $payload['exp']);

			Flasher::setFlash('Change Password&nbsp<b>SUCCESS</b>!', 'success');
		} catch (Exception $e) {
			// dd($e->getMessage());
			Flasher::setFlash('<b>Wrong</b>&nbspPassword!', 'danger');
		}
		redirectTo('/profile');
	}

	public function update()
	{
		try {
			$this->auth('user');
			csrf_validate('/profile');
			
			$res = $this->model("User_model")->update($_POST['id'], $_POST);
			if ($res) throw new Exception('Haha eror');

			$payload = [
				'sub' => $this->user['id'],
				'name' => $_POST['username'],
				'password' => $this->user['password'],
				'exp' =>  time() + (7 * 24 * 60 * 60) // Token expired after 1 day
			];
			Cookie::create_jwt($payload, $payload['exp']);
			
			Flasher::setFlash('Change Password &nbsp<b>SUCCESS</b>!', 'success');
		} catch (Exception $e) {
			// dd($e->getMessage());
			Flasher::setFlash('Change Password &nbsp<b>FAILED</b>!', 'danger');
		}
		redirectTo('/profile');
	}
}

?>