<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\bootstrap\Modal;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

use yii\widgets\ActiveForm;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<!-- <body> -->
 <style type="text/css">
    /*  .table-bordered>tbody>tr>td,.table-bordered>thead>tr>th{
  border:1px solid #eee !important;
 }*/
    .form-group {
        margin-bottom: 0px;
    }
    .page-titles{
        margin-bottom: 10px!important;
    }
    .form-control {
        font-size: 15px;
        font-weight: 150;
    }
    th{
        font-size: 15px;
    }
    .customtab2 li a.nav-link.active{
        background-color: #fc4b6c;
    }
    .control-label {
        font-size: small;
        font-weight: 500;
    }
    .dropdown-item{
        font-size: 15px;
    }
    .panel{
        margin-bottom: 0px !important;
    }
    .list-main-tab .list-main-tab-heading{
        padding: 0px !important;
        background: #fff !important;
        /*  box-shadow: 0px 1px 2px #a5a0a0 !important;*/
        border-bottom:2px solid #aaa !important;
    }
    .nav-pills li>a:hover{
        background: #eee !important;
        color:#000 !important;
        border-bottom: 2px solid #eee;
    }
    .nav-pills>li.active>a{
        background: none !important;
        color:#4285f4 !important;
        border-bottom: 2px solid #4285f4;
    }
    .nav-pills>li.active>a:hover{
        background-color: #f8f8f8 !important;
    }
    .nav-pills>li>a{
        border-radius: 0px;
        padding:6px 16px 6px 16px !important;
        font-size: 12px;
        font-family: 'Roboto', sans-serif;
        text-transform: uppercase;
        font-weight: 550 !important;
        color:#616161;
        letter-spacing: .05em;
    }
    .item_autocomplete .autocomplete_data {
        width:80% !important;
    }
    #sales_items_tab .table-bordered>tbody>tr>td .form-group {
        margin:0px !important;
    }
    #sales_items_tab .table-bordered>tbody>tr>td  select{
        padding-left:7px;
        margin: 1px !important;
        padding-right: 1px;
    }
    #sales_items_tab .table > tbody > tr > td {
        vertical-align: top!important;
        color:#555;
    }
    #sales_items_tab .table > tbody > tr > td{
        overflow: visible !important;
    }

    #sales_items_tab .table-bordered>tbody>tr>td {
        border:none !important;
        border-bottom:1px solid #f4f4f4 !important;
        border-top:1px solid #f4f4f4 !important;
        padding:12px 0px 12px 10px !important;
    }
    .glyphicon-pencil,.glyphicon-trash{
        /*color: #c9e4ea;*/
        color: transparent;

    }
    .error-summary {
        color: #a94442;
        background: #efd4d4;
        border-left: 3px solid #eed3d7;
        padding: 10px 20px;
        /*    margin: 0 15px 15px 15px;*/
    }
    .ui-widget-content,.autocomplete {
        border: 1px solid #aaaaaa !important;
        background: #ffffff url("images/ui-bg_flat_75_ffffff_40x100.png") 50% 50% repeat-x !important;
        color: #222222 !important;
        max-height:150px !important;
        overflow-y:auto !important;
        overflow-x:hidden !important;
        font-size:11px !important;
        padding-left:0px;
    }
    .ui-menu-item,.autocomplete li {
        position: relative !important;
        margin: 0 !important;
        padding: 3px 1em 3px .4em !important;
    }

    .ui-menu-item,.autocomplete li,.ui-widget{
        cursor: pointer !important;
        min-height: 0 !important;
        list-style-image: url("data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7") !important;
    }

    .ui-widget,.autocomplete li {
        font-family: Verdana,Arial,sans-serif !important;
    }

    .ui-menu-item div:hover ,.autocomplete li:hover{
        background: #337ab7 !important;
        font-weight: normal !important;
        color: #fff !important;
    }
    .autocomplete{  ;position: absolute;z-index:3;margin-top: -4px}
    .autocomplete li{
        padding: 3px 0em 3px 0em;
        border:none !important;
    }
    .item_autocomplete .autocomplete_data {
        width:80% !important;
    }
    .autocomplete{
        margin-top:2px;
        width: 85%

    }
    .autocomplete li{
        width: 100%;
    }
    .number input[type="text"]{
        text-align:right;
    }
    input[readonly], input[readonly="readonly"],input[disabled],select[disabled]{
        cursor: not-allowed;
        background:transparent !important;
    }
    .number input[type="text"]:hover{
        background: #F9F9F9 !important;
        border-bottom:1px solid #aaa;
    }

</style>

    <style type="text/css">
        .overlay-back,
