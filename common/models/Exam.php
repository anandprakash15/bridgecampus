<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exam".
 *
 * @property int $id
 * @property int $examcatID
 * @property int $courseID
 * @property string $name
 * @property string $exam_dates
 * @property string $exam_fullname
 * @property string $conductedBy
 * @property string $process
 * @property string $highlight
 * @property string $eligibility
 * @property string $appform
 * @property string $exam_center
 * @property int $r_book
 * @property string $result
 * @property string $cutt_off
 * @property string $selection_process
 * @property string $main_stream
 * @property string $summary
 * @property string $analysis
 * @property string $bylocation
 * @property string $question_paper
 * @property string $ans_key
 * @property resource $counselling
 * @property string $syllabus
 * @property string $admit_card
 * @property string $upload_guide
 * @property string $createdDate
 * @property string $updatedDate
 * @property int $status
 * @property int $createdBy
 * @property int $updatedBy
 *
 * @property ExamCategory $examcat
 * @property User $createdBy0
 * @property User $updatedBy0
 */
class Exam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['examcatID'], 'required'],
            [['examcatID', 'courseID', 'r_book', 'status', 'createdBy', 'updatedBy'], 'integer'],
            [['name', 'exam_dates', 'exam_fullname', 'conductedBy', 'process', 'highlight', 'eligibility', 'appform', 'exam_center', 'result', 'cutt_off', 'selection_process', 'main_stream', 'summary', 'analysis', 'bylocation', 'question_paper', 'ans_key', 'counselling', 'syllabus', 'admit_card', 'upload_guide'], 'string'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['examcatID'], 'exist', 'skipOnError' => true, 'targetClass' => ExamCategory::className(), 'targetAttribute' => ['examcatID' => 'id']],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updatedBy' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'examcatID' => 'Examcat ID',
            'courseID' => 'Course ID',
            'name' => 'Name',
            'exam_dates' => 'Exam Dates',
            'exam_fullname' => 'Exam Fullname',
            'conductedBy' => 'Conducted By',
            'process' => 'Process',
            'highlight' => 'Highlight',
            'eligibility' => 'Eligibility',
            'appform' => 'Appform',
            'exam_center' => 'Exam Center',
            'r_book' => 'R Book',
            'result' => 'Result',
            'cutt_off' => 'Cutt Off',
            'selection_process' => 'Selection Process',
            'main_stream' => 'Main Stream',
            'summary' => 'Summary',
            'analysis' => 'Analysis',
            'bylocation' => 'Bylocation',
            'question_paper' => 'Question Paper',
            'ans_key' => 'Ans Key',
            'counselling' => 'Counselling',
            'syllabus' => 'Syllabus',
            'admit_card' => 'Admit Card',
            'upload_guide' => 'Upload Guide',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'status' => 'Status',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamcat()
    {
        return $this->hasOne(ExamCategory::className(), ['id' => 'examcatID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'updatedBy']);
    }
}
