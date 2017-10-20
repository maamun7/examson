<form class="form-vertical" id="edit-login-info" method="POST" action="{action}">
<div style="height:300px;">
	<h4>Edit your login settings here</h4>	
	<table border="0" style="margin-top:10px;">
		<tr>
			<th width="24%">First name</th>
			<td width="2%"></td>
			<td width="25%">
				<input type="text" tabindex="1" class="input_field" name="first_name" value="<?php if (isset($first_name_value)) { echo $first_name_value; } ?>" id="first_name" placeholder="First name">
			</td>
			<td width="25%">
				<?php if (isset($error_first_name)) { ?>
					<span class="required"><?php echo $error_first_name; ?></span>
				<?php } ?>
			</td>
		</tr>
		
		<tr>
			<th width="24%">Last name</th>
			<td width="2%"></td>
			<td width="25%">
				<input type="text" tabindex="2" class="input_field" name="last_name" value="<?php if (isset($last_name_value)) { echo $last_name_value; } ?>" id="last_name" placeholder="Last name">
			</td>
			<td width="25%">
				<?php if (isset($error_last_name)) { ?>
					<span class="required"><?php echo $error_last_name; ?></span>
				<?php } ?>
			</td>
		</tr>
		
		<tr>
			<th width="24%">Date of birth</th>
			<td width="2%"></td>
			<td width="25%">
				<div class='input-group date'>
					<input type="text" tabindex="3" class="input_field" id='select_date' name="date_of_birth" value="<?php if (isset($dbo_value)) { echo $dbo_value; } ?>" id="last_name" placeholder="Date of birth" style="width:90%">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			
			
			</td>
			<td width="25%">
				<?php if (isset($error_date_of_birth)) { ?>
					<span class="required"><?php echo $error_date_of_birth; ?></span>
				<?php } ?>
			</td>
		</tr>
		
		<tr>
			<th width="24%">House</th>
			<td width="2%"></td>
			<td width="25%">
				<input type="text" tabindex="4" class="input_field" name="house" value="<?php if (isset($house_value)) { echo $house_value; } ?>" placeholder="Address"/>
			</td>
			<td width="25%">
				<?php if (isset($error_house)) { ?>
					<span class="required"><?php echo $error_house; ?></span>
				<?php } ?>
			</td>
		</tr>
		
		<tr>
			<th width="24%">Mobile</th>
			<td width="2%"></td>
			<td width="25%">
				<input type="text" tabindex="4" class="input_field" name="mobile" value="<?php if (isset($mobile_value)) { echo $mobile_value; } ?>" placeholder="Mobile number"/>
			</td>
			<td width="25%">
				<?php if (isset($error_mobile)) { ?>
					<span class="required"><?php echo $error_mobile; ?></span>
				<?php } ?>
			</td>
		</tr>
		
		<tr>
			<th width="24%">Education level (last)</th>
			<td width="2%"></td>
			<td width="25%">
				<input type="text" tabindex="4" class="input_field" name="education_level" value="<?php if (isset($education_level_value)) { echo $education_level_value; } ?>" placeholder="Education level"/>
			</td>
			<td width="25%">
				<?php if (isset($error_education_level)) { ?>
					<span class="required"><?php echo $error_education_level; ?></span>
				<?php } ?>
			</td>
		</tr>
		
		<tr>
			<th width="24%">Employment status</th>
			<td width="2%"></td>
			<td width="25%">
				<input type="text" tabindex="5" class="input_field" name="employment_status" value="<?php if (isset($empl_status_value)) { echo $empl_status_value; } ?>" placeholder="Employment status"/>
			</td>
			<td width="25%">
				<?php if (isset($error_empl_status)) { ?>
					<span class="required"><?php echo $error_empl_status; ?></span>
				<?php } ?>
			</td>
		</tr>
	</table>

</div>
<div class="button"><input type="submit" class="btn OnePxBorder" value="Join Now"></div>
</form>
   <script type="text/javascript">
		$(document).ready(function() {
			$("#select_date").datepicker({
				format: "yyyy-mm-dd",
				autoclose: true,
			});
		});
	</script>
<!--<script>
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
</script>-->