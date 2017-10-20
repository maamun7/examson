<!DOCTYPE html>
<html>
<head>
	<title><?php echo (isset($title)) ? $title :"Welcome to ExamsOn !" ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.js"></script>
	<link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>my-assets/front/css/user-profile.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>my-assets/front/css/common.css" rel="stylesheet">
    <!-- Customize Popup 2 -->
    <link href="<?php echo base_url(); ?>assets/common/jquery-popup2/css/baze.modal.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/common/jquery-popup2/css/normalize.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/common/jquery-popup2/js/baze.modal.js"></script>
        <!-- Date pickar -->
    <link href="<?php echo base_url(); ?>my-assets/common/css/datepicker.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>my-assets/common/js/bootstrap-datepicker.js"></script>

</head>
<body>
    <div class="container" style="background-color:#D2D2D2;">
		<?php $this->load->view('common/front/header'); ?>
		<div class="row">		
			{account_info}
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12" style="height:auto;overflow:hidden;">
				<div id="account-left" class="col-sm-6 col-md-4 col-lg-4">	
					<!-- Left menu start -->
					{left_menus}
					<!-- Left menu end -->
				</div>
				<div id="account-right" class="col-sm-12 col-md-8 col-lg-8">										
					<div id="use_right_content">
						{content}
					</div>	
				</div>
			</div>
		</div>		
		
		<?php $this->load->view('common/front/footer'); ?>
	</div><!-- end div #container -->	
	 <!-- Le javascript ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>

    <!-- Customize Popup -->
    <link href="<?php echo base_url(); ?>assets/common/jquery-popup/css/jquery-impromptu.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/common/jquery-popup/js/jquery-impromptu.js"></script>
	<!-- Form Validation JS --->	
    <script src="<?php echo base_url(); ?>my-assets/common/js/jquery.validate.js"></script>
</body>
</html>