<?php 

class Controller_template extends Controller
{
	protected $model_name = 'Template_model';

	public function index()
	{
        $this->auth('user');
        csrf_generate();

        $data['title'] = 'Title';
        $data['user'] = $this->user;

        $this->view('example/index', $data);
	}

    public function insert()
    {
        try {
            $this->auth('user');
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
            $this->auth('user');
            
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
            $this->auth('user');
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
        $this->auth('user');
        returnJson($this->model($this->model_name)->getDataById($_POST['id']));
    }

	public function destroy()
	{
	}
}
