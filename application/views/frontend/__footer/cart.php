
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