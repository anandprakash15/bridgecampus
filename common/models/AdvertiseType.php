<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "advertise_type".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class AdvertiseType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'advertise_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'status'], 'required'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 250],
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
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->created_by = \Yii::$app->user->identity->id;
                $this->created_at = date('Y-m-d H:i:s');
            }
            $this->updated_at = \Yii::$app->user->identity->id;
            $this->updated_by = \Yii::$app->user->identity->id;
            return true;
        }
        return false;
    }
}
