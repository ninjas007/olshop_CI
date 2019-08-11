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