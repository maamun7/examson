<script src="<?php echo base_url(); ?>my-assets/front/js/exam_timer.js"></script>
<div class="row">		
	<div class="col-sm-12 col-md-12 col-lg-12">
			
	</div>
</div>
<div class="row">	
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div id="bredcumbs" class="bredcumbs">
			<?php 
				print_r($bredcumbs);
                if ($this->session->userdata('exam_type') != 1) {
                    if (!empty($subject_ids)) {
                        echo " > ";
                        foreach ($subject_ids as $subject_name => $val) {
                            echo $subject_name . ", ";
                        }
                    }
                }
			?>
		</div>	
		<div id="bredcumbs">
			<ul class='bredcumb-subj'>
				<?php
                    if ($this->session->userdata('exam_type') != 1) {
                        if (!empty($subject_ids)) {
                            foreach ($subject_ids as $subject_name => $val) {
                                echo "<li>" . $subject_name . "</li>";
                            }
                        }
                    } else {
                        echo "<li>" . $subject_ids . "</li>";
                    }
				?>
			</ul>
		</div>
	</div>
</div>
<div class="row test">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<form method="post" id="exam_form" action="" >
			<div id="exam-left" class="col-sm-12 col-md-8 col-lg-8">
				<div id="question-head">
				<?php if (!empty($question_option)) { ?>

					<!-- Question Sequence -->
					<?php if(strlen($question_option[0]['sequence_number'])<2){ echo "0";} echo $question_option[0]['sequence_number']; ?> .
					
					<!-- Question Picture -->
					<?php
					$question_pic = $question_option[0]['ques_pic'];
					$image_path = $question_option[0]['ques_pic_path'];

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
					
					<?php echo html_entity_decode($question_option[0]['details'],ENT_QUOTES,'utf-8'); ?>
					<input type="hidden" name="question_id" value="<?php echo $question_option[0]['question_id']; ?>" />
					<input type="hidden" name="sequence_no" value="<?php echo $question_option[0]['sequence_number']; ?>" />

				<?php }else{ echo "You have finished your all questions"; } ?>
				</div>
				<div id="options">
                    <div class="option-height">
					<?php if (!empty($question_option)) { ?>
						<?php foreach ($question_option as $key => $value) { ?>
							<span>
								<input type="radio" name="answer_option" <?php echo $value['checked']; ?> value="<?php echo $value['id']; ?>" />
								<!-- Option Picture -->
								<?php
								if ($value['image'] !='') {
									$picture = base_url().'uploads/question/options/'.$value['image'];
									$pic_path = $value['image_path']."".$value['image'];
					                if (file_exists($pic_path)) {
					            ?>
			                    		<img src="<?php echo $picture; ?>" height="60" width="95" />

								<?php } ?>
							<?php } ?>							
					            <!--Option text -->
								<?php echo $value['option_details']; ?>
							</span> <br/>
						<?php } ?>
					<?php } ?>
                    </div>
					<div id="exam-all-button">
						<table width="100%">
							<tr>
							<?php if (!empty($question_option)) { ?>
								<td width="46%">
                                    <button class="btn-submit" value="make_review">Mark for review</button>
                                </td>
								<!--<td><button class="btn-submit" value="clear">Clear</button></td>-->
                                <td width="34%">
                                    <button class="btn-submit" value="skip">Skip</button>
                                </td>
                                <td width="21%">
                                    <button class="btn-submit" value="save_next" style="background: #003340;color:#fff">Save & Next</button>
                                </td>
							<?php }else{ ?>
                                <td width="50%">
                                    <a href="#"><button class="btn-submit">Cancel</button></a>
                                </td>
                                <td width="50%">
                                    <a href="<?php echo base_url(); ?>exam/save_user_result">
                                        <span class="btn-submit" style="float:right;background: #003340;color:#fff">Save and Finish Exam</span>
                                    </a>
                                </td>
							<?php } ?>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div id="exam-right" class="col-sm-6 col-md-4 col-lg-4">
				<div id="exam-watch">
					<div id="clockContaner">
						<div class="clockWatch"></div>
						<div class="examTimer">
							<div class="timeHour">  </div>
							<div class="timeMin">  </div>
							<div class="timeSec">  </div>
						</div>
					</div>
					<br/>
					<span class="loader" style="display:none;">Loading....</span>	
				</div>
				<div id="question-palette">
					<div id="question-palette-head">
						Question Palette :
					</div>
					<div id="palette-container">
						<?php
						if (!empty($question_sets)) { $i=0;
							foreach ($question_sets as $key => $value) { $i++ ;
								$palette_class ="palette-not-viewed";
								if ($value['is_answered'] == 1) {
									$palette_class ="palette-answered";
								}
								if ($value['is_not_answered'] == 1) {
									$palette_class ="palette-not-answered";
								}
								if ($value['is_marked'] == 1) {
									$palette_class ="palette-marked";
								}
						?>
								<div class="round-palette <?php echo $palette_class; ?>" name="<?php echo $value['sequence_number']; ?>@<?php echo $value['question_id']; ?>"> <?php if(strlen($value['sequence_number'])<2){ echo "0";} echo $value['sequence_number']; ?> </div>
						<?php
							} 
						}
						?>
					<!-- 	<div class="round-palette palette-not-viewed">01</div>
						<div class="round-palette palette-default">02</div>
						<div class="round-palette palette-default">03</div>
						<div class="round-palette palette-default">04</div>
						<div class="round-palette palette-answered">05</div>
						<div class="round-palette palette-not-answered">06</div>
						<div class="round-palette palette-marked">07</div> -->
					</div>
				</div>
			</div>
		</form>
	</div>
</div>	

<script type="text/javascript">
	myStopWatchr = new antiClock(<?php echo $hour; ?>,<?php echo $minute; ?>,<?php echo $second; ?>);
</script>

<script type="text/javascript">
$(document).ready(function() {
	$('.btn-submit').click(function(ev) {
		// form submit event
		var exmForm = $('#exam_form');
		var btn_value = $(this).val();

	    exmForm.submit(function (ev) {	
			var url = "<?php echo base_url(); ?>exam/submit_exam";
			// Stop form from submitting normally
	  		ev.preventDefault();

			$.ajax({
				url: url, // form action url
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data: exmForm.serialize() + '&option_type='+ btn_value, // serialize form data 			
				cache: false,
				error: function(ev) {
					//console.log(ev);
				},
				beforeSend: function() {
					$('.loader').show();

				},
				complete: function(){
					$('.loader').hide();
				},
				success: function(json) {
					$('.test').html(json);
				}
			});

		});
	});
});


//Load Single Questions
$(document).ready(function() {
	$(".round-palette").click(function()
	{			
		var link = "<?php echo base_url(); ?>exam/single_q_exam";
		var id=$(this).attr('name');
		var dataString = 'ids='+ id;

		$.ajax({
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
				$('.test').html(json);
			}
		});
	});
});
</script>
