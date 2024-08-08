<?php

class Supplier extends Controller
{
	protected $model_name = 'Supplier_model';

	public function index()
	{
		$this->auth('user', 'Owner|Manager|Warehouse');
        csrf_generate();

		$data['title'] = 'Home';
		$data['user'] = $this->user;
        
        $data['supplier'] = $this->model($this->model_name)->getAllData($this->user['outlet_uuid']);
		
		$this->view('stok/supplier', $data);
	}

    public function insert()
    {
        try {
            $this->auth('user', 'Owner|Manager|Warehouse');
            csrf_validate('/supplier');

            $_POST['outlet_uuid'] = $this->user['outlet_uuid'];
            $this->model($this->model_name)->insert($_POST);

            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/supplier');
    }

    public function delete($id)
    {
        try {
            $this->model($this->model_name)->delete($id);

            Flasher::setFlash('Delete&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Delete&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/supplier');
    }

	public function update()
    {
        try {
            $this->auth('user', 'Owner|Manager|Warehouse');
            csrf_validate('/supplier');

            $this->model($this->model_name)->update($_POST['id'], $_POST);

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/supplier');
    }


    public function getUbah()
    {
        $this->auth('user', 'Owner|Manager|Warehouse');
        returnJson($this->model($this->model_name)->getDataById($_POST['id'])); 
    }

	public function destroy()
	{
	}
}
