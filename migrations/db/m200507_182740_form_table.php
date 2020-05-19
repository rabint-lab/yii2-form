<?php

use yii\db\Migration;

class m200507_182740_form_table extends Migration
{
    static $prefix = "frm_";

    /**
     * @return bool|void
     */
    public static function tn($name)
    {
        return '{{%' . self::$prefix . $name . '}}';
    }

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::tn('form'), [
            'id' => $this->primaryKey()->comment('شناسه'),
            'slug' => $this->string(190)->notNull()->comment('نامک'),
            'title' => $this->string(190)->notNull()->comment('عنوان'),
            'status' => $this->tinyInteger()->defaultValue('0'),
            'publish_at' => $this->integer()->unsigned()->comment('تاریخ شروع'),
            'expire_at' => $this->integer()->unsigned()->comment('تاریخ پایان'),
            'max_duration' => $this->integer()->comment('مدت کل آزمون'),
            'access_type' => $this->string(15)->defaultValue('none'),//none,password,list
            'access_password_hash' => $this->string(255)->comment('رمز ورود'),
            'price' => $this->integer()->comment('هزینه'),
            'description' => $this->text()->comment('توضیحات'),
            'form_limit' => $this->integer()->comment('محدودیت تعداد'),
            'from_reserve' => $this->integer()->comment('تعداد رزرو'),
            'type' => $this->string(15)->comment('نوع'),
            'class_options' => $this->text()->comment('تنظیمات برگزاری'),
            'part_options' => $this->text()->comment('تنظیمات بخش ها'),// زمان هر بخش  , اجازه آور شدن زمان در بخش ها و...
            'result_options' => $this->text()->comment('تنظیمات نتیجه'),//پاسخ تشریحی آزمون ، پیام های موفقیت آمیز و ... ، رویداد های بعد از موفقیت یا عدم آن...
            'created_at' => $this->integer()->unsigned()->comment('ایجاد شده در'),
            'updated_at' => $this->integer()->unsigned()->comment('آخرین ویرایش'),
            'created_by' => $this->integer()->comment('ایجاد کننده'),
            'updated_by' => $this->integer()->comment('ویرایش کننده'),
        ], $tableOptions);

        $this->addForeignKey('fk_form_creator_id', self::tn('form'), 'created_by',"{{%user}}" , 'id', NULL, 'cascade');
        $this->addForeignKey('fk_form_updater_id', self::tn('form'), 'updated_by',"{{%user}}" , 'id', NULL, 'cascade');

        $this->createTable(self::tn('access_list'), [
            'id' => $this->primaryKey()->comment('شناسه'),
            'type' => $this->string(31)->notNull()->comment('نوع'),//(user_id,group_id,cell_phone)
            'identifier' => $this->bigInteger()->unsigned()->comment('مشخصه'),
            'price' => $this->integer()->comment('هزینه'),
            'created_by' => $this->integer()->comment('ایجاد کننده'),
        ], $tableOptions);

        $this->addForeignKey('fk_form_access_list_creator_id', self::tn('access_list'), 'created_by',"{{%user}}" , 'id', NULL, 'cascade');

        $this->createTable(self::tn('question'), [
            'id' => $this->primaryKey()->comment('شناسه'),
            'type' => $this->string(31)->comment('نوع'),
            'parent_id' => $this->integer()->comment('سوال پیش نیاز'),
            'attachment' => $this->string(190)->comment('فایل سوال'),
            'question' => $this->text()->comment('سوال'),
            'options' => $this->text()->comment('گزینه ها'),
            'answer' => $this->text()->comment('پاسخ صحیح'),
            'difficulty' => $this->tinyInteger()->comment('میزان سختی سوال'),
            'validation' => $this->text()->comment('اعتبار سنجی'),
            'is_private' => $this->tinyInteger()->defaultValue(0)->comment('خصوصی است'),
            'duration_sec' => $this->integer()->comment('زمان پاسخگویی'),
            'created_at' => $this->integer()->unsigned()->comment('ایجاد شده در'),
            'updated_at' => $this->integer()->unsigned()->comment('آخرین ویرایش'),
            'created_by' => $this->integer()->comment('ایجاد کننده'),
            'updated_by' => $this->integer()->comment('ویرایش کننده'),
        ], $tableOptions);
        //validation message
        //option goto && sub question
        //

        $this->addForeignKey('fk_form_question_creator_id', self::tn('question'), 'created_by',"{{%user}}" , 'id', NULL, 'cascade');
        $this->addForeignKey('fk_form_question_updater_id', self::tn('question'), 'updated_by',"{{%user}}" , 'id', NULL, 'cascade');

        $this->createTable(self::tn('form_question'), [
            'id' => $this->primaryKey()->comment('شناسه'),
            'question_id' => $this->integer()->comment('سوال'),
            'part_name' => $this->string(190)->comment('بخش'),
            'section_name' => $this->string(190)->comment('دسته'),
            'score' => $this->float()->comment('بارم'),
            'weight' => $this->integer()->comment('ترتیب'),
        ], $tableOptions);

        $this->addForeignKey('fk_form_question_relation_question_id', self::tn('form_question'), 'question_id', self::tn('question'), 'id', NULL, 'cascade');


        $this->createTable(self::tn('answer'), [
            'id' => $this->primaryKey()->comment('شناسه'),
            'form_id' => $this->integer()->comment('فرم'),
            'user_id' => $this->integer()->comment('کاربر'),
            'tracking_code' => $this->string(15)->comment('کد رهگیری'),
            'status' => $this->tinyInteger()->defaultValue('0')->comment('وضعیت'),//(not_pay,not_started,not_ended,end)
            'start_at' => $this->integer()->unsigned()->comment('تاریخ شروع'),
            'end_at' => $this->integer()->unsigned()->comment('تاریخ پایان'),
            'answers_data' => $this->text()->comment('پاسخنامه'),//json
            'score' => $this->float()->comment('نمره دریافتی'),
            'rank' => $this->float()->comment('رتبه'),// بر اساس همه شرکت کنندگان در این آزمون
            'result' => $this->text()->comment('نتیجه آزمون'),//json
            //'user_identity' => $this->string(190)->comment('نامک'),
            'ip' => $this->string(48)->comment('آی پی'),
            'agent' => $this->text()->comment('واسط کاربری'),
            'location' => $this->string(50)->comment('محل ثبت نام'),
            'answer_record_file' => $this->text()->comment('صوت یا تصویر پاسخگویی'),
            'created_at' => $this->integer()->unsigned()->comment('ایجاد شده در'),
            'updated_at' => $this->integer()->unsigned()->comment('آخرین ویرایش'),
            'created_by' => $this->integer()->comment('ایجاد کننده'),
            'updated_by' => $this->integer()->comment('ویرایش کننده'),
        ], $tableOptions);


        $this->addForeignKey('fk_form_answer_form_id', self::tn('answer'), 'form_id', self::tn('answer'), 'id', NULL, 'cascade');
        $this->addForeignKey('fk_form_answer_user_id', self::tn('answer'), 'user_id', '{{%user}}', 'id', null, 'cascade');

        $this->addForeignKey('fk_form_answer_creator_id', self::tn('answer'), 'created_by',"{{%user}}" , 'id', NULL, 'cascade');
        $this->addForeignKey('fk_form_answer_updater_id', self::tn('answer'), 'updated_by',"{{%user}}" , 'id', NULL, 'cascade');

    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->dropTable(self::tn('answer'));
        $this->dropTable(self::tn('form_question'));
        $this->dropTable(self::tn('question'));
        $this->dropTable(self::tn('access_list'));
        $this->dropTable(self::tn('form'));

    }
}
