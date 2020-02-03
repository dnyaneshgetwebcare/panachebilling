<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FormulaMaster */

$this->title = 'Update Formula Master';

?>
<div class="formula-master-update">



    <?= $this->render('_form_exp', [
        'model' => $model,
        'model_category'=>$model_category,
            'model_exp'=>$model_exp,
    ]) ?>

</div>
