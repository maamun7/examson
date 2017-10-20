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
			url: baseUrl+"admin/chapter/sub_categories",
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
	
	$(".retrieveSubCat").change(function()
	{
		var id=$(this).val();
		var dataString = 'sub_cat_id='+ id;
		//alert(baseUrl);
		$.ajax
	   ({
			type: "POST",
			url: baseUrl+"admin/chapter/subjects",
			data: dataString,
			cache: false,
			beforeSend: function(){
				$('#loader2').show();
			},
			complete: function(){
				$('#loader2').hide();
			},
			success: function(html)
			{
				$(".retrieveSubject").html(html);
			} 
		});
	});

	//Status Change
	$(".chapterStatusChange").click(function()
	{	
		var id=$(this).attr('name');
		var dataString = 'chapter_id='+ id;
		//alert(dataString);
		$.ajax
	   ({
			type: "POST",
			url: baseUrl+"admin/chapter/change_status",
			data: dataString,
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});
	});

	//Delete
	$(".deleteChapter").click(function()
	{	
		var id=$(this).attr('name');
		var dataString = 'chapter_id='+ id;
		var x = confirm("Are You Sure ?");				
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: baseUrl+"admin/chapter/delete",
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