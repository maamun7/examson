<!DOCTYPE html>
<html>
<head>
	<title><?php echo (isset($title)) ? $title :"Welcome to ExamsOn !" ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery-1.10.2.js"></script>
	<link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>my-assets/front/css/user-profile.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>my-assets/front/css/common.css" rel="stylesheet">
    <!-- Customize Popup 2 -->
    <link href="<?php echo base_url(); ?>assets/common/jquery-popup2/css/baze.modal.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/common/jquery-popup2/css/normalize.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/common/jquery-popup2/js/baze.modal.js"></script>


</head>
<body>
    <div class="container" style="background-color:#D2D2D2;">
		<?php $this->load->view('common/front/header'); ?>

			{content}	
		
		<?php $this->load->view('common/front/footer'); ?>
	</div><!-- end div #container -->	
	 <!-- Le javascript ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>

    <!-- Customize Popup -->
    <link href="<?php echo base_url(); ?>assets/common/jquery-popup/css/jquery-impromptu.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/common/jquery-popup/js/jquery-impromptu.js"></script>
</body>
</html>