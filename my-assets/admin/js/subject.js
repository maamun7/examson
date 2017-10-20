$(document).ready(function(){ 
	var baseUrl = $('#baseUrl').attr('name');
	$(".selectCategory").change(function()
	{
		var id=$(this).val();
		var dataString = 'cat_id='+ id;
		//alert(baseUrl);
		$.ajax
	   ({
			type: "POST",
			url: baseUrl+"admin/subject/sub_categories",
			data: dataString,
			cache: false,
			beforeSend: function(){
				$('#loader1').show();
			},
			complete: function(){
				$('#loader1').hide();
			},
			success: function(html)
			{
				$(".retrieveSubCat").html(html);
			} 
		});
	});

	//Status Change
	$(".subjectStatusChange").click(function()
	{	
		var id=$(this).attr('name');
		var dataString = 'sub_id='+ id;
		//alert(dataString);
		$.ajax
	   ({
			type: "POST",
			url: baseUrl+"admin/subject/change_status",
			data: dataString,
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});
	});

	//Delete
	$(".deleteSubject").click(function()
	{	
		var id=$(this).attr('name');
		var dataString = 'sub_id='+ id;
		var x = confirm("Are You Sure ?");				
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: baseUrl+"admin/subject/delete",
				data: dataString,
				cache: false,
				success: function(datas)
				{
					location.reload();
				} 
			});
		}
	});

});