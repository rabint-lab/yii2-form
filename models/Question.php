<?php

namespace rabint\form\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "frm_question".
 *
 * @property integer $id
 * @property string $type
 * @property integer $parent_id
 * @property string $attachment
 * @property string $question
 * @property string $options
 * @property string $answer
 * @property integer $difficulty
 * @property string $validation
 * @property integer $is_private
 * @property integer $duration_sec
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property FormQuestion[] $formQuestions
 * @property User $createdBy
 * @property User $updatedBy
 */
class Question extends \common\models\base\ActiveRecord     /* \yii\db\ActiveRecord */
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
        return 'frm_question';
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
            [['parent_id', 'difficulty', 'is_private', 'duration_sec', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['question', 'options', 'answer', 'validation'], 'string'],
            [['type'], 'string', 'max' => 31],
            [['attachment'], 'string', 'max' => 190],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rabint', 'شناسه'),
            'type' => Yii::t('rabint', 'نوع'),
            'parent_id' => Yii::t('rabint', 'سوال پیش نیاز'),
            'attachment' => Yii::t('rabint', 'فایل سوال'),
            'question' => Yii::t('rabint', 'سوال'),
            'options' => Yii::t('rabint', 'گزینه ها'),
            'answer' => Yii::t('rabint', 'پاسخ صحیح'),
            'difficulty' => Yii::t('rabint', 'میزان سختی سوال'),
            'validation' => Yii::t('rabint', 'اعتبار سنجی'),
            'is_private' => Yii::t('rabint', 'خصوصی است'),
            'duration_sec' => Yii::t('rabint', 'زمان پاسخگویی'),
            'created_at' => Yii::t('rabint', 'ایجاد شده در'),
            'updated_at' => Yii::t('rabint', 'آخرین ویرایش'),
            'created_by' => Yii::t('rabint', 'ایجاد کننده'),
            'updated_by' => Yii::t('rabint', 'ویرایش کننده'),
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
    public function getFormQuestions()
    {
        return $this->hasMany(FormQuestion::className(), ['question_id' => 'id']);
    }

    /**
     * @return \common\models\base\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \common\models\base\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
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
