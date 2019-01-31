<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "frontend".
 *
 * @property int $id
 * @property string $about
 * @property int $about_status
 * @property string $privacy
 * @property int $privacy_status
 * @property string $term_condition
 * @property int $term_condition_status
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $created_date
 * @property string $updated_date
 *
 * @property User $createdBy0
 * @property User $updatedBy0
 */
class Frontend extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'frontend';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['about', 'privacy', 'term_condition'], 'string'],
            /*[['about_status', 'privacy_status', 'term_condition_status', 'createdBy', 'updatedBy', 'created_date'], 'required'],*/
            [['about_status', 'privacy_status', 'term_condition_status', 'createdBy', 'updatedBy'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updatedBy' => 'id']],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->createdBy = \Yii::$app->user->identity->id;
                $this->created_date = date('Y-m-d H:i:s');
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
            'about' => 'About',
            'about_status' => 'About Status',
            'privacy' => 'Privacy',
            'privacy_status' => 'Privacy Status',
            'term_condition' => 'Term Condition',
            'term_condition_status' => 'Term Condition Status',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
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
