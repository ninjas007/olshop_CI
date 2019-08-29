<!-- Striped table start -->
<div class="col-lg-12 mt-5">
    <?php echo $this->session->flashdata('alert') ?>
    <div class="card">
        <div class="card-body">
            <div class="header-title">
                <span>All Order</span>
                <span class="mb-2 float-right">
                    <button class="btn btn-xs btn-danger" id="hapusOrder">Hapus Order</button>
                    <button class="btn btn-xs btn-success" id="konfirmasiTransfer">Konfirmasi Status</button>
                </span>
            </div>
            <div class="single-table">
                <div class="table-responsive">
                    <table id="tableListOrder" class="table table-striped text-center">
                        <thead class="text-uppercase">
                            <tr>
                                <th>No</th>
                                <th>Code Order</th>
                                <th>Penerima</th>
                                <th>Tgl Order</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Inject here list order -->
                        </tbody>
                    </table>
                    
                    <!-- Modal Detail-->
                    <div class="modal fade" id="lihatDetail">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Order</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Striped table end -->