.overlay-back-new{z-index:1050;background:rgba(0,0,0,0.4);border-radius:3px;
position:absolute;top:0;left:0;width:100%;height:100%;
}
.overlay{z-index:1100;background:rgba(0,0,0,0.3);border-radius:3px;
position:absolute;top:0;left:0;width:100%;height:100%;
}
    </style>
<style>
    .slimScrollDiv {
        height: auto !important;
    }
    .modal-content{
        margin-top: 200px;
    }
</style>
<?php $this->beginBody() ?>

<div class="wrap">


            <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">

                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                            <img src="assets/images/logo3.png" class="light-logo" alt="homepage"  style="width: 200px; height: 60px;"/>
                        <!--  <img src="assets/images/logo_lady.png" alt="homepage" class="dark-logo"  style="height: 50px;"/> -->
                         <!-- Light Logo text -->    
                         </span>
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="assets/images/logo3.png" alt="homepage" class="dark-logo" style="height:60px ;width: 200px;" />
                            <!-- Light Logo icon -->
                           <!--  <img src="assets/images/logo_lady.png" alt="homepage" class="light-logo" style="height: 50px;"/> -->
                        </b>
                        <!--End Logo icon -->
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-search"></i></a>
                            <div class="dropdown-menu scale-up-left bg-light-info" style="margin-left: 250px;width: 60%;min-height: 500px">
                                <input type="text" class="form-control" placeholder="Search & enter"  onkeyup="checkitembooking(this.value)" autocomplete="off" style="width: 60%"> <a class="srh-btn"></a>
                                <div class='item_autocomplete' id='itemselection-suggesstion-check-box'></div>
                                <div class="col-lg-12" id="itemselection-check" class="other_quantity"></div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                     <!--    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="assets/images/users/1.jpg" alt="user"></div>
                                            <div class="u-text">
                                                <h4>Steave Jobs</h4>

                                        </div>
                                    </li>

                                    <li></li>
                                </ul>
                            </div>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <?php $form = ActiveForm::begin(['action'=>'index.php?r=site/logout','id'=>'logout_form','options' => ['method' => 'post']]); ?>

                            <button href="#" class="btn btn-secondary btn-square"  type="submit" style="height: -webkit-fill-available;background: none; border: none;"> <i class="fa fa-power-off"></i></button>
                            <?php  ActiveForm::end(); ?> </li>
                    </ul>
                </div>
            </nav>
        </header>


       
       


        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile" style="background: url(assets/images/background/user-info.jpg) no-repeat;">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="assets/images/users/profile.png" alt="user" /> </div>
                    <!-- User profile text-->
                    <!-- <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Markarn Doe</a>
                        <div class="dropdown-menu animated flipInY"> <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a> <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a> <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                            <div class="dropdown-divider"></div> <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a> </div>
                    </div> -->
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                       
                        
                                <li><a href="index.php?r=site/index"><i class="mdi mdi-home"></i>Home</a></li>
                        <li><a href="index.php?r=customer/index"><i class="mdi mdi-account-star-variant "></i>Customer</a></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-sale"></i><span class="hide-menu">Sales</span></a>
                            <ul aria-expanded="false" class="collapse">
                                
                                <li><a href="index.php?r=booking/index">Booking</a></li>
                                <li><a href="index.php?r=booking-item/index">Item Picked</a></li>
                                <li><a href="index.php?r=booking-item/index-return">Return Item</a></li>

                               <li><a href="index.php?r=booking/index-payment">Pending Payment</a></li>
                                <li><a href="index.php?r=payment/index">Transaction</a></li>
                                <li><a href="index.php?r=booking/index-sales">Total Sales</a></li>
                                <li><a href="index.php?r=booking-item/sales-item">Total Item Sales</a></li>
                            </ul>
                        </li> 
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cart"></i><span class="hide-menu">Purchase</span></a>
                            <ul aria-expanded="false" class="collapse">
                                
                                <li><a href="index.php?r=purchase/index">Purchase Order</a></li>
                                <li><a href="index.php?r=purchase/items-report">Items Report</a></li>
                               <!--  <li><a href="index.php?r=booking-item/index-return">Return Item</a></li>

                               <li><a href="index.php?r=booking/index-payment">Payment</a></li>
                                <li><a href="index.php?r=booking/index-sales">Total Sales</a></li> -->
                            </ul>
                        </li>
                        <!-- <li><a href="index.php?r=purchase/index"><i class="mdi mdi-cart"></i>Purchase</a></li> -->
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-square-inc-cash"></i><span class="hide-menu">Expense</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.php?r=expense/index">Expense</a></li>
                                <li><a href="index.php?r=expsense-category/index">Expense Category</a></li>
                               
                            </ul>
                        </li>
                        
                                <li><a href="index.php?r=item/index"><i class="mdi mdi-database"></i>Item Master</a></li>
                                <li><a href="index.php?r=vendor/index"><i class="mdi mdi-account"></i>Vendor</a></li>
                                <li><a href="index.php?r=formula/calculate"><i class="mdi mdi-account"></i>Run Split</a></li>

                          
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-wrench"></i><span class="hide-menu">Setting</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.php?r=type/index">Item Type</a></li>
                                <li><a href="index.php?r=cater/index">Item Category</a></li>
                                <li><a href="index.php?r=color-master/index">Colors</a></li>
                                <li><a href="index.php?r=expsense-category/index">Expense Category</a></li>
                                <li><a href="index.php?r=address-group/index">Address Group</a></li>
                                <li><a href="index.php?r=formula/create">Split Formula</a></li>
                            </ul>
                        </li>
                        <li class="nav-devider"></li>
                        
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Reports</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.php?r=reports/index-item-master">Item</a></li>
                                <li><a href="index.php?r=reports/index">Booking Orders</a></li>
                                <li><a href="index.php?r=reports/index-item">Booking Item Report</a></li>
                               
                            </ul>
                        </li>
                        
                       
                        
                         
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
           
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
         <div class="overlay" style="position: fixed">
                <center> <img src="img/loader.gif" style="height:100px;"></center>
                <center style="font-size: 20px;color: #3c60b5;margin-top: 30px"><b id="data_progress_bar" style="background-color: #ffffff"></b></center>
            </div>
            <div class="overlay-back" style="display:none" >

            </div>  
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                 <?= Alert::widget() ?>
        <?= $content ?>
    </div>

      <?php
        yii\bootstrap\Modal::begin([
            'id'=>'pModal',
        ]);
        echo "<div id='modalContent' ></div>";
        yii\bootstrap\Modal::end();

        ?>
         <div class="modal fade bs-example-modal-lg" id="big_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content" >
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Create Item</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body" id="bigmodalContent">
                                                
                                               
                                            </div>
                                           
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
</div>
    
