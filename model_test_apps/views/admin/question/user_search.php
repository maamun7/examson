<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<i title="Delete" class="fa fa-tasks"></i> Question List
			</div>
			<div class="panel-body">		

				<form class="pull-left form-inline" method="post" action="<?php echo base_url();?>admin/question/search_item" role="form" >				
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-search"></i></div>
							<input class="form-control col-sm-6" type="text" name="key_word" placeholder="Enter keyword">
						</div>
					</div>
					<button type="submit" class="btn btn-success"> Go !</button>
				</form>

				<form class="pull-right form-inline" method="post" action="<?php echo base_url();?>admin/question/search_by_user" role="form" >				
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-search"></i></div>
							<select name="user_id"class="selectCategory form-control">
								<option value="">...Search By User...</option>  
								{all_users}    
									<option value="{user_id}"> {first_name} {last_name}</option>  
								{/all_users}                                       
							</select>				
						</div>
					</div>
					<button type="submit" class="btn btn-success"> Search !</button>
				</form>	
			</div>
			<?php
				if(!empty($question_lists)){
			?>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>#</th>
								<th>Question</th>								
								<th>Chapter Name</th>								
								<th>Subject Name</th>
								<th><center>Actions</center></th>
								<th><center>Options</center></th>
								<th><center>User Name</center></th>
							</tr>
						</thead>
						<tbody>
							{question_lists}
								<tr>
									<td>{sl}</td>			
									<td>{details}</td>			
									<td>{chapter_name}</td>		
									<td>{subject_name}</td>		
									<td>
										<center>
											<a href="<?php echo base_url(); ?>admin/question/edit/{id}"><i title="Edit" class="fa fa-edit"></i></a>&nbsp; | &nbsp;
											<span class="deleteQuestion" name="{id}"><i title="Delete" class="fa fa-minus-circle"></i></span>&nbsp; | &nbsp;
											<i title="Change Status" class="fa {sts_class} questionStatusChange" name="{id}"></i>
										</center>
									</td>
									<td>
										<center>
											<a class="" data-target="#myModal" data-toggle="modal" href="<?php echo base_url(); ?>admin/question/view_options/{id}"><i title="View Options" class="fa fa-eye"></i></a>
										</center>
									</td>									
									<td><center>{first_name} {last_name}</center></td>	
								</tr>
							{/question_lists}
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
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times</button>
				<h4 id="myModalLabel">All Options:</h4>
			</div>
			<div class="modal-body">
				Loading...
			</div>
			<div class="modal-footer">	
				<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</div>
	</div>
</div>

<span id="baseUrl" name="<?php echo base_url(); ?>"></span>
<script src="<?php echo base_url(); ?>my-assets/admin/js/question.js"></script>


