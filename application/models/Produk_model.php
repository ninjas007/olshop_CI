<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

	public function get_produk_unit()
	{
		$this->db->select('*');
		$this->db->from('tbl_unit_produk');
		$this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_unit_produk.produk_id', 'inner');
		$this->db->join('tbl_kategori_produk', 'tbl_kategori_produk.id_kategori = tbl_produk.kategori_produk_id', 'inner');
		
		return $this->db->get()->result_array();
	}

	public function get_produk_by_category($query = null, $start = 0)
	{	
		if ($query)
		{
			$this->db->like('nama_produk', $query, 'after');
		}

		return $this->db->get('tbl_produk', 6, $start)->result_array();
	}

	public function count_produk($query = null)
	{
		if ($query)
		{
			$this->db->like('nama_produk', $query, 'after');
		}

		return $this->db->get('tbl_produk')->num_rows();
	}

	public function detail_produk($idProduk = null)
	{
		$this->db->select('*');
		$this->db->select('IFNULL(warna, "-" ) AS warna, IFNULL(ukuran, "-" ) AS ukuran, IFNULL(harga, "-" ) AS harga');
		$this->db->from('tbl_produk');
		$this->db->join('tbl_unit_produk', 'tbl_unit_produk.produk_id = tbl_produk.id_produk', 'left');
		$this->db->join('tbl_kategori_produk', 'tbl_kategori_produk.id_kategori = tbl_produk.kategori_produk_id', 'right');
		$this->db->where('id_produk', $idProduk);

		return $this->db->get()->result_array();
	}

	public function list_produk_per_kategori($id_kategori = NULL)
	{
		$this->db->select('*');
		$this->db->from('tbl_produk');
		$this->db->where('kategori_produk_id', $id_kategori);

		return $this->db->get()->result_array();
	}

}

/* End of file Produk_model.php */
/* Location: ./application/models/Produk_model.php */