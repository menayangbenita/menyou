<?php 

class Register extends Controller
{
  public function index()
  {
		$this->auth('guest');
		csrf_generate();
		
		$data['title'] = 'Sign Up';

		$this->view('auth/register', $data);
  }

  public function process()
  {
		try {
			$this->auth('guest');
			csrf_validate('/register');

			$this->model("User_model")->register($_POST["username"], $_POST["password"], $_POST["email"]);
			
			Flasher::setFlash('Register&nbsp<b>SUCCESS</b>! Wait the next notification from&nbsp<b>'. $_POST["email"] .'</b>&nbspor&nbsp<b>Owner</b>&nbspfor user activation!', 'success', 5000);
			redirectTo('/login');
		} catch (Exception $e) {
			Flasher::setFlash('Register&nbsp<b>FAILED</b>!', 'danger');
			redirectTo('/register');
		}
  }
}
