<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property int $type 1-unvesity, 2-college
 * @property int $coll_univID
 * @property int $courseID
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
class Review extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'coll_univID', 'courseID', 'description', 'createdDate', 'status', 'createdBy', 'updatedBy'], 'required'],
            [['type', 'coll_univID', 'courseID', 'status', 'createdBy', 'updatedBy'], 'integer'],
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
            'type' => 'Type',
            'coll_univID' => 'Coll Univ ID',
            'courseID' => 'Course ID',
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
