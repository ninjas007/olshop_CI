	    	<!-- footer area start-->
		    <footer>
		        <div class="footer-area">
		            <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
		        </div>
		    </footer>
		    <!-- footer area end-->
		</div>
	</div>
	<!-- Load offset area -->
	<?php $this->load->view('backend/__main/offset') ?>
	<!-- page container area end -->
	<!-- jquery latest version -->
	<script src="<?php echo base_url('assets/template_backend/')?>js/vendor/jquery-2.2.4.min.js"></script>
	<!-- bootstrap 4 js -->
	<script src="<?php echo base_url('assets/template_backend/')?>js/popper.min.js"></script>
	<script src="<?php echo base_url('assets/template_backend/')?>js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/template_backend/')?>js/owl.carousel.min.js"></script>
	<script src="<?php echo base_url('assets/template_backend/')?>js/metisMenu.min.js"></script>
	<script src="<?php echo base_url('assets/template_backend/')?>js/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url('assets/template_backend/')?>js/jquery.slicknav.min.js"></script>
    <!-- others plugins -->
    <!-- Load footer single page -->
    <?php $this->load->view('backend/__footer/'.strtolower($page).''); ?>
    <script src="<?php echo base_url('assets/template_backend/')?>/js/plugins.js"></script>
    <script src="<?php echo base_url('assets/template_backend/')?>/js/scripts.js"></script>
</body>

</html>
