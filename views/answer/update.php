<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model rabint\form\models\Answer */

$this->title = Yii::t('rabint', 'Update') .  ' ' . Yii::t('rabint', 'Answer') . ' «' . $model->id .'»';
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'Answers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('rabint', 'Update');
?>

<div class="box-form answer-update"  id="ajaxCrudDatatable">

    <h2 class="ajaxModalTitle" style="display: none"><?=  $this->title; ?></h2>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
