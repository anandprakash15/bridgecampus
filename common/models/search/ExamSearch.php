<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Exam;

/**
 * ExamSearch represents the model behind the search form of `common\models\Exam`.
 */
class ExamSearch extends Exam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'examcatID', 'courseID', 'r_book', 'status', 'createdBy', 'updatedBy'], 'integer'],
            [['name', 'exam_dates', 'exam_fullname', 'conductedBy', 'process', 'highlight', 'eligibility', 'appform', 'exam_center', 'result', 'cutt_off', 'selection_process', 'main_stream', 'summary', 'analysis', 'bylocation', 'question_paper', 'ans_key', 'counselling', 'syllabus', 'admit_card', 'upload_guide', 'createdDate', 'updatedDate'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Exam::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'examcatID' => $this->examcatID,
            'courseID' => $this->courseID,
            'r_book' => $this->r_book,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
            'status' => $this->status,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'exam_dates', $this->exam_dates])
            ->andFilterWhere(['like', 'exam_fullname', $this->exam_fullname])
            ->andFilterWhere(['like', 'conductedBy', $this->conductedBy])
            ->andFilterWhere(['like', 'process', $this->process])
            ->andFilterWhere(['like', 'highlight', $this->highlight])
            ->andFilterWhere(['like', 'eligibility', $this->eligibility])
            ->andFilterWhere(['like', 'appform', $this->appform])
            ->andFilterWhere(['like', 'exam_center', $this->exam_center])
            ->andFilterWhere(['like', 'result', $this->result])
            ->andFilterWhere(['like', 'cutt_off', $this->cutt_off])
            ->andFilterWhere(['like', 'selection_process', $this->selection_process])
            ->andFilterWhere(['like', 'main_stream', $this->main_stream])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'analysis', $this->analysis])
            ->andFilterWhere(['like', 'bylocation', $this->bylocation])
            ->andFilterWhere(['like', 'question_paper', $this->question_paper])
            ->andFilterWhere(['like', 'ans_key', $this->ans_key])
            ->andFilterWhere(['like', 'counselling', $this->counselling])
            ->andFilterWhere(['like', 'syllabus', $this->syllabus])
            ->andFilterWhere(['like', 'admit_card', $this->admit_card])
            ->andFilterWhere(['like', 'upload_guide', $this->upload_guide]);

        return $dataProvider;
    }
}
