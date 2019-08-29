<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_model extends CI_Model {

	public function ambil_data_order()
	{
		$this->db->select('*');
		$this->db->from('tbl_detail_order');
		$this->db->order_by('id_detail_order', 'desc');
		// $this->db->join('tbl_detail_order', 'tbl_detail_order.code_order = tbl_order.code_order_id', 'left');

		return $this->db->get()->result_array();
	}

	public function ambil_data_order_lunas()
	{
		$this->db->select('*');
		$this->db->from('tbl_detail_order');
		$this->db->where('status_transfer', '2');
		$this->db->order_by('id_detail_order', 'desc');

		return $this->db->get()->result_array();
	}

	public function update_status_order($code_orders = [])
	{
		$this->db->set('status_transfer', 2);
		$this->db->where_in('code_order', $code_orders);
		$this->db->update('tbl_detail_order');

		return $this->db->affected_rows();
	}

	public function update_status_transfer($status_transfer, $code_order)
	{
		$this->db->trans_start();
		$data = [];
		foreach ($status_transfer as $key => $status) {
			$data[] = [
				'code_order' => $code_order[$key],
				'status_transfer' => $status,
			];
		}

		$this->db->update_batch('tbl_detail_order', $data, 'code_order');
		
		$this->db->trans_complete();

		if ( $this->db->trans_status() != FALSE )
		{
			return TRUE;
		}
	}

}

/* End of file Orders_model.php */
/* Location: ./application/models/Orders_model.php */