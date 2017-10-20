<!DOCTYPE html>
<html>
<head>
	<title><?php echo (isset($title)) ? $title :"Welcome to ExamsOn !" ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="<?php echo base_url(); ?>assets/admin/js/jquery-1.10.2.js"></script>
	<link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>my-assets/front/css/template.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>my-assets/front/css/common.css" rel="stylesheet">
</head>
<body>
    <div class="container" style="background-color:#F1F1F1;">
		<?php $this->load->view('common/front/header'); ?>
			{msg_content}
			{content}
		<!--</div>--> <!-- /#page-wrapper -->
	</div><!-- end div #wrapper -->
	<?php $this->load->view('common/front/footer'); ?>
	 <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
</body>
</html>