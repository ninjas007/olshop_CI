<?php
function formatAngka($number) {
	return number_format($number, 0,',',',');
}
?>
<div class="card">
	<div class="card-header">Konfirmasi Pembayaran</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-12 p-0">
				<table class="table">
					<thead>
						<tr>
							<th>No Order</th>
							<th>Bukti Transfer</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($detail_order as $d_order): ?>
						<tr>
							<td>
								<a data-toggle="collapse" href="<?php echo '#collapseOrder' .$d_order['id_detail_order']. '' ?>">
									<span class="badge badge-primary badge-pill p-2 px-3"><?php echo $d_order['code_order'] ?></span>
								</a>
							</td>
							<td>
								<a href="<?php echo '#modalUpload' .$d_order['id_detail_order']. '' ?>" data-toggle="modal"><span class="badge badge-secondary badge-pill p-2 px-3">Upload</span></a>
							</td>
							<td><?php echo strtoupper($d_order['status_transfer']) ?></td>
						</tr>
						<tr>
							<td colspan="4">
								<div class="collapse" id="<?php echo 'collapseOrder' .$d_order['id_detail_order']. '' ?>">
									<div class="card" style="font-size: 12px !important;">
										<div class="card-header">
											<div class="row mb-2">
												<div class="col-md-8">
													<div class="card-text"><b>No Invoice :</b> <?php echo $d_order['code_order'] ?></div>
													<div class="card-text"><b>Tanggal Order : </b><?php echo $d_order['tgl_order'] ?></div>
												</div>
												<div class="col-md-4 float-right text-center">
													<p class="card-text font-weight-bold">BISNIS IMPORT</p>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-md-8 py-2">
													<div class="font-weight-bold">Penerima :</div>
													<div class="card-text text-justify">Nama : <?php echo $d_order['nama_penerima'] ?></div>
													<div class="card-text text-justify">No Hp : <?php echo $d_order['nohp_penerima'] ?></div>
													<div class="card-text text-justify">Alamat : <?php echo $d_order['alamat_penerima'] ?></div>
													<div class="card-text">Kodepos : <?php echo $d_order['kodepos'] ?></div>
													<div class="card-text">Kurir : <?php echo $d_order['kurir'] ?></div>
												</div>
												<div class="col-md-4 py-2">
													<div class="font-weight-bold">Pengirim :</div>
													<div class="card-text"><?php echo $toko[0]['nama_toko'] ?></div>
													<div class="card-text"><?php echo $toko[0]['nohp_toko'] ?></div>
													<div class="card-text"><?php echo $toko[0]['alamat_toko'] ?></div>
												</div>
											</div>
											<div class="row mt-3 mb-3">
												<div class="col-md-12">
													
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 p-0">
													<table class="table">
														<tbody>
															<tr>
																<th>Item</th>
																<th>Satuan</th>
																<th>Total</th>
															</tr>
															<?php foreach ($orders as $item): ?>
															
															<tr>
																<td>
																	<?php
																		echo $item['nama_produk'] .'<br>' .
																			$item['warna'] .
																			' (' .$item['ukuran']. ') ' .
																			$item['berat_produk'] . 'gr x ' .
																			$item['qty'];
																	?>
																</td>
																<td><?php echo formatAngka($item['harga_produk']) ?></td>
																<td><?php echo formatAngka($item['harga_produk'] * $item['qty'])?></td>
															</tr>
															
															<?php endforeach ?>
															<tr><td colspan="3"><div class="border"></div></td></tr>
															<tr>
																<td class="py-1 font-weight-bold">Total Harga Produk : <?php echo formatAngka($d_order['subtotal']) ?></td>
																<td class="py-1 font-weight-bold">Total Bayar : <?php echo formatAngka($d_order['total']) ?></td>
															</tr>
															<tr><td class="py-1 font-weight-bold">Total Ongkir : <?php echo formatAngka($d_order['ongkir']) ?></td></tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<div class="card-footer text-center p-0">
											<p class="card-text bg-primary text-light p-2">Silahkan Transfer ke Rekening <br> BNI 2654848184181 atas nama Cokro Winata <br>Pastikan transfer ke rekening yang benar.</p>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<!-- Modal -->
						<form action="<?php echo base_url() ?>">
							<div class="modal fade" id="<?php echo 'modalUpload' .$d_order['id_detail_order']. '' ?>">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Bukti Transfer</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<input type="file" class="form-control mb-2">
											<img src="http://placehold.it/250x250" width="100%">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary btn-sm">Save changes</button>
										</div>
									</div>
								</div>
							</div>
						</form>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>