<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseHeader */

$this->title = 'Create Purchase Header';

?>
<div class="purchase-header-create">

   <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Purchase</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Create Purchase</a></li>
                            <li class="breadcrumb-item active">Purchase</li>
                        </ol>
                    </div>
                   
                </div>
    <?= $this->render('_form', [
        'model' => $model,
        'vendor_model' => $vendor_model,
        'purchase_items' => $purchase_items,
        //'model_category'=>$model_category,
          //  'model_category'=>$model_type,
    ]) ?>

</div>
