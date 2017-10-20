<script src="<?php echo base_url(); ?>my-assets/js/admin_js/json/supplier.js.php" ></script>
<script language="javascript">
// Menu Re-ordering
	$(document).ready(function(){
		$("#menu-pages").sortable({
			update: function(event, ui) {
				$.post("<?php echo base_url(); ?>admin/main_menus/update_ordering",{ type: "orderPages", pages:$('#menu-pages').sortable('serialize') } );		
				//location.reload();
			}
		});
	});
</script>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<i title="Delete" class="fa fa-tasks"></i> Main and Sub Category List
			</div>
			<div class="panel-body">		
				<form class="pull-right form-inline" method="post" action="<?php echo base_url();?>admin/main_category/search_item" role="form" >				
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Search</div>
							<input class="form-control col-sm-6" type="text" name="key_word" placeholder="Enter keyword">
						</div>
					</div>
					<button type="submit" class="btn btn-success"><i class="fa fa-search"></i>&nbsp; Go !</button>
				</form>
			</div>
			<?php
				if(!empty($category_lists)){
			?>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>								
								<th>URL</th>
								<th><center>Status</center></th>
								<th><center>Actions</center></th>
							</tr>
						</thead>
						<tbody id="menu-pages">
							<?php foreach($category_lists as $category_list): ?>
								<tr class="page" id="page_<?php echo $category_list['id']; ?>">
									<td><?php echo $category_list['sl']; ?></td>			
									<td><?php echo $category_list['name']; ?></td>
									<td><?php echo $category_list['link']; ?></td>			
									<td><center><i class="fa <?php echo $category_list['sts_class']; ?> mainMenuStatusChange" name="<?php echo $category_list['id']; ?>"></i></center></td>
									<td>
										<center>
											<a href="<?php echo base_url().'admin/main_category/edit/'.$category_list['id']; ?>"><i title="Edit" class="fa fa-edit"></i></a>&nbsp; | &nbsp;
											<span class="deleteMainMenu" name="<?php echo $category_list['id']; ?>"><i title="Delete" class="fa fa-minus-circle"></i>
										</center>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>				
				<?php if(isset($links)){ echo $links; } ?>      
			</div> 		
			<div class="panel-footer">
                &nbsp;
            </div>
		<?php
			}else{
			?>
				<div class="NoDataFound"><center>No Data Found</center></div>
			<?php
			}
		?>
		</div>
	</div>
</div>


