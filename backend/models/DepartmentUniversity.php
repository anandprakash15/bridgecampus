<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department_university".
 *
 * @property int $id
 * @property string $name
 * @property string $createdDate
 * @property int $createdBy
 * @property string $updatedDate
 * @property int $updatedBy
 * @property int $status
 */
class DepartmentUniversity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department_university';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'createdDate', 'createdBy', 'updatedBy', 'status'], 'required'],
            [['id', 'createdBy', 'updatedBy', 'status'], 'integer'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['id'], 'unique'],
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
            'createdDate' => 'Created Date',
            'createdBy' => 'Created By',
            'updatedDate' => 'Updated Date',
            'updatedBy' => 'Updated By',
            'status' => 'Status',
        ];
    }
}
