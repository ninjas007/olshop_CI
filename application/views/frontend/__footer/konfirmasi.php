<script>
	function modalOrder(code_order) {
		$.ajax({
			url: 'api/invoice/modal',
			type: 'GET',
			dataType: 'html',
			data: {code_order: code_order},
			success: function(response) {
				$('.table-invoice tbody').html(response)
			}
		})
		
	}
</script>