<section>
  <div class="card-header text-center p-0">
    <p class="pt-3" id="query"><?php echo $query; ?></p>
  </div>
  <div class="card-body">
    <div class="card-group">
      <div class="row ml-0" id="getProduk" style="width: 100%;">
        <!-- Inject Produk Get Here -->
        <div id="lastId" style="display: none"></div>
      </div>
    </div>
  </div>
  <div class="card-footer" id="footerLoad">
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