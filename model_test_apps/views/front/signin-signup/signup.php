<div class="row">
	<div class="col-sm-12 center-div-parent">
        <div class="col-sm-6 center-div-child">
            <form class="user_signup" action="{action}" id="user_signup" method="post"  name="user_signup" enctype="multypart/formdata">
                <div class="form-group">
                    <input type="text" class="form-control" name="first_name" value="<?php if (isset($first_name_value)) { echo $first_name_value; } ?>" id="first_name" placeholder="First Name">
                    <?php if (isset($error_first_name)) { ?>
                        <span style="color:red;font-size:11px;"><?php echo $error_first_name; ?></span>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="last_name" value="<?php if (isset($last_name_value)) { echo $last_name_value; } ?>" id="last_name" placeholder="Last Name">
                    <?php if (isset($error_last_name)) { ?>
                        <span style="color:red;font-size:11px;"><?php echo $error_last_name; ?></span>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="user_name" value="<?php if (isset($user_name_value)) { echo $user_name_value; } ?>" id="user_name" placeholder="Email">
                    <?php if (isset($error_user_name)) { ?>
                        <span style="color:red;font-size:11px;"><?php echo $error_user_name; ?></span>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">

                    <?php if (isset($error_password)) { ?>
                        <span style="color:red;font-size:11px;"><?php echo $error_password; ?></span>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <div class="col-sm-6" style="padding:0px;margin-top:0px;">
                        <input type="text" class="form-control" name="mobile_no" id="mobile_no" value="<?php if (isset($mobile_no_value)) { echo $mobile_no_value; } ?>" placeholder="Mobile">

                        <?php if (isset($error_mobile_no)) { ?>
                            <span style="color:red;font-size:11px;"><?php echo $error_mobile_no; ?></span>
                        <?php } ?>
                    </div>
                    <div class="col-sm-6" style="padding-right:0px;margin-top:0px;">
                        <select class="form-control" name="user_type" id="user_type">
                            <option value=""> Select </option>
                            <option <?php if (isset($user_type_value) && $user_type_value == 2) { echo "selected='selected'"; } ?> value="2"> Student </option>
                            <option <?php if (isset($user_type_value) && $user_type_value == 3) { echo "selected='selected'"; } ?> value="3"> Institute</option>
                        </select>
                    </div>
                    <?php if (isset($error_user_type)) { ?>
                        <span style="color:red;font-size:11px;"><?php echo $error_user_type; ?></span>
                    <?php } ?>
                </div><br><br>	<br>
                <!-- if user select institute -->
                <?php
                $block_css = "display:none";
                 if (isset($user_type_value) && $user_type_value==3){
                    if (isset($error_institute_name) && $error_institute_name !="") {
                        $block_css = "display:";
                    }
                    if (isset($institute_name_value) && $institute_name_value !="") {
                        $block_css = "display:";
                    }
                }
                ?>
                <div class="form-group" id="institute_name_field" style="<?php echo $block_css; ?>;padding-bottom:0px;margin-bottom:0px;">
                    <input type="text" class="form-control" name="institute_name" value="<?php if (isset($institute_name_value)) { echo $institute_name_value; } ?>" id="institute_name" placeholder="Institute Name">

                    <?php if (isset($error_institute_name)) { ?>
                        <span style="color:red;font-size:11px;"><?php echo $error_institute_name; ?></span>
                    <?php } ?>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Sign up</button>
            </form>
            <div class="col-sm-12" style="padding:0px">
                <a href="<?php echo base_url(); ?>auth/signin">Signin </a>
            </div>
        </div>
	</div>
</div> <!-- Home Bottom Header -->
<script type="text/javascript">
	$('#user_type').change(function() {
	    if ($(this).val() === '3') {
	        $('#institute_name_field').show();
	    }else{
	    	$('#institute_name_field').hide();
	    }
	});
</script>
