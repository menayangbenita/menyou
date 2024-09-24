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
    
        // Cek apakah ada filter kuartal dan tahun
        if (isset($_POST['kuartal']) && isset($_POST['tahun'])) {
            $data['kuartal'] = intval($_POST['kuartal']);
            $data['tahun'] = intval($_POST['tahun']);
            
            // Jika ada filter, ambil data yang difilter
            $data['finance'] = $this->model($this->model_name)->getDataByKuartal(
                $data['kuartal'],
                $data['tahun'],
                $this->user['outlet_uuid']
            );
        } else {
            // Jika tidak ada filter, ambil semua data
            $data['finance'] = $this->model($this->model_name)->getAllData($this->user['outlet_uuid']);
            
            // Set default kuartal dan tahun untuk tampilan
            $data['kuartal'] = ceil(date('n') / 3);
            $data['tahun'] = date('Y');
        }
    
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
    
            // Log data POST untuk memastikan input dikirim dengan benar
            error_log(print_r($_POST, true));
    
            // Pastikan ID ada dan valid
            if (empty($_POST['id'])) {
                throw new Exception("ID tidak boleh kosong");
            }
    
            // Panggil model untuk melakukan update
            $affectedRows = $this->model($this->model_name)->update($_POST['id'], $_POST);
            
            if ($affectedRows > 0) {
                Flasher::setFlash('Update&nbsp<b>SUCCESS</b>','success');
            } else {
                throw new Exception("Tidak ada data yang diupdate");
            }
    
        } catch (Exception $e) {
            // Tangkap error yang lebih detail
            Flasher::setFlash('Update&nbsp<b>FAILED</b>: ' . $e->getMessage(), 'danger');
        }
        redirectTo('/finance');
    }
    

    public function getUbah()
    {
        $this->auth('user', 'Owner|Manager|Analyzer');
        returnJson($this->model($this->model_name)->getDataById($_POST['id']));
    }
}