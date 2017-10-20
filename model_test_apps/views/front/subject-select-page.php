<div id="exam-container">
	<div class="row">
        <div class="exam-center-top-bar-left col-sm-9 col-md-7 col-lg-7" style="padding-left: 0px;">
            Exam Center
        </div>
        <div class="col-sm-7 col-md-5 col-lg-5">
            <div class="exam-center-top-bar-right">
                <p>Over 1.00.000 Questions and 200 exam together in one place</p>
            </div>
        </div>
    </div>
    <div class="row">
		<div class="col-sm-12 col-md-9 col-lg-9">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="exam-page-top-text">
                   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                </div>
            </div>
			<div class="col-sm-12 col-md-12 col-lg-12">
				<div class="exam-header">
					General Exam/Subject/Course in Bangladesh
					<span class="glyphicon glyphicon-chevron-up" style="float:right;margin-top:5px"></span>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12">
				<div id="exam-wrapper">	
					<!-- Left Menu -->				
					<div class="exam-left-portion">
						<span style="float:left;height:30px;width:100%;background-color:#004151;border-bottom:1px solid #fff;">&nbsp;</span>
						<div class="exam-left-nav">
							<ul>
								<?php
								if (!empty($main_categories)) {
								?>
									<span style="display:none" class="get_first_value" name="<?php print_r($main_categories[0]['id']); ?>"></span>
								<?php
									$i=0;
									foreach ($main_categories as $main_categorie) {
										$left_active_menu = "";
										$left_active_menu_color = "";
										if ($i == 0) {
											$left_active_menu = "left-active-menu";
											$left_active_menu_color = "left-active-menu-color";
										}
								?>
										<li class="left-active <?php echo $left_active_menu; ?>" onclick="click_by_left_menu(<?php print_r($main_categorie['id']); ?>,this)">
											<span class="left-active-color <?php echo $left_active_menu_color; ?>"><?php print_r($main_categorie['name']); ?></span>
										</li>
								<?php	
										$i++;
									}
								}
								?>
								<li class="left-active" onclick="cliclk_by_model_test(1,this)">
									<span class="left-active-color">Model Test</span>
								</li>
							</ul>						
						</div>
					</div>
					<!-- Ajax Load Here -->
					<div class="exam-right-portion">
						<div class="exam-top-nav">
						</div>
						<div style='floar:left;height:218px;width:100%;overflow:auto;'>
							<div id="subject-chapter">
								//Subject and chapter will load here
							</div>
						</div>
					</div>
				</div><!-- #exam-wrapper -->
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12">
				<div class="exam-header">
					Special Exam/Subject/Course
					<span class="glyphicon glyphicon-chevron-down" style="float:right;margin-top:5px"></span>
				</div>
			</div>

            <div class="col-sm-12 col-md-12 col-lg-12">
                <span style="float:left;height:30px;width:100%;margin-bottom:10px;line-height:40px;color:#003340;border-bottom:1px solid #9f9f9f;">
                    Country'd some famous institute using ExamsOn.com in regular basis.
                </span>
            </div>
            <!-- Bottom Slider	 -->
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="bottom-slider">
                </div>
            </div>
		</div>
        <!--End Left Portion-->
       <!-- Right portion add from here-->
		<div class="col-sm-5 col-md-3 col-lg-3" style="padding: 0px;">
            <div class="col-sm-12 col-md-12 col-lg-12" style="padding: 0px;">
                <div class="exam-page-medium-ad">
                    AD
                </div>
            </div>
            <div class="virtual-div padding-left-none col-sm-12 col-md-12 col-lg-12">
                <div id="selected-chapter-wrapper" style="display: none">
                    <div class="selected-chapter-header">
                        <img src="<?php echo base_url(); ?>my-assets/front/images/selected-subject-arraw.png" class="selected-chapter-img" />
                        <span style="test-align:center">Selected Chapters </span>
                    </div>
                    <div class="selected-chapter-body">
                        <!-- Selected Chapter Load Here By Ajax-->
                    </div>
                    <div style="margin: 0 auto">
                        <button style="" class="btn-submit" data-baze-modal data-target='#exam-terms-condition'>Continue</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12" style="padding: 0px;">
                <div class="exam-page-medium-ad">
                    AD
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12" style="padding: 0px;">
                <div class="exam-page-medium-ad">
                    AD
                </div>
            </div>
        </div>
	</div>
</div><!-- #exam container -->

