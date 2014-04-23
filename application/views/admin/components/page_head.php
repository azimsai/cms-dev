<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $meta_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo site_url('css/bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
    <link href="<?php echo site_url('css/admin.css'); ?>" rel="stylesheet" media="screen">
    <link href="<?php echo site_url('css/datepicker.css'); ?>" rel="stylesheet" media="screen">
	
	<script src="<?php echo site_url('js/jquery.js'); ?>"></script>
	<script src="<?php echo site_url('js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo site_url('js/bootstrap-datepicker.js'); ?>"></script>
	
	<?php if (isset($sortable) && $sortable == TRUE): ?>
		<script src="<?php echo site_url('js/jquery-ui-1.10.4.custom.min.js'); ?>"></script>
		<script src="<?php echo site_url('js/jquery.mjs.nestedSortable.js'); ?>"></script>
	<?php endif ?>
	

    <script type="text/javascript" src="<?php echo site_url('js/tinymce/tinymce.min.js'); ?>"></script>
	<script type="text/javascript">
	tinymce.init({
	    selector: "textarea",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste "
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	});
	</script>
  </head>