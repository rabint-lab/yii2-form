<?php

use yii\bootstrap4\Html;


/* @var $this yii\web\View */
/* @var $model rabint\form\models\Form */


$this->title = Yii::t('rabint', 'Create') .  ' ' . Yii::t('rabint', 'Form') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-form form-create"  id="ajaxCrudDatatable">

    <h2 class="ajaxModalTitle" style="display: none"><?=  $this->title; ?></h2>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
