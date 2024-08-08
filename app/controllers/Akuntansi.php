<?php 

class Akuntansi extends Controller
{
	protected $model_name = 'Akuntansi_model';

	public function index()
	{
        $this->auth('user', 'Owner|Manager|Analyzer');
        csrf_generate();

        $data['title'] = 'No Akun Akuntansi';
        $data['user'] = $this->user;

        $data['akuntansi'] = $this->model($this->model_name)->getAllData();

        $this->view('finance/noakun', $data);
	}

    public function insert()
    {
        try {
            $this->auth('user', 'Owner|Manager|Analyzer');
            csrf_validate('/akuntansi');
            
            $_POST['outlet_uuid'] = $this->user['outlet_uuid'];
            $this->model($this->model_name)->insert($_POST);

            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/akuntansi');
    }

    public function delete($id)
    {
        try {
            $this->auth('user', 'Owner|Manager|Analyzer');
            
            $this->model($this->model_name)->delete($id);

            Flasher::setFlash('Delete&nbsp<b>SUCCESS</b>','success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Delete&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/akuntansi');
    }

	public function update()
	{
        try {
            $this->auth('user', 'Owner|Manager|Analyzer');
            csrf_validate('/akuntansi');

            $this->model($this->model_name)->update($_POST['id'], $_POST);

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>','success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/akuntansi');
	}

    public function getUbah()
    {
        $this->auth('user', 'Owner|Manager|Analyzer');
        returnJson($this->model($this->model_name)->getDataById($_POST['id']));
    }

	public function destroy()
	{
	}
}