<script type="text/javascript">
	$( document ).ready(function() {
		var baseUrl="<?php echo base_url(); ?>";
		var id= $(".get_first_value").attr('name');
		var dataString = 'category_id='+ id;
		$.ajax
	   ({
			type: "POST",
			url: baseUrl+"exam-center/load_by_left_menu",
			data: dataString,
			cache: false,
			success: function(html)
			{
				var obj = jQuery.parseJSON(html);
				$(".exam-top-nav").html(obj.top_menu);
				$("#subject-chapter").html(obj.subject_chapter);
			} 
		});
	});

	function click_by_left_menu(id,event){

		var baseUrl="<?php echo base_url(); ?>";
		var dataString = 'category_id='+ id;
		$.ajax
	   ({
			type: "POST",
			url: baseUrl+"exam-center/load_by_left_menu",
			data: dataString,
			cache: false,
			success: function(html)
			{
				var obj = jQuery.parseJSON(html);
				$(".exam-top-nav").html(obj.top_menu);
				$("#subject-chapter").html(obj.subject_chapter);

				$(".left-active").removeClass("left-active-menu");
				$(event).addClass("left-active-menu");
				$(".left-active-color").removeClass("left-active-menu-color");
				$(event).children().addClass("left-active-menu-color");
			} 
		});
	}
	
	function click_by_top_menu(id,event){

		var baseUrl="<?php echo base_url(); ?>";
		var dataString = 'top_menu_id='+ id;
		$.ajax
	   ({
			type: "POST",
			url: baseUrl+"exam-center/load_by_top_menu",
			data: dataString,
			cache: false,
			success: function(html)
			{
				var obj = jQuery.parseJSON(html);
				$("#subject-chapter").html(obj.subject_chapter);
				$(".top-active").removeClass("top-active-menu");
				$(event).addClass("top-active-menu");
			} 
		});
	}
	//Load model test by click on the top menu
	function click_model_test_top_menu(id,event){

		var baseUrl="<?php echo base_url(); ?>";
		var dataString = 'top_menu_id='+ id;
		$.ajax
	   ({
			type: "POST",
			url: baseUrl+"exam-center/load_model_test_by_top_menu",
			data: dataString,
			cache: false,
			success: function(html)
			{
				var obj = jQuery.parseJSON(html);
				$("#subject-chapter").html(obj.subject_chapter);
				$(".top-active").removeClass("top-active-menu");
				$(event).addClass("top-active-menu");
			}
		});
	}
	
	function checked_unchecked_chapter(event){

		var baseUrl="<?php echo base_url(); ?>";		
		var chaptValue = $(event).val();		
		var dataString = 'selected_item='+ chaptValue;

		// If not checked
		if (! $(event).is(':checked')) {
			$.ajax
		   ({
				type: "POST",
				url: baseUrl+"exam-center/remove_selected_chapter",
				data: dataString,
				cache: false,
				success: function(html)
				{
					//var obj = jQuery.parseJSON(html);
					if (html == 0) {
						$("#selected-chapter-wrapper").hide();
					}else{
						$("#selected-chapter-wrapper").show();
						$(".selected-chapter-body").html(html);
					}
				} 
			});
		}else{
			$.ajax
		   ({
				type: "POST",
				url: baseUrl+"exam-center/add_selected_chapter",
				data: dataString,
				cache: false,
				success: function(html)
				{
					//var obj = jQuery.parseJSON(html);
					if (html == 0) {
						$("#selected-chapter-wrapper").hide();
					}else{
						$("#selected-chapter-wrapper").show();
						$(".selected-chapter-body").html(html);
					}
				} 
			});
		}
	}

	function unchecked_chapter(chaptValue){

		var baseUrl="<?php echo base_url(); ?>";		
		//var chaptValue = $(event).val();		
		var dataString = 'selected_item='+ chaptValue;
		$.ajax
	   ({
			type: "POST",
			url: baseUrl+"exam-center/remove_selected_chapter",
			data: dataString,
			cache: false,
			success: function(html)
			{
				//var obj = jQuery.parseJSON(html);
				if (html == 0) {
					$("#selected-chapter-wrapper").hide();
				}else{
					$("#selected-chapter-wrapper").show();
					$(".selected-chapter-body").html(html);
				}
			} 
		});
	}

	$( document ).ready(function() {
		var baseUrl="<?php echo base_url(); ?>";
		//$(".selected-chapter-body").load(baseUrl+"exam-center/add_selected_chapter");	
		var dataString = '';
		$.ajax
		   ({
				type: "POST",
				url: baseUrl+"exam-center/add_selected_chapter",
				data: dataString,
				cache: false,
				success: function(html)
				{
					//var obj = jQuery.parseJSON(html);
					if (html == 0) {
						$("#selected-chapter-wrapper").hide();
					}else{
						$("#selected-chapter-wrapper").show();
						$(".selected-chapter-body").html(html);
					}
				} 
			});	
	});

	
	function cliclk_by_model_test(location_id,event){

		var baseUrl="<?php echo base_url(); ?>";
		var dataString = 'location_id='+ location_id;
		$.ajax({
			type: "POST",
			url: baseUrl+"exam-center/load_model_test",
			data: dataString,
			dataType: 'json',
			cache: false,
			success: function(json)
			{
				$(".exam-top-nav").html(json['top_menu']);
				$("#subject-chapter").html(json['subject_chapter']);

				$(".left-active").removeClass("left-active-menu");
				$(event).addClass("left-active-menu");
				$(".left-active-color").removeClass("left-active-menu-color");
				$(event).children().addClass("left-active-menu-color");
			} 
		});
	}

	//Start model test
	function select_model_test(event){
		if ($(event).is(':checked')) {
			$.prompt("If you want to start the model test right now,click on the Yes....", {
				title: "Are you Ready?",
				buttons: { "Yes,Go ahead..": true, "No, Lets Wait": false },
				submit: function(e,flag,m,f){
					//all model test unchecked
					$('.model_test').prop('checked', false);
					//checked only selected model test
					$(event).prop('checked', true);
					if(flag){
						//$('.form_class').submit();
                        $(event).closest('form').submit();
					}else{
						$('.model_test').prop('checked', false);
						false;
					}
				}
			});
		}
	}

