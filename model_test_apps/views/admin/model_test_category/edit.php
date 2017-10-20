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
										Category Name <span class="red_color">*</span>
									</td>
									<td class="col-lg-4">
										<input type="text" tabindex="1" class="form-control" name="category_name" value="<?php if (isset($category_name_value)) { echo $category_name_value; } ?>" placeholder="Enter Category Name" />
									</td>
									<td class="col-lg-4 text-left">
										<?php if (isset($error_category_name)) { ?>
				                        <span class="red_color"><?php echo $error_category_name; ?></span>
				                        <?php } ?>
									</td>
								</tr>
								<tr>						
									<td class="col-lg-3 text-right">
										For country
									</td>
									<td class="col-lg-4">
                                        <select name="location_id" class="form-control">
                                            <option value="1" <?php if (isset($location_id_value) && $location_id_value==1) {echo "selected='selected'"; }?>>Bangladesh</option>
                                            <option value="2" <?php if (isset($location_id_value) && $location_id_value==2) {echo "selected='selected'"; }?>>India</option>
                                            <option value="3" <?php if (isset($location_id_value) && $location_id_value==3) {echo "selected='selected'"; }?>>Others</option>
                                        </select>
									</td>
									<td class="col-lg-4"></td>
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
								<tr> <td colspan="3"> </td> </tr>
							</tbody>
						</table>
			    	</form>		
				</div>
			</div>
		</div>
	</div>
</div>