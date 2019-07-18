  <!-- Header -->
  <div class="card-header" style="padding: 0;">

  </div>

  <!-- Content -->
  <div class="card-body">
      <table class="table table-hover">
        <?php echo $load; ?>
      </table>
  </div>
</div>

<!-- Pembayaran Modal -->
<div class="modal fade" id="prosesPembayaran">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Proses Pembayaran</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <table class="table" width="100%">
          <tbody style="width: 100%">
            <tr>
              <td>Nama</td>
              <td><input type="text" class="form-control input-sm" id="nama"></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td><textarea class="form-control input-sm" id="alamat" rows="3" style="resize: none;"></textarea></td>
            </tr>
            <tr>
              <td>No Hp</td>
              <td><input type="text" class="form-control input-sm" id="nohp"></td>
            </tr>
            <tr>
              <td>Bank</td>
              <td><input type="text" class="form-control input-sm" id="bank"></td>
            </tr>
            <tr>
              <td>Kurir</td>
              <td><input type="text" class="form-control input-sm" id="kurir"></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" id="savePembayaran">Proses</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Keluar</button>
      </div>

    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Cart</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveEdit">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
      </div>

    </div>
  </div>
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
          alert('Berhasil menghapus item')
        } else {
          alert('Gagal menghapus item')
        }
      }
    })    
  });

  $('#savePembayaran').click(function(event) {

    var data = {
      nama : $('#nama').val(),
      alamat : $('#alamat').val(),    
      nohp : $('#nohp').val(), 
      bank : $('#bank').val(),     
      kurir : $('#kurir').val(),
    }

    $.ajax({
      url: '../frontend/order/pembayaran',
      type: 'POST',
      dataType: 'json',
      data: data,
      success: function(response) {

      }
    })
  });

  $('#saveEdit').click(function(event) {
    $.ajax({
      url: '../frontend/cart/edit/',
      type: 'POST',
      dataType: 'json',
      data: {id_row: $(this).attr('id')},
      success: function(response) {
        if (response.status == 200) {
          alert('Berhasil menghapus item')
        } else {
          alert('Gagal menghapus item')
        }
      }
    })    
  });

</script>
</body>
</html>