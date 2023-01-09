<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang_model extends CI_Model
{

    public $table = 'barang';
    public $id = 'id_barang';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_barang, barang.nama as nama_barang, kategori.nama as nama_kategori, satuan.nama as nama_satuan',false);
        $this->datatables->from('barang');
        //add this line for join
        $this->datatables->join('kategori', 'barang.kategori_id = kategori.id_kategori');
        $this->datatables->join('satuan', 'barang.satuan_id = satuan.id_satuan');
        $this->datatables->add_column('action', anchor(site_url('barang/read/$1'),'Read')." | ".anchor(site_url('barang/update/$1'),'Update')." | ".anchor(site_url('barang/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_barang');
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
        $this->db->select('id_barang, barang.nama as nama, kategori_id, satuan_id, kategori.nama as nama_kategori, satuan.nama as nama_satuan',false);
        $this->db->from('barang');
        //add this line for join
        $this->db->join('kategori', 'barang.kategori_id = kategori.id_kategori');
        $this->db->join('satuan', 'barang.satuan_id = satuan.id_satuan');
        $this->db->where('id_barang', $id);
        return $this->db->get()->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_barang', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('kategori_id', $q);
	$this->db->or_like('satuan_id', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_barang', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('kategori_id', $q);
	$this->db->or_like('satuan_id', $q);
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

/* End of file Barang_model.php */
/* Location: ./application/models/Barang_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-01-09 03:47:26 */
/* http://harviacode.com */