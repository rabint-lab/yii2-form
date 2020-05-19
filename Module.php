<?php

namespace rabint\form;

/**
 * form module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'rabint\form\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }


    public static function registerEvent()
    {
//        \yii\base\Event::on(\yii\web\Controller::className(), \yii\web\Controller::EVENT_AFTER_ACTION, function ($event) {
//            die('ma kheyli bahalim');
//        });
//            \yii\base\Event::on(\yii\web\Response::className(), \yii\web\Response::EVENT_AFTER_SEND, function ($event) {
//                \sahifedp\stats\stats::stat();
//            });
//        \Yii::$app->view->on(\yii\web\View::EVENT_END_PAGE, function () {
//            \sahifedp\stats\stats::stat();
//        });
//        \Yii::$app->on(\app\modules\payment\controllers\PaymentController::EVENT_AFTER_PAY_SUCCESS,
//            [controllers\TranslateController::className(), 'afterPay']
//        );
    }

    public static function adminMenu()
    {
        return [
            [
                'label' => \Yii::t('rabint', 'فرم'),
                'icon' => '<i class="fas fa-list-alt"></i>',
                'url' => '#',
                'options' => ['class' => 'treeview'],
                'items' => [
                    [
                        'label' => \Yii::t('rabint', 'ایجاد فرم جدید'),
                        'url' => ['/form/admin-form/create', 'type' => 'form'],
                        'icon' => '<i class="far fa-circle"></i>'
                    ],
                    [
                        'label' => \Yii::t('rabint', 'مدیریت فرم ها'),
                        'url' => ['/post/admin-group', 'type' => 'form'],
                        'icon' => '<i class="far fa-circle"></i>'
                    ],
                ]
            ],
            [
                'label' => \Yii::t('rabint', 'آزمون'),
                'icon' => '<i class="fas fa-clipboard-list"></i>',
                'url' => '#',
                'options' => ['class' => 'treeview'],
                'items' => [
                    ['label' => \Yii::t('rabint', 'ایجاد آزمون جدید'), 'url' => ['/form/form/create', 'type' => 'quiz'], 'icon' => '<i class="far fa-circle"></i>'],
                    ['label' => \Yii::t('rabint', 'مدیریت آزمون ها'), 'url' => ['/form/form', 'type' => 'quiz'], 'icon' => '<i class="far fa-circle"></i>'],
                ]
            ],
//            [
//                'label' => \Yii::t('rabint', 'نظرسنجی'),
//                'icon' => '<i class="far fa-list-alt"></i>',
//                'url' => '#',
//                'options' => ['class' => 'treeview'],
//                'items' => [
//                    ['label' => \Yii::t('rabint', 'ایجاد نظرسنجی جدید'), 'url' => ['/form/admin-form/create', 'type' => 'survey'], 'icon' => '<i class="far fa-circle"></i>'],
//                    ['label' => \Yii::t('rabint', 'مدیریت نظرسنجی ها'), 'url' => ['/form/admin-form', 'type' => 'form'], 'survey' => '<i class="far fa-circle"></i>'],
//                ]
//            ]
        ];
    }
}
