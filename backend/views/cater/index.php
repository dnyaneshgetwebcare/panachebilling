<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CaterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Category';

?>
<style type="text/css">
      .error-summary {
    color: #a94442;
    background: #efd4d4;
    border-left: 3px solid #eed3d7;
    padding: 10px 20px;
    margin-bottom: 10px;
/*    margin: 0 15px 15px 15px;*/
}
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


<div class="category-master-index">

   <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"><?= Html::encode($this->title) ?></h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Setting</a></li>
                <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">

               <button type="button" onclick="addnewItem()" class="btn btn-info pull-right">Add New </button>

            </div>
        </div>
    </div>

   

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
 <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive m-t-40">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            ['class' => 'yii\grid\ActionColumn', 
            'template' => '{view}{update}{delete}',
          'buttons' => [
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'lead-view'),
                ]);
            },

            'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil" onclick="open_update('.$model->id.')"></span>');
            },
            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'lead-delete'),
                ]);
            }

          ],],
        ],
    ]); ?>

</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    function addnewItem() {
        $.ajax({
            url:"<?php echo \Yii::$app->getUrlManager()->createUrl('cater/create') ?>",
            type: 'post',
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
    function open_update(type_id) {
        $.ajax({
            url:"<?php echo \Yii::$app->getUrlManager()->createUrl('cater/update') ?>",
            type: 'get',
            data:{
                id:type_id
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
</script>