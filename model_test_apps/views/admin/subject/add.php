<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				Add New Subject
				<small class="pull-right red_color">Star marks field are mandatory.</small>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
			    	<form class="form-vertical" action="{action}" id="supplier" method="post"  name="insert_product" enctype="multypart/formdata">
						<table class="table table-condensed table-striped">
							<thead></thead>
							<tbody id="form-actions">
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
										Subject Name <span class="red_color">*</span>
									</td>
									<td class="col-lg-4">
										<input type="text" tabindex="1" class="form-control" name="subject_name" value="<?php if (isset($subject_name_value)) { echo $subject_name_value; } ?>" placeholder="Enter Subject Name" />
									</td>
									<td class="col-lg-4 text-left">
										<?php if (isset($error_subject_name)) { ?>
				                        <span class="red_color"><?php echo $error_subject_name; ?></span>
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
										Ordering<span class="red_color">*</span>
									</td>
									<td class="col-lg-4">
										<input type="text" tabindex="1" class="form-control" name="ordering" value="<?php if (isset($ordering_value)) { echo $ordering_value; }else{ ?>#<?php } ?>" placeholder="Enter Only Numeric Value" />
									</td>
									<td class="col-lg-4 text-left"> 
										<?php if (isset($error_ordering)) { ?>
				                        <span class="red_color"><?php echo $error_ordering; ?></span>
				                        <?php } ?>
									</td>
								</tr>
								<tr> <td colspan="3"> </td> </tr>
								<tr>						
									<td class="col-lg-3"></td>
									<td class="col-lg-4">
										<input type="submit" id="add-subject" class="btn btn-info btn-large" tabindex="5" name="add-subject" value="Save" />
			           					<input type="submit" value="Save and add another one" name="add-subject-subject" tabindex="6" class="btn btn-primary btn-large" id="add-subject-another">
			        				</td>						
									<td class="col-lg-4"></td>
								</tr>
							</tbody>
						</table>
			    	</form>		
				</div>
			</div>
		</div>
	</div>
</div>
<span id="baseUrl" name="<?php echo base_url(); ?>"></span>
<script src="<?php echo base_url(); ?>my-assets/admin/js/subject.js"></script>
