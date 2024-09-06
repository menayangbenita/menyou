<?php

class Finance extends Controller
{
    protected $model_name = 'Finance_model';

    public function index()
    {
        $this->auth('user', 'Owner|Manager|Analyzer');
        csrf_generate();

        $data['title'] = 'Rekap Finance';
        $data['user'] = $this->user;

        $data['kuartal'] = intval((isset($_POST['kuartal'])) ? $_POST['kuartal'] : ceil(date('n') / 3));
        $data['tahun'] = intval((isset($_POST['tahun'])) ? $_POST['tahun'] : date('Y'));
        $data['finance'] = $this->model($this->model_name)->getDataByKuartal(
            $data['kuartal'],
            $data['tahun'],
            $this->user['outlet_uuid']
        );
        $data['akuntansi'] = $this->model('Akuntansi_model')->getAllData();

        $this->view('finance/index', $data);
    }

    public function insert()
    {
        try {
            $this->auth('user', 'Owner|Manager|Analyzer');
            csrf_validate('/finance');

            var_dump($_POST);
            
            $_POST['outlet_uuid'] = $this->user['outlet_uuid'];
            $this->model($this->model_name)->insert($_POST);

            Flasher::setFlash('Insert&nbsp<b>SUCCESS</b>', 'success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Insert&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/finance');
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
        redirectTo('/finance');
    }

    public function update()
	{
        try {
            $this->auth('user', 'Owner|Manager|Analyzer');
            csrf_validate('/finance');

            error_log(print_r($_POST, true));

            $this->model($this->model_name)->update($_POST['id'], $_POST);
            

            Flasher::setFlash('Update&nbsp<b>SUCCESS</b>','success');
        } catch (Exception $e) {
            // dd($e->getMessage());
            Flasher::setFlash('Update&nbsp<b>FAILED</b>', 'danger');
        }
        redirectTo('/finance');
	}

    public function getUbah()
    {
        $this->auth('user', 'Owner|Manager|Analyzer');
        returnJson($this->model($this->model_name)->getDataById($_POST['id']));
    }
}