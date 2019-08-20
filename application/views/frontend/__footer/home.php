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
        
        output += '<div class="carousel-item '+active+'"><table width="100%"><tr>';
        
        $.each(el, function(i, data) {
          output += `
              <td width="25%" class="p-2">
                <form class="form-inline my-2 my-lg-0" action="<?php echo base_url('produk') ?>" method="post">
                    <input type="hidden" name="search" value="${data.name_category}">
                    <button type="submit">
                      <img src="${data.img_category}" alt="IMG-CATEGORY" width="100%" height="100">
                      <p class="card-text mt-2">${data.name_category}</p>
                    </button>
                </form>
              </td>
          `
        });

        output += '</tr></table></div>';
        
      });

      $('#carouselProduct .carousel-inner').html(output)
      
    }
  })
}

init()
</script>