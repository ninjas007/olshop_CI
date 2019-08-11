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