<?php defined('BASEPATH') OR exit ('No direct sript access allowed');

class Toko_model extends CI_Model
{
    public function ambil_data_toko()
    {
    	$this->db->select('*');
    	$this->db->from('tbl_toko');
    	$this->db->join('tbl_bank', 'tbl_bank.id_bank = tbl_toko.id_toko', 'left');

    	return $this->db->get()->result_array();
    }
}