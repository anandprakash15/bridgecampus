<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course_details".
 *
 * @property int $id
 * @property string $duration
 * @property string $fees
 * @property int $uccID
 * @property string $description
 * @property string $updatedDate
 * @property int $updatedBy
 * @property int $createdBy
 * @property string $createdDate
 * @property int $status
 */
class CourseDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['duration', 'fees', 'uccID'], 'required'],
            [['duration', 'description'], 'string'],
            [['uccID', 'updatedBy', 'createdBy', 'status'], 'integer'],
            [['updatedDate', 'createdDate'], 'safe'],
            [['fees'], 'string', 'max' => 100],
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'duration' => 'Duration',
            'fees' => 'Fees',
            'uccID' => 'Ucc ID',
            'description' => 'Description',
            'updatedDate' => 'Updated Date',
            'updatedBy' => 'Updated By',
            'createdBy' => 'Created By',
            'createdDate' => 'Created Date',
            'status' => 'Status',
        ];
    }
}
