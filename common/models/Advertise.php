<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "advertise".
 *
 * @property int $id
 * @property int $college_university_advpurposeID
 * @property int $programID
 * @property int $courseID
 * @property int $cityID
 * @property int $stateID
 * @property int $countryID
 * @property string $description
 * @property string $createdDate
 * @property string $updatedDate
 * @property int $status
 * @property int $createdBy
 * @property int $updatedBy
 *
 * @property User $createdBy0
 * @property User $updatedBy0
 */
class Advertise extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advertise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['college_university_advpurposeID', 'description', 'createdDate', 'status', 'createdBy', 'updatedBy'], 'required'],
            [['college_university_advpurposeID', 'programID', 'courseID', 'cityID', 'stateID', 'countryID', 'status', 'createdBy', 'updatedBy'], 'integer'],
            [['description'], 'string'],
            [['createdDate', 'updatedDate'], 'safe'],
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
            'college_university_advpurposeID' => 'College University Advpurpose ID',
            'programID' => 'Program ID',
            'courseID' => 'Course ID',
            'cityID' => 'City ID',
            'stateID' => 'State ID',
            'countryID' => 'Country ID',
            'description' => 'Description',
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
