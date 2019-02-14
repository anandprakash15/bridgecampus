<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exam".
 *
 * @property int $id
 * @property int $programID
 * @property int $courseID
 * @property string $exam_name
 * @property string $type
 * @property string $short_name
 * @property int $exam_course_level
 * @property string $overview
 * @property string $registration_end_date
 * @property string $registration_extended_date_from
 * @property string $registration_extended_date_to
 * @property string $admit_card_download_start_date
 * @property string $admit_card_download_end_date
 * @property string $online_exam_date
 * @property string $paper_based_test_date
 * @property string $result_date
 * @property string $result_overview
 * @property string $cut_off
 * @property string $syllabus
 * @property string $exam_pattern
 * @property string $exam_duration
 * @property string $no_of_questions
 * @property string $total_marks
 * @property string $language_of_paper
 * @property string $marks_per_question
 * @property string $negative_marks_per_question
 * @property string $do_dont_during_the_exam
 * @property string $exam_registration_website
 * @property string $couducting_authority
 * @property string $exam_centres
 * @property string $exam_helpline_nos
 * @property string $number_of_exam_cities
 * @property string $exam_books_guide
 * @property string $question_papers
 * @property string $exam_FAQ
 * @property string $createdDate
 * @property string $updatedDate
 * @property int $createdBy
 * @property int $updatedBy
 * @property int $status
 */
class Exam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['programID','courseID'], 'required'],
            [['programID', 'courseID', 'exam_course_level', 'createdBy', 'updatedBy','status'], 'integer'],
            [['exam_name', 'type', 'short_name', 'overview', 'registration_end_date', 'registration_extended_date_from', 'registration_extended_date_to', 'admit_card_download_start_date', 'admit_card_download_end_date', 'online_exam_date', 'paper_based_test_date', 'result_date', 'result_overview', 'cut_off', 'syllabus', 'exam_pattern', 'exam_duration', 'no_of_questions', 'total_marks', 'language_of_paper', 'marks_per_question', 'negative_marks_per_question', 'do_dont_during_the_exam', 'exam_registration_website', 'couducting_authority', 'exam_centres', 'exam_helpline_nos', 'number_of_exam_cities', 'exam_books_guide', 'question_papers', 'exam_FAQ'], 'string'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updatedBy' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'programID' => 'Program',
            'courseID' => 'Course',
            'exam_name' => 'Exam Name',
            'type' => 'Type',
            'short_name' => 'Short Name',
            'exam_course_level' => 'Exam Course Level',
            'overview' => 'Overview',
            'registration_end_date' => 'Registration End Date',
            'registration_extended_date_from' => 'Registration Extended Date From',
            'registration_extended_date_to' => 'Registration Extended Date To',
            'admit_card_download_start_date' => 'Admit Card Download Start Date',
            'admit_card_download_end_date' => 'Admit Card Download End Date',
            'online_exam_date' => 'Online Exam Date',
            'paper_based_test_date' => 'Paper Based Test Date',
            'result_date' => 'Result Date',
            'result_overview' => 'Result Overview',
            'cut_off' => 'Cut Off',
            'syllabus' => 'Syllabus',
            'exam_pattern' => 'Exam Pattern',
            'exam_duration' => 'Exam Duration',
            'no_of_questions' => 'No Of Questions',
            'total_marks' => 'Total Marks',
            'language_of_paper' => 'Language Of Paper',
            'marks_per_question' => 'Marks Per Question',
            'negative_marks_per_question' => 'Negative Marks Per Question',
            'do_dont_during_the_exam' => 'Do Dont During The Exam',
            'exam_registration_website' => 'Exam Registration Website',
            'couducting_authority' => 'Couducting Authority',
            'exam_centres' => 'Exam Centres',
            'exam_helpline_nos' => 'Exam Helpline Nos',
            'number_of_exam_cities' => 'Number Of Exam Cities',
            'exam_books_guide' => 'Exam Books Guide',
            'question_papers' => 'Question Papers',
            'exam_FAQ' => 'Exam  Faq',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->createdBy = \Yii::$app->user->identity->id;
                $this->createdDate = date('Y-m-d H:i:s');
            }
            $this->updatedBy = \Yii::$app->user->identity->id;
            return true;
        }
        return false;
    }

    public function getProgram()
    {
        return $this->hasOne(Program::className(), ['id' => 'programID']);
    }

    public function getCourse()
    {
        return $this->hasOne(Courses::className(), ['id' => 'courseID']);
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
