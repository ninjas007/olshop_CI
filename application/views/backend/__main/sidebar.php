    <!-- sidebar menu area start -->
    <div class="sidebar-menu">
        <div class="sidebar-header">
            <div class="logo">
                <a href="index.html"><img src="<?php echo base_url('vendor/strdash/') ?>assets/images/icon/logo.png" alt="logo"></a>
            </div>
        </div>
        <!-- Load sidebar -->
        <div class="main-menu">
            <div class="menu-inner">
                <nav>
                    <ul class="metismenu" id="menu">
                        <li class="<?php echo $this->uri->segment(1) == 'dashboard' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('dashboard') ?>"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                        </li>
                        <li class="<?php if($this->uri->segment(1) == 'orders' || $this->uri->segment(2) == 'paid'){echo 'active';} ?>">
                           <a href="javascript:void(0)" aria-expanded="true"><i class="ti-shopping-cart-full"></i><span>Orders</span></a>
                           <ul class="collapse <?php if($this->uri->segment(1) == 'orders' || $this->uri->segment(2) == 'paid'){echo 'in';} ?>">
                               <li class="<?php echo $this->uri->segment(1) == 'orders' ? 'active' : ''; ?>"><a href="<?php echo base_url('orders') ?>">All</a></li>
                               <li class="<?php echo $this->uri->segment(2) == 'paid' ? 'active' : ''; ?>"><a href="<?php echo base_url('order/paid') ?>">Paid</a></li>
                           </ul>
                        </li>
                        <li class="<?php echo $this->uri->segment(1) == 'charts' ? 'active' : ''; ?>">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span>Charts</span></a>
                            <ul class="collapse">
                                <li><a href="barchart.html">bar chart</a></li>
                                <li><a href="linechart.html">line Chart</a></li>
                                <li><a href="piechart.html">pie chart</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-slice"></i><span>icons</span></a>
                            <ul class="collapse">
                                <li><a href="fontawesome.html">fontawesome icons</a></li>
                                <li><a href="themify.html">themify icons</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-table"></i>
                                <span>Tables</span></a>
                                <ul class="collapse">
                                    <li><a href="table-basic.html">basic table</a></li>
                                    <li><a href="table-layout.html">table layout</a></li>
                                    <li><a href="datatable.html">datatable</a></li>
                                </ul>
                            </li>
                            <li><a href="maps.html"><i class="ti-map-alt"></i> <span>maps</span></a></li>
                            <li><a href="invoice.html"><i class="ti-receipt"></i> <span>Invoice Summary</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        