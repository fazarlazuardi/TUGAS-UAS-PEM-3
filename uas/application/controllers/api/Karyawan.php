<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends BD_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_get()
    {
        $karyawan = $this->db->get('karyawan')->result();
        $data = $karyawan;
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    public function detail_get($id)
    {
        $karyawan = $this->db->where('id',$id)->get('karyawan')->row();
        $akademis = $this->db->where('karyawan_id',$id)->get('riwayat_akademis')->row();
        $data = array('karyawan' => $karyawan, 'akademis' => $akademis);
        $this->set_response($data, REST_Controller::HTTP_OK);
    }
}