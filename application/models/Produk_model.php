<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

	public function getProduk()
	{
		$this->db->select('*');
		$this->db->from('tbl_produk');
		$this->db->join('tbl_kategori_produk', 'tbl_kategori_produk.id_kategori = tbl_produk.kategori_produk_id', 'inner');
		
		return $this->db->get()->result_array();
	}	

}

/* End of file Produk_model.php */
/* Location: ./application/models/Produk_model.php */