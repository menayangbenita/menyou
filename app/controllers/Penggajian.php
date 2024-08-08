<?php

class Penggajian extends Controller
{
    public function index()
    {
        $this->auth('user', 'Owner|Manager|HR');

        $data['title'] = 'Penggajian';
        $data['user'] = $this->user;
        
        $data['filter'] = [
            'bulan' => intval((isset($_POST['bulan'])) ? $_POST['bulan'] : date('m')),
            'tahun' => intval((isset($_POST['tahun'])) ? $_POST['tahun'] : date('Y')),
        ];

        $data['karyawan'] = $this->model('Karyawan_model')
            ->getAllSalaryByMonthYear($data['filter']['bulan'], $data['filter']['tahun'], $this->user['outlet_uuid']);

        $this->view('karyawan/penggajian', $data);
    }

    public function print($bulan, $tahun, $uuid)
    {
        $this->auth('user', 'Owner|Manager|HR');

        $data['title'] = 'Print Penggajian';
        $data['user'] = $this->user;

        $data['reward_punishment'] = $this->model('Rewardpunishment_model')->getDataByMonthYear($bulan, $tahun);
        $data['karyawan'] = $this->model('Karyawan_model')->getDataByUuid($uuid);        
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->view('karyawan/cetakPenggajian', $data);
    }
}