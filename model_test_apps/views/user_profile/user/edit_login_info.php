<form class="form-vertical" id="edit-login-info" method="POST" action="{action}">
<div style="height:300px;">
	<h4>Edit your login settings here</h4>	
	<table border="0" style="margin-top:10px;">
		<tr>
			<th width="13%">User ID (email)</th>
			<td width="2%"></td>
			<td colspan="2" >{user_name}</td>
		</tr>
		
		<tr>
			<th width="24%">Current password</th>
			<td width="2%"></td>
			<td width="25%">
				<input type="password" tabindex="1" class="input_field required" name="current_password" value=""/>
			</td>
			<td width="25%">
				<?php if (isset($error_current_password)) { ?>
					<span class="required"><?php echo $error_current_password; ?></span>
				<?php } ?>
			</td>
		</tr>
		
		<tr>
			<th width="24%">Choose a new password</th>
			<td width="2%"></td>
			<td width="25%">
				<input type="password" tabindex="1" class="input_field required" name="new_password" id="new_password" value=""/>
			</td>
			<td width="25%">
				<?php if (isset($error_new_password)) { ?>
					<span class="required"><?php echo $error_new_password; ?></span>
				<?php } ?>
			</td>
		</tr>
		
		<tr>
			<th width="24%">Retype new password</th>
			<td width="2%"></td>
			<td width="25%">
				<input type="password" tabindex="1" class="input_field required" name="confirm_password" value="" />
			</td>
			<td width="25%">
				<?php if (isset($error_confirm_password)) { ?>
					<span class="required"><?php echo $error_confirm_password; ?></span>
				<?php } ?>
			</td>
		</tr>
		
		<tr>
			<th width="24%">Alternate email address</th>
			<td width="2%"></td>
			<td width="25%">
				<input type="text" tabindex="1" class="input_field required" name="alternative_email" value="<?php if (isset($alternative_email_value)) { echo $alternative_email_value; } ?>"/>
			</td>
			<td width="25%">
				<?php if (isset($error_alternative_email)) { ?>
					<span class="required"><?php echo $error_alternative_email; ?></span>
				<?php } ?>
			</td>
		</tr>
	</table>

</div>
<div class="button"><input type="submit" class="btn OnePxBorder" value="Join Now"></div>
</form>
<script>
	$(document).ready(function(){ 	 
		$("#edit-login-info").validate({  
			rules:{
				current_password:{required:true,minlength:6,maxlength: 20},
				new_password:{required:true,minlength: 6,maxlength: 20},
				confirm_password:{required:true, equalTo:"#new_password"},
				alternative_email:{required:false,email: true}
			},
			messages:{
				current_password:{
					required:"Enter Your Current password",
					minlength:"Password must be minimum 6 characters",
					maxlength:"Password must be maximum 20 characters"},
				new_password:{
					required:"Enter password",
					minlength:"Password must be minimum 6 characters",
					maxlength:"Password must be maximum 20 characters"},
				confirm_password:{
					required:"Enter confirm password",
					equalTo:"Password and confirm password doesn't match"},
				alternative_email:{
					email:"Enter valid email address"}
			},
			invalidHandler: function(form, validator) { 
			var errors = validator.numberOfInvalids();
			if (errors) {  
				var message = errors == 1 ? 'You missed 1 field. It has been highlighted': 'You missed ' + errors + ' fields. They have been highlighted';    
				$("div.error span").html(message); 
				$("div.error").show();        
			} else {
			$("div.error").hide();  }
			}           
		});	
	});
</script>