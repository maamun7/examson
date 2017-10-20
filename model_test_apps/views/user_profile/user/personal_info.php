<div style="height:300px;">
	<h4>Login details</h4>
	<table border="0" style="margin-top:10px;">
		<tr>
			<th width="25%">Full name</th>
			<td width="2%">:</td>
			<td width="55%">{first_name} {last_name}</td>
		</tr>
		<tr>
			<th width="25%">Date of birth</th>
			<td width="2%">:</td>
			<td width="55%">{date_of_birth}</td>
		</tr>		
		<tr>
			<th width="25%">House</th>
			<td width="2%">:</td>
			<td width="55%">{house}</td>
		</tr>		
		<tr>
			<th width="25%">Mobile</th>
			<td width="2%">:</td>
			<td width="55%">{mobile}</td>
		</tr>	
		<tr>
			<th width="25%">Education level (last)</th>
			<td width="2%">:</td>
			<td width="55%">{education_level}</td>
		</tr>	
		<tr>
			<th width="25%">Employment Status</th>
			<td width="2%">:</td>
			<td width="55%">{employment_status}</td>
		</tr>
		
	</table>
</div>
<div class="button"><a href="<?php echo base_url();?>user/edit_personal_info"> Edit </a></div>