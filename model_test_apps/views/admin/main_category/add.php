<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				Add New Category
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
										Category Alias
									</td>
									<td class="col-lg-4">
										<input type="text" tabindex="1" class="form-control" name="category_alias" value="<?php if (isset($category_alias_value)) { echo $category_alias_value; } ?>" placeholder="Enter Category Alias" />
									</td>
									<td class="col-lg-4 text-right"> </td>
								</tr>

								<tr>						
									<td class="col-lg-3 text-right">
										Link (URL)
									</td>
									<td class="col-lg-4">
										<input type="text" tabindex="1" class="form-control" name="link_url" value="<?php if (isset($link_url_value)) { echo $link_url_value; }else{ ?>#<?php } ?>" placeholder="Enter Url" />
									</td>
									<td class="col-lg-4 text-right"> </td>
								</tr>

								<tr>						
									<td class="col-lg-3 text-right">
										Select Parent
									</td>
									<td class="col-lg-4">
                                        <select name="parent_cat_id"class="form-control">
                                            <option value="0">None</option>
                                            <?php 
                                            if (!empty($parent_categories)) {
                                            	foreach ($parent_categories as $value) {
                                            ?>                                            	                           	
                                           		<option value="<?php echo $value['id']; ?>" <?php if(isset($parent_cat_value) && $parent_cat_value==$value['id']){echo "selected='selected'"; } ?> ><?php echo $value['name']; ?></option>
                                           	<?php
                                            	}
                                            }
                                            ?>
                                        </select>
									</td>
									<td class="col-lg-4 text-right"></td>
								</tr>

								<tr>						
									<td class="col-lg-3 text-right">
										Meta Keyword
									</td>
									<td class="col-lg-4">
										 <textarea name="meta_keyword" class="form-control" placeholder="Enter Meta Keyword" rows="4"> <?php if (isset($meta_keyword_value)) { echo $meta_keyword_value; }?> </textarea>
									</td>
									<td class="col-lg-4 text-right"> </td>
								</tr>

								<tr>						
									<td class="col-lg-3 text-right">
										Meta Description
									</td>
									<td class="col-lg-4">
										 <textarea name="meta_description" class="form-control" placeholder="Enter Meta Description" rows="3"> <?php if (isset($meta_description_value)) { echo $meta_description_value; }?> </textarea>
									</td>
									<td class="col-lg-4 text-right"> </td>
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
								<tr>						
									<td class="col-lg-3"></td>
									<td class="col-lg-4">
										<input type="submit" id="add-category" class="btn btn-info btn-large" tabindex="5" name="add-category" value="Save" />
			           					<input type="submit" value="Save and add another one" name="add-category-category" tabindex="6" class="btn btn-primary btn-large" id="add-category-another">
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
