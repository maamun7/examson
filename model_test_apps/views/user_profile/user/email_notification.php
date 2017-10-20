<style>
tr { 
    display: block;
    margin-bottom: 5px;
}
</style>
<div style="height:300px;">
	<h4>Email notifications</h4>
	<h5>Send me an email,when:</h5>
	<table border="0" style="margin-top:10px;">
		<tr>
			<td width="2%">
			<?php if(isset($assigned_exam) && $assigned_exam != 0){ ?>
				<img class="img-responsive" height="20" width="20" src="<?php echo base_url(); ?>my-assets/front/images/checked.png">
			<?php }else{ ?>
				<img class="img-responsive" height="20" width="20" src="<?php echo base_url(); ?>my-assets/front/images/unchecked.png">
			<?php } ?>
			</td>
			<td width="1%"> &nbsp; </td>
			<td width="55%">I got assigned for an exam</td>
		</tr>	
		<tr>
			<td width="2%">
			<?php if(isset($send_exam) && $send_exam != 0){ ?>
				<img class="img-responsive" height="20" width="20" src="<?php echo base_url(); ?>my-assets/front/images/checked.png">
			<?php }else{ ?>
				<img class="img-responsive" height="20" width="20" src="<?php echo base_url(); ?>my-assets/front/images/unchecked.png">
			<?php } ?>
			</td>
			<td width="1%"> &nbsp; </td>
			<td width="55%">Someone send me an exam</td>
		</tr>
		<tr>
			<td width="2%">
			<?php if(isset($send_exam_report) && $send_exam_report != 0){ ?>
				<img class="img-responsive" height="20" width="20" src="<?php echo base_url(); ?>my-assets/front/images/checked.png">
			<?php }else{ ?>
				<img class="img-responsive" height="20" width="20" src="<?php echo base_url(); ?>my-assets/front/images/unchecked.png">
			<?php } ?>
			</td>
			<td width="1%"> &nbsp; </td>
			<td width="55%">Someone send me an exam report</td>
		</tr>
		<tr>
			<td width="2%">
			<?php if(isset($monthly_newsletter) && $monthly_newsletter != 0){ ?>
				<img class="img-responsive" height="20" width="20" src="<?php echo base_url(); ?>my-assets/front/images/checked.png">
			<?php }else{ ?>
				<img class="img-responsive" height="20" width="20" src="<?php echo base_url(); ?>my-assets/front/images/unchecked.png">
			<?php } ?>
			</td>
			<td width="1%"> &nbsp; </td>
			<td width="55%">I have receive a monthly newsletter send by admin </td>
		</tr>
	</table>
</div>
<div class="button"><a href="<?php echo base_url();?>user/edit_email_notification"> Edit </a></div>