<?php 
    function formatAngka($number) {
    return number_format($number, 0,',',',');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <title>Checkout</title>
    <style>
        body {
            background: url('https://image.freepik.com/darmowe-wektory/wzor-o-zakupach_1061-495.jpg') fixed;
            font-family: 'Exo', sans-serif;
        }
        .container {
            /*text-align: center;*/
        }
        table td {
            border-top: 0px !important;
        }
        /*label {
            color: grey;
        }*/
    </style>
</head>
<body>
    <form action="<?php echo base_url('pembayaran') ?>" method="post">
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
                                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama penerima" value="<?php echo set_value('nama') ?>">
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

                                                    foreach ($orders as $key => $order)
                                                    {
                                                        foreach ($order as $item)
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
<script>

    var kurir = `
        <option selected disabled>Pilih kurir...</option>
        <option value="jne">JNE</option>
        <option value="tiki">TIKI</option>
        <option value="pos">POS</option>
    `

    // tampilkan daftar kota dan menjadikan default input ongkir dan total
    function ambil_kota() {
        $('#kota').html('<option disabled selected>Sedang proses...</option>')

        $.ajax({
            url: 'ongkir/get_kota',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let data = response.rajaongkir.results;
                let output = '<option disabled selected>Kota penerima...</option>';
                $.each(data, function(index, el) {
                    output += `
                        <option value="${el.city_id}-${el.postal_code}" >${el.city_name}</option>
                    `
                });
                $('#kota').html(output)
                $('#kota').change(function(event) {
                    let kodepos = $(this).val().split('-')
                    $('#kodepos').val(kodepos[1])
                    $('#kurir').html(kurir)
                    $('#layanan').html('')
                    $('#ongkir').html('0')
                });
            }
        })                
    }
    
    // tampilkan ongkir dan total
    function ambil_total() {
        $.ajax({
            url: 'ongkir/ambil_total_ongkir',
            type: 'POST',
            dataType: 'json',
            data: {layanan: $('#layanan').val()},
            success: function(response) {
                $('#ongkir').html(response.ongkir)
                $('#total').html(response.total)
            }
        })
    }
    
    // get ongkir
    function ongkir() {
        let data = {
            kota_id_tujuan: $('#kota').val(),
            kurir: $('#kurir').val(),
            berat: $('#berat').html(),
            subtotal: $('#subtotal').html()
        }

        $.ajax({
            url: 'ongkir/get_ongkir',
            type: 'POST',
            dataType: 'html',
            data: data,
            success: function(response) {
                $('#layanan').html(response);
                ambil_total();
            }
        })
    }

    function batalOrder(id_order, nama_produk) {
        swal({
            title: "Batal order "+nama_produk+" ?",
            text: "Item yang dibatalkan tidak dapat dikembalikan",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: 'frontend/order/batal',
                    type: 'POST',
                    dataType: 'json',
                    data: {id_order: id_order},
                    success: function(response) {
                        swal(response.message);
                        setTimeout(function(){ location.reload() }, 1000);
                    }
                })
            }
        });
    }

    /**
    * change kurir
    *
    * @return call function ongkir
    */
    $('#kurir').change(function(event) {
        ongkir()
    });

    /**
    * change layanan kurir
    *
    * @return call function ambil_total
    */
    $('#layanan').change(function(event) {
        ambil_total()
    });  
    
    // call function
    ambil_kota()
    // ongkir()
</script>
</body>
</html>