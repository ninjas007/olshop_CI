<!-- Start datatable js -->
<!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> -->
<script>
	var path = window.location.pathname.split('/')

	let init = function() {
		$.ajax({
			url: '../api_backend/orders/order_paid',
			type: 'GET',
			dataType: 'html',
			data: {param1: 'value1'},
			success: function(response) {
				$('#tableListOrder tbody').html(response)
			}
		})	
	}
	
	init()

	function lihat_detail(id_order = null) {
		$.ajax({
			url: '../api_backend/orders/lihat_detail',
			type: 'POST',
			dataType: 'json',
			data: {id_order: id_order},
			success: function(response) {			
				if (response.status == 200) {
					let data = response.data;
					$("#lihatDetail").modal('show');
					$("#lihatDetail .modal-body").html(`
						<table width="100%" id="tableDetail">
							<tbody>
								<tr>
									<td>Code Order</td><td>:</td><td>${data.code_order}</td>
									<td rowspan="4" width="30%"><img src="`+gambar_bukti_transfer(data.bukti_transfer)+`" style="height:150px !important; width:100% !important"></td>
								</tr>
								<tr><td>Tgl Order</td><td>:</td><td>${data.tgl_order}</td></tr>
								<tr>
									<td valign="top">Penerima</td>
									<td valign="top">:</td>
									<td valign="top">${data.nama_penerima} <br> ${data.nohp_penerima} <br> ${data.alamat_penerima}</td>
								</tr>
								<tr><td valign="top">Status Transfer</td><td valign="top">:</td><td valign="top">PAID</td></tr>
								<tr><td>Pesanan</td><td>:</td><td>${data.nohp_penerima}</td></tr>
							</tbody>
						</table>
					`);

					function gambar_bukti_transfer(gambar) {
						if (gambar == null) {
							return window.location.origin+`/`+path[1]+`/assets/img/bukti_transfer/default.jpg`;
						} else {
							return window.location.origin+`/`+path[1]+`/assets/img/bukti_transfer/${gambar}`;
						}
					}
				}
			}
		})
	}
</script>