</div>



<?php $this->endBody() ?>

</html>
<?php $this->endPage() ?>
<script type="text/javascript">
    $(window).on('load',function() {
     $('.overlay').hide();
    });
    function addslashes( str ) {
        return (str + '').replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0').replace(/"/g, '&quot;');
    }
    function isNumberCheck(evt) {

        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46) {
            return false;
        }
        return true;
    }

    function checkitembooking(val) {
        $.ajax({
            url:"<?php echo \Yii::$app->getUrlManager()->createUrl('booking/item-check-autocomplete') ?>",
            dataType: 'json',
            type: 'get',
            data:{
                term:val,
               /* id:id_pass,
                type:value,*/
            },
            success: function( data, textStatus, jQxhr ){
                var result1 =  "#itemselection-suggesstion-check-box";
                $(result1).show();
                var result2 = "#itemselection-description";
                var data_new= '<ul class="autocomplete add_new" style="min-height: 350px!important;">';
                data_new+="<li value=''>"+'<?= 'SELECT'; ?>'+"</li>";

                for(i=0; i<data['item_details'].length; i++) {
                    var image_name='img/no-image.jpg';
                    // alert(data['item_details'][i]['images']!= '');
                    if(data['item_details'][i]['images']!= ''){
                        image_name='uploads/'+data['item_details'][i]['images'];
                    }

                    var item_name = addslashes(data['item_details'][i]['name']);
                    data_new += '<li onClick="selectcheck('+data['item_details'][i]['id']+')"><img src="'+image_name+'" style="height: 70px;width: 70px;">'+data['item_details'][i]['id']+" - "+data['item_details'][i]['name']+'</li>';

                }
                data_new += '</ul>';

                $(result1).html(data_new);
                // $(result2).prop('readonly',true);

            },
            error: function( jqXhr, textStatus, errorThrown ){
                //alert(errorThrown);
                if(errorThrown=='Forbidden'){
                    alert("<?= 'YOU_DONT_HAVE_ACCESS';?>");
                }
                //console.log( errorThrown );
            }
        });
    }

    function selectcheck(item_id) {
        url= '<?php echo Yii::$app->request->baseUrl.'/index.php?r=booking/item-booking-check' ?>';
        var result1 =  "#itemselection-suggesstion-check-box";
        $(result1).hide();

        if(url!=''){
            $.ajax({
                url: url,
                type: 'post',
                async:false,
                data:{
                    item_id:item_id,
                    // plant:plant,
                },
                success: function (data) {

                    if(data!=null){
                        $("#itemselection-check").html(data);
                    }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    if(errorThrown=='Forbidden'){
                        alert("<?= 'YOU_DONT_HAVE_ACCESS';?>");
                    }
                }

            });
        }
    }

    //$('#mdate').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
</script>
