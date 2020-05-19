<?php

namespace rabint\form\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "frm_form".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property integer $status
 * @property integer $publish_at
 * @property integer $expire_at
 * @property integer $max_duration
 * @property string $access_type
 * @property string $access_password_hash
 * @property integer $price
 * @property string $description
 * @property integer $form_limit
 * @property integer $from_reserve
 * @property string $type
 * @property string $class_options
 * @property string $part_options
 * @property string $result_options
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Form extends \common\models\base\ActiveRecord     /* \yii\db\ActiveRecord */
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
        return 'frm_form';
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
            [['slug', 'title'], 'required'],
            [['status', 'publish_at', 'expire_at', 'max_duration', 'price', 'form_limit', 'from_reserve', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['description', 'class_options', 'part_options', 'result_options'], 'string'],
            [['slug', 'title'], 'string', 'max' => 190],
            [['access_type', 'type'], 'string', 'max' => 15],
            [['access_password_hash'], 'string', 'max' => 255],
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
            'slug' => Yii::t('rabint', 'نامک'),
            'title' => Yii::t('rabint', 'عنوان'),
            'status' => Yii::t('rabint', 'Status'),
            'publish_at' => Yii::t('rabint', 'تاریخ شروع'),
            'expire_at' => Yii::t('rabint', 'تاریخ پایان'),
            'max_duration' => Yii::t('rabint', 'مدت کل آزمون'),
            'access_type' => Yii::t('rabint', 'Access Type'),
            'access_password_hash' => Yii::t('rabint', 'رمز ورود'),
            'price' => Yii::t('rabint', 'هزینه'),
            'description' => Yii::t('rabint', 'توضیحات'),
            'form_limit' => Yii::t('rabint', 'محدودیت تعداد'),
            'from_reserve' => Yii::t('rabint', 'تعداد رزرو'),
            'type' => Yii::t('rabint', 'نوع'),
            'class_options' => Yii::t('rabint', 'تنظیمات برگزاری'),
            'part_options' => Yii::t('rabint', 'تنظیمات بخش ها'),
            'result_options' => Yii::t('rabint', 'تنظیمات نتیجه'),
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
