<script src="<?php echo base_url(); ?>my-assets/front/js/exam_timer.js"></script>
<div class="row">		
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div id="report-left" class="col-sm-8 col-md-6 col-lg-6">
			<div id="report-top-left">
				<div class="nav">
					<ul>
						<li> <a href="#"> Save </a> </li>
						<li> <a href="#"> Re-exam </a> </li>
						<li> <a href="#"> Share </a> </li>
						<li> <a href="#"> Print </a> </li>
					</ul>
				</div>
				<div class="heading">Exam's Report </div>
				<div class="table_container">
					<table border="0" style="margin-top:10px;">
						<tr>
							<th width="40%">Time of Exam:</th>
							<td width="3%"></td>
							<td width="55%"><?php echo $final_date; ?></td>
						</tr>
						<tr>
							<th width="40%">Assign by:</th>
							<td width="3%"></td>
							<td width="55%">Myself</td>
						</tr>
						<tr>
							<th width="40%">Subject/Course:</th>
							<td width="3%"></td>
							<td width="55%"><?php echo $subject_name; ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>		
		<div id="report-right" class="col-sm-8 col-md-6 col-lg-6">	
			<div id="report-top-right">
				AD
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12" style="height:auto;overflow:hidden;">
		<div id="report-left" class="col-sm-6 col-md-4 col-lg-4">
			<script>
			$(document).ready(function(){
				$(".report-bar-1").click(function(){
					$(".report-bar-1-content").slideDown();
					$(".report-bar-2-content").slideUp();
					//Arrow icon					
					$(".top-arrow-right").show();
					$(".top-arrow-down").hide();					
					$(".bottom-arrow-right").hide();
					$(".bottom-arrow-down").show();
					//Rihgt portion
					$("#question-wise-report").show();
					$(".summarise-report").hide();
				});
				
				$(".report-bar-2").click(function(){
					$(".report-bar-1-content").slideUp();
					$(".report-bar-2-content").slideDown();
					//Arrow icon							
					$(".top-arrow-right").hide();
					$(".top-arrow-down").show();
					$(".bottom-arrow-right").show();
					$(".bottom-arrow-down").hide();
					//Rihgt portion						
					$("#question-wise-report").hide();
					$(".summarise-report").show();
				});
			});
			//Tab
			$(document).ready(function(){
				$(".basic-tab").click(function(){
					$(".summarise-report-advance").hide();
					$(".summarise-report-basic").show();
					$(".advance-tab").addClass("bg-border");					
					$(".basic-tab").removeClass("bg-border");
				});
				$(".advance-tab").click(function(){					
					$(".summarise-report-basic").hide();
					$(".summarise-report-advance").show();
					$(".basic-tab").addClass("bg-border");
					$(".advance-tab").removeClass("bg-border");
				});
			});
			</script>
			<div id="accordion_container">
				<div id="accordion-report-bar" class="report-bar-1">
					<span> Question-wise Report </span> 
					<span class="glyphicon glyphicon-chevron-right top-arrow-right" style="float:right;margin:9px;"></span>
					<span class="glyphicon glyphicon-chevron-down top-arrow-down" style="float:right;margin:9px;display:none;"></span>
				</div>
				<div id="question-palette" style="margin: 4px 5px 0 0;" class="report-bar-1-content">
					<p> Question Palette :	 </p>
					<div id="palette-container">
						<?php
						if (!empty($circle_datas)) { $i=0;
							foreach ($circle_datas as $k => $v) { $i++ ;
								if ($v !== "") {
									if ($v == 1) {
										$palette_class ="palette-answered";
									}else if ($v == 0) {
										$palette_class ="palette-not-answered";
									}
								}else{
									$palette_class ="palette-not-viewed";									
								}
						?>
								<div class="round-palette ques_seq_<?php echo $i; ?> <?php echo $palette_class; ?>" name="<?php echo $k; ?>"> <?php if(strlen($i)<2){ echo "0";} echo $i; ?> </div>
						<?php
							} 
						}
						?>
					</div>
				</div>
				<div id="accordion-report-bar" class="report-bar-2">
					<span> Summarise Report </span>					
					<span class="glyphicon glyphicon-chevron-down bottom-arrow-down" style="float:right;margin:9px"></span>
					<span class="glyphicon glyphicon-chevron-right bottom-arrow-right" style="float:right;margin:9px;display:none;"></span>
				</div>
				<div id="summarise-report-pallete" class="report-bar-2-content" style="padding:0px;background-color: #fff;">
					<div id="summarise-report-indicator">
						<img class="img-responsive" width="100%" alt="logo" src="<?php echo base_url(); ?>my-assets/front/images/summarise-report.png">
					</div>
					<div class="ad">
					AD
					</div>
				</div>
			</div>
		</div>
		<div id="report-right" class="col-sm-12 col-md-8 col-lg-8">
			<div id="question-wise-report" style="">
				<div id="question-head" style="width:100%;padding:5px 0px;">
					<div id="Left-Arrow"></div>
					<div id="Question-Part">
					<?php if (!empty($question_ans)) { ?>

						<!-- Question Sequence -->
						<?php echo "Q 01"; ?> .
						
						<!-- Question Picture -->
						<?php
						$question_pic = $question_ans[0]['ques_pic'];
						$image_path = $question_ans[0]['ques_pic_path'];

						if ($question_pic !='') {
							$picture = base_url().'uploads/question/questions/'.$question_pic;
							$pic_path = $image_path."".$question_pic;
							if (file_exists($pic_path)) {
						?>
								<img src="<?php echo $picture; ?>" height="60" width="95" />
						<?php
							}
						}
						?>

						<!--Question text -->
						
						<?php echo html_entity_decode($question_ans[0]['details'],ENT_QUOTES,'utf-8'); ?>
					<?php }else{ echo "You have finished your all questions"; } ?>
					</div>
					<div id="Right-Arrow"></div>
				</div>
				<div id="question-wise-options" style="width:100%;">
					<div class="options"> Options </div>
					<?php if (!empty($question_ans)) { ?>
						<table border="0">
						<?php foreach ($question_ans as $key => $value) { ?>
							<tr>
								<td width="17%" style="padding:0px;"><div class="<?php if($value['checked'] !==""){ if($value['id'] == $correct_option_id){ echo "user_answer_correct"; }else{ echo "user_answer_incorrect"; } } ?>"> <?php if($value['checked'] !==""){echo "Your Answer"; } ?></div> </td>
								<td width="3%">
									<input type="radio" name="answer_option" <?php echo $value['checked']; ?> disabled="disabled"/>
								</td>
								<td>
									<?php
									if ($value['image'] !='') {
										$picture = base_url().'uploads/question/options/'.$value['image'];
										$pic_path = $value['image_path']."".$value['image'];
										if (file_exists($pic_path)) {
									?>
											<img src="<?php echo $picture; ?>" height="60" width="95" />

									<?php } ?>
								<?php } ?>				
									<?php echo $value['option_details']; ?>
								</td>
							</tr>
						<?php } ?>
						</table>
					<?php } ?>
				</div>
				<div id="question-head" style="width:100%;">			
					<?php if (!empty($question_ans)) { ?>
						<?php foreach ($question_ans as $keys => $values) { ?>
							<?php if ($correct_option_id == $values['id']) { ?>
								<span>
									<i>Correct answer :</i>
									
									<?php
									if ($values['image'] !='') {
										$picture = base_url().'uploads/question/options/'.$values['image'];
										$pic_path = $values['image_path']."".$values['image'];
										if (file_exists($pic_path)) {
									?>
											<img src="<?php echo $picture; ?>" height="60" width="95" />

									<?php } ?>
								<?php } ?>				
									<?php echo $values['option_details']; ?>
								</span>
							<?php } ?>
						<?php } ?>
					<?php } ?>				
				</div>
			</div>				
			<div class="summarise-report" style="width:100%;display:none">
				<ul>
					<li class="basic-tab">Basic Report</li>
					<li class="advance-tab bg-border">Advance Report</li>
				</ul>
				<div class="summarise-report-basic">
					<div style="float:left;width:100%;">
						<!--- Heading Start-->
						<table style="margin-bottom:15px;">
							<tr>
								<td width="30%" style="border:0px solid #fff;"><div class="basic-advance-summarise-report-ad">AD</div></td>
								<td width="40%" style="border:0px solid #fff;"><div class="basic-advance-summarise-report-heading">Summarise Report</div></td>
								<td width="30%" style="border:0px solid #fff;"><div class="basic-advance-summarise-report-ad">AD</div></td>
							</tr>
						</table>
						<table style="margin-bottom:15px;">
							<tr>
								<td style="border:0px solid #fff;width:60%;text-align:left;">Name:</td>
								<td style="border:0px solid #fff;width:40%;text-align:left;">Time Taken: <b><?php echo $time_taken; ?> </b></td>
							</tr>
							<tr>
								<td style="border:0px solid #fff;width:60%;text-align:left;">Exam name:<b><?php echo $exam_name; ?></b></td>
								<td style="border:0px solid #fff;width:40%;text-align:left;">Assign date & time: <b><?php echo $final_date; ?> </b></td>
							</tr>
							<tr>
								<td style="border:0px solid #fff;width:60%;text-align:left;">&nbsp;</td>
								<td style="border:0px solid #fff;width:40%;text-align:left;">Exam type: <b><?php echo $exam_type; ?> </b></td>
							</tr>
						</table>
					<!--- Heading End-->
												
						<table border="1" class="only-td-border">
							<?php
							if ($basic_report) {
								foreach ($basic_report as $key => $value) {									
							?>
								<tr>
									<th width="50%"><?php print_r($key); ?></th>
									<td><?php print_r($value); ?></td>
								</tr>
							<?php
								}
							}
							?>
						</table>	
						<!--<div style="width:100%;text-align:center;"><b>Note:</b></div>-->
					</div>
				</div>
				<div class="summarise-report-advance" style="display:none;">
				<!--- Heading Start-->
					<table style="margin-bottom:15px;">
						<tr>
							<td width="30%" style="border:0px solid #fff;"><div class="basic-advance-summarise-report-ad">AD</div></td>
							<td width="40%" style="border:0px solid #fff;"><div class="basic-advance-summarise-report-heading">Summarise Report</div></td>
							<td width="30%" style="border:0px solid #fff;"><div class="basic-advance-summarise-report-ad">AD</div></td>
						</tr>
					</table>
					<table style="margin-bottom:15px;">
						<tr>
							<td style="border:0px solid #fff;width:60%;text-align:left;">Name:</td>
							<td style="border:0px solid #fff;width:40%;text-align:left;">Time Taken: <b><?php echo $time_taken; ?></td>
						</tr>
						<tr>
							<td style="border:0px solid #fff;width:60%;text-align:left;">Exam name: <b><?php echo $exam_name; ?></b></td>
							<td style="border:0px solid #fff;width:40%;text-align:left;">Assign date & time: <b><?php echo $final_date; ?> </b></td>
						</tr>
						<tr>
							<td style="border:0px solid #fff;width:60%;text-align:left;">&nbsp;</td>
							<td style="border:0px solid #fff;width:40%;text-align:left;">Exam type: <b><?php echo $exam_type; ?> </b></td>
						</tr>
					</table>
					<!--- Heading End-->
					<div style="float:left;width:50%;">					
						<table border="1" class="only-td-border">
							<?php
							if ($basic_report) {
								foreach ($basic_report as $key => $value) {									
							?>
								<tr>
									<th width="50%"><?php print_r($key); ?></th>
									<td><?php print_r($value); ?></td>
								</tr>
							<?php
								}
							}
							?>
						</table>							
					</div>
					<div style="float:left;width:50%;">
						<table border="1" class="only-td-border">
							<?php
							if ($advance_report) {
								foreach ($advance_report as $keys => $values) {									
							?>
								<tr>
									<th width="50%"><?php print_r($keys); ?></th>
									<td><?php print_r($values); ?></td>
								</tr>
							<?php
								}
							}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	

