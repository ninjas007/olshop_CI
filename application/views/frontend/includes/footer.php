<!-- Footer -->
<nav class="navbar fixed-bottom navbar-light bg-light justify-content-between" style="z-index: 9999; width: 40%; margin: auto; padding: 0px;  box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, .3);">
	
	<ul class="nav nav-tabs" role="tablist" id="list-navbar-bottom" style="margin: auto;">
		<li class="nav-item">
			<a class="nav-link pages active" href="#" id="home" role="tab" data-toggle="tab" style="font-size: 12px">HOME</a>
		</li>
		<li class="nav-item">
			<a class="nav-link pages" href="#" id="pesanan" role="tab" data-toggle="tab" style="font-size: 12px">PESANAN</a>
		</li>
		<li class="nav-item">
			<a class="nav-link pages" href="#" id="help" role="tab" data-toggle="tab" style="font-size: 12px">HELP</a>
		</li>
		<li class="nav-item">
			<a class="nav-link pages" href="#" id="produk" role="tab" data-toggle="tab" style="font-size: 12px">SEMUA PRODUK</a>
		</li>
		<li class="nav-item">
			<a class="nav-link pages" href="#" id="akun" role="tab" data-toggle="tab" style="font-size: 12px">AKUN</a>
		</li>
	</ul>
</nav>
</div>
</center>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>

$('.pages').click(function(e) {

	let menu = $(this).attr('id')
	
	if (menu == 'produk') {
		$('.card-body').load(function() {
			/* Act on the event */
		});
	}

});	

</script>
</body>
</html>