<?php
use yii\helpers\Url;
use yii\bootstrap4\Html;
use rabint\widgets\GridView;

/* @var $this yii\web\View */
/* @var $searchModel rabint\form\models\search\FormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rabint', 'Forms');
$this->params['breadcrumbs'][] = $this->title;

$this->context->layout = "@themeLayouts/full";


?>

<div class="form-index"  id="ajaxCrudDatatable">
        
    <h2 class="ajaxModalTitle" style="display: none"><?=  $this->title; ?></h2>
    <div class="content-search">
        <?php echo $this->render('_search',['model'=>$searchModel]);?>
    </div>
    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'modelTitle' => Yii::t('rabint', 'Forms'),
            'bulkActions' => $this->context::bulkActions(),
        ])?>
    </div>
</div>
