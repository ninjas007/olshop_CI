<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

	public function tambah_detail_order($data = [])
	{
		$this->db->insert('tbl_detail_order', $data);

		return $this->db->affected_rows();
	}

	public function tambah_order($data)
	{
		$this->db->insert_batch('tbl_order', $data);

		return $this->db->affected_rows();
	}

	public function ambil_data_order_user_login($id_user_login = NULL)
	{
		$this->db->select('id_order, code_order_id, nama_produk, qty, warna, ukuran, berat_produk, harga_produk');
		$this->db->from('tbl_order');
		$this->db->where('user_id', $id_user_login);
		$this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_order.produk_id', 'left');
		$this->db->join('tbl_unit_produk', 'tbl_unit_produk.id_unit = tbl_order.unit_id', 'left');
		$this->db->where('status', 1);
		
		return $this->db->get()->result_array();
	}

	public function ambil_code_order_user_login($id_user_login = NULL)
	{
		$this->db->select('code_order_id, SUM(qty * harga_produk) AS total_harga');
		$this->db->from('tbl_order');
		$this->db->where('user_id', $id_user_login);
		$this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_order.produk_id', 'left');
		$this->db->join('tbl_unit_produk', 'tbl_unit_produk.id_unit = tbl_order.unit_id', 'left');
		$this->db->group_by('code_order_id');
		
		return $this->db->get()->result_array();
	}


	/**
	* Order yang sudah masuk konfirmasi pembayaran
	*
	* 
	*/ 
	public function konfirmasi_pembayaran($id_order = 0)
	{	
		$this->db->select('*');
		$this->db->from('tbl_order');
		$this->db->join('tbl_detail_order', 'tbl_detail_order.code_order = tbl_order.code_order_id', 'left');
		$this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_order.produk_id', 'left');
		$this->db->join('tbl_unit_produk', 'tbl_unit_produk.id_unit = tbl_order.unit_id', 'left');
		
		return $this->db->get()->result_array();
	}

	/**
	* Batal order
	*
	* @param id order   string
	* @return affected rows
	*/
	public function delete($id = NULL)
	{
		$this->db->where('id_order', $id);
		$this->db->delete('tbl_order');

		return $this->db->affected_rows();
	}

	/**
	* set code order dan status
	*
	* @param code order   string
	* @param id order   array
	* 
	* @return affected rows
	*/
	public function update_data_order($code_order = "", $id_order = [])
	{
		$this->db->set('status', 2);
		$this->db->set('code_order_id', $code_order);
		$this->db->where_in('id_order', $id_order);
		$this->db->update('tbl_order');

		return $this->db->affected_rows();
	}
}

/* End of file Order_model.php */
/* Location: ./application/models/Order_model.php */