<div class="row">		
	<div class="col-sm-12">		
		<div class="main-home-slider">
		    <div class="social-icon-cover">
                <a href="#">
                    <img src="<?php echo base_url(); ?>my-assets/front/images/facebook-icon.png" align="left" class="img-responsive">
                </a>
                <a href="#">
                    <img src="<?php echo base_url(); ?>my-assets/front/images/twitter-icon.png" align="left" class="img-responsive">
                </a>
                <a href="#">
                    <img src="<?php echo base_url(); ?>my-assets/front/images/gplus-icon.png" align="left" class="img-responsive">
                </a>
            </div>
            <?php
            if (! $is_active_view) {
            ?>
			<div class="signin col-lg-4 pull-right">
				<div class="header"> Sign in</div>
				<div class="body">
					<form class="user_signin" action="<?php echo base_url(); ?>auth/signin" id="user_signin" method="post"  name="user_signin" enctype="multypart/formdata">
					    <div class="form-group">
					        <input type="email" name="user_name" class="form-control solid-border" id="inputEmail" placeholder="Email">
					    </div>
					    <div class="form-group">
					        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
					    </div>
					    <div class="checkbox col-sm-8" style="padding:0px">
					        <label><input type="checkbox"> Remember me</label><br/>
					        <a href="#">Forgot password </a>
					    </div>
					    <div style="margin-top:27px">
					   		<button type="submit" class="btn btn-primary pull-right">Sign in</button>
					    </div>
					</form>
				</div>
			</div>
            <?php } ?>
		</div>
	</div>
</div> <!-- Home Bottom Header -->

<div class="row">		
	<div class="col-sm-12">		
		<div class="main-home-body">	
			<div class="col-sm-4">
				<div class="start-exam-button">	
					<a href="#">Start an exam </a>
				</div>
				<div class="popular-course">
					<div class="header"> Popular Test/Exams/Courses </div>
                    <?php
                    if (!empty($popular_exams)) {
                    ?>
                        <ul>
                            {popular_exams}
                            <li><span class="exam-name-wrapper">{exam_name}</span> {start_link}</li>
                            {/popular_exams}
                        </ul>
                    <?php
                    }
                    ?>
				</div>
			</div>

			<div class="col-sm-4">	
				<div class="start-exam-button">	
					<a href="#">Create/Assign Exam </a>
				</div>
                <div class="exam-taker">
                    <div class="header"> Recent exam taker...</div>
                    <?php
                    if (!empty($exam_takers)) {
                    ?>
                    {exam_takers}
                        <div class="exam-taker-row">
                            <div class="exam-date">{final_date}</div>
                            <div style="float:left;width:22%">
                                <img src="<?php echo base_url(); ?>my-assets/front/images/profile/default.jpg"
                                     class="img-responsive" alt="{name}" width="50" height="">
                            </div>
                            <div class="user-name">{first_name} {last_name}</div>
                            <div class="score-exam-time">
                                <span class="exam-score">Score : {score} </span>
                                <span class="exam-time">{final_time}</span>
                            </div>
                        </div>
                    {/exam_takers}
                    <?php
                    }
                    ?>
                </div>  <!--  .exam-taker end-->
			</div>

			<div class="col-sm-4">	
				<div class="search">	
					<form>
						<input type="text" id="search" name="search" placeholder="Google search within this website" />
						<button>Search</button>
					</form>
				</div>
				<div class="signup">
                    <?php
                    if (! $is_active_view) {
                    ?>
                        <div class="header"> Signup </div>
                        <div class="body">
                            <form method="post" name="user-signup" action="<?php echo base_url(); ?>auth/signup" class="user-signup" id="user-signup"  >
                                <div class="form-group">
                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="user_name" id="user_name" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6" style="padding:0px;margin-top:0px;">
                                        <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile">
                                    </div>
                                    <div class="col-sm-6" style="padding-right:0px;margin-top:0px;">
                                        <select class="form-control" name="mobile_no" id="user_type">
                                            <option></option>
                                            <option value="2"> Student </option>
                                            <option value="3"> Institute </option>
                                        </select>
                                    </div>
                                </div><br><br>
                                <div class="form-group" id="institute_name_field" style="display:none;padding-bottom:0px;margin-bottom:0px;">
                                    <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Institute Name">
                                </div>
                                <div class="checkbox col-sm-6" style="padding:0px">
                                    <a href="#">Forgot password </a>
                                </div>
                                <div class="col-sm-6" style="margin-top:15px;padding-right:0px;">
                                    <button type="submit" class="btn btn-primary pull-right">Sign in</button>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#user_type').change(function() {
	    if ($(this).val() === '3') {
	        $('#institute_name_field').show();
	    }else{
	    	$('#institute_name_field').hide();
	    }
	});

    //Home Slider
    $(document).ready(function() {
        $(".main-home-slider").backgroundCycle({
            imageUrls: [
                "<?php echo base_url(); ?>my-assets/front/images/home-slider/1.jpg",
                "<?php echo base_url(); ?>my-assets/front/images/home-slider/2.jpg",
                "<?php echo base_url(); ?>my-assets/front/images/home-slider/3.jpg",
                "<?php echo base_url(); ?>my-assets/front/images/home-slider/4.jpg",
                "<?php echo base_url(); ?>my-assets/front/images/home-slider/5.jpg",
                "<?php echo base_url(); ?>my-assets/front/images/home-slider/6.jpg",
            ],
            fadeSpeed: 3000,
            duration: 5000,
            backgroundSize: SCALING_MODE_COVER
        });
    });
</script>