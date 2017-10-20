<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<i title="Delete" class="fa fa-tasks"></i> Main and Sub Category List
			</div>
			<div class="panel-body">		
				<!--<form class="pull-right form-inline" method="post" action="<?php echo base_url();?>admin/main_category/search_item" role="form" >				
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-search"></i></div>
							<input class="form-control col-sm-6" type="text" name="key_word" placeholder="Enter keyword">
						</div>
					</div>
					<button type="submit" class="btn btn-success">Go !</button>
				</form>-->
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
								<th>Model Test Category</th>	
								<th>For Location</th>	
								<th><center>Status</center></th>
								<th><center>Actions</center></th>
							</tr>
						</thead>
						<tbody id="menu-pages">
							{category_lists}
								<tr>
									<td>{sl}</td>			
									<td>{category_name}</td>			
									<td>{location_name}</td>			
									<td><center><i class="fa {sts_class} modelTestStatusChange" name="{id}"></i></center></td>
									<td>
										<center>
											<a href="<?php echo base_url(); ?>admin/model_test_category/edit/{id}"><i title="Edit" class="fa fa-edit"></i></a>&nbsp; | &nbsp;
											<span class="deleteModelTestCat" name="{id}"><i title="Delete" class="fa fa-minus-circle"></i></span>
										</center>
									</td>
								</tr>
							{/category_lists}
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

<script>
	//Status Change
	$(".modelTestStatusChange").click(function(){	
		var id=$(this).attr('name');
		var dataString = 'cat_id='+ id;
		$.ajax
	   ({
			type: "POST",
			url: "<?php echo base_url(); ?>admin/model_test_category/change_status",
			data: dataString,
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});	
	});
	
	//Delete
	$(".deleteModelTestCat").click(function(){	
		var id=$(this).attr('name');
		var dataString = 'cat_id='+ id;
		var x = confirm("Are You Sure ?");				
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/model_test_category/delete",
				data: dataString,
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});
</script>

