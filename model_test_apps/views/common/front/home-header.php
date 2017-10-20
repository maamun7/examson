<style type="text/css">
    #header{background: #003340 !important;padding: 0px;}
    .border-left{border-left: 1px solid #fff;}
    .border-right{border-right: 1px solid #fff;}
    .nav {background-color:#003340;}
    .home-color {background:#fff !important;}
    .home-color span{color:#003340 !important;}
    <?php
    if (! $is_active_view) {
    ?>

    <?php
    }
    ?>
</style>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div id="header">
            <div class="col-sm-7 col-md-5 col-lg-5">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div style="float:left;height: 40px;"> &nbsp; </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12" style="float: right;padding: 0px;">
                    <a href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url(); ?>my-assets/front/images/logo.png" alt="logo" class="img-responsive">
                    </a>
                </div>
            </div>
            <div class="col-sm-9 col-md-7 col-lg-7" style="padding: 0px;">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div style="float:left;height: 50px;"> &nbsp; </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12" style="float: right;padding: 0px;">
                    <!--- Top menu goes to here -->
                    {main_menus}
                </div>
            </div>
        </div> <!-- #header -->
    </div>
</div>