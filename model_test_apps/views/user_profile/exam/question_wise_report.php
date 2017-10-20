<!--<div id="question-wise-report" style="">-->
<div id="question-head" style="width:100%;padding:5px 0px;">
	<div id="Left-Arrow"></div>
	<div id="Question-Part">
	<?php if (!empty($question_ans)) { ?>

		<!-- Question Sequence -->
		<?php echo "Q ".$quest_sequence_no; ?> .
		
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
				<td width="17%"><div class="<?php if($value['checked'] !==""){ if($value['id'] == $correct_option_id){ echo "user_answer_correct"; }else{ echo "user_answer_incorrect"; } } ?>"> <?php if($value['checked'] !==""){echo "Your Answer"; } ?> </div></td>
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
</script>
			