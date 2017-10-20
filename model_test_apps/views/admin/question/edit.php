<link href="<?php echo base_url(); ?>assets/admin/js/plugins/text_editor/jquery-te-1.4.0.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/text_editor/jquery-te-1.4.0.min.js"></script>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				Edit Question
				<small class="pull-right red_color">Star marks field are mandatory.</small>
			</div>
			<div class="panel-body">
				<form class="form-vertical" action="{action}" id="supplier" method="post"  name="insert_product" enctype="multipart/form-data">
					<div class="tab-content">
						<div class="tab-pane fade in active" id="question_part">						
							<div class="table-responsive" style="margin-top:10px;">
								<table class="table table-condensed  table-striped table-bordered table-hover">
									<thead></thead>
									<tbody id="OptionField">
										<tr>						
											<td class="col-lg-3 text-right">
												Select Category <span class="red_color">*</span>
											</td>
											<td class="col-lg-4">
												<select name="category_id"class="selectCategory form-control">                                            
													<?php 
													if (!empty($parent_categories)) {
														echo '<option value="">...Select...</option>';
														foreach ($parent_categories as $value) {
													?>                                            	                           	
														<option value="<?php echo $value['id']; ?>" <?php if(isset($parent_cat_value) && $parent_cat_value==$value['id']){echo "selected='selected'"; } ?> ><?php echo $value['name']; ?></option>
													<?php
														}
													}else{
														echo '<option value="">None</option>';
													}
													?>
												</select>
											</td>
											<td class="col-lg-4 text-left">
												<?php if (isset($error_category_id)) { ?>
												<span class="red_color"><?php echo $error_category_id; ?></span>
												<?php } ?>
											</td>
										</tr>
										<tr>						
											<td class="col-lg-3 text-right">
												Select Sub Category <span class="red_color">*</span>
											</td>
											<td class="col-lg-4">
		                                        <select name="sub_cat_id" id="sub_cat_id" class="retrieveSubCat form-control">
													<option value="">..First Select Category..</option> 
													{sub_categories}
														<option value="{id}" {selected}>{name}</option>  
													{/sub_categories}
												</select>
											</td>
											<td class="col-lg-4">
												<i id="loader1" class="fa fa-spinner"></i>
												<?php if (isset($error_sub_cat_id)) { ?>
						                        	<span class="red_color"><?php echo $error_sub_cat_id; ?></span>
						                        <?php } ?>
											</td>
										</tr>
										<tr>						
											<td class="col-lg-3 text-right">
												Select Subject<span class="red_color">*</span>
											</td>
											<td class="col-lg-4">
		                                        <select name="subject_id" id="subject_id" class="retrieveSubject form-control">
													<option value="">..First Select Subject..</option> 
													{subjects}
														<option value="{id}" {selected}>{subject_name}</option>  
													{/subjects}
												</select>
											</td>
											<td class="col-lg-4">
												<i id="loader2" class="fa fa-spinner"></i>
												<?php if (isset($error_subject_id)) { ?>
						                        	<span class="red_color"><?php echo $error_subject_id; ?></span>
						                        <?php } ?>
											</td>
										</tr>
										<tr>						
											<td class="col-lg-3 text-right">
												Select Chapter<span class="red_color">*</span>
											</td>
											<td class="col-lg-4">
												<select name="chapter_id" id="chapter_id" class="retrieveChapter form-control">
													{chapters}
														<option value="{id}" {selected}>{chapter_name}</option>  
													{/chapters}
													
												</select>
											</td>
											<td class="col-lg-4">
												<i id="loader3" class="fa fa-spinner"></i>
												<?php if (isset($error_chapter_id)) { ?>
													<span class="red_color"><?php echo $error_chapter_id; ?></span>
												<?php } ?>
											</td>
										</tr>
										<tr>						
											<td class="col-lg-3 text-right">
												Question Detail<span class="red_color">*</span>
											</td>
											<td colspan="2" class="col-lg-4">
												<textarea type="text" class="txtEditor form-control" name="question_name" placeholder="Enter Question Name" /><?php if (isset($question_name_value)) { echo $question_name_value; } ?></textarea>
												<?php if (isset($error_question_name)) { ?>
												<span class="red_color"><?php echo $error_question_name; ?></span>
												<?php } ?>
											</td>
										</tr>
										<tr>						
											<td class="col-lg-3 text-right">
												Select Picture
											</td>
											<td class="col-lg-4">
												<!--<input type="file" name="question" multiple OnChange="image(this)">-->
                                                <input id="uploadFile" type="file" name="question" />

                                                <?php if (isset($error_question_picture)) { ?>
                                                <span class="red_color"><?php echo $error_question_picture; ?></span>
                                                <?php } ?>
											</td>
											<td class="col-lg-4">
                                                <div id="imagePreview"></div>
												
												<?php
												if ($question_pic !='') {
													$picture = base_url().'uploads/question/questions/'.$question_pic;
													$pic_path = $image_path."".$question_pic;
									                if (file_exists($pic_path)) {
									            ?>
									                    <img src="<?php echo $picture; ?>" height="60" width="95" />
									                    <span onclick='delete_question_picture(<?php echo $question_id; ?>)'><i style="color:red" title="Delete Picture">&times;</i></span>
									            <?php
									            	}
									            }
									            ?>
											</td>
										</tr>
										<tr>						
											<td class="col-lg-3 text-right">
												Published
											</td>
											<td class="col-lg-4">
												<select name="published_sts" class="form-control">
													<option value="1" <?php if (isset($published_sts_value) AND $published_sts_value==1) {echo "selected='selected'"; }?>>Published</option>
													<option value="0" <?php if (isset($published_sts_value) AND $published_sts_value==0) {echo "selected='selected'"; }?>>Un published</option>
												</select>
											</td>
											<td class="col-lg-4"><input type="hidden" name="question_id" value="{question_id}"></td>
										</tr>
										<?php
										$i=0;
										if (!empty($all_edit_data)) {
											
											foreach ($all_edit_data as $value) { $i++;
											?>
											<tr>						
												<td class="col-lg-3 text-right">
													Option <?php echo $i; ?>
												</td>
												<td class="col-lg-5">
													<textarea class="editor_1 form-control" name="option_name[]" placeholder="Enter Option Name" ><?php echo $value['option_details']; ?></textarea>
	                                                <?php if (isset($error_option_name)) { ?>
	                                                <span class="red_color"><?php echo $error_option_name; ?></span>
	                                                <?php } ?>
	                                                <input type="hidden" name="option_id[]" value="<?php echo $value['id']; ?>" />

	                                            </td>
												<td class="col-lg-3">
													 <input type="radio" id="right_answer" <?php if($value['answer_option_id'] ==  $value['id']){echo "checked='checked'";} ?> name="right_answer_<?php echo $i; ?>" value="1" /> &nbsp; Is Right Answer
													<span class='pull-right closeRow'  onclick='delete_option(<?php echo $value['id']; ?>);' >&times;</span>"
												</td>
											</tr>										
											<tr>						
												<td class="col-lg-3 text-right">
													Select Option Picture <?php echo $i; ?>
												</td>
												<td class="col-lg-4">
												     <input type="file" name="option_img_<?php echo $i; ?>" onchange="show_picture(this,<?php echo $i; ?>);">
												</td>
												<td class="col-lg-4">                                                
	                                                <div class="option" id="option_<?php echo $i; ?>"></div>
	                                                <?php
													if ($value['image'] !='') {
														$picture = base_url().'uploads/question/options/'.$value['image'];
														$pic_path = $value['image_path']."".$value['image'];
										                if (file_exists($pic_path)) {
										            ?>
										                    <img src="<?php echo $picture; ?>" height="60" width="95" />
									                    <span onclick='delete_option_picture(<?php echo $question_id; ?>)'><i style="color:red" title="Delete Picture">&times;</i></span>
										            <?php
										            	}
										            }
										            ?>                                 
	                                            </td>
											</tr>
											<?php
											}
										}
										?>
									</tbody>	
									</tfoot>	
										<tr> 
											<td colspan="2"> <input type="hidden" id="total_raw_option" value="<?php echo $i+1; ?>" /> </td> 
											<td> 
												<input type="button" id="add-invoice-item" class="btn btn-success" name="add-invoice-item"  onClick="addOptionFieldForEdit('OptionField',5);" value="Add new Option" />
											</td> 
										</tr>								
										<tr> <td colspan="3"> </td> </tr>										
										<tr>						
											<td class="col-lg-3"></td>
											<td class="col-lg-5">
												<input type="submit" id="add-question" class="btn btn-info btn-large" tabindex="5" name="add-question" value="Save Changes" />
											</td>						
											<td class="col-lg-3"></td>
										</tr>
									</tfoot>
								</table>	
							</div>
						</div>					
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<span id="baseUrl" name="<?php echo base_url(); ?>"></span>
<script src="<?php echo base_url(); ?>my-assets/admin/js/question.js"></script>
<!--editor initialization script-->
<script>
    $('.txtEditor').jqte();
