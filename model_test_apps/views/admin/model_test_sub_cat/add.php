<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				Add New Model Test Category
				<small class="pull-right red_color">Star marks field are mandatory.</small>
			</div>
			<div class="panel-body">		
				<div class="pull-right">			
					<a onclick="$('#form').submit();" class="btn btn-success">Save</a>
			        <a href="<?php echo base_url();?>admin/model_test_sub_category" class="btn btn-primary btn-large">Cancel</a>
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
										Model Test Category <span class="red_color">*</span>
									</td>
									<td class="col-lg-4">
                                        <select name="category_id" class="form-control">
                                            <option value=""> Select Category </option>
											<?php
											if(! empty($category_lists)){
												foreach($category_lists as $category_list){
											?>
													<option value="<?php echo $category_list['id'];  ?>" <?php if (isset($category_value) && $category_value == $category_list['id']) {echo "selected='selected'"; }?>><?php echo $category_list['category_name']; ?></option>
											<?php 
												}
											}
											?>
                                        </select>
									</td>
									<td class="col-lg-4">
										<?php if (isset($error_category_name)) { ?>
											<span class="red_color"><?php echo $error_category_name; ?></span>
				                        <?php } ?>
									</td>
								</tr>
								<tr>						
									<td class="col-lg-3 text-right">
										Sub Category Name <span class="red_color">*</span>
									</td>
									<td class="col-lg-4">
										<input type="text" tabindex="1" class="form-control" name="sub_cat_name" value="<?php if (isset($sub_cat_name_value)) { echo $sub_cat_name_value; } ?>" placeholder="Enter Sub Category Name" />
									</td>
									<td class="col-lg-4 text-left">
										<?php if (isset($error_sub_category_name)) { ?>
				                        <span class="red_color"><?php echo $error_sub_category_name; ?></span>
				                        <?php } ?>
									</td>
								</tr>							
								<tr> <td colspan="3"> </td> </tr>
							</tbody>
						</table>
			    	</form>		
				</div>
			</div>
		</div>
	</div>
</div>
