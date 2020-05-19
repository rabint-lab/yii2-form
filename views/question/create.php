<?php

use yii\bootstrap4\Html;


/* @var $this yii\web\View */
/* @var $model rabint\form\models\Question */


$this->title = Yii::t('rabint', 'Create') .  ' ' . Yii::t('rabint', 'Question') . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rabint', 'Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-form question-create"  id="ajaxCrudDatatable">

    <h2 class="ajaxModalTitle" style="display: none"><?=  $this->title; ?></h2>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