</script>

<!-- Start exam with instructons -->

<div class="bzm-content" id="exam-terms-condition" data-title="Instructions">
	<div class="modal-exam-instruction">
	    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque aspernatur, non odio! Molestias similique officiis, non magni voluptates architecto quos optio dignissimos placeat adipisci ad nisi, vel obcaecati error! Repellendus.</p>

	    <ul>
	        <li>
	            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur omnis, at deserunt, accusantium repellendus totam deleniti sequi tempore cum sapiente nemo amet molestiae ea. Dolorum, totam dolore commodi vero possimus.</p>
	        </li>
	        <li>
	            <p>Dignissimos ex, eos quas voluptas laborum, cupiditate obcaecati impedit in fugit eligendi sint adipisci aspernatur natus? Error rerum repudiandae provident alias impedit, assumenda hic quod laudantium. Consequuntur similique, repellendus expedita.</p>
	        </li>
	    </ul>
	    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime velit, labore quisquam autem ipsum eaque recusandae unde, et deleniti, magni aperiam vitae deserunt perferendis quam. Eius commodi aliquid soluta! Iure?</p>
		    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque aspernatur, non odio! Molestias similique officiis, non magni voluptates architecto quos optio dignissimos placeat adipisci ad nisi, vel obcaecati error! Repellendus.</p>
	    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime velit, labore quisquam autem ipsum eaque recusandae unde, et deleniti, magni aperiam vitae deserunt perferendis quam. Eius commodi aliquid soluta! Iure?</p>
	</div>


	<div class="modal-bottom-divider"> </div>
	<div style="height:6px;"> </div>
	<div class="modal-bottom-content">
		<div id="terms-cond-alert"></div>
		<div class="checkbox">
			<label><input type="checkbox" class="terms_conditions" name="agree" value="">Tick to make sure that you read and understand "Instruction"</label>
		</div>		
		<div style="width:55%;margin:0 auto;font-family: Tahoma;color:#003340;">
			<div style="float:left;width:120px;height:20px;font-size: 16px;">
				<a href="<?php echo base_url(); ?>exam-center">Change Subject</a>
			</div>
			<div style="float:right;width:50px;height:20px;">
				<span onclick="agree_terms_conditions(this)">Continue</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    var elems = $('[data-baze-modal]');
    elems.bazeModal({
        onOpen: function () {
           // alert('opened');
        },
        onClose: function () {
            //alert('closed');
        }
    });

    //
	function agree_terms_conditions(event){
		if ($('.terms_conditions').is(':checked')) {
			$('#exam_starts').submit();
		}else{
			alert('You must agree with our terms and conditions !');
		}
	}
</script>
