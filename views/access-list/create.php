<?php

use yii\bootstrap4\Html;


/* @var $this yii\web\View */
/* @var $model rabint\form\models\AccessList */


$this->title = Yii::t('rabint', 'Create') .  ' ' . Yii::t('rabint', 'Access List') . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'Access Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-form access-list-create"  id="ajaxCrudDatatable">

    <h2 class="ajaxModalTitle" style="display: none"><?=  $this->title; ?></h2>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