<script type="text/javascript">
	$(document).ready(function() {
		$('#Left-Arrow').click(function() {
		var question_id = $('.ques_seq_<?php echo $prev_sequence_no; ?>').attr('name');
			if (question_id != null) {			
				load_question_wise_report(question_id);
			}
		});
	});

	$(document).ready(function() {
		$('#Right-Arrow').click(function() {
			var question_id = $('.ques_seq_<?php echo $next_sequence_no; ?>').attr('name');
			if (question_id != null) {			
				load_question_wise_report(question_id);
			}
		});
	});

	function load_question_wise_report(question_id){
		var dataString = 'ques_id='+ question_id;
		var link = "<?php echo base_url(); ?>exam/question_wise_report";
		$.ajax
	   ({
			type: "POST",
			url: link,
			data: dataString,
			cache: false,
			error: function(ev) {
				//Alert popup
				$.prompt("Sorry! Can't load question", {
					buttons: {"Close": false }
				});
			},
			beforeSend: function() {
				$('.loader').show();
			},
			complete: function(){
				$('.loader').hide();
			},
			success: function(json) {
				$('#question-wise-report').html(json);
			}
		});
	}
	
	$(document).ready(function() {
		$('.round-palette').click(function() {
			var question_id = $(this).attr('name');
			if (question_id != null) {			
				load_question_wise_report(question_id);
			}
		});
	});
</script>
