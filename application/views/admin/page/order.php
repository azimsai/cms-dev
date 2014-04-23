<section>
	<h2>Order pages</h2>
	<p class="alert alert-info">Drag to order the page and click save.</p>
	<div id="orderResult"></div>
	<input type="button" class="btn btn-primary" id="save" value="save">
</section>

<script>
	$(function() {
		$.post('<?php echo site_url('admin/page/order_ajax'); ?>', {}, function(data) {		
			$('#orderResult').html(data);
		});

		$('#save').click(function () {    	
    	var oSortable = $('.sortable').nestedSortable('toArray');
    	$.post('<?php echo site_url('admin/page/order_ajax'); ?>', { sortable : oSortable }, function(data) {
    		$('#orderResult').html(data);
    	});
    });
	});

</script>

