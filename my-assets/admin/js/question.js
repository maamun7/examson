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
			url: baseUrl+"admin/question/sub_categories",
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
			url: baseUrl+"admin/question/subjects",
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
	
	$(".retrieveSubject").change(function()
	{
		var id=$(this).val();
		var dataString = 'subject_id='+ id;
		//alert(dataString);
		$.ajax
	   ({
			type: "POST",
			url: baseUrl+"admin/question/chapters",
			data: dataString,
			cache: false,
			beforeSend: function(){
				$('#loader3').show();
			},
			complete: function(){
				$('#loader3').hide();
			},
			success: function(html)
			{
				$(".retrieveChapter").html(html);
			} 
		});
	});

	//Status Change
	$(".questionStatusChange").click(function()
	{	
		var id=$(this).attr('name');
		var dataString = 'question_id='+ id;
		//alert(dataString);
		$.ajax
	   ({
			type: "POST",
			url: baseUrl+"admin/question/change_status",
			data: dataString,
			cache: false,
			success: function(datas)
			{
				location.reload();
			} 
		});
	});

	//Delete
	$(".deleteQuestion").click(function()
	{	
		var id=$(this).attr('name');
		var dataString = 'question_id='+ id;
		var x = confirm("Are You Sure ?");				
		if (x==true){
			$.ajax
		   ({
				type: "POST",
				url: baseUrl+"admin/question/delete",
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
	var count = 2;
	var limits = 50;
	function addOptionField(divName){
		//var param = "$(this).attr(name)";
		 if (count == limits)  {
			  alert("You have reached the limit of adding " + count + " inputs");
		 } else {
			  var newdiv = document.createElement('tr');
			  var newdiv1 = document.createElement('tr');
			  newdiv.innerHTML ="<td class='col-lg-3 text-right'> Option "+count+" </td>"
								+"<td class='col-lg-5'>"
								+"<textarea class='form-control' name='option_name[]' placeholder='Enter Option Name'></textarea>"
								+"</td>"
								+"<td class='col-lg-3'>"
								+"<input type='radio' id='right_answer' name='right_answer_"+count+"' value='1' /> &nbsp; Is Right Answer"
								+"<span class='pull-right closeRow closeRow_"+count+"' onclick='close_table_row("+count+");' >&times;</span>"
								+"</td>"

			  newdiv1.innerHTML ="<td class='col-lg-3 text-right'> Option Picture "+count+" </td>"
								+"<td class='col-lg-4'>"
								+"<input type='file' name='option_img_"+count+"' onchange='show_picture(this,"+count+")'>"
								+"</td>"
								+"<td class='col-lg-4'>"
								+"<div class='option' id='option_"+count+"'></div>"
								+"<span class='closeRow closeRow_"+count+" '></span>"
								+"</td>";
			  document.getElementById(divName).appendChild(newdiv);
			  document.getElementById(divName).appendChild(newdiv1);
			  count++;
		 }
	}

	var counter = document.getElementById("total_raw_option").value;
	var limit = 50;
	function addOptionFieldForEdit(divName,last_row_no){
		//var param = "$(this).attr(name)";
		//alert(counter);
		 if (counter == limit)  {
			  alert("You have reached the limit of adding " + counter + " inputs");
		 } else {
			  var newdiv = document.createElement('tr');
			  var newdiv1 = document.createElement('tr');
			  newdiv.innerHTML ="<td class='col-lg-3 text-right'> Option "+counter+" </td>"
								+"<td class='col-lg-5'>"
								+"<textarea class='form-control' name='option_name[]' placeholder='Enter Option Name'></textarea>"
								+"</td>"
								+"<td class='col-lg-3'>"
								+"<input type='radio' id='right_answer' name='right_answer_"+counter+"' value='1' /> &nbsp; Is Right Answer"
								+"<span class='pull-right closeRow closeRow_"+counter+"' onclick='close_table_row("+counter+");' >&times;</span>"
								+"<input type='hidden' name='option_id[]' value='' />"
								+"</td>"

			  newdiv1.innerHTML ="<td class='col-lg-3 text-right'> Option Picture "+counter+" </td>"
								+"<td class='col-lg-4'>"
								+"<input type='file' name='option_img_"+counter+"' onchange='show_picture(this,"+counter+")'>"
								+"</td>"
								+"<td class='col-lg-4'>"
								+"<div class='option' id='option_"+counter+"'></div>"
								+"<span class='closeRow closeRow_"+counter+" '></span>"
								+"</td>";
			  document.getElementById(divName).appendChild(newdiv);
			  document.getElementById(divName).appendChild(newdiv1);
			  counter++;
		 }
	}
	
	function close_table_row(classPortion)
	{
	  $(".closeRow_"+classPortion).parent().parent().remove();
	}	
	