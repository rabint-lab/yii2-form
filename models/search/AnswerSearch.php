<?php

namespace rabint\form\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use rabint\form\models\Answer;

/**
 * AnswerSearch represents the model behind the search form about `rabint\form\models\Answer`.
 */
class AnswerSearch extends Answer
{

    //var $keyword;
    //var $created_from;
    //var $created_to;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'form_id', 'user_id', 'status', 'start_at', 'end_at', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['tracking_code', 'answers_data', 'result', 'ip', 'agent', 'location', 'answer_record_file'], 'safe'],
            [['score', 'rank'], 'number'],
            //[['created_from', 'created_to', 'keyword'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return parent::attributeLabels() + [
        //    'created_from' =>  Yii::t('rabint', 'Created from'),
        //    'created_to' =>  Yii::t('rabint', 'Created to'),
        //   'keyword' =>  Yii::t('rabint', 'Keyword'),
        ];
    }
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param boolean $returnActiveQuery
     *
     * @return ActiveDataProvider | ActiveQuery
     */
    public function search($params,$returnActiveQuery = FALSE)
    {
        $query = Answer::find();//->alias('answer');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'form_id' => $this->form_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'score' => $this->score,
            'rank' => $this->rank,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'tracking_code', $this->tracking_code])
            ->andFilterWhere(['like', 'answers_data', $this->answers_data])
            ->andFilterWhere(['like', 'result', $this->result])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'agent', $this->agent])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'answer_record_file', $this->answer_record_file]);


        // if (!empty($this->creator_id) && is_string($this->creator_id)) {
        //     $exp1 = new \yii\db\Expression(
        //         "creator_id in (SELECT user_id from user_profile  WHERE " .
        //             "firstname like :keyword or  " .
        //             "lastname like :keyword or  " .
        //             "nickname like :keyword )",
        //         ['keyword' => '%' . $this->creator_id . '%']
        //     );
        //     $query->andWhere($exp1);
        // } else {
        //     $query->andFilterWhere([
        //         'contact_id' => $this->creator_id,
        //     ]);
        // }
        
        //if (!empty($this->keyword)) {
        //    $query->andFilterWhere([
        //        'OR',
        //        ['title'=>$this->keyword],
        //        //['decription'=>$this->keyword],
        //    ]);
        //
        //    //$exp1 = new \yii\db\Expression(
        //    //        "id in (SELECT user_id from user_profile  WHERE " .
        //    //        //  "firstname like '%:keyword%' or  ".
        //    //        //  "lastname like '%:keyword%' or  ".
        //    //        "nickname like ':keyword')", 
        //    //     ['keyword' => '%'.$this->keyword.'%']);
        //    //$query->andWhere($exp1);
        //}

        /**
         * date filters:
         */
        //if (!empty($this->created_at)) {
        //    $from = locality::anyToGregorian($this->created_at);
        //    $to = locality::anyToGregorian($this->created_at+86400);
        //    $query->andFilterWhere(['>=', 'created_at', $from]);
        //    $query->andFilterWhere(['<=', 'created_at', $to]);
        //}
        //
        //if (!empty($this->created_from)) {
        //    $this->created_from = locality::anyToGregorian($this->created_from);
        //    $query->andFilterWhere(['>=', 'created_at', $this->created_from]);
        //}
        //if (!empty($this->created_to)) {
        //    $this->calldate_ = locality::anyToGregorian($this->created_to);
        //    $query->andFilterWhere(['<=', 'created_at', $this->created_to]);
        //}
        


        if ($returnActiveQuery) {
            return $query;
        }
        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param boolean $returnActiveQuery
     *
     * @return ActiveDataProvider | ActiveQuery
     */
    public static function searchFactory($params, $returnActiveQuery = FALSE, $shortParams = true)
    {
        $new = new self();
        if ($shortParams) {
            $modelName = basename(str_replace('\\', '/', self::class));
            $newParams = [$modelName => $params];
        }
        return $new->search($newParams, $returnActiveQuery);
    }
}
