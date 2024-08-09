<?php 

class Users extends Controller
{
	protected $model_name = 'User_model';

	public function index()
	{
        $this->auth('user', 'Owner');
        csrf_generate();

        $data['title'] = 'Users';
        $data['user'] = $this->user;
        
        $data['users'] = $this->model($this->model_name)->getAllUser();
        $data['outlet'] = $this->model('Outlet_model')->getAllData();
        
        $this->view('admin/users', $data);
	}

    public function insert()
    {
        try {
            $this->auth('user', 'Owner');
            csrf_validate('/users');

            // Sanitize role
            $_POST['role'] = $_POST['role'] !== "null" ? $_POST['role'] : null;
            
            $this->model($this->model_name)->insert($_POST);
            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/users');
    }

	public function update($id)
	{
        try {
            $this->auth('user', 'Owner');
            csrf_validate('/users');
            
            // Sanitize role
            $_POST['role'] = $_POST['role'] !== "null" ? $_POST['role'] : null;

            $this->model($this->model_name)->update($id, $_POST, true);
            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/users');
	}

    public function activateUser($user_id)
    {
        try {
            $this->auth('user', 'Owner');
            csrf_validate('/users');

            // Password validation
            $owner = $this->model('User_model')->getUserBy('role', 'Owner');

            if (hash('sha256', $_POST['password']) !== $owner['password'])
                throw new Exception('<b>Wrong</b>&nbsppassword!');

            // Try to send email notification
            $user = $this->model($this->model_name)->getUserById($user_id);

            $mail = Mailer::send(
                ['masando0110@gmail.com', 'SPOSERP'], [$user['email'], $user['username']],
                "Registrasi User SPOSERP",
                '<div style="font-family: Arial, sans-serif; font-size: 14px; line-height: 1.5; color: #333; background-color: #f9f9f9; padding: 20px;">
                    <h1 style="font-size: 24px; font-weight: bold; color: #444; margin-top: 0;">Halo '. $user['username'] .'</h1>
                    <p style="margin-bottom: 20px;">Terima kasih telah mendaftar di situs kami. Akun Anda telah kami aktivasi. Silakan klik tombol dibawah ini untuk memulai menggunakan akun Anda.</p>
                    <a href="'.BASEURL.'" style="background-color: #4CAF50; color: white; padding: 8px 16px; text-align: center; text-decoration: none; display: inline-block; border-radius: 4px;">Masuk</a>
                    <p style="margin-bottom: 20px;">Jika Anda tidak pernah mendaftar di situs kami, silakan ignore email ini.</p>
                    <p style="margin-bottom: 20px;">Terima kasih.</p>
                </div>'
            );
            
            // Activate user
            if ($this->model($this->model_name)->activateUser($user_id, $_POST['outlet_uuid'], $_POST['role']) == 0)
                throw new Exception('Update&nbsp<b>FAILED</b>');

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>.' . ($mail !== true) ? 'Email was send to&nbsp<b>'.$user['email'].'</b>' : '', 'success');
        } catch (Exception $e) {
            Flasher::setFlash($e->getMessage(), 'danger');
        }
        redirectTo('/users');
    }

    public function getUbah()
    {
        $this->auth('user', 'Owner');
        returnJson($this->model($this->model_name)->getUserById($_POST['id'])); 
    }

	public function destroy($id)
	{
        try {
            $this->auth('user', 'Owner');
            
            $this->model($this->model_name)->destroy($id);

            Flasher::setFlash('Delete&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Delete&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/users');
	}
}
