<!DOCTYPE html>
<html>
<head>
	<title><?php echo (isset($title)) ? $title :"ExamsOn Admin" ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery-1.10.2.js"></script>
	<link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/admin/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/admin/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/admin/css/plugins/timeline/timeline.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/admin/css/sb-admin.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>my-assets/admin/css/customize.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
		<?php $this->load->view('admin/include/header'); ?>
		<div id="page-wrapper">
			{msg_content}
			{sub_menu}
			{content}
		</div> <!-- /#page-wrapper -->	
	</div><!-- end div #wrapper -->	
	<?php $this->load->view('admin/include/footer'); ?>
	 <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>

    <!--	
    <link href="<?php echo base_url(); ?>assets/admin/js/plugins/jquery_bundle/base/jquery.ui.all.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/admin/js/plugins/jquery_bundle/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/js/plugins/jquery_bundle/ui/jquery.ui.widget.js"></script>	
    <script src="<?php echo base_url(); ?>assets/admin/js/plugins/jquery_bundle/ui/jquery.ui.sortable.js"></script>	-->
	
    <script src="<?php echo base_url(); ?>assets/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/plugins/morris/morris.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/sb-admin.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/demo/dashboard-demo.js"></script>
</body>
</html>