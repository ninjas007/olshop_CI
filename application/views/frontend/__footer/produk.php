<script>
  function init_produk(last_id = 0) {

    $('#footerLoad').html(`<img src="https://cdn.dribbble.com/users/172519/screenshots/3520576/dribbble-spinner-800x600.gif" width="50" height="35">`)

    $.ajax({
      url: 'api/produk/get_produk_limit',
      type: 'POST',
      dataType: 'json',
      data: {last_id: last_id, search: $('#query').html()},
      success: function(response) {      
        
        $('#footerLoad').html(`<button href="#" class="btn btn-load" onclick="load_click()">Load More</button>`)

        if (response.status == 200) {  
          let output = ``;
          $.each(response.data, function(index, el) {
            output += `
              <div class="col-md-4 col-xs-12 my-2" style="padding-right: 5px; padding-left: 5px;">
                <div class="card">
                  <a href="#" data-toggle="modal" data-target="#exampleModalScrollable" onclick="detailProduk(\`${el.id_produk}\`)">
                    <img src="${el.gambar_produk}" class="card-img-top" alt="img-product" width="200" height="150">
                      <p class="px-2 pt-2"><small class="text-muted">${el.nama_produk}</small></p>
                      <p class="px-2"><small class="text-muted">Rp. ${el.harga_produk}</small></p>
                  </a>
                </div>
              </div>
            `
          });

          if (response.total_data < 6) {
            $('#footerLoad').html(`<p class="mb-0">semua produk telah tampil</p>`)
          }
          
          $('#getProduk').append(output)
          $('#lastId').html(response.last_id)
        } else {
          if (response.total_data == 0 && response.last_id == null) {
              $('#getProduk').html(`<img src="https://everflowstore.com/themes/black/img/ic_notfound.png" style="margin: auto">`)
              $('.btn-load').html(`produk tidak ditemukan`)
          } else {
            $('.btn-load').html(response.data)
          }
        }
      }
    })
    
  }

  init_produk();
  
  function load_click() {
    
    let last_id = $('#lastId').html()
    init_produk(parseInt(last_id))
    
  }

  function detailProduk(id = null) {
    
    $('#exampleModalScrollable .modal-body').html('Loading..')

    $.ajax({
      url: 'api/produk/detail',
      type: 'POST',
      dataType: 'json',
      data: {id_produk: id},
      success: function (response) {
        
        let warna_ukuran = '';
        let berat = '';

        $.each(response.data.unit, function(index, el) {
          warna_ukuran += `<option value="${el.id}">${el.warna} - ${el.ukuran}</option>`
        });

        if (response.status == 200) {
            
            html_unit = `
                <tr>
                  <td class="pt-2 pr-1 pb-1">Unit</td>
                  <td class="pt-2 pr-1 pb-1" valign="top">:</td>
                  <td class="pt-2 pr-1 pb-1" valign="top">
                    <select id="unit">
                      ${warna_ukuran}
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="pt-2 pr-1 pb-1">Berat</td>
                  <td class="pt-2 pr-1 pb-1">:</td>
                  <td class="pt-2 pr-1 pb-1">${response.data.produk.produk.berat} gram</td>
                </tr>
                <tr>
                  <td class="pt-2 pr-1 pb-1">Harga</td>
                  <td class="pt-2 pr-1 pb-1">:</td>
                  <td class="pt-2 pr-1 pb-1">Rp. <span id="hargaProduk">${response.data.produk.produk.harga}</span></td>
                </tr>
                <tr>
                  <td class="pt-2 pr-1 pb-1">Qty</td>
                  <td class="pt-2 pr-1 pb-1">:</td>
                  <td class="pt-2 pr-1 pb-1">
                    <div class="input-group pull-left">
                      <input type="number" class="input-sm px-2" id="qty" style="width:70px;" placeholder="Qty" value="1" onclick="changeTotal()">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="pt-2 pr-1 pb-1">Total</td>
                  <td class="pt-2 pr-1 pb-1">:</td>
                  <td class="pt-2 pr-1 pb-1">Rp. <span id="subTotal">${response.data.produk.produk.harga}</span></td>
                </tr>
                
            `

            $('#exampleModalScrollable .modal-body').html(`
                <div class="row">
                  <div class="col-md-12">
                    <h6 class="border py-2 text-center"><b>${response.data.produk.produk.nama}</b></h6>
                  </div>
                </div>
                <div class="row border m-1">
                  <div class="col-md-5" style="padding-left:0px; padding-right:0px;">
                    <img src="${response.data.produk.produk.gambar}" class="d-block w-100" style="height:190px" onmousemove="zoomIn(\'${response.data.produk.produk.gambar}\')">
                  </div>
                  <div class="col-md-7 pr-0">
                    <small>
                    <table>
                      `+html_unit+`
                    </table>
                    </small>
                  </div> 
                </div>
                <div class="row border mx-1 p-3 description-product" style="overflow-y:scroll;">
                  <p class="card-text" style="height:200px;">Deskripsi Produk : <br>${response.data.produk.produk.deskripsi}</p>
                </div>
            `)

            $('#exampleModalScrollable .modal-footer').html(`
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <a href="#" id="addToCart" class="btn btn-success btn-sm" onclick="addToCart(\`${response.data.produk.produk.id}\`,\`${response.data.produk.produk.nama}\`,\`${response.data.produk.produk.harga}\`,\`${response.data.produk.produk.gambar}\`)">Add to Cart</a>
              `)
            
        }

      }
    })    

  }


  function changeTotal() {

    let qty = $('#qty').val()
    if (qty < 1) {
      $('#qty').val(1)
      swal('Qty tidak boleh kurang dari nol')
      $('#subTotal').html($('#qty').val() * $('#hargaProduk').html())
      return false
    }

  }


  function addToCart(id_produk = null, nama_produk = '', harga_produk = null, gambar_produk = '') {
        
    if (changeTotal() != false) {
      $.ajax({
        url: 'frontend/cart/add_to_cart',
        type: 'POST',
        data: { id_produk: id_produk,
                qty: $('#qty').val(),
                price: harga_produk, 
                name: nama_produk, 
                id_unit: $('#unit').val()
              },
        success: function (response) {
          swal('Berhasil menambah produk ke keranjang');
          $('#jumlahItem').html(response)
        }
      })    
    } else {
      swal('Qty tidak boleh kurang dari nol')
    }
    
  }

  function zoomIn(gambar) {
    
    $('.description-product').html(`<img src="${gambar}" width="200" height="200">`)

  }

</script>