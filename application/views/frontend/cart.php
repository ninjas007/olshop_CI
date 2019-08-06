<div class="card-header text-center">
  <h5>Keranjang</h5>
</div>
<!-- Content -->
<div class="card-body" style="font-size: 13px;">
    <form action="<?php echo base_url('order/add') ?>" method="post">
      <table class="table">
        <!-- load cart -->
        <?php echo $load; ?> 
      </table>
    </form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>

  $('.remove-cart').click(function(event) {
    $.ajax({
      url: '../frontend/cart/delete/',
      type: 'POST',
      dataType: 'json',
      data: {id_row: $(this).attr('id')},
      success: function(response) {
        if (response.status == 200) {
          swal('Berhasil menghapus item')
        } else {
          swal('Gagal menghapus item')
        }
      }
    })    
  });

  
</script>
</body>
</html>