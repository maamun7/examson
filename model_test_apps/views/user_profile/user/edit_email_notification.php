<style>
tr { 
    display: block;
    margin-bottom: 8px;
}
</style>
<form class="form-vertical" id="edit-login-info" method="POST" action="{action}">
<div style="height:300px;">
	<h4>Email notifications</h4>
	<h5>Send me an email,when:</h5>
	<table border="0" style="margin-top:10px;">
		<tr>
			<td width="5%">
				<input type="checkbox" name="assigned_exam" value="1" <?php if(isset($assigned_exam_value) && $assigned_exam_value = 1){ echo "checked='checked'"; } ?> />
			</td>
			<td width="5%"> &nbsp; </td>
			<td width="55%">I got assigned for an exam</td>
		</tr>
		<tr>
			<td width="5%">
				<input type="checkbox" name="send_exam" value="1" <?php if(isset($send_exam_value) && $send_exam_value == 1){ echo "checked='checked'"; } ?> />
			</td>
			<td width="5%"> &nbsp; </td>
			<td width="55%">Someone send me an exam</td>
		</tr>
		<tr>
			<td width="5%">
				<input type="checkbox" name="send_exam_report" value="1" <?php if(isset($send_exam_report_value) && $send_exam_report_value == 1){ echo "checked='checked'"; } ?> />
			</td>
			<td width="2%"> &nbsp; </td>
			<td width="55%">Someone send me an exam report</td>
		</tr>
		<tr>
			<td width="5%">
				<input type="checkbox" name="monthly_newsletter" value="1" <?php if(isset($monthly_newsletter_value) && $monthly_newsletter_value == 1){ echo "checked='checked'"; } ?> />
			</td>
			<td width="1%"></td>
			<td width="55%">I have receive a monthly newsletter send by admin </td>
		</tr>	
	</table>
</div>
<div class="button"><input type="submit" class="btn OnePxBorder" name="btn_email_nitif" value="Save changes"></div>
</form>