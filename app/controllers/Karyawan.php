<?php

class Karyawan extends Controller
{
    protected $model_name = 'Karyawan_model';

    public function index()
    {
        $this->auth('user', 'Owner|Manager|HR');
        csrf_generate();

        $data['title'] = 'Manage Karyawan';
        $data['user'] = $this->user;

        $data['outlet'] = $this->model("Outlet_model")->getAllData();
        $data['karyawan'] = $this->model($this->model_name)->getAllData($this->user['outlet_uuid']);

        $this->view('karyawan/index', $data);
    }

    public function detail($id)
    {
        $this->auth('user');

        $data['title'] = 'Detail Karyawan';
        $data['user'] = $this->user;

        $data['karyawan'] = $this->model($this->model_name)->getDataByid($id);

        $this->view('karyawan/detail', $data);
    }


    public function insert()
    {
        try {
            $this->auth('user', 'Owner|Manager|HR');
            csrf_validate('/karyawan');

            if ($_POST['outlet_uuid'] == 'null') $_POST['outlet_uuid'] = NULL;
            $this->model($this->model_name)->insert($_POST);

            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/karyawan');
    }

    public function delete($id)
    {
        try {
            $this->auth('user', 'Owner|Manager|HR');
            
            $this->model($this->model_name)->delete($id);

            Flasher::setFlash('Delete&nbsp<b>SUCCESS</b>','success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Delete&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/karyawan');
    }

    public function update()
    {
        try {
            $this->auth('user', 'Owner|Manager|HR');
            csrf_validate('/karyawan');

            if ($_POST['outlet_uuid'] == 'null') $_POST['outlet_uuid'] = NULL;
            $this->model($this->model_name)->update($_POST['id'], $_POST);

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>','success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/karyawan');
    }

    public function getUbah()
    {
        $this->auth('user', 'Owner|Manager|HR');
        returnJson($this->model($this->model_name)->getDataById($_POST['id']));
    }

    public function destroy()
    {
    }
}
