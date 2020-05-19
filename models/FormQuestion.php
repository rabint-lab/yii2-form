<?php

namespace rabint\form\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "frm_form_question".
 *
 * @property integer $id
 * @property integer $question_id
 * @property string $part_name
 * @property string $section_name
 * @property double $score
 * @property integer $weight
 *
 * @property Question $question
 */
class FormQuestion extends \common\models\base\ActiveRecord     /* \yii\db\ActiveRecord */
{
    const SCENARIO_CUSTOM = 'custom';
    /* statuses */
    const STATUS_DRAFT = 0;
    const STATUS_PENDING = 1;
    const STATUS_PUBLISH = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frm_form_question';
    }


    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => time(),
            ],
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
// [
//     'class' =>\rabint\behaviors\SoftDeleteBehavior::className(),
//     'attribute' => 'deleted_at',
//     'attribute' => 'deleted_by',
// ],
            /*[
            'class' => \rabint\behaviors\Slug::className(),
            'sourceAttributeName' => 'title', // If you want to make a slug from another attribute, set it here
            'slugAttributeName' => 'slug', // Name of the attribute containing a slug
            ],*/
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
// $scenarios[self::SCENARIO_CUSTOM] = ['status'];
        return $scenarios;
    }


    /* ====================================================================== */

    public static function statuses()
    {
        return [
            static::STATUS_DRAFT => ['title' => \Yii::t('rabint', 'draft')],
            static::STATUS_PENDING => ['title' => \Yii::t('rabint', 'pending')],
            static::STATUS_PUBLISH => ['title' => \Yii::t('rabint', 'publish')],
        ];
    }

    /* ====================================================================== */

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id', 'weight'], 'integer'],
            [['score'], 'number'],
            [['part_name', 'section_name'], 'string', 'max' => 190],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rabint', 'شناسه'),
            'question_id' => Yii::t('rabint', 'سوال'),
            'part_name' => Yii::t('rabint', 'بخش'),
            'section_name' => Yii::t('rabint', 'دسته'),
            'score' => Yii::t('rabint', 'بارم'),
            'weight' => Yii::t('rabint', 'ترتیب'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
//if(!empty($this->publish_at)){
//    $this->publish_at = \rabint\helpers\locality::anyToGregorian($this->publish_at);
//    $this->publish_at = strtotime($this->publish_at);// if timestamp needs
//}
        return parent::beforeSave($insert);
    }


    /**
     * @return \common\models\base\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }
    /**
     * @inheritdoc
     * @return \rabint\models\query\PublishQuery the active query used by this AR class.
     */
    //public static function find()
    //{
    //    $publishQuery = new \rabint\models\query\PublishQuery(get_called_class());
    //    $publishQuery->statusField="status";
    //    $publishQuery->activeStatusValue=self::STATUS_PUBLISH;
    //    $publishQuery->ownerField="creator_id";
    //    $publishQuery->showNotActiveToOwners=true;
    //    return $publishQuery;
    //}

}
