<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course_specialization".
 *
 * @property int $id
 * @property int $courseID
 * @property int $specializationID
 * @property string $createdDate
 * @property int $createdBy
 * @property string $updatedDate
 * @property int $updatedBy
 *
 * @property Courses $course
 * @property Specialization $specialization
 * @property User $createdBy0
 * @property User $updatedBy0
 */
class CourseSpecialization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course_specialization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['courseID', 'specializationID', 'createdDate', 'createdBy', 'updatedBy'], 'required'],
            [['courseID', 'specializationID', 'createdBy', 'updatedBy'], 'integer'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['courseID'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['courseID' => 'id']],
            [['specializationID'], 'exist', 'skipOnError' => true, 'targetClass' => Specialization::className(), 'targetAttribute' => ['specializationID' => 'id']],
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
            'courseID' => 'Course ID',
            'specializationID' => 'Specialization ID',
            'createdDate' => 'Created Date',
            'createdBy' => 'Created By',
            'updatedDate' => 'Updated Date',
            'updatedBy' => 'Updated By',
        ];
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
    public function getSpecialization()
    {
        return $this->hasOne(Specialization::className(), ['id' => 'specializationID']);
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
