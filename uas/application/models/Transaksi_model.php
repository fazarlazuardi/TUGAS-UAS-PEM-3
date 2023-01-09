<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public $table = 'transaksi';
    public $id = 'id_transaksi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_transaksi,nama_transaksi,tgl_transaksi,FORMAT(harga,0) as harga,qty,transaksi.id_barang,concat(diskon,"%") as diskon,transaksi.id_pelanggan');
        $this->datatables->select('FORMAT(harga - (harga*diskon/100),0) as total', false);
        $this->datatables->select('barang.nama as nama_barang', false);
        $this->datatables->select('if(transaksi.id_pelanggan > 0, "Member", "Non Member") As status_member', false);
        $this->datatables->select('kategori.nama as nama_kategori', false);
        $this->datatables->select('IF(transaksi.id_pelanggan = 0, "-", nama_pelanggan) as napel', false);
        $this->datatables->from('transaksi');
        //add this line for join
        $this->datatables->join('pelanggan', 'transaksi.id_pelanggan = pelanggan.id_pelanggan', 'left');
        $this->datatables->join('barang', 'transaksi.id_barang = barang.id_barang');
        $this->datatables->join('kategori', 'barang.kategori_id = kategori.id_kategori');
        $this->datatables->add_column('action', anchor(site_url('transaksi/read/$1'),'Read')." | ".anchor(site_url('transaksi/update/$1'),'Update')." | ".anchor(site_url('transaksi/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_transaksi');
        return $this->datatables->generate();
    }

    function json_member($status) {
        $this->datatables->select('id_transaksi,nama_transaksi,tgl_transaksi,FORMAT(harga,0) as harga,qty,transaksi.id_barang,concat(diskon,"%") as diskon,transaksi.id_pelanggan');
        $this->datatables->select('FORMAT(harga - (harga*diskon/100),0) as total', false);
        $this->datatables->select('barang.nama as nama_barang', false);
        $this->datatables->select('if(transaksi.id_pelanggan > 0, "Member", "Non Member") As status_member', false);
        $this->datatables->select('kategori.nama as nama_kategori', false);
        $this->datatables->select('IF(transaksi.id_pelanggan = 0, "-", nama_pelanggan) as napel', false);
        $this->datatables->from('transaksi');
        if($status == 'non'){
            $this->datatables->where('transaksi.id_pelanggan', 0);
        }else{
            $this->datatables->where('transaksi.id_pelanggan !=', 0);
        }
        //add this line for join
        $this->datatables->join('pelanggan', 'transaksi.id_pelanggan = pelanggan.id_pelanggan', 'left');
        $this->datatables->join('barang', 'transaksi.id_barang = barang.id_barang');
        $this->datatables->join('kategori', 'barang.kategori_id = kategori.id_kategori');
        $this->datatables->add_column('action', anchor(site_url('transaksi/read/$1'),'Read')." | ".anchor(site_url('transaksi/update/$1'),'Update')." | ".anchor(site_url('transaksi/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_transaksi');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_transaksi', $q);
	$this->db->or_like('nama_transaksi', $q);
	$this->db->or_like('tgl_transaksi', $q);
	$this->db->or_like('harga', $q);
	$this->db->or_like('qty', $q);
	$this->db->or_like('id_barang', $q);
	$this->db->or_like('diskon', $q);
	$this->db->or_like('id_pelanggan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_transaksi', $q);
	$this->db->or_like('nama_transaksi', $q);
	$this->db->or_like('tgl_transaksi', $q);
	$this->db->or_like('harga', $q);
	$this->db->or_like('qty', $q);
	$this->db->or_like('id_barang', $q);
	$this->db->or_like('diskon', $q);
	$this->db->or_like('id_pelanggan', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-09 05:40:19 */
/* http://harviacode.com */