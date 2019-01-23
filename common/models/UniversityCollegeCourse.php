<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "university_college_course".
 *
 * @property int $id
 * @property int $universityID
 * @property int $collegeID
 * @property int $courseID
 * @property string $createdDate
 * @property string $updatedDate
 * @property int $status
 * @property int $createdBy
 * @property int $updatedBy
 *
 * @property Courses $course
 * @property User $createdBy0
 * @property User $updatedBy0
 */
class UniversityCollegeCourse extends \yii\db\ActiveRecord
{
    const SCENARIO_UC_CREATE = 'uc_create';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'university_college_course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universityID', 'collegeID', 'courseID', 'status', 'createdBy', 'updatedBy'], 'integer'],
            [['courseID', 'status'], 'required','except' => self::SCENARIO_UC_CREATE],
            [['createdDate', 'updatedDate'], 'safe'],
            [['courseID'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['courseID' => 'id']],
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
            'universityID' => 'University ID',
            'collegeID' => 'College ID',
            'courseID' => 'Course ID',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'status' => 'Status',
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

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_UC_CREATE] = ['courseID','universityID'];

        return $scenarios;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
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
