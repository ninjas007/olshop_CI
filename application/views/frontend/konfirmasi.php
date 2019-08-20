<?php
function formatAngka($number) {
	return number_format($number, 0,',',',');
}
?>
<table width="50%" style="display: flex; justify-content: center; align-items: center; margin: auto;">
	<tr>
		<td>
			<div class="card">
				<div class="card-header">
					Konfirmasi Pembayaran
					<a href="<?php echo base_url('home') ?>" class="btn btn-success btn-sm float-right">Back to Home</a>
				</div>
				<div class="card-body">
					<table width="100%">
						<tr>
							<td>
								<?php echo $this->session->flashdata('alert') ?>
								<table width="100%">
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
												<a data-toggle="modal" href="<?php echo '#modalOrder' .$d_order['code_order']. '' ?>" onclick="modalOrder('<?php echo $d_order['code_order'] ?>')">
													<span class="badge badge-primary badge-pill p-2 px-3"><?php echo $d_order['code_order'] ?></span>
												</a>
											</td>
											<td>
												<a href="<?php echo '#modalUpload' .$d_order['id_detail_order']. '' ?>" data-toggle="modal"><span class="badge badge-secondary badge-pill p-2 px-3">Upload</span></a>
											</td>
											<td><?php echo strtoupper($d_order['status_transfer']) ?></td>
										</tr>
										<tr style="font-size: 10px;">
											<td>
												<div class="modal fade" id="<?php echo 'modalOrder' .$d_order['code_order']. '' ?>">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="exampleModalLabel">Detail Invoice</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<div class="card">
																	<div class="card-header p-0">
																		<table width="100%">
																			<tr>
																				<td width="60%">
																					<div class="card-text"><b>No Invoice :</b> <?php echo $d_order['code_order'] ?></div>
																					<div class="card-text"><b>Tanggal Order : </b><?php echo $d_order['tgl_order'] ?></div>
																				</td>
																				<td align="center"><p class="card-text font-weight-bold text-primary">BISNIS IMPORT</p></td>
																			</tr>
																		</table>
																		<hr>
																		<table width="100%">
																			<tr>
																				<td width="60%">
																					<div class="font-weight-bold">Penerima :</div>
																					<div class="card-text text-justify">Nama : <?php echo $d_order['nama_penerima'] ?></div>
																					<div class="card-text text-justify">No Hp : <?php echo $d_order['nohp_penerima'] ?></div>
																					<div class="card-text text-justify">Alamat : <?php echo $d_order['alamat_penerima'] ?></div>
																					<div class="card-text">Kodepos : <?php echo $d_order['kodepos'] ?></div>
																					<div class="card-text">Kurir : <?php echo $d_order['kurir'] ?></div>
																				</td>
																				<td>
																					<div class="font-weight-bold">Pengirim :</div>
																					<div class="card-text"><?php echo $toko[0]['nama_toko'] ?></div>
																					<div class="card-text"><?php echo $toko[0]['nohp_toko'] ?></div>
																					<div class="card-text"><?php echo $toko[0]['alamat_toko'] ?></div>
																				</td>
																			</tr>
																		</table>
																	</div>
																	<div class="card-body p-0">
																		<table width="100%" class="table-invoice">
																			<tbody>
																				<!-- Inject order here-->
																			</tbody>
																		</table>
																		<table width="100%">
																			<tbody>
																				<tr class="py-1 font-weight-bold">
																					<td width="60%">
																						<p class="card-text">Total Harga Produk : <?php echo formatAngka($d_order['subtotal']) ?></p>
																						<p class="card-text">Total Ongkir : <?php echo formatAngka($d_order['ongkir']) ?></p>
																					</td>
																					<td>
																						<p class="card-text">Total Bayar : <?php echo formatAngka($d_order['total']) ?></p>
																						<button type="button" class="btn btn-sm btn-default" style="font-size: 10px;"><i class="fas fa-print"></i> Cetak Invoice</button>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</td>
										</tr>
										<!-- Modal Upload-->
										<form action="<?php echo base_url('upload_bukti_transfer') ?>" method="POST" enctype="multipart/form-data">
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
															<input type="file" class="form-control mb-2" name="image">
															<input type="hidden" name="code_order" value="<?php echo $d_order['code_order'] ?>">
															<?php
																if ($d_order['bukti_transfer'] == NULL)
																{
																		echo '<img src="' . base_url('assets/img/bukti_transfer/default.jpg') . '" width="100%" height="400px">';
																}
																else
																{
																	echo '<img src="' . base_url('assets/img/bukti_transfer/'.$d_order['bukti_transfer']) . '" width="100%" height="400px">';
																}
															?>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-primary btn-sm">Save changes</button>
														</div>
													</div>
												</div>
											</div>
										</form>
										<?php endforeach ?>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<p class="card-text border text-center p-3 bg-dark text-white">Setelah mengupload bukti transfer, sistem akan segera memverifikasi pembayaran anda.</p>
							</td>
						</tr>
					</table>
				</div>
			</div>	
		</td>
	</tr>
</table>