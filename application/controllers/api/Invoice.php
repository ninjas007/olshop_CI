<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
	
	public function modal()
	{
		$this->load->model('konfirmasi_model');

		$orders = $this->konfirmasi_model->ambil_data_order_per_code_order($this->input->get('code_order'));
		$output = '
			<tr>
				<th>Item</th>
				<th>Satuan</th>
				<th>Total</th>
			</tr>';

		foreach ($orders as $item)
		{
			$output .= "
			<tr>
				<td width='60%'>" .$item['nama_produk']. "<br>
					" .$item['warna']. " ( " .$item['ukuran']. " ) " .$item['berat_produk']. "gr x " .$item['qty']. "
				</td>
				<td>" .number_format($item['harga_produk'], 0,',',','). "</td>
				<td>" .number_format($item['harga_produk'] * $item['qty'], 0,',',','). "</td>
			</tr>";

		}


		$this->output->set_content_type('application/json')->set_output($output);
	}

}

/* End of file Invoice.php */
/* Location: ./application/controllers/api/Invoice.php */