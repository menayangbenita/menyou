<?php 

class Prepare extends Controller
{
	protected $model_name = 'Menu_model';

	public function index()
	{
        $this->auth('user', 'Owner|Manager|Sales');
        csrf_generate();

        $data['title'] = 'Prepare';
        $data['user'] = $this->user;

        $this->view('penjualan/prepare', $data);
	}

    public function insert()
    {
        try {
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate('/');

            $this->model($this->model_name)->insert($_POST);

            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/', 200);
    }

    public function delete($id)
    {
        try {
            $this->auth('user', 'Owner|Manager|Sales');
            
            $this->model($this->model_name)->delete($id);

            Flasher::setFlash('Delete&nbsp<b>SUCCESS</b>','success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Delete&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/', 200);
    }

	public function update()
	{
        try {
            $this->auth('user', 'Owner|Manager|Sales');
            csrf_validate('/');

            $this->model($this->model_name)->update($_POST['id'], $_POST);

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>','success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/', 200);
	}

    public function getUbah()
    {
        $this->auth('user', 'Owner|Manager|Sales');
        returnJson($this->model($this->model_name)->getDataById($_POST['id']));
    }

	public function destroy()
	{
	}
}
