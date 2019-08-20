<table width="50%" class="align-items-center" style="margin: auto;">
	<tbody>
		<tr>
			<td>
				<div class="card-header bg-light text-center">
					<h5>Cart</h5>
				</div>
				<!-- Content -->
				<div class="card-body" style="font-size: 13px;">
					<form action="<?php echo base_url('order/add') ?>" method="post">
						<table class="table">
							<!-- load cart -->
							<?php echo $load; ?>
						</table>
					</form>
				</div>
			</td>
		</tr>
	</tbody>
</table>
	