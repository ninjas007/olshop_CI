<!-- Header -->
<div class="card-header" style="padding: 0;">
  
  <!-- Carousel -->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="<?php echo base_url('assets/img/slider/image1.jpg'); ?>" alt="First slide" height="150" width="100%">
      </div>
      <div class="carousel-item">
        <img src="https://i0.wp.com/igem.blog/wp-content/uploads/2018/01/barang-produk-impor-china-murah.jpg?fit=1326%2C561&ssl=1" alt="Second slide" height="150" width="100%">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<!-- Content -->
<div class="card-body">
  
  <!-- Header body -->
  
  <div class="row">
    <div class="col-8">
      <div class="text-left">
        <marquee class="card-title"><small>Belanja barang import dengan harga terjangkau. open pre-order Whatsapp : 082330490855</small></marquee>
      </div>
    </div>
    <div class="col-4">
      <a href="" style="font-size: 14px; text-align: right; color: #68c93e; font-weight: bold">Lihat Produk</a>
    </div>
  </div>
  <br>
  
  <!-- List prduct carousel -->
  <div class="row">
    <div class="col-4">
      <div class="card">
        <img src="http://placehold.it/250x250" class="card-img-top">
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <img src="http://placehold.it/250x250" class="card-img-top">
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <img src="http://placehold.it/250x250" class="card-img-top">
      </div>
    </div>
  </div>
  <hr>
  <a href="#">
    <div class="card mb-3" style="box-shadow: 0 2px 4px 0 rgba(0,0,0,.3)">
      <div class="row no-gutters">
        <div class="col-md-3">
          <img src="http://placehold.it/250x250" class="card-img rounded-circle mt-2 mb-2" style="width: 80px; ">
        </div>
        <div class="col-md-9">
          <div class="card-body text-left">
            <p style="margin-bottom: 0"><strong>Jadi Agen di BisnisImport</strong></p>
            <small class="card-text" style="font-size: 10px">Buruan daftar sekarang</small>
          </div>
        </div>
      </div>
    </div>
  </a>
  <a href="#">
    <div class="card mb-3"  style="box-shadow: 0 2px 4px 0 rgba(0,0,0,.3)">
      <div class="row no-gutters">
        <div class="col-md-3">
          <img src="http://placehold.it/250x250" class="card-img rounded-circle mt-2 mb-2" style="width: 80px; ">
        </div>
        <div class="col-md-9">
          <div class="card-body text-left">
            <p style="margin-bottom: 0"><strong>Jualan di BisnisImport</strong></p>
            <small class="card-text" style="font-size: 10px">Buka kios di BisnisImport dan jual produk pangan atau produk Anda</small>
          </div>
        </div>
      </div>
    </div>
  </a>
  <br>
  <!-- List prduct carousel -->
  <p style="border: 1px solid #cccccc; padding: 5px">Temukan produk yang ingin anda beli</p>
  <input type="hidden" id="totalData" value="0">
  <div id="carouselProduct" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <!-- Inject Here -->
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselProduct" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselProduct" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <hr>
  <p style="border: 1px solid #cccccc; padding: 5px">Produk rekomendasi</p>
  <div class="row mb-4">
    <div class="col-4">
      <div class="card">
        <img src="http://placehold.it/250x250" class="card-img-top">
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <img src="http://placehold.it/250x250" class="card-img-top">
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <img src="http://placehold.it/250x250" class="card-img-top">
      </div>
    </div>
  </div>
</div>
<!-- Footer -->
</div>

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

<script type="text/JavaScript">

function init() {
  
  $('#carouselProduct .carousel-inner').html('load data..')

  var length = $('#totalData').val()

  $.ajax({
    url: 'api/produk/get',
    type: 'GET',
    dataType: 'json',
    success: function (response) {
    }
  })

  $.ajax({
    url: 'api/kategori_produk/get',
    type: 'GET',
    dataType: 'json',
    data: {length: length},
    success: function (response) {
      
      let output = '';

      $.each(response.category, function(index, el) {
        
        var active = "active";
        if (index != 0) {
          active = "";
        }
        
        output += '<div class="carousel-item '+active+'"><div class="row">';
        
        $.each(el, function(i, data) {
          output += `
              <div class="col-md-3">
                <a href="">
                <img src="${data.img_category}" class="d-block w-100" alt="IMG-CATEGORY" style="height:100px; border-radius: 5px;">
                <p>${data.name_category}</p>
                </a>
              </div>
          `
        });

        output += '</div></div>';
        
      });

      $('#carouselProduct .carousel-inner').html(output)
      
    }
  })
}

init()
</script>