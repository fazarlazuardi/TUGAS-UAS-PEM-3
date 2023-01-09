<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('transaksi/transaksi_list');
        $this->load->view('template/footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        error_reporting(0);
        echo $this->Transaksi_model->json();
    }

    public function member($status)
    {
        $data['status'] = $status;
        $this->load->view('template/header');
        $this->load->view('transaksi/member', $data);
        $this->load->view('template/footer');
    } 
    
    public function json_member($status) {
        header('Content-Type: application/json');
        error_reporting(0);
        echo $this->Transaksi_model->json_member($status);
    }

    public function read($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_transaksi' => $row->id_transaksi,
		'nama_transaksi' => $row->nama_transaksi,
		'tgl_transaksi' => $row->tgl_transaksi,
		'harga' => $row->harga,
		'qty' => $row->qty,
		'id_barang' => $row->id_barang,
		'diskon' => $row->diskon,
		'id_pelanggan' => $row->id_pelanggan,
	    );
            $this->load->view('template/header');
            $this->load->view('transaksi/transaksi_read', $data);
            $this->load->view('template/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('transaksi/create_action'),
	    'id_transaksi' => set_value('id_transaksi'),
	    'nama_transaksi' => set_value('nama_transaksi'),
	    'tgl_transaksi' => set_value('tgl_transaksi'),
	    'harga' => set_value('harga'),
	    'qty' => set_value('qty'),
	    'id_barang' => set_value('id_barang'),
	    'diskon' => set_value('diskon'),
	    'id_pelanggan' => set_value('id_pelanggan'),
	);
            $this->load->view('template/header');
            $this->load->view('transaksi/transaksi_form', $data);
            $this->load->view('template/footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $diskon = ($this->input->post('id_pelanggan') > 0 ? 5 : 2);
            $data = array(
                'nama_transaksi' => $this->input->post('nama_transaksi',TRUE),
                'tgl_transaksi' => $this->input->post('tgl_transaksi',TRUE),
                'harga' => $this->input->post('harga',TRUE),
                'qty' => $this->input->post('qty',TRUE),
                'id_barang' => $this->input->post('id_barang',TRUE),
                'diskon' => $diskon,
                'id_pelanggan' => $this->input->post('id_pelanggan',TRUE),
            );

            $this->Transaksi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transaksi/create'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi/update_action'),
		'id_transaksi' => set_value('id_transaksi', $row->id_transaksi),
		'nama_transaksi' => set_value('nama_transaksi', $row->nama_transaksi),
		'tgl_transaksi' => set_value('tgl_transaksi', $row->tgl_transaksi),
		'harga' => set_value('harga', $row->harga),
		'qty' => set_value('qty', $row->qty),
		'id_barang' => set_value('id_barang', $row->id_barang),
		'diskon' => set_value('diskon', $row->diskon),
		'id_pelanggan' => set_value('id_pelanggan', $row->id_pelanggan),
	    );
            $this->load->view('template/header');
            $this->load->view('transaksi/transaksi_form', $data);
            $this->load->view('template/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_transaksi', TRUE));
        } else {
            $data = array(
		'nama_transaksi' => $this->input->post('nama_transaksi',TRUE),
		'tgl_transaksi' => $this->input->post('tgl_transaksi',TRUE),
		'harga' => $this->input->post('harga',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'id_barang' => $this->input->post('id_barang',TRUE),
		'diskon' => $this->input->post('diskon',TRUE),
		'id_pelanggan' => $this->input->post('id_pelanggan',TRUE),
	    );

            $this->Transaksi_model->update($this->input->post('id_transaksi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);

        if ($row) {
            $this->Transaksi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_transaksi', 'nama transaksi', 'trim|required');
	$this->form_validation->set_rules('tgl_transaksi', 'tgl transaksi', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');
	$this->form_validation->set_rules('qty', 'qty', 'trim|required');
	$this->form_validation->set_rules('id_barang', 'id barang', 'trim|required');
	// $this->form_validation->set_rules('diskon', 'diskon', 'trim|required');
	// $this->form_validation->set_rules('id_pelanggan', 'id pelanggan', 'trim|required');

	$this->form_validation->set_rules('id_transaksi', 'id_transaksi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "transaksi.xls";
        $judul = "transaksi";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Transaksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Transaksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga");
	xlsWriteLabel($tablehead, $kolomhead++, "Qty");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Diskon");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Pelanggan");

	foreach ($this->Transaksi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_transaksi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
	    xlsWriteNumber($tablebody, $kolombody++, $data->harga);
	    xlsWriteNumber($tablebody, $kolombody++, $data->qty);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_barang);
	    xlsWriteNumber($tablebody, $kolombody++, $data->diskon);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_pelanggan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-09 05:40:19 */
/* http://harviacode.com */