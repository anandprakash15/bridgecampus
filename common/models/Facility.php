<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "facility".
 *
 * @property int $id
 * @property int $type 1-unvesity, 2-college
 * @property int $coll_univID
 * @property int $ftype
 * @property string $description
 * @property string $createdDate
 * @property string $updatedDate
 * @property int $status
 * @property int $createdBy
 * @property int $updatedBy
 */
class Facility extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facility';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'coll_univID', 'ftype', 'description', 'createdDate', 'status', 'createdBy', 'updatedBy'], 'required'],
            [['type', 'coll_univID', 'ftype', 'status', 'createdBy', 'updatedBy'], 'integer'],
            [['description'], 'string'],
            [['createdDate', 'updatedDate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'coll_univID' => 'Coll Univ ID',
            'ftype' => 'Ftype',
            'description' => 'Description',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'status' => 'Status',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
        ];
    }
}
