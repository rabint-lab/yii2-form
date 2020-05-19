<?php

namespace rabint\form\components;

use rabint\form\models\Report;
use rabint\helpers\collection;
use Yii;
use yii\base\Component;
use yii\base\Widget;
use yii\db\mssql\Schema;

/**
 * AdminDataController implements the CRUD actions for Data model.
 */
abstract class FormTypeAbstract extends Component
{
    var $options = [];


    /**
     * create instance by record id
     *
     * @param integer $reportId
     * @return FormTypeAbstract
     * @throws \yii\base\InvalidConfigException
     */
    public static function loadInstance($reportId)
    {
        $report = Report::findOne(['id' => $reportId]);
        $className = Report::templates('class')[$report->class_template];
        $class = static::newInstance($className, $report->class_options);
//        $class->report = $report;
//        $class->levelConfig = json_decode($report->level_config, 1);
        return $class;
    }

    /**
     * create new instance by template and options
     *
     * @param string $type
     * @param array|json $options
     * @return FormTypeAbstract
     * @throws \yii\base\InvalidConfigException
     */
    public static function newInstance($type, $options = null)
    {
        if (is_string($options) && collection::isJson($options)) {
            $options = json_decode($options, 1);
        }
        if (empty($options)) {
            $options = [
                'structure' => [],
                'fields' => [],
            ];
        }
        $config = [
            'class' => $type,
            'options' => $options
        ];
        $class = Yii::createObject($config);
        return $class;
    }

}
