<?php
function formatAngka($number) {
    return number_format($number, 0,',',',');
}
?>
<form action="<?php echo base_url('checkout') ?>" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Checkout</div>
                    <div class="card-body">
                        <?php echo $this->session->flashdata('alert') ?>
                        <div class="row">
                            
                            <?php if ($orders == NULL): ?>
                            <div class="col-md-12 mb-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <p class="card-text">Order anda kosong.</p>
                                        <p class="card-text"> Silahkan belanja terlebih dahulu.</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="<?php echo base_url('produk') ?>" class="btn btn-success btn-md btn-block" >Belanja sekarang</a>
                                    </div>
                                </div>
                            </div>
                            <?php else : ?>
                            <div class="col-md-5 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-title" style="font-weight: bold">Data Penerima</p>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nama">Nama Penerima*</label>
                                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Penerima..." value="<?php echo set_value('nama') ?>">
                                                <?php echo form_error('nama','<small class="text-danger">','</small>') ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nohp">No Hp Penerima*</label>
                                                <input type="text" class="form-control" name="nohp" id="nohp" placeholder="08123456xxx" value="<?php echo set_value('nohp') ?>">
                                                <?php echo form_error('nohp','<small class="text-danger">','</small>') ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat Tujuan Penerima*</label>
                                            <textarea name="alamat" class="form-control" id="alamat" rows="5" placeholder="Jln. MT. Haryono. Lr. Nipa Raya 2 Kel. Lalolara Kec. Kambu" style="resize: none;"><?php echo set_value('alamat') ?></textarea>
                                            <?php echo form_error('alamat','<small class="text-danger">','</small>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="kota">Kota Penerima*</label>
                                            <select name="kota" id="kota" class="form-control input-sm">
                                                <!-- Injet kota -->
                                            </select>
                                            <?php echo form_error('kota','<small class="text-danger">','</small>') ?>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="kurir">Kurir*</label>
                                                <select name="kurir" id="kurir" class="form-control">
                                                    <!-- Inject courier -->
                                                </select>
                                                <?php echo form_error('kurir','<small class="text-danger">','</small>') ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="kodepos">Kode Pos</label>
                                                <input type="text" class="form-control" name="kodepos" id="kodepos" readonly placeholder="kode pos">
                                                <?php echo form_error('kodepos','<small class="text-danger">','</small>') ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="layanan">Jenis Layanan*</label>
                                            <select name="layanan" id="layanan" class="form-control">
                                                <!-- Inject layanan -->
                                            </select>
                                            <?php echo form_error('layanan','<small class="text-danger">','</small>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank">Bank Transfer*</label>
                                            <select name="bank" id="bank" class="form-control">
                                                <option selected disabled>Pilih...</option>
                                                <option value="Bri">BRI - 7471100445168424</option>
                                                <option value="Bni">BNI - 0457100445168424</option>
                                                <option value="Mandiri">Mandiri - 66584445160014</option>
                                            </select>
                                            <?php echo form_error('bank','<small class="text-danger">','</small>') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Batal</th>
                                                    <th>Item</th>
                                                    <th>Satuan</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $output = '';
                                                $totalBerat = 0;
                                                $subTotal = 0;
                                                foreach ($orders as $key => $item)
                                                {
                                                    $totalBerat += $item['berat_produk'];
                                                    $subTotal += $item['harga_produk'] * $item['qty'];
                                                    $output .= '
                                                        <tr>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-danger" onclick="batalOrder(\'' .$item['id_order']. '\',\'' .$item['nama_produk']. '\')"><i class="fas fa-trash"></i></button>
                                                                <input type="hidden" value="' .$item['id_order']. '" name="id_order[]">
                                                            </td>
                                                            <td><b>' .$item['nama_produk']. '</b> <br>'
                                                                .$item['warna']. ' ('
                                                                .$item['ukuran']. ') '
                                                                .formatAngka($item['berat_produk']). 'gr x '
                                                                .$item['qty']. '
                                                            </td>
                                                            <td>Rp. ' .formatAngka($item['harga_produk']). '</td>
                                                            <td>Rp. ' .formatAngka($item['harga_produk'] * $item['qty']). '</td>
                                                        </tr>
                                                    ';
                                                }
                                                $output .= '
                                                    <tr><td colspan="4"><hr></td></tr>
                                                    <tr class="bg-light">
                                                        <td colspan="3">Total Berat</td>
                                                        <td><span id="berat">' .$totalBerat / 1000 . '</span> Kg</td>
                                                    </tr>
                                                    <tr class="bg-light">
                                                        <td colspan="3">Subtotal</td>
                                                        <td>Rp. <span id="subtotal">' . formatAngka($subTotal) . '</span></td>
                                                    </tr>
                                                    <tr class="bg-light">
                                                        <td colspan="3">Ongkir</td>
                                                        <td>Rp. <span id="ongkir">0</span></td>
                                                    </tr>
                                                    <tr class="bg-light">
                                                        <td colspan="3">Total Bayar</td>
                                                        <td>Rp. <span id="total">' . formatAngka($subTotal) . '</span></td>
                                                    </tr>
                                                ';
                                                echo $output;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success btn-sm float-right" id="prosesPembayaran">Proses Pemesanan</button>
                                        <a href="<?php echo base_url('produk') ?>" class="btn btn-primary btn-sm float-right mr-2">Belanja Lagi</a>
                                    </div>
                                </div>
                            </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>