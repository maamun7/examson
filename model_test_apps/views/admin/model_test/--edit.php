<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				Edit Model Test Category
				<small class="pull-right red_color">Star marks field are mandatory.</small>
			</div>
			<div class="panel-body">		
				<div class="pull-right">			
					<a onclick="$('#form').submit();" class="btn btn-success">Save Cahnges</a>
			        <a href="<?php echo base_url();?>admin/model_test_category" class="btn btn-primary btn-large">Cancel</a>
				</div>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
			    	<form class="form-vertical" action="{action}" id="form" method="post"  name="insert_product" enctype="multypart/formdata">
						<table class="table table-condensed table-striped">
							<thead></thead>
							<tbody id="form-actions">
								<tr>						
									<td class="col-lg-3 text-right">
										Select Parent
									</td>
									<td class="col-lg-4">
                                        <select name="parent_cat_id"class="form-control">
                                            <?php 
                                            if (!empty($parent_categories)) {
                                            	foreach ($parent_categories as $value) {
                                            ?>                                            	                           	
                                           		<option value="<?php echo $value['id']; ?>" <?php if(isset($parent_cat_value) && $parent_cat_value==$value['id']){echo "selected='selected'"; } ?> ><?php echo $value['category_name']; ?></option>
                                           	<?php
                                            	}
                                            }
                                            ?>
                                        </select>
									</td>
									<td class="col-lg-4 text-left">
										<?php if (isset($error_parent_cat_id)) { ?>
				                        <span class="red_color"><?php echo $error_parent_cat_id; ?></span>
				                        <?php } ?>
									</td>
								</tr>
								<tr>						
									<td class="col-lg-3 text-right">
										Model Test Name <span class="red_color">*</span>
									</td>
									<td class="col-lg-4">
										<input type="text" tabindex="1" class="form-control" name="model_test_name" value="<?php if (isset($model_test_name_value)) { echo $model_test_name_value; } ?>" placeholder="Enter Model Test Name" />
									</td>
									<td class="col-lg-4 text-left">
										<?php if (isset($error_model_test_name)) { ?>
				                        <span class="red_color"><?php echo $error_model_test_name; ?></span>
				                        <?php } ?>
									</td>
								</tr>
								<tr>						
									<td class="col-lg-3 text-right">
										Number Of Questions <span class="red_color">*</span>
									</td>
									<td class="col-lg-4">									
										<input type="text" readonly tabindex="2" class="form-control no_of_question" name="no_of_question" disable="disable" value="<?php if (isset($no_of_question_value)) { echo $no_of_question_value; } ?>" placeholder="Number of Question" />
									
									</td>
									<td class="col-lg-4 text-left">
										<?php if (isset($error_no_of_question)) { ?>
				                        <span class="red_color"><?php echo $error_no_of_question; ?></span>
				                        <?php } ?>
									</td>
								</tr>
								<tr>						
									<td class="col-lg-3 text-right">
										Duration Time <span class="red_color">*</span>
									</td>
									<td class="col-lg-4">
										<input type="text" tabindex="3" class="form-control" name="duration_time" value="<?php if (isset($duration_time_value)) { echo $duration_time_value; } ?>" placeholder="Enter Duration Time" />
									</td>
									<td class="col-lg-4 text-left">
										<?php if (isset($error_duration_time)) { ?>
				                        <span class="red_color"><?php echo $error_duration_time; ?></span>
				                        <?php } ?>
									</td>
								</tr>
								<tr>						
									<td class="col-lg-3 text-right">
										Published 
									</td>
									<td class="col-lg-4">
                                        <select name="published_sts" class="form-control">
                                            <option value="1" <?php if (isset($published_sts_value) && $published_sts_value==1) {echo "selected='selected'"; }?>>Published</option>
                                            <option value="0" <?php if (isset($published_sts_value) && $published_sts_value==0) {echo "selected='selected'"; }?>>Un published</option>
                                        </select>
									</td>
									<td class="col-lg-4"></td>
								</tr>
								<tr>						
									<td class="col-lg-3 text-right">
										Load Questions
									</td>
									<td class="col-lg-4">
										<input type="text" name="subject_name" tabindex="5" class="form-control subjectSelection" onclick="load_chapter();" placeholder='Type Subject Name' tabindex="3" required id="subject_name" >
										<input type="hidden" class="subject_hidden_value" name="subject_id" id="SchoolHiddenId"/>
										<input type="hidden" class="baseUrl" value="<?php echo base_url();?>" />
									</td>
									<td class="col-lg-4 text-left">
									</td>
								</tr>								
								<tr> 
									<td colspan="3">
										{questions}
											<div class="questions checkbox">
												<label><input type="checkbox" checked="checked" name="question_id[]" value="{question_id}" class="count_item" onchange="count_checked_items(this);">{details}</label>
											</div>
										{/questions}
										<div id="chapter-question">
										</div>
									</td>
								</tr>
							</tbody>
						</table>
			    	</form>		
				</div>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/common/jquery-ui-1.9.1/development-bundle/themes/base/jquery.ui.all.css">
<script src="<?php echo base_url(); ?>assets/common/jquery-ui-1.9.1/js/jquery-ui-1.9.1.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/common/jquery-ui-1.9.1/development-bundle/ui/jquery.ui.autocomplete.js"></script>
<script src="<?php echo base_url(); ?>my-assets/admin/js/autocomplete/subject.js.php"></script>
<script type="text/javascript">
function checked_unchecked_all(item,event){
	var select_item = ".select_"+item;
	//alert(select_item);
	if ($(event).is(':checked')) {		
		$(select_item).prop("checked", true);
	} else {
		$(select_item).prop("checked", false);
	}
	count_checked_items();
}

function count_checked_items(){	
	var count_checked = $('.count_item:checked').size();
	$(".no_of_question").val(count_checked);
}

</script>