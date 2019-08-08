<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi_model extends CI_Model {

	public function ambil_data_order_user_login($id_user_login = NULL)
	{
		$this->db->select('id_order, id_detail_order, tbl_order.produk_id, unit_id, user_id, qty, status, user_id, code_order_id, nama_produk, harga_produk, berat_produk, kode_produk, warna, ukuran, harga, nama_penerima, nohp_penerima, alamat_penerima, tgl_order, subtotal, kurir, ongkir, kodepos, total, bank');
		$this->db->from('tbl_order');
		$this->db->where('user_id', $id_user_login);
		$this->db->join('tbl_detail_order', 'tbl_detail_order.code_order = tbl_order.code_order_id', 'left');
		$this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_order.produk_id', 'left');
		$this->db->join('tbl_unit_produk', 'tbl_unit_produk.id_unit = tbl_order.unit_id', 'left');
		
		return $this->db->get()->result_array();
	}
}

/* End of file Konfirmasi_model.php */
/* Location: ./application/models/Konfirmasi_model.php */