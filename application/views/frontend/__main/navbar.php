<table width="50%" class="align-items-center table-navbar" style="margin: auto;">
    <tr>
        <td class="bg-dark py-2"><h3 class="text-center"><a href="<?php echo base_url() ?>" class="text-white">BISNIS IMPORT</a></h3></td>
    </tr>
</table>
<table width="50%" class="align-items-center sticky-top table-navbar" style="margin: auto;">
    <tr>
        <td>
            <nav class="navbar navbar-expand-lg navbar-light justify-content-between" style="background: #68c93e">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo base_url() ?>">Home</a>
                                <a class="dropdown-item" href="<?php echo base_url('produk') ?>">Semua Produk</a>
                                <a class="dropdown-item" href="<?php echo base_url('order') ?>">My Order</a>
                                <a class="dropdown-item" href="#">Help</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url('login') ?>">Akun</a>
                                <?php if ($this->session->userdata('status') == 'login'): ?>
                                <a class="dropdown-item" href="<?php echo base_url('konfirmasi') ?>">Konfirmasi</a>
                                <?php endif ?>
                                
                            </div>
                        </li>
                        <li class="nav-item"><a href="<?php echo base_url('cart/') ?>" class="nav-link">Cart <span style="background-color: white; padding: 2px 5px 2px 5px; border-radius: 20px; font-size: 10px;" id="jumlahItem"><?php echo $total_items ?></span></a></li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0" action="<?php echo base_url('produk') ?>" method="post">
                        <input class="form-control mr-sm-2" type="search" id="search" name="search" placeholder="Cari produk">
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Cari</button>
                    </form>
                </div>
            </nav>
        </td>
    </tr>
</table>