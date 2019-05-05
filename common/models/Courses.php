<?php

namespace common\models; 

use Yii; 

/** 
 * This is the model class for table "courses". 
 * 
 * @property int $id
 * @property int $programID
 * @property string $name
 * @property string $short_name
 * @property string $code
 * @property int $duration
 * @property string $required _skillset
 * @property string $elagibility_criteria
 * @property string $course_curriculam
 * @property string $job_profiles
 * @property string $top_recruiters
 * @property int $medium_of_teaching
 * @property string $course_high_lights
 * @property string $entrance_exams_accepted
 * @property string $admission_process
 * @property string $important_dates
 * @property int $no_of_seats
 * @property string $seat_brakeup
 * @property string $placement_details
 * @property string $course_credits
 * @property int $sortno
 * @property string $course_duration _hours
 * @property int $courselevel
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
           [['programID', 'name', 'short_name', 'status', 'type','courseType'], 'required'],

            [['programID', 'duration', 'medium_of_teaching', 'no_of_seats', 'sortno', 'courselevel', 'status', 'createdBy', 'updatedBy', 'full_part_time', 'type', 'courseType'], 'integer'],
            [['required_skillset', 'elagibility_criteria', 'course_curriculam', 'job_profiles', 'top_recruiters', 'course_high_lights', 'admission_process', 'important_dates', 'seat_brakeup', 'placement_details', 'course_credits', 'course_duration_hours', 'description'], 'string'],
            [['createdDate', 'updatedDate', 'entrance_exams_accepted'], 'safe'],
            [['name'], 'string', 'max' => 300],
            [['short_name'], 'string', 'max' => 100],
            [['code'], 'string', 'max' => 20],
            ['code', 'codeunique'],
            [['programID'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['programID' => 'id']],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updatedBy' => 'id']],
            ['short_name','validateShortName'],
        ]; 
    } 

    public function validateShortName($attribute, $params, $validator)
    {
        $query = Courses::find()->where(['programID'=>$this->programID,'LOWER(short_name)'=>strtolower($this->short_name)]);
        
        if(!$this->isNewRecord)
        {
            $query->andWhere(['<>','id', $this->id]);
        }
        $check = $query->one();
        if(!empty($check)){
            $this->addError($attribute, $this->short_name.' short name has already been taken.');
        }
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
            'programID' => 'Program Name',
            'name' => 'Course Name',
            'short_name' => 'Short Name',
            'code' => 'Course Code',
            'duration' => 'Course Duration',
            'required_skillset' => 'Required Skillset',
            'elagibility_criteria' => 'Elagibility Criteria',
            'course_curriculam' => 'Course Curriculam',
            'job_profiles' => 'Job Profiles',
            'top_recruiters' => 'Top Recruiters',
            'medium_of_teaching' => 'Medium of Teaching',
            'course_high_lights' => 'Course High Lights',
            'entrance_exams_accepted' => 'Entrance Exams Accepted',
            'admission_process' => 'Admission Process',
            'important_dates' => 'Important Dates',
            'no_of_seats' => 'No of Seats',
            'seat_brakeup' => 'Seat Brakeup',
            'placement_details' => 'Placement Details',
            'course_credits' => 'Course Credits',
            'sortno' => 'Sortno',
            'course_duration_hours' => 'Course Duration in Hours',
            'courselevel' => 'Certification Type',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'status' => 'Status',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'full_part_time' => 'Course Type',
            'type' => 'Qualification Type',
            'description' => 'Course Description',
            
            'courseType' => 'Affiliation Type',
        ]; 
    } 

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $maxcode = Courses::find()->max('code');
                if(empty($maxcode)){
                    $maxcode = 0;
                }
                $this->code = $maxcode + 1; 
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
