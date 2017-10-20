<div class="row">
	<div class="col-sm-12 center-div-parent">
        <div class="col-sm-5 center-div-child">
            <?php if (isset($error_invalid_user)) { ?>
                <span style="color:red;font-size:11px;"><?php echo $error_invalid_user; ?></span>
            <?php } ?>
            <form class="user_signup" action="{action}" id="user_signup" method="post"  name="user_signup" enctype="multypart/formdata">
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
                <div class="checkbox col-sm-12" style="padding:0px">
                    <label><input type="checkbox"> Remember me</label><br/>
                    <a href="#">Forgot password </a>
                    <button type="submit" class="btn btn-primary pull-right">Sign in</button>
                </div>
            </form>
            <div class="col-sm-12" style="padding:0px">
                <a href="<?php echo base_url(); ?>auth/signup">Signup </a>
            </div>
        </div>
	</div>
</div> <!-- Home Bottom Header -->