</script>
<!--showing image after select script-->
<script type="text/javascript">
    $(function() {
        $("#uploadFile").on("change", function()
        {
            
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function(){ // set image data as background of div
                    $("#imagePreview").css("background-image", "url("+this.result+")");
                }
            }
        });
    });

    function show_picture(ele,optn_no){

            var files = !!ele.files ? ele.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function(){ // set image data as background of div
                    $("#option_"+optn_no).css("background-image", "url("+this.result+")");
                }
            }
    }

// delete queatoin previous image
    function delete_question_picture(question_id){
    	var baseUrl = "<?php echo base_url(); ?>";
    	var dataString = 'question_id='+ question_id;
    	var x = confirm("Are You Sure ?");				
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: baseUrl+"admin/question/delete_question_picture",
				data: dataString,
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
    }
// delete queatoin previous image
    function delete_option_picture(option_id){
    	var baseUrl = "<?php echo base_url(); ?>";
    	var dataString = 'option_id='+ option_id;
    	var x = confirm("Are You Sure ?");				
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: baseUrl+"admin/question/delete_option_picture",
				data: dataString,
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
    }
// delete a single option with picture
    function delete_option(option_id){
    	var baseUrl = "<?php echo base_url(); ?>";
    	var dataString = 'option_id='+ option_id;
    	//alert(dataString);
    	var x = confirm("Are You Sure ?");				
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: baseUrl+"admin/question/delete_option",
				data: dataString,
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
    }

</script>