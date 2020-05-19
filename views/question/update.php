<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model rabint\form\models\Question */

$this->title = Yii::t('rabint', 'Update') .  ' ' . Yii::t('rabint', 'Question') . ' «' . $model->id .'»';
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('rabint', 'Update');
?>

<div class="box-form question-update"  id="ajaxCrudDatatable">

    <h2 class="ajaxModalTitle" style="display: none"><?=  $this->title; ?></h2>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
