<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

	/**
	* tambah detail order dan update data order by id
	*
	* @param data penerima   object
	* @param code order   string
	* @param id order   object
	* 
	* @return affected rows
	*/
	public function add_detail_order_and_update_order($data = [], $code_order = NULL, $id_order = [])
	{
		$this->db->trans_start();
		
		$this->db->insert('tbl_detail_order', $data); // insert ke table order

		$this->db->set('status', 2);
		$this->db->set('code_order_id', $code_order);
		$this->db->where_in('id_order', $id_order);
		$this->db->update('tbl_order');
		
		$this->db->trans_complete();

		if ( $this->db->trans_status() != FALSE )
		{
			return TRUE;
		}
		
	}

	/**
	* tambah order dari cart
	*
	* @param product item order   object
	* 
	* @return affected rows
	*/
	public function tambah_order($data)
	{
		$this->db->trans_start();
		$this->db->insert_batch('tbl_order', $data);
		$this->db->trans_complete();

		if ( $this->db->trans_status() != FALSE )
		{
			return TRUE;
		}
	}

	/**
	* ambil data order by login user
	*
	* @param id user   int
	* 
	* @return data order 	object
	*/
	public function ambil_data_order_checkout($id_user_login = NULL)
	{
		$this->db->select('id_order, code_order_id, nama_produk, qty, warna, ukuran, berat_produk, harga_produk');
		$this->db->from('tbl_order');
		$this->db->where('user_id', $id_user_login);
		$this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_order.produk_id', 'left');
		$this->db->join('tbl_unit_produk', 'tbl_unit_produk.id_unit = tbl_order.unit_id', 'left');
		$this->db->where('status', 1);
		
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

}

/* End of file Order_model.php */
/* Location: ./application/models/Order_model.php */