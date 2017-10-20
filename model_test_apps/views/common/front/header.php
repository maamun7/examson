<style type="text/css">
    #header{background: #F1F1F1 !important;padding: 0px;}
    .border-left{border-left: 1px solid #fff;}
    .border-right{border-right: 1px solid #fff;}
    .navbar-nav > li > a {background-color:#003340;}
</style>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div id="header">
            <div class="col-sm-7 col-md-5 col-lg-5">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div style="float:left;height: 40px;"> &nbsp; </div>
                </div>
                <!--- Logo -->
                <div class="col-sm-12 col-md-12 col-lg-12" style="float: right;padding: 0px;">
                    <a href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url(); ?>my-assets/front/images/logo1.png" alt="logo" class="img-responsive">
                    </a>
                </div>
            </div>
            <div class="col-sm-9 col-md-7 col-lg-7" style="padding: 0px;">
                <!--- Shopping basket goes to here -->
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div style="float:left;height: 50px;"> &nbsp; </div>
                </div>
                <!--- Top Menu -->
                <div class="col-sm-12 col-md-12 col-lg-12" style="float: right;padding: 0px;">
                    {main_menus}
                </div>
            </div>
        </div> <!-- #header -->
    </div>
</div>