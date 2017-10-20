<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                Edit Model Test
                <small class="pull-right red_color">Star marks field are mandatory.</small>
            </div>
            <div class="panel-body">
                <div class="pull-right">
                    <a onclick="$('#form').submit();" class="btn btn-success">Save Changes</a>
                    <a href="<?php echo base_url();?>admin/model_test" class="btn btn-primary btn-large">Cancel</a>
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
                                    Select Category
                                </td>
                                <td class="col-lg-4">
                                    <select name="parent_cat_id" tabindex="1" class="selectCategory form-control">
                                        <option value="">...Select Category...</option>
                                        <?php
                                        if (!empty($parent_categories)) {
                                            foreach ($parent_categories as $value) {
                                                ?>
                                                <option value="<?php echo $value['id']; ?>" <?php if(isset($parent_cat_value) && $parent_cat_value == $value['id']){echo "selected='selected'"; } ?> ><?php echo $value['category_name']; ?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="col-lg-4 text-left">
                                    <?php if (isset($error_parent_cat)) { ?>
                                        <span class="red_color"><?php echo $error_parent_cat; ?></span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-lg-3 text-right">
                                    Select Sub Category
                                </td>
                                <td class="col-lg-4">
                                    <select name="sub_cat_id" id="sub_cat_id" class="retrieveSubCat form-control">
                                        <option value="">..First Select Category..</option>

                                    </select>
                                </td>
                                <td class="col-lg-4 text-left">
                                    <?php if (isset($error_sub_cat_id)) { ?>
                                        <span class="red_color"><?php echo $error_sub_cat_id; ?></span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-lg-3 text-right">
                                    Model Test Name <span class="red_color">*</span>
                                </td>
                                <td class="col-lg-4">
                                    <input type="text" tabindex="2" class="form-control" name="model_test_name" value="<?php if (isset($model_test_name_value)) { echo $model_test_name_value; } ?>" placeholder="Enter Model Test Name" />
                                </td>
                                <td class="col-lg-4 text-left">
                                    <?php if (isset($error_model_test_name)) { ?>
                                        <span class="red_color"><?php echo $error_model_test_name; ?></span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-lg-3 text-right">
                                    Number Of Questions <span class="red_color">*</span>
                                </td>
                                <td class="col-lg-4">
                                    <input type="text" tabindex="2" class="form-control no_of_question" name="no_of_question" value="<?php if (isset($no_of_question_value)) { echo $no_of_question_value; } ?>" placeholder="Number of Question" />
                                </td>
                                <td class="col-lg-4 text-left">
                                    <?php if (isset($error_no_of_question)) { ?>
                                        <span class="red_color"><?php echo $error_no_of_question; ?></span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-lg-3 text-right">
                                    Duration Time <span class="red_color">*</span>
                                </td>
                                <td class="col-lg-4">
                                    <input type="text" tabindex="3" class="form-control" name="duration_time" value="<?php if (isset($duration_time_value)) { echo $duration_time_value; } ?>" placeholder="Enter Duration Time (in minute)" />
                                </td>
                                <td class="col-lg-4 text-left">
                                    <?php if (isset($error_duration_time)) { ?>
                                        <span class="red_color"><?php echo $error_duration_time; ?></span>
                                    <?php } ?>
                                </td>
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
                            <tr>
                                <td class="col-lg-3 text-right">
                                    Load Questions
                                </td>
                                <td class="col-lg-4">
                                    <select name="subject_parent" tabindex="1" class="subjSubCategory form-control">
                                        <option value=''>...Select Category...</option>
                                        <?php
                                        if (!empty($subject_parents)) {
                                            foreach ($subject_parents as $subject_parent) {
                                                ?>
                                                <option value="<?php echo $subject_parent['id']; ?>" <?php if(isset($subject_parent_value) && $subject_parent_value==$subject_parent['id']){echo "selected='selected'"; } ?> ><?php echo $subject_parent['name']; ?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="col-lg-4 text-left">
                                    <?php if (isset($error_subject_parent)) { ?>
                                        <span class="red_color"><?php echo $error_subject_parent; ?></span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div id="chapter-question">
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot class="loadSubjectsInputField">
                                <?php
                                if (!empty($subject_ids)) {
                                    foreach ($subject_ids as $key=>$val) {
                                ?>
                                <tr>
                                    <td class='col-lg-3 text-right'><?php echo $val['subject_name']; ?> </td>
                                    <td class='col-lg-4'>
                                        <input type='hidden' name='subject_ids[]' value="<?php echo $val['subject_id']; ?>" />
                                        <input type='number' class='form-control' name="<?php echo $val['subject_id']; ?>" value="<?php echo $val['no_of_q']; ?>" placeholder="<?php echo 'Enter No. Of Question for'.$val['subject_name']; ?>" />
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/common/jquery-ui-1.9.1/development-bundle/themes/base/jquery.ui.all.css">
<script src="<?php echo base_url(); ?>assets/common/jquery-ui-1.9.1/js/jquery-ui-1.9.1.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/common/jquery-ui-1.9.1/development-bundle/ui/jquery.ui.autocomplete.js"></script>
<script src="<?php echo base_url(); ?>my-assets/admin/js/autocomplete/subject.js.php"></script>
<script type="text/javascript">

    //Load sub model test category
    $(document).ready(function() {
        var baseUrl = "<?php echo base_url(); ?>";
        $(".selectCategory").change(function () {
            var id = $(this).val();
            var dataString = 'cat_id=' + id;
            //alert(baseUrl);
            $.ajax
            ({
                type: "POST",
                url: baseUrl + "admin/model_test/model_sub_categories",
                data: dataString,
                cache: false,
                beforeSend: function () {
                    $('#loader1').show();
                },
                complete: function () {
                    $('#loader1').hide();
                },
                success: function (html) {
                    $(".retrieveSubCat").html(html);
                }
            });
        });
    });

    //Get Suject name by selecting subject sub category
    $(document).ready(function() {
        var baseUrl = "<?php echo base_url(); ?>";
        $(".subjSubCategory").change(function () {
            var id = $(this).val();
            var dataString = 'sub_cat_id=' + id;
            //alert(baseUrl);
            $.ajax
            ({
                type: "POST",
                url: baseUrl + "admin/model_test/load_all_subjects",
                data: dataString,
                cache: false,
                dataType: 'json',
                beforeSend: function () {
                    $('#loader1').show();
                },
                complete: function () {
                    $('#loader1').hide();
                },
                success: function (json) {
                    $(".loadSubjectsInputField").html(json['chapter_question']);
                }
            });
        });
    });

    function checked_unchecked_all(item,event){
        var select_item = ".select_"+item;
        //alert(select_item);
        if ($(event).is(':checked')) {
            $(select_item).prop("checked", true);
        } else {
            $(select_item).prop("checked", false);
        }
        count_checked_items();
    }

    function count_checked_items(){
        var count_checked = $('.count_item:checked').size();
        $(".no_of_question").val(count_checked);
    }


</script>