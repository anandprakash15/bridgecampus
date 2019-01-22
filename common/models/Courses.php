<?php

namespace common\models;

use Yii;

/** 
 * This is the model class for table "courses". 
 * 
 * @property int $id
 * @property int $programID
 * @property int $program_categoryID 
 * @property string $name
 * @property string $sortname
 * @property string $code
 * @property int $sortno
 * @property string $courselevel
 * @property string $createdDate
 * @property string $updatedDate
 * @property int $status
 * @property int $createdBy
 * @property int $updatedBy
 * @property int $full_part_time 1-fulltime, 2-parttime
 * @property int $type (certi, deg etc)
 * @property string $description
 * @property int $courseType (autonomas, university)
 * 
 * @property CourseSpecialization[] $courseSpecializations
 * @property Program $program
 * @property User $createdBy0
 * @property User $updatedBy0
 * @property UniversityCollegeCourse[] $universityCollegeCourses
 */ 

class Courses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courses';
    }
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['programID', 'name', 'sortname', 'status', 'type','courseType'], 'required'],
            [['programID', 'sortno', 'status', 'createdBy', 'updatedBy', 'full_part_time', 'type', 'courseType'], 'integer'],
            [['createdDate', 'updatedDate','description','courselevel','program_categoryID'], 'safe'],
            [['name'], 'string', 'max' => 300],
            [['code'], 'string', 'max' => 20],
            ['code', 'codeunique'],
            [['sortname'], 'string', 'max' => 100],

            [['programID'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['programID' => 'id']],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updatedBy' => 'id']],
        ];
    }

    public function codeunique($attribute,$params)
    {
        $check = '';
        if(!$this->isNewRecord){
            $id = $this->id;
            $check = Courses::find()->where(['code'=>$this->code])->andWhere(['<>','id',$id])->one();
        }else{
            $check = Courses::find()->where(['code'=>$this->code])->one();
        }
        if(!empty($check)){
            $this->addError($attribute, $this->code.' This code has already been taken');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'programID' => 'Program',
            'program_categoryID' => 'program_categoryID',
            'specializationID' => 'Specialization',
            'name' => 'Name',
            'code' => 'Code',
            'sortno' => 'Sort No.',
           'sortname' => 'Sortname',
            'courselevel' => 'Course Level',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'status' => 'Status',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'full_part_time' => 'Full Part Time',
            'type' => 'Type',
            'description' => 'Description',
            'courseType' => 'Course Type',
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
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(Program::className(), ['id' => 'programID']);
    }

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getCourseSpecializations() 
    { 
        return $this->hasMany(CourseSpecialization::className(), ['courseID' => 'id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUniversityCourses()
    {
        return $this->hasMany(UniversityCourse::className(), ['courseID' => 'id']);
    }
}
