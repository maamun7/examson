<link href="<?php echo base_url(); ?>assets/admin/js/plugins/text_editor/jquery-te-1.4.0.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/text_editor/jquery-te-1.4.0.min.js"></script>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				Add New Question
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
													<option value="">..Select Subject..</option> 
													
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
													<option value="">..Select Chapter..</option> 
													
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
												<textarea type="text" class="txtEditor form-control" name="question_name" placeholder="Enter Question Name" /><?php if (isset($chapter_name_value)) { echo $chapter_name_value; } ?></textarea>
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
												<!--<img id="images" class="question_photo" width="100" height="100" /> -->
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
											<td class="col-lg-4"></td>
										</tr>
										<tr>						
											<td class="col-lg-3 text-right">
												Option 1
											</td>
											<td class="col-lg-5">
												<textarea class="editor_1 form-control" name="option_name[]" placeholder="Enter Option Name" ><?php if (isset($option_name_value)) { echo $option_name_value; } ?></textarea>
                                                <?php if (isset($error_option_name)) { ?>
                                                <span class="red_color"><?php echo $error_option_name; ?></span>
                                                <?php } ?>
                                            </td>
											<td class="col-lg-3">
												 <input type="radio" id="right_answer" name="right_answer_1" value="1" /> &nbsp; Is Right Answer
											</td>
										</tr>										
										<tr>						
											<td class="col-lg-3 text-right">
												Select Picture
											</td>
											<td class="col-lg-4">
											     <input type="file" name="option_img_1" onchange="show_picture(this,1);">
											</td>
											<td class="col-lg-4">                                                
                                                <div class="option" id="option_1"></div>                                 
                                            </td>
										</tr>
									</tbody>	
									</tfoot>	
										<tr> 
											<td colspan="2"> </td> 
											<td> 
												<input type="button" id="add-invoice-item" class="btn btn-success" name="add-invoice-item"  onClick="addOptionField('OptionField');" value="Add new item" />
											</td> 
										</tr>								
										<tr> <td colspan="3"> </td> </tr>										
										<tr>						
											<td class="col-lg-3"></td>
											<td class="col-lg-5">
												<input type="submit" id="add-question" class="btn btn-info btn-large" tabindex="5" name="add-question" value="Save" />
												<input type="submit" value="Save and add another one" name="add-another-question" tabindex="6" class="btn btn-primary btn-large" id="add-another-question">
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

<script>
    $('.txtEditor').jqte();
</script>

<script type="text/javascript">
/*
	$(window).load(function() { 
		$("img.question_photo").each(function()
		{ 
			var image = $(this); 
			if(image.context.naturalWidth == 0 || image.readyState == 'uninitialized')
			{    
				$(image).unbind("error").attr("src", "../../images/no-image.png");
				$(this).css('background-color', '#EEEEEE');
				$(this).css('width', '150px');
				$(this).css('height', '120px');
				$(this).css('padding', '5px');
				$(this).css('border','1px solid #666666');
			} 
		});  
		$("img.question_photo").click(function(){
			$("#screenshot").click();
		})    
	});
	
	function image(ele)
    {
		$('#images').attr('src', ele.value); // for IE
		if (ele.files && ele.files[0]) {		
			var reader = new FileReader();			
			reader.onload = function (e) {
				$('#images').attr('src', e.target.result);
			}
			reader.readAsDataURL(ele.files[0]);
		}
    }
    */
</script>

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
</script>