<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model rabint\form\models\Question */
/* @var $form yii\widgets\ActiveForm */
$isModalAjax = Yii::$app->request->isAjax;

$this->context->layout = "@themeLayouts/full";

?>
<?php $form = ActiveForm::begin(); ?>


<div class="clearfix"></div>
<div class="form-block question-form">
    <div class="row">
        <div class="col-sm-<?= $isModalAjax?'12':'8';?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card block block-rounded <?= $isModalAjax?'ajaxModalBlock':'';?>">
                        <div class="card-header block-header block-header-default">
                            <h3 class="block-title"><?= Html::encode($this->title) ?></h3>
                        </div>

                        <div class="card-body block-content">
                            
                            <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'parent_id')->textInput() ?>

                            <?= $form->field($model, 'attachment')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'question')->textarea(['rows' => 6]) ?>

                            <?= $form->field($model, 'options')->textarea(['rows' => 6]) ?>

                            <?= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>

                            <?= $form->field($model, 'difficulty')->textInput() ?>

                            <?= $form->field($model, 'validation')->textarea(['rows' => 6]) ?>

                            <?= $form->field($model, 'is_private')->textInput() ?>

                            <?= $form->field($model, 'duration_sec')->textInput() ?>

                            <?= $form->field($model, 'created_at')->textInput() ?>

                            <?= $form->field($model, 'updated_at')->textInput() ?>

                            <?= $form->field($model, 'created_by')->textInput() ?>

                            <?= $form->field($model, 'updated_by')->textInput() ?>

                        </div>
                    </div>
                </div>
                <!-- =================================================================== -->
                <?php  if (FALSE AND !$model->isNewRecord) {  ?>
                <div class="col-sm-12">
                    <div class="card block block-rounded">
                        <div class="card-header block-header block-header-default">
                            <h3 class="block-title"><?= Yii::t('rabint', 'Title') ?></h3>
                        </div>
                        <div class="card-body block-content">
                            ...
                        </div>
                    </div>
                </div>
                <?php   }  ?>
            </div>
        </div>
        <div class="col-sm-<?= $isModalAjax?'12':'4';?>">
            <div class="row">
                <!-- =================================================================== -->
                <div class="col-sm-12">
                    <div class="card block block-success">
                        <div class="card-header block-header block-header-default">
                            <h3 class="block-title"><?= Yii::t('rabint', 'Save') ?></h3>
                        </div>
                        <div class="card-body block-content">
                            <?php   //echo  $form->field($model, 'published_at')->widget('trntv\yii\datetimepicker\DatetimepickerWidget') ?>
                            <?php   //echo  $form->field($model, 'status')->checkblock() ?>
                        </div>
                        <div class="card-body block-content block-content-full">
                            <div class="text-center">
                                <?= Html::submitButton($model->isNewRecord ? Yii::t('rabint', 'Create') : Yii::t('rabint', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-flat' : 'btn btn-primary btn-flat']) ?>
                            </div>
                        </div><!-- /.block-content block-content-full-->
                    </div>
                </div>
                <!-- =================================================================== -->
                <?php  if (FALSE AND !$model->isNewRecord) {  ?>
                <div class="col-sm-12">
                    <div class="card block block-warning block-solid">
                        <div class="card-header block-header block-header-default">
                            <h3 class="block-title"><?= Yii::t('rabint', 'Stat') ?></h3>
                            <div class="block-tools text-center">
                                <button class="btn btn-block-tool" data-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button class="btn btn-block-tool" data-widget="remove"><i class="fas fa-times"></i></button>
                            </div><!-- /.block-tools -->
                        </div><!-- /.block-header -->
                        <div class="card-body block-content no-padding">
                            <ul class="nav nav-stacked">
                                <li>
                                    <a href="#">
                                        <?= Yii::t('rabint', 'visit count') ?>
                                        <span class="text-center badge bg-blue">0</span>
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.block-content -->
                    </div><!-- /.block -->
                </div>
                <?php   }  ?>
                <!-- =================================================================== -->

            </div>
        </div>

    </div>
</div>

<?php ActiveForm::end(); ?>