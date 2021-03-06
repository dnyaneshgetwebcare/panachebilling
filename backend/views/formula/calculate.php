  <?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FormulaMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Formula';
?>
<style type="text/css">
     
.form-group {
         margin-bottom: 0px;
     }
     
     .form-control {
         font-size: medium;
         font-weight: 500;
     }
     .control-label {
         font-size: small;
         font-weight: 500;
     }
  td,th{
    font-size: 15px; 
}

</style>
 <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"><?= Html::encode($this->title) ?></h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Setting</a></li>
                <li class="breadcrumb-item active">Caculate <?= Html::encode($this->title) ?></li>
            </ol>
        </div>
           <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-l-10 hidden-md-down">
                                <div class="chart-text">
                                   <div class="col-md-12">
                                     <div class="form-group">
                                       <?php $month_array=array("01"=>"Jan","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"May","06"=>"June","07"=>"July","08"=>"Aug","09"=>"Sept","10"=>"Oct","11"=>"Nov","12"=>"Dec",);
                                       $year_array= range(date('Y')-5,date('Y')+1,1);
                                       $select_month=isset($_GET['month'])?$_GET['month']:date('m');
                                      // echo $select_month;die;
                                       $select_year=isset($_GET['year'])?$_GET['year']:date('Y');
                                       ?>
                                        <label class="control-label text-right col-md-2"></label> 
                                <div class="col-md-3"> 
                                       <select name="month" id='month' class="form-control">
                                          <option>Select Month</option>
                                         <?php foreach ($month_array as $key => $month) {
                                              ?> 
                                      <option value="<?= $key; ?>" <?= ($key==$select_month)?'selected':''; ?>><?= $month; ?>
                                      </option>
                                              <?php 
                                            } ?>
                                            
                                        </select>
                                    </div>
                                      <div class="col-md-3"> 
                                  <select name="year" id='year' class="form-control">
                                          <option>Select Month</option>
                                         <?php foreach ($year_array as $key => $year) {
                                              ?> 
                                      <option value="<?= $year; ?>" <?= ($year==$select_year)?'selected':''; ?>><?= $year; ?>
                                      </option>
                                              <?php 
                                            } ?>
                                            
                                        </select>
                                      </div>
                                      <div class="col-md-2"> 
                                        <button type="button" onclick="set_month_filter()"; class="btn btn-inverse">Apply</button>
                                      </div>
                                     
                                  </div>
                                  </div>
                              </div>
                            </div>
                          
                            
                          
                        </div>
                    </div>
    </div>
    <div class="row">
                  
                    <div class="col-lg-12">
                        <div class="card">


 <?php
$form = ActiveForm::begin(['enableClientValidation'=>false,'id'=>'booking_header_form','action'=>"index.php?r=formula/save-calculate", 'options' => ['class' => 'disable-submit-buttons']]);
?>
   <ul class="nav nav-tabs formula-tab" role="tablist">
         <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#category_split" role="tab" style="font-size: large;">Category Split</a> </li>
         <li class="nav-item"> <a  style="font-size: large;" class="nav-link" data-toggle="tab" href="#expense_split" role="tab">Expense Split</a> </li>
         <!-- <li class="nav-item"> <a   style="font-size: large;" class="nav-link" data-toggle="tab" href="#settings" role="tab">Payment</a> </li> -->
   </ul>
<div class="tab-content">
          <div class="tab-pane" id="expense_split" role="tabpanel">
            <div class="card-body">
           <hr>
             <h4 class="card-title">Expense Cal. Table</h4>
              <div class="table-responsive">
                 <table class="table color-bordered-table muted-bordered-table">
                   <thead>
                   <tr>
                     <th>Exp. Category</th>                      
                                              <?php 
                                                $expense_cat_summary=array();
                                                $expense_count=0;
                                                $expense_cat_amounts=array();;
                                                $total_cat_expense=0;
                                               
                                                foreach ($model_exp_category as $key => $expense_category) {
                                                    $expense_count++;
                                                    $expense_cat_summary[$expense_category->id]=0;
                                                ?>
                                                
                                                <th><?= $expense_category->name; ?></th>
                                               
                                                <?php }
                                               //echo "dfdh"; print_r($model_exp_category);die;
                                                 ?>
                                                <th> Total </th>
                                            </tr>  
                                            <tr>
                                              
                                              <td>Total Expense</td>
                                       
                                              <?php 
                                               
                                               
                                                foreach ($model_exp_category as $key => $expense_category) {
                                                   $cat_expense=($key+1)*1000;
                                                   $expense_cat_amounts[$expense_category->id]= $cat_expense;


                                                ?>
                                                
                                                  <td> <input type="text" id="expense_cat_<?= $key; ?>" name="" onkeyup="recalculate_expesne()"  value="<?= $cat_expense; ?>">
                                    </td>
                                               
                                                <?php }
                                               //echo "dfdh"; print_r($model_exp_category);die;
                                                 ?>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <?php 
                                      //$category_count=0;
                                         $item_cat_expense_split_array=array();
                                        foreach ($model_category as   $item_category) {
                                         //  $category_count++;
                                         $item_cat_key =$item_category->id;
                                         
                                            ?> 
                                   
                                         <tr>
                                            <td> <?= $item_category->name; ?></td>
                                        
                                         <?php  

                                         $item_cat_expense_total=0;
                                         foreach ($model_exp_category as $exp_cat_key => $expense_category) {
                                          $expense_amount=$expense_cat_amounts[$expense_category->id];
                                             $cat_expense_per = $expense_category->formula($item_category->id);
                                          $calculated_exp_amount=($expense_amount*$cat_expense_per)/100;
                                              $expense_cat_summary[$expense_category->id]+= $calculated_exp_amount;
                                              $item_cat_expense_total+=$calculated_exp_amount;
                                        ?>
                                        
                                                <td>
                                                    <?php 
                                                    
                                                    echo "<span id='cat_expense_amount_".$item_cat_key."_".$exp_cat_key."'>".number_format($calculated_exp_amount)."</span>"; ?>
                                                    <input type="text" id="cat_expense_per_<?= $item_cat_key.'_'.$exp_cat_key ;?>" class="form-control text_first"  value="<?= $cat_expense_per; ?>"  placeholder="Expense" autocomplete="off" aria-required="true">
                                                     </td>
                                                <?php //}
                                            
                                          
                                        }
                                       $item_cat_expense_split_array[$item_category->id]=$item_cat_expense_total;
                                        ?>
                                        <td> <span id="item_cat_expense_total_<?=$item_cat_key; ?>"><?= $item_cat_expense_total;  ?></span>
                                        </td>
                                         </tr>
                                           <?php
                                        } ?>

                                        <tr class="table-warning"> 
                                            <td>Total</td>
                                           
                                           
                                            <?php 
                                              foreach ($model_exp_category as $key => $value) {
                                                ?>
                                                
                                                <th style="font-size: 20px;"> ₹ <?= "<span id='total_cat_exp_amount_".$key."'>".number_format($expense_cat_summary[$value->id])."</span>"; ?></th>
                                                <?php } ?>
                                        </tr>
                                    </table>
                                </div>
<div>
                                <hr> </div>
                          
                          
                            </div>
                          </div>
                 <div class="tab-pane active" id="category_split" role="tabpanel">


        <div class="card-body">
           <hr>
               <h4 class="card-title">Calculation Table</h4>
                 <div class="table-responsive">
                     <table class="table color-bordered-table muted-bordered-table">
                       <thead>
                        <tr>
                          <th>Category</th>
                          <th>Turnover</th>
                          <th>Cat. Expense</th>
                            <th>Expense Split</th>
                        <?php 
                          $reviver_array=array();
                          $reciver_count=0;
                          $total_turn_over=0;
                          $total_cat_expense=0;        
                            foreach ($model_reciver as $key => $value) {
                                      $reciver_count++;
                                      $reviver_array[$value->id]=0;
                                                ?>
                                      <th><?= $value->name; ?></th>
                                     <?php }
                                         $reviver_array[6]=0;
                                      ?>     
                                    </tr>
                                        </thead>
                                  <?php 
                                //  print_r($expense_cat_summary);die;
                                      $category_count=0;
                                        foreach ($model_category as $key_category => $value) {
                                           $category_count++;
                                        	echo "<tr>";
                                            echo '<td> '.$value->name.'</td>';
                                           $category_turn_over= $value->earningByCategory($select_month."-".$select_year);
                                           $category_expense=0;
                                               $reviver_array[6] += $category_turn_over;
                                               $total_turn_over+=$category_turn_over;
                                               $total_cat_expense+=$category_expense;
                                            ?> 

                                        	<td> <input style="width: 100px" type="text" id="total_<?= $value->id;?>" class="form-control text_first" onkeyup="recalculat()" value="<?= $category_turn_over;?>" name="Total[<?= $value->id;?>]"  placeholder="" autocomplete="off" aria-required="true"> </td>
                                          <td> 
                                            <input style="width: 100px" type="text" id="cat_vis_expense_<?= $value->id;?>" class="form-control text_first" onkeyup="recalculat()" value="<?= $category_expense;?>" name="Total[<?= $value->id;?>]"  placeholder="" autocomplete="off" aria-required="true"> 
                                          </td>
                                        <td> 
                                            <span id="exp_cat_split_<?= $value->id; ?>"><?= number_format($item_cat_expense_split_array[$value->id]); ?>
                                              
                                            </span>
                                          </td>
                                        
                                         <?php	foreach ($model_reciver as $key_recv => $recv) {
                                             $expense = $total_expense*($value->formula(0)/100);
                                             $expense= $expense+$category_expense;
                                            if($recv->id==0){
                                                  $reviver_array[$recv->id] += $expense;
                                                ?> 
                                           <td> 
                                            
                                         <?= "<span id='expense_amount_".$value->id."_".$recv->id."'>".number_format($expense)."</span>"; ?>
                                          <input type="hidden" id="expense_per_<?= $value->id.'_'.$recv->id ;?>" class="form-control text_first"  value="<?= $recv->formula($value->id); ?>"  placeholder="Expense" autocomplete="off" aria-required="true">
                                           </td>
                         <?php
                                  }else{
                             ?>
                             <td>
                   <?php 
                      $earning_cat=(($recv->formula($value->id))/100)*($category_turn_over-$expense);
                                                    //$reviver_array[$value->id]=0;
                   $reviver_array[$recv->id] += $earning_cat;
                  echo "<span id='reciver_amount_".$value->id."_".$recv->id."'>".number_format($earning_cat)."</span>"; ?>
                   <input type="hidden" id="reciver_per_<?= $value->id.'_'.$recv->id ;?>" class="form-control text_first"  value="<?= $recv->formula($value->id); ?>"  placeholder="Expense" autocomplete="off" aria-required="true">
                   </td>
                  <?php }
                                        		
                  }
                echo "</tr>";
               } ?>
              <tr class="table-warning"> 
                                            <td>Total</td>
                                            <th style="font-size: 20px;">₹ <?= "<span id='reciver_total_amount_6'>".number_format($reviver_array[6])."</span>"; ?></th>
                                            <th style="font-size: 20px;">₹ <?= "<span id='total_category_expense'>".number_format($total_cat_expense)."</span>"; ?></th>
                                            <?php 
                                              foreach ($model_reciver as $key => $value) {
                                                ?>
                                                
                                                <th style="font-size: 20px;"> ₹ <?= "<span id='reciver_total_amount_".$value->id."'>".number_format($reviver_array[$value->id])."</span>"; ?></th>
                                                <?php } ?>
                                        </tr>
                                    </table>
                                </div>
<div>
                                <hr> </div>
                                <div class="card-body m-b-20 m-t-10">
                                <div class="row">
                                    <div class="col-3">
                                        <h1><span id="turn_over_summary">₹ <?= number_format($total_turn_over); ?> </span></h1>
                                        <h6 class="text-muted">Total Turn Over</h6></div>
                                    <div class="col-3">
                                        <h1><span id="expense_summary">₹ <?= number_format($total_expense); ?> </span></h1>
                                        <h6 class="text-muted">Total Expense</h6></div> 
                                        <div class="col-3">
                                        <h1><span id="total_earning">₹ <?= number_format($total_turn_over - $total_expense); ?> </span></h1>
                                        <h6 class="text-muted">Total Earning</h6></div>
                                   <!--  <div class="col-3 align-self-center text-right">
                                        <button type="submit" class="btn btn-success">Post</button>
                                    </div> -->
                                </div>
                            </div>
                          
                            </div>
                          </div>
                  
                        </div>
                              <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
<script type="text/javascript">
     function open_update(receiver_name,category_id) {
        $.ajax({
            url:"<?php echo \Yii::$app->getUrlManager()->createUrl('formula/update') ?>",
            type: 'get',
            data:{
                category_id:category_id,
                receiver_name:receiver_name

               },
            dataType:'html',
            beforeSend: function(){
                $(".overlay").show();
            },
            complete: function(){
                $(".overlay").hide();
            },
            success: function (data) {
                // console.log(data);
               
                $('#pModal').modal('show');
                $('#modalContent').html(data);
            },
            error: function(jqXhr, textStatus, errorThrown ){
                // alert(errorThrown);
                if(errorThrown=='Forbidden'){
                    alert(YOU_DONT_HAVE_ACCESS);
                }
            }
        });
    }
    var category_count=<?= $category_count; ?>;
    var reciver_count=<?= $reciver_count; ?>;
    var expense_category_count=<?= $expense_count; ?>;
    function recalculat() {
       // var total_expense=$('#total_expense').val();
        var total_turn_over=0;
        var cat_vise_total_expense=0;
        var categ_array=[0,0,0,0,0];
        for(var category_iterator=1; category_iterator<=category_count; category_iterator++ ){
            var category_turn_over=$('#total_'+category_iterator).val();
            var category_expense=$('#cat_vis_expense_'+category_iterator).val();
            var split_expense=$('#exp_cat_split_'+category_iterator).html();
           // console.log("Turn Around"+category_turn_over);

            if(category_turn_over==""){
                    category_turn_over=0;
                 }
                 if(category_expense==""){
                    category_expense=0;
                 }
                if(split_expense==""){
                    split_expense=0;
                 }

                 cat_vise_total_expense = +cat_vise_total_expense + +category_expense;
           total_turn_over = +total_turn_over + +category_turn_over;
            var expense_per=$('#expense_per_'+category_iterator+'_0').val();
           
                 if(total_expense==""){
                    total_expense=0;
                 }

                //var cat_expense_amount=(total_expense*(expense_per/100)).toFixed(2);
                 cat_expense_amount= +cat_expense_amount+ +category_expense;
               var cat_earning=category_turn_over-cat_expense_amount;
                 $("#expense_amount_"+category_iterator+'_0').html(cat_expense_amount);
                 categ_array[0]=  +categ_array[0] + +cat_expense_amount;
             for(var reciver_iterator=1; reciver_iterator<=reciver_count; reciver_iterator++ ){
                 var reciver_per=$('#reciver_per_'+category_iterator+'_'+reciver_iterator).val();
                 var cat_reciver_amount=(cat_earning*(reciver_per/100)).toFixed(2);

                  $("#reciver_amount_"+category_iterator+'_'+reciver_iterator).html(numberWithCommas(cat_reciver_amount));
                categ_array[reciver_iterator]= +categ_array[reciver_iterator] + +cat_reciver_amount;
           }
        }
//console.log(categ_array);
          $("#turn_over_summary").html(numberWithCommas(total_turn_over));
          
          $("#reciver_total_amount_6").html( numberWithCommas(total_turn_over));
          $("#total_category_expense").html( numberWithCommas(cat_vise_total_expense));
        for(var reciver_iterator=0; reciver_iterator<=reciver_count; reciver_iterator++ ){
            if(reciver_iterator==0){
                $("#expense_summary").html("₹ "+numberWithCommas(categ_array[reciver_iterator]));
                $("#total_earning").html("₹ "+numberWithCommas(total_turn_over-categ_array[reciver_iterator]));

            }

             $("#reciver_total_amount_"+reciver_iterator).html(numberWithCommas(categ_array[reciver_iterator]));
        }

    }
    function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function set_month_filter() {
var month=$('#month').val();
var year=$('#year').val();

 window.location.href = "<?= Url::base(); ?>/index.php?r=formula/calculate&month="+month+"&year="+year;
}

function recalculate_expesne() {

 var cat_amount_array=new Array(category_count);

   for(var expesne_category_iterator=0; expesne_category_iterator<expense_category_count; expesne_category_iterator++ ){
      
       var exp_cat_amount= $("#expense_cat_"+expesne_category_iterator).val();
       var sum_exp_cat_total=0;
     for(var category_iterator=1; category_iterator<=category_count; category_iterator++ ){
       var exp_cat_per= $("#cat_expense_per_"+category_iterator+"_"+expesne_category_iterator).val();
       var calcu_expense_amount= (+exp_cat_per/100) * +exp_cat_amount;
      // cat_expense_amount
       $("#cat_expense_amount_"+category_iterator+"_"+expesne_category_iterator).html(calcu_expense_amount);
       sum_exp_cat_total+= calcu_expense_amount;
      
       if(cat_amount_array[category_iterator]==null){
        cat_amount_array[category_iterator]=0;
       }
       //console.log(cat_amount_array);
       if(calcu_expense_amount!=null){
         cat_amount_array[category_iterator]=+cat_amount_array[category_iterator] +calcu_expense_amount;
       }
      
   }
     $("#total_cat_exp_amount_"+expesne_category_iterator).html(sum_exp_cat_total);
 }

for(var category_iterator=0; category_iterator<=category_count; category_iterator++){
  $("#item_cat_expense_total_"+category_iterator).html(cat_amount_array[category_iterator]);
  $("#exp_cat_split_"+category_iterator).html(cat_amount_array[category_iterator]);
}

}

</script>