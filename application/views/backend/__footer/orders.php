<!-- Start datatable js -->
<!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> -->
<script>
	var path = window.location.pathname.split('/')

	var gambar_bukti_transfer = function(gambar) {
		if (gambar == null) {
			return window.location.origin+`/`+path[1]+`/assets/img/bukti_transfer/default.jpg`;
		} else {
			return window.location.origin+`/`+path[1]+`/assets/img/bukti_transfer/${gambar}`;
		}
	}

	var init = function() {
		$.ajax({
			url: 'api_backend/orders/index',
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
			url: 'api_backend/orders/lihat_detail',
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
								<tr><td valign="top">Status Transfer</td><td valign="top">:</td><td valign="top">`+cek_status(data.status_transfer)+`</td></tr>
								<tr><td>Pesanan</td><td>:</td><td>${data.nohp_penerima}</td></tr>
							</tbody>
						</table>
					`);

					function cek_status(status) {
						if (status == 0) {
							return `UNPAID`;
						}
						if (status == 1) {
							return `PROCESS`;
						} 
						if (status == 2) {
							return `PAID`;
						}
					}
				}
			}
		})
	}

	// checkbox all
   $("#checkAll").change(function(){
       if(this.checked){
           $(".checkSingle").each(function(){
               this.checked = true;
           })              
       }else{
           $(".checkSingle").each(function(){
               this.checked = false;
           })              
       }
   });

   	$('#konfirmasiTransfer').click(function(event) {

   		let status = $('input:checkbox:checked.checkSingle').map(function () {
    		return this.value;
  		}).get();

  		let code_orders = $('input:checkbox:checked.checkSingle').map(function () {
    		return this.name;
  		}).get();

		for (var i = 0; i < status.length; i++) {
			if (status[i] != 1) {
				swal('Konfirmasi status hanya yang berstatus PROCESS');
				return false;
			}
		}
		
		if (code_orders.length > 0) {
	   		swal({
	   		  title: "Konfirmasi orderan ini?",
	   		  text: "orderan yang sudah dikonfirmasi, tidak dapat diubah lagi!",
	   		  icon: "warning",
	   		  buttons: true,
	   		})
	   		.then((konfirmasi) => {
	   		  	if (konfirmasi) {
	  				$.ajax({
	  					url: 'api_backend/orders/cek_konfirmasi',
	  					type: 'POST',
	  					dataType: 'json',
	  					data: {code_orders: code_orders},
	  					success: function(response) {
	  						if (response.status == 200) {
	  	  						swal({icon:"success", text: "Berhasil mengkonfirmasi order"});
	  							init();
	  						}
	  					}
	  				})
	   		  	}
	   		});
	   	} else {
	   		swal({icon:"error", text: "ceklist order terlebih dahulu"});
	   	}
   	});

   	$('#hapusOrder').click(function(event) {

  		let code_orders = $('input:checkbox:checked.checkSingle').map(function () {
    		return this.name;
  		}).get();

		if (code_orders.length > 0) {
	   		swal({
	   		  title: "Hapus orderan ini?",
	   		  text: "orderan yang telah dihapus, dipindahkan ke trash!",
	   		  icon: "warning",
	   		  buttons: true,
	   		  dangerMode: true,
	   		})
	   		.then((deleted) => {
	   		  	if (deleted) {
	  				$.ajax({
	  					url: 'api_backend/orders/hapus_order',
	  					type: 'POST',
	  					dataType: 'json',
	  					data: {code_orders: code_orders},
	  					success: function(response) {
	  						if (response.status == 200) {
	  	  						swal({icon:"success", text: "Berhasil menghapus order"});
	  							init();
	  						}
	  					}
	  				})
	   		  	}
	   		});
	   	} else {
	   		swal({icon:"error", text: "ceklist order terlebih dahulu"});
	   	}
   	});
</script>