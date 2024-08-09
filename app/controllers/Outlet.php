<?php 

class Outlet extends Controller
{
	protected $model_name = 'Outlet_model';

	public function index()
	{
        $this->auth('user', 'Owner|Manager');

        $data['title'] = 'Outlet';
        $data['user'] = $this->user;

        $data['outlet'] = $this->model($this->model_name)->getAllData();
        $data['users'] = ($this->user['role'] == "Owner") ?
            $this->model('User_model')->getAllUser(true, false):
            [$this->model('User_model')->getUserById($this->user['id'])];

        $this->view('outlet/index', $data);
    }

	public function detail($uuid)
	{
        $this->auth('user', 'Owner|Manager');

        $data['title'] = 'Details Outlet';
        $data['user'] = $this->user;

        $data['outlet'] = $this->model($this->model_name)->getDataByUuid($uuid);
        $data['menu'] = $this->model('Menu_model')->getAllData($uuid);
        $data['karyawan'] = $this->model('Karyawan_model')->getAllData($uuid);
        $data['barang'] = $this->model('Stok_model')->getAllData($uuid);
        $finance = $this->model('Finance_model')->getKreditAndDebitOutlet($uuid);
        $data['finance'] = ['masuk' => 0, 'keluar' => 0];

        if ($finance)
            foreach ($finance as $sum) 
                $data['finance'][$sum['kategori']] = $sum['total'];

        $this->view('outlet/detail', $data);
    }

    public function insert()
    {
        try {
            $this->auth('user', 'Owner|Manager');
            csrf_validate('/outlet');

            // Change manager_id if empty
            $_POST['manager_id'] = $_POST['manager_id'] === 'null' ? null : $_POST['manager_id'];

            // Add outlet data
            $result = $this->model($this->model_name)->insert($_POST);
            if ($result == 0) throw new Exception('Haha error');

            // Set manager outlet uuid
            if (!empty($result[0])) {
                $result = $this->model("User_model")->setOutletUuid($result[0], $result[1]);
                if ($result == 0) throw new Exception('Haha error');
            }

            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/outlet');
    }

    public function delete($id)
    {
        try {
            $this->auth('user', 'Owner|Manager');

            $this->model($this->model_name)->delete($id);

            Flasher::setFlash('Delete&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Delete&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/outlet');
    }

    public function changeUserAccess($user_id)
    {
        try {
            $this->auth('user', 'Owner|Manager');
            csrf_validate('/outlet');

            $owner = $this->model('User_model')->getUserBy('role', 'Owner');

            if (hash('sha256', $_POST['password']) !== $owner['password'])
                throw new Exception('<b>Wrong</b>&nbsppassword!');

            if ($this->model("User_model")->setOutletUuid($user_id, $_POST['outlet_uuid']) == 0)
                throw new Exception('Update&nbsp<b>FAILED</b>');

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash($e->getMessage(), 'danger');
        }
        redirectTo('/outlet');
    }

	public function update()
	{
        try {
            $this->auth('user', 'Owner|Manager');
            csrf_validate('/outlet');

            // Change manager_id if empty
            $_POST['manager_id'] = $_POST['manager_id'] === 'null' ? null : $_POST['manager_id'];

            $this->model($this->model_name)->update($_POST['id'], $_POST);
            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
        } catch(Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/outlet');
	}

    public function getUbah()
    {
        $this->auth('user', 'Owner|Manager');
        returnJson($this->model($this->model_name)->getDataById($_POST['id']));
    }

	public function destroy()
	{
	}
}
