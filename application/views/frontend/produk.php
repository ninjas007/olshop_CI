<section>
  <!-- Header -->
  <div class="card-header text-center" style="padding: 0;">
    <p class="pt-3" id="query"><?php echo $query; ?></p>
  </div>
  <!-- Content -->
  <div class="card-body">
    <div class="card-group">
      <div class="row" id="getProduk" style="width: 100%; margin-left: 0px;">

        <!-- Inject Produk Get Here -->
        
        <div id="lastId" style="display: none"></div>
      </div>
    </div>
  </div>
  <!-- Load More -->
  <div class="card-footer" id="footerLoad" style="display: flex; justify-content: center; align-items: center;">

    <!-- Inject footer html -->
  </div>

</div>
</section>

<!-- Modal Detail Produk-->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Detail Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Detail produk -->
      </div>
      <div class="modal-footer">
        <!-- Add Button -->
      </div>
    </div>
  </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
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

        if (response.status == 200) 
        {  
          let output = ``;
          $.each(response.data, function(index, el) {
            output += `
              <div class="col-md-4 col-xs-12 my-2" style="padding-right: 5px; padding-left: 5px;">
                <div class="card">
                  <a href="#" data-toggle="modal" data-target="#exampleModalScrollable" onclick="detailProduk(\`${el.id_produk}\`)">
                    <img src="${el.gambar_produk}" class="card-img-top" alt="img-product" width="200" height="150">
                    <div class="card-footer">
                      <small class="text-muted">${el.nama_produk}</small> <br>
                      <small class="text-muted">${el.harga_produk}</small>
                    </div>
                  </a>
                </div>
              </div>
            `
          });

          if (response.total_data < 6)
          {
            $('#footerLoad').html(`<p class="mb-0">semua produk telah tampil</p>`)
          }
          $('#getProduk').append(output)
          $('#lastId').html(response.last_id)
        }
        else 
        {
          if (response.total_data == 0 && response.last_id == null)
          {
              $('#getProduk').html(`<img src="https://everflowstore.com/themes/black/img/ic_notfound.png" style="margin: auto">`)
              $('.btn-load').html(`produk tidak ditemukan`)
          }
          else
          {
            $('.btn-load').html(response.data)
          }
        }

      }
    })
    
  }

  init_produk();
  
  function load_click() {
    
    let last_id = $('#lastId').html()
    init_produk(parseInt(last_id) + 1)
    
  }

  function detailProduk(id = null) {
    
    $('#exampleModalScrollable .modal-body').html('Loading..')

    $.ajax({
      url: 'api/produk/detail',
      type: 'POST',
      dataType: 'json',
      data: {id_produk: id},
      success: function (response) {
        
        let warna = '';
        let ukuran = '';
        let berat = '';

        $.each(response.data.unit, function(index, el) {
          warna += `${el.warna}, `
          ukuran += `${el.ukuran}, `
        });

        if (response.status == 200) {
            
            html_unit = `
                <tr>
                  <td class="pt-2 pr-1 pb-1">Warna</td>
                  <td class="pt-2 pr-1 pb-1">:</td>
                  <td class="pt-2 pr-1 pb-1">${warna}</td>
                </tr>
                <tr>
                  <td class="pt-2 pr-1 pb-1">Ukuran</td>
                  <td class="pt-2 pr-1 pb-1">:</td>
                  <td class="pt-2 pr-1 pb-1">${ukuran}</td>
                </tr>
                <tr>
                  <td class="pt-2 pr-1 pb-1">Berat</td>
                  <td class="pt-2 pr-1 pb-1">:</td>
                  <td class="pt-2 pr-1 pb-1">${response.data.produk.produk.berat} gram</td>
                </tr>
            `

            $('#exampleModalScrollable .modal-body').html(`
                <div class="row">
                  <div class="col-md-12">
                    <h6 class="border py-2 text-center"><b>${response.data.produk.produk.nama}</b></h6>
                  </div>
                </div>
                <div class="row border m-1">
                  <div class="col-md-4" style="padding-left:0px; padding-right:0px;">
                    <img src="${response.data.produk.produk.gambar}" class="d-block w-100" style="height:152px">
                    <div class="input-group pull-left my-2">
                      <input type="button" class="btn btn-success btn-flat btn-md" value="-" onclick="minus()">
                      <input type="text" id="qty" style="width:80px; padding:3px;" placeholder="Qty" value="1">
                      <input type="button" class="btn btn-success btn-flat btn-md" value="+" onclick="plus()">
                    </div>
                  </div>
                  <div class="col-md-8 pr-0" style="overflow-y:scroll;">
                    <table>
                      `+html_unit+`
                    </table>
                    <p class="card-text" style="height: 200px; padding:2px">${response.data.produk.produk.deskripsi}</p>
                  </div> 
                </div>
            `)

            $('#exampleModalScrollable .modal-footer').html(`
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <a href="#" id="addToCart" class="btn btn-success" onclick="addToCart(\`${response.data.produk.produk.id}\`,\`${response.data.produk.produk.nama}\`,\`${response.data.produk.produk.harga}\`,\`${response.data.produk.produk.gambar}\`)">Add to Cart</a>
              `)
            
        }

      }
    })    

  }

  function minus() {
    
    let qty = $('#qty').val()

    if (qty > 1) {
      $('#qty').val(qty - 1)
    }

  }

  function plus() {
    
    let qty = $('#qty').val()

    if (qty < 10) {
      $('#qty').val(parseInt(qty) + 1)
    }

  }

  function addToCart(id = null, nama_produk = '', harga_produk = null, gambar_produk = '') {
    
    $.ajax({
      url: 'frontend/produk/add_to_cart',
      type: 'POST',
      data: {id: id, nama: nama_produk, harga: harga_produk, gambar: gambar_produk, qty: $('#qty').val()},
      success: function (response) {
          var pathname = window.location.pathname.split('/', 2)
          $('#addToCart').attr('href', window.location.origin + '/' + pathname[1] + '/produk/cart');
      }
    })
    
    // let qty = $('#qty').val()
    // localStorage.setItem("qty", qty);

    // var pathname = window.location.pathname.split('/', 2)
    // console.log(pathname[1])
    // // $('#addToCart').attr('href', window.location.origin + '/frontend/kategori_produk/');
    
    // console.log(localStorage.getItem("qty"))
  
  }

</script>