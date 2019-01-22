<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "university".
 *
 * @property int $id
 * @property string $name
  * @property string $sortname
 * @property string $bannerURL
 * @property string $area
 * @property string $code
 * @property string $address
 * @property int $cityID
 * @property int $stateID
 * @property int $countryID
 * @property string $taluka
 * @property string $district
 * @property string $pincode
 * @property string $contact
 * @property string $fax
 * @property string $email
 * @property string $websiteurl
 * @property string $establish_year
 * @property string $approved_by
 * @property string $accredited_by
 * @property string $grade
 * @property string $about
 * @property string $brochureurl
 * @property string $logourl
 * @property string $createdDate
 * @property string $updatedDate
 * @property int $status
 * @property int $createdBy
 * @property int $updatedBy
 *
 * @property User $createdBy0
 * @property User $updatedBy0
 * @property UniversityCourse[] $universityCourses
 * @property UniversityType[] $universityTypes
 */
class University extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'university';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['cityID', 'stateID', 'countryID', 'status', 'createdBy', 'updatedBy'], 'integer'],
            [['approved_by', 'accredited_by', 'about'], 'string'],
            [['createdDate', 'updatedDate','sortname','bannerURL','area'], 'safe'],
            [['name'], 'string', 'max' => 300],
            [['code', 'pincode', 'establish_year'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 500],
            [['taluka', 'district', 'contact', 'fax', 'email', 'brochureurl', 'logourl'], 'string', 'max' => 50],
            [['websiteurl'], 'string', 'max' => 100],
            [['grade'], 'string', 'max' => 10],
            ['code', 'codeunique'],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updatedBy' => 'id']],
        ];
    }

    public function codeunique($attribute,$params)
    {
        $check = '';
        if(!$this->isNewRecord){
            $id = $this->id;
            $check = University::find()->where(['code'=>$this->code])->andWhere(['<>','id',$id])->one();
        }else{
            $check = University::find()->where(['code'=>$this->code])->one();
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
            'name' => 'Name',
            'sortname' => 'Sortname',
            'bannerURL' => 'Banner Url',
            'area' => 'Area',
            'code' => 'Code',
            'address' => 'Address',
            'cityID' => 'City',
            'stateID' => 'State',
            'countryID' => 'Country',
            'taluka' => 'Taluka',
            'district' => 'District',
            'pincode' => 'Pincode',
            'contact' => 'Contact',
            'fax' => 'Fax',
            'email' => 'Email',
            'websiteurl' => 'Website Url',
            'establish_year' => 'Establish Year',
            'approved_by' => 'Approved By',
            'accredited_by' => 'Accredited By',
            'grade' => 'Grade',
            'about' => 'About',
            'brochureurl' => 'Brochureurl',
            'logourl' => 'Logourl',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'status' => 'Status',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
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
        return $this->hasMany(UniversityCourse::className(), ['universityID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUniversityTypes()
    {
        return $this->hasMany(UniversityType::className(), ['universityID' => 'id']);
    }
}
