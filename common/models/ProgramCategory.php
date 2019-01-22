<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "program_category".
 *
 * @property int $id
 * @property string $name
 * @property int $programID
 * @property string $createdDate
 * @property int $createdBy
 * @property string $updatedDate
 * @property int $updatedBy
 * @property int $status
 *
 * @property Program $program
 * @property User $createdBy0
 * @property User $updatedBy0
 */
class ProgramCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'program_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'programID', 'createdDate', 'createdBy', 'updatedBy', 'status'], 'required'],
            [['programID', 'createdBy', 'updatedBy', 'status'], 'integer'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['name'], 'string', 'max' => 500],
            [['programID'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['programID' => 'id']],
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
            'name' => 'Name',
            'programID' => 'Program ID',
            'createdDate' => 'Created Date',
            'createdBy' => 'Created By',
            'updatedDate' => 'Updated Date',
            'updatedBy' => 'Updated By',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(Program::className(), ['id' => 'programID']);
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
