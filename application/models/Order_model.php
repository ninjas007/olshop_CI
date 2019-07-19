<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

	public function tambahDetailOrder($data = [])
	{
		$this->db->insert('tbl_detail_order', $data);

		return $this->db->affected_rows();
	}

	public function tambahOrder($data)
	{
		$this->db->insert_batch('tbl_order', $data);

		return $this->db->affected_rows();
	}

}

/* End of file Order_model.php */
/* Location: ./application/models/Order_model.php */