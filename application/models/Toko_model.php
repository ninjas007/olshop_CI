<?php defined('BASEPATH') OR exit ('No direct sript access allowed');

class Toko_model extends CI_Model
{
    public function ambil_data_toko()
    {
    	return $this->db->get('tbl_toko')->result_array();
    }
}