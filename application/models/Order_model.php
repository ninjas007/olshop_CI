<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

	public function add($data = [])
	{
		$this->db->insert('tbl_order', $data);

		return $this->db->affected_rows();;
	}

}

/* End of file Order_model.php */
/* Location: ./application/models/Order_model.php */