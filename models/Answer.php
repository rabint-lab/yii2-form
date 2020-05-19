<?php

namespace rabint\form\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "frm_answer".
 *
 * @property integer $id
 * @property integer $form_id
 * @property integer $user_id
 * @property string $tracking_code
 * @property integer $status
 * @property integer $start_at
 * @property integer $end_at
 * @property string $answers_data
 * @property double $score
 * @property double $rank
 * @property string $result
 * @property string $ip
 * @property string $agent
 * @property string $location
 * @property string $answer_record_file
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property User $createdBy
 * @property Answer $form
 * @property Answer[] $answers
 * @property User $updatedBy
 * @property User $user
 */
class Answer extends \common\models\base\ActiveRecord     /* \yii\db\ActiveRecord */
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
        return 'frm_answer';
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
            [['form_id', 'user_id', 'status', 'start_at', 'end_at', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['answers_data', 'result', 'agent', 'answer_record_file'], 'string'],
            [['score', 'rank'], 'number'],
            [['tracking_code'], 'string', 'max' => 15],
            [['ip'], 'string', 'max' => 48],
            [['location'], 'string', 'max' => 50],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['form_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answer::className(), 'targetAttribute' => ['form_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rabint', 'شناسه'),
            'form_id' => Yii::t('rabint', 'فرم'),
            'user_id' => Yii::t('rabint', 'کاربر'),
            'tracking_code' => Yii::t('rabint', 'کد رهگیری'),
            'status' => Yii::t('rabint', 'وضعیت'),
            'start_at' => Yii::t('rabint', 'تاریخ شروع'),
            'end_at' => Yii::t('rabint', 'تاریخ پایان'),
            'answers_data' => Yii::t('rabint', 'پاسخنامه'),
            'score' => Yii::t('rabint', 'نمره دریافتی'),
            'rank' => Yii::t('rabint', 'رتبه'),
            'result' => Yii::t('rabint', 'نتیجه آزمون'),
            'ip' => Yii::t('rabint', 'آی پی'),
            'agent' => Yii::t('rabint', 'واسط کاربری'),
            'location' => Yii::t('rabint', 'محل ثبت نام'),
            'answer_record_file' => Yii::t('rabint', 'صوت یا تصویر پاسخگویی'),
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
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \common\models\base\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne(Answer::className(), ['id' => 'form_id']);
    }

    /**
     * @return \common\models\base\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['form_id' => 'id']);
    }

    /**
     * @return \common\models\base\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \common\models\base\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
