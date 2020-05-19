<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel rabint\form\models\search\DefaultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rabint', 'Forms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list_box form-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <div class="row">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            /*
             'id',  'slug',  'title',  'status',  'publish_at',  'expire_at',  'max_duration',  'access_type',  'access_password_hash',  'price',  'description:ntext',  'form_limit',  'from_reserve',  'type',  'class_options:ntext',  'part_options:ntext',  'result_options:ntext',  'created_at',  'updated_at',  'created_by',  'updated_by', 
            */        
            ob_start(); ?>
        
            <div class="col-sm-12">
                <h4 class="title">
                    <?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);?>
                </h4>
            </div>
            
            <?php  return ob_get_clean();
        },
    ]) ?>

        
    </div>
</div>
