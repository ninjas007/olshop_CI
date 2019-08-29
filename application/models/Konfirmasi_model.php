<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi_model extends CI_Model {

	/**
	* ambil code order by login user
	*
	* @param id user   int
	* 
	* @return data order 	object
	*/
	public function ambil_code_order_user_login($id_user_login = NULL)
	{
		$this->db->select('id_detail_order, nama_penerima, nohp_penerima, alamat_penerima, code_order, tgl_order, subtotal, kurir, ongkir, kodepos, total, bank, bukti_transfer, status_transfer');
		$this->db->from('tbl_detail_order');
		$this->db->join('tbl_order', 'tbl_order.code_order_id = tbl_detail_order.code_order', 'left');
		$this->db->where('user_id', $id_user_login);
		$this->db->where('status', 2);
		$this->db->group_by('code_order_id');
		
		return $this->db->get()->result_array();
	}

	/**
	* ambil data order for invoice
	*
	* @param id user   int
	* 
	* @return data order 	object
	*/
	public function ambil_data_order_invoice($id_user_login = NULL)
	{
		$this->db->select('*');
		$this->db->from('tbl_order');
		$this->db->where('user_id', $id_user_login);
		$this->db->join('tbl_detail_order', 'tbl_detail_order.code_order = tbl_order.code_order_id', 'left');
		$this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_order.produk_id', 'left');
		$this->db->join('tbl_unit_produk', 'tbl_unit_produk.id_unit = tbl_order.unit_id', 'left');
		$this->db->where('status', 2);
		$this->db->group_by('code_order_id');
		$this->db->order_by('id_detail_order', 'asc');
		
		return $this->db->get()->result_array();
	}

	/**
	* update bukti transfer di detail order
	*
	* @param nama file gambar   string
	* @param code order   string
	* 
	* @return affected rows
	*/
	public function update_foto_detail_order($file_name = NULL, $code_order)
	{
		$this->db->set('bukti_transfer', $file_name);
		$this->db->set('status_transfer', 1);
		$this->db->where('code_order', $code_order);
		$this->db->update('tbl_detail_order');
		
		return $this->db->affected_rows();
	}

	/**
	* ambil data per code order untuk modal invoice
	*
	* @param code order   string
	* 
	* @return orders   array
	*/
	public function ambil_data_order_per_code_order($code_order)
	{
		$this->db->select('*');
		$this->db->from('tbl_order');
		$this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_order.produk_id', 'left');
		$this->db->join('tbl_unit_produk', 'tbl_unit_produk.id_unit = tbl_order.unit_id', 'left');
		$this->db->where('code_order_id', $code_order);

		return $this->db->get()->result_array();
	}
}

/* End of file Konfirmasi_model.php */
/* Location: ./application/models/Konfirmasi_model.php */