<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news_artical".
 *
 * @property int $id
 * @property int $natype 1-news, 2-artical
 * @property int $type 1-unversity, 2-college
 * @property int $coll_univID
 * @property int $programID
 * @property int $courseID
 * @property string $title
 * @property string $description
 * @property int $national_international 1-national, 2-international
 * @property string $startDate
 * @property string $endDate
 * @property string $createdDate
 * @property string $updatedDate
 * @property int $status
 * @property int $createdBy
 * @property int $updatedBy
 *
 * @property User $createdBy0
 * @property User $updatedBy0
 */
class NewsArtical extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_artical';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['natype', 'type', 'coll_univID', 'title', 'description', 'national_international', 'startDate', 'endDate', 'createdDate', 'status', 'createdBy', 'updatedBy'], 'required'],
            [['natype', 'type', 'coll_univID', 'programID', 'courseID', 'national_international', 'status', 'createdBy', 'updatedBy'], 'integer'],
            [['title', 'description'], 'string'],
            [['startDate', 'endDate', 'createdDate', 'updatedDate'], 'safe'],
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
            'natype' => 'Natype',
            'type' => 'Type',
            'coll_univID' => 'Coll Univ ID',
            'programID' => 'Program ID',
            'courseID' => 'Course ID',
            'title' => 'Title',
            'description' => 'Description',
            'national_international' => 'National International',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
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
