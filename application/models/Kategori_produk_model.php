<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_produk_model extends CI_Model {

	public function get_kategori()
	{	
		$this->db->select('*');
		$this->db->from('tbl_kategori_produk');

		return $this->db->get()->result_array();
	}

}

/* End of file Kategori_produk_model.php */
/* Location: ./application/models/Kategori_produk_model.php */