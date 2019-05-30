<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\components\CustomUrlRule;
use yii\db\Query;
use common\models\Program;
use common\models\Role;
use common\models\ExamCategory;
use common\models\CampusFacilities;

 class MyHelpers extends Component{


    public static function formsubmitedbyajax($formid = null,$aftersuccessurl = null)
    {
      return '$("form#'.$formid.'").on("beforeSubmit", function(e) {
            $(".onsub").attr("disabled","disabled");
            $("#span").show();

            url = $(this).attr("action");
              $(this).find("input[type=\'file\']").each(function(){
                  if ($(this).get(0).files.length === 0) {
                    $(this).remove();
                  }
              });
                $.ajax({    
                type: "POST",  
                url: url,  
                data: new FormData(this),
                contentType: false,
                cache: false,
                async:true,
                processData:false,
                beforeSend:function(){
                    $("#load").button("loading");
                    $(".onsub").attr("disabled","disabled");
                    $("#span").show();
                 },
                success:function(data){
                 //$(location).attr("href", "'.$aftersuccessurl.'");
                },
              });

        }).on("submit", function(e){
          e.preventDefault();
        });';
    }


    public static function getCourseMode(){
        return [1 => 'Regular', 2=>'Distance Learning', 3 =>'Correspondence', 4=>'Online Mode', 5=>'Hybrid Mode', 6=>'MOOCs (massive open online courses)'];
    }

    public static function getHereunder(){
        return [1 => 'Admission Start Date', 2=>'Last Date to Apply', 3 =>'GD-PI Date', 4=>'Internal Entrance Exam Dates', 5=>'Merit List Date', 6=>'Admission Last Date'];
    }

    public static function getOwnership(){
        return [1 => 'Owned by Trust', 2=>'Private College', 3 =>'Public College', 4=>'Self-Financed Institute'];
    }

    public static function getShift(){
        return [1 => 'First Shift', 2=>'Second Shift', 3 =>'Third Shift'];
    }

    public static function getActiveInactive()
    {
        return [1 => 'Active', 0=>'Inactive'];
    }
    public static function getFacility()
    {
        return ArrayHelper::map(CampusFacilities::find()->where(['status'=>1])->all(),'id','name');
    }

    public static function getGender()
    {
        return ['M' => 'Male', 'F'=>'Female'];
    }

    public static function getFullPartTime()
    {
        return [1 => 'Full Time', 2=>'Part Time'];
    }

    public static function getSpecialisationType()
    {
        return [1 => 'Single Specialisation', 2=>'Dual Specialisation'];
    }



    public static function getCourseLevel()
    {
        return [1 => 'Under Graduate', 2=>'Post Graduate', 3 =>'Advanced Masters', 4=>'After 10th', 5=>'Doctorate', 6=>'Post Doctorate', 7=>'Post Masters'];
    }

    

    public static function getPriority()
    {
        return [1 => 'Very High', 2=>'High', 3=>'Moderate', 4=>'low', 5=>'Very Low'];
    }

    public static function getAdvertisePossitionArray()
    {

        return $data = [
        1 => "Main banner",
        2 => "Featured Colleges",
        6 => "Featured videos",
        3 => "Sponsored colleges",
        4 => "Bottom banner",
        5 => "Top banner",
        7 => "Left banner",
        8 => "Right banner",
        9 => "Middle banner",
        10 => "Featured colleges",
        11 => "Top Platinum",
        12 => "Middle Gold",
        13 => "Middle Silver",
        14 => "Middle bronze",
        15 => "Right floating",
        16 => "Bottom featured",
        17 => "Featured ads of colleges accepting the exam",
        18 => "Right banners",
        19 => "Bottom banner",
        20 => "Top Banner",
        21 => "Featured colleges offering the course",
        22 => "Right banners",
        23 => "Bottom banner",
        24 => "Top Banner",
        25 => "Right",
        26 => "Top",
];

    }

    public static function getAdvertisePossition()
    {

        return $data = [
    "Home page" => [
        1 => "Main banner",
        2 => "Featured Colleges",
        6 => "Featured videos",
        3 => "Sponsored colleges",
        4 => "Bottom banner",
    ],
    "Inner pages - college/University" => [
        5 => "Top banner",
        7 => "Left banner",
        8 => "Right banner",
        9 => "Middle banner",
        10 => "Featured colleges",
    ],
    "Landing pages - college/University" => [
        11 => "Top Platinum",
        12 => "Middle Gold",
        13 => "Middle Silver",
        14 => "Middle bronze",
        15 => "Right floating",
        16 => "Bottom featured",
    ],
    "Exam page" => [
        17 => "Featured ads of colleges accepting the exam",
        18 => "Right banners",
        19 => "Bottom banner",
        20 => "Top Banner",
    ],
    "Course page" => [
        21 => "Featured colleges offering the course",
        22 => "Right banners",
        23 => "Bottom banner",
        24 => "Top Banner",
    ],
    "General" => [
        25 => "Right",
        26 => "Top",
    ]
];

       // return [1 => 'Top', 2=>'Bottom', 3=>'Left', 4=>'Right', 5=>'Center', 6=>'Video'];
    }


    public static function getCourseType()
    {
        return [1 => 'Autonomous', 2=>'Affiliated'];
    }

    public static function getCourseDuration()
    {
        return [1 => '1 Day Workshop', 2=>'1 Week Workshop', 3=>'3 months', 4=>'6 month', 5=>'9 months',6=>'1 Year',7=>'1.5 Years', 8=>'2 Years',9=>'3 Years', 10=>'4 Years', 11=>'5 Years'];
    }

    public static function getMedium()
    {
        return [0 => 'Afrikaans',
    1 => 'Albanian',
    2 => 'Amharic',
    3 => 'Arabic (Egyptian Spoken)',
    4 => 'Arabic (Levantine)',
    5 => 'Arabic (Modern Standard)',
    6 => 'Arabic (Moroccan Spoken)',
    7 => 'Arabic (Overview)',
    8 => 'Aramaic',
    9 => 'Armenian',
    10 => 'Assamese',
    11 => 'Aymara',
    12 => 'Azerbaijani',
    13 => 'Balochi',
    14 => 'Bamanankan',
    15 => 'Bashkort (Bashkir)',
    16 => 'Basque',
    17 => 'Belarusan',
    18 => 'Bengali',
    19 => 'Bhojpuri',
    20 => 'Bislama',
    21 => 'Bosnian',
    22 => 'Brahui',
    23 => 'Bulgarian',
    24 => 'Burmese',
    25 => 'Cantonese',
    26 => 'Catalan',
    27 => 'Cebuano',
    28 => 'Chechen',
    29 => 'Cherokee',
    30 => 'Croatian',
    31 => 'Czech',
    32 => 'Dakota',
    33 => 'Danish',
    34 => 'Dari',
    35 => 'Dholuo',
    36 => 'Dutch',
    37 => 'English',
    38 => 'Esperanto',
    39 => 'Estonian',
    40 => 'Éwé',
    41 => 'Finnish',
    42 => 'French',
    43 => 'Georgian',
    44 => 'German',
    45 => 'Gikuyu',
    46 => 'Greek',
    47 => 'Guarani',
    48 => 'Gujarati',
    49 => 'Haitian Creole',
    50 => 'Hausa',
    51 => 'Hawaiian',
    52 => 'Hawaiian Creole',
    53 => 'Hebrew',
    54 => 'Hiligaynon',
    55 => 'Hindi',
    56 => 'Hungarian',
    57 => 'Icelandic',
    58 => 'Igbo',
    59 => 'Ilocano',
    60 => 'Indonesian (Bahasa Indonesia)',
    61 => 'Inuit/Inupiaq',
    62 => 'Irish Gaelic',
    63 => 'Italian',
    64 => 'Japanese',
    65 => 'Jarai',
    66 => 'Javanese',
    67 => 'Kiche',
    68 => 'Kabyle',
    69 => 'Kannada',
    70 => 'Kashmiri',
    71 => 'Kazakh',
    72 => 'Khmer',
    73 => 'KhoekhoeKorean',
    74 => 'Kurdish',
    75 => 'Kyrgyz',
    76 => 'Lao',
    77 => 'Latin',
    78 => 'Latvian',
    79 => 'Lingala',
    80 => 'Lithuanian',
    81 => 'Macedonian',
    82 => 'Maithili',
    83 => 'Malagasy',
    84 => 'Malay (Bahasa Melayu)',
    85 => 'Malayalam',
    86 => 'Mandarin (Chinese)',
    87 => 'Marathi',
    88 => 'Mende',
    89 => 'Mongolian',
    90 => 'Nahuatl',
    91 => 'Navajo',
    92 => 'Nepali',
    93 => 'Norwegian'];
    }

    public static function getCDType()
    {
        return [1 => 'Degree', 2=>'Diploma', 3=>'Hybrid',4=>'Online', 5=>'Aprentis', 6=>'Certification', 7=>'Vocational',8=>'Correspondence', 9=>'Distance Diploma', 10=>'Doctorate', 11=>'Dual Degree'];
    }

    public static function getNationalInternational()
    {
        return [1 => 'National', 2=>'International'];
    }

    public static function getNewsArtical()
    {
        return [1 => 'News', 2=>'Articals'];
    }
    public static function getUCE()
    {
        return [1 => 'University', 2=>'College', 3=>'Exam'];
    }

    public static function getAdvertisetype()
    {
        return [1 => 'University', 2=>'College', 3=>'Other'];
    }

    public static function getUniversitytype()
    {
        return [1 => 'Private University', 2=>'Public University', 3=>'State University',4=>'Central University',5=>'Deemed University', 6=>'Deemed to be University', 7=>'Autonomous Institute', 8=>'Open Universities'];
    }

    public static function getCollegetype()
    {
        return [1 => 'Autonomous', 2=>'Affiliated'];
    }

    

    public function getProgram(){
        $result = '';
        $model = Program::find()
        ->where(['status'=>1])
        ->all();
        if(!empty($model)){
            $result = ArrayHelper::map($model, 'id', 'name');
        }

        return $result;
    }

    public function getExamCategory(){
        $result = '';
        $model = ExamCategory::find()
        ->all();
        if(!empty($model)){
            $result = ArrayHelper::map($model, 'id', 'name');
        }

        return $result;
    }


    public function getCreatenew($allowbyrole,$url = null, $label='Create New')
    {
      $roleid = Yii::$app->user->identity->roleID;
      if(in_array($roleid, $allowbyrole)){
        if($url){
          return Html::a($label, [$url], ['class' => 'btn btn-success btn-xs']);
        }else{
          return Html::a($label, ['create'], ['class' => 'btn btn-success btn-xs']);
        } 
      }
    }

    public function getRole()
    {
      return  ArrayHelper::map(Role::find()->where(['not in','id', [1]])->all(), 'id', 'name');
    }

    public static function getEncryptID($id)
    {
        return @CustomUrlRule::encryptor("encrypt",$id);
    }

    public static function getDecryptID($id)
    {
        return @CustomUrlRule::encryptor("decrypt",$id);
    }


    //ucType = university or college
    public function getUploadPath($ucType,$ucID,$fileType = ""){
        if($ucType == 1){
            $ucType = "university";
        }else{
            $ucType = "college";
        }

        $ucID = $this->getEncryptID($ucID);
        $uploadPath=Yii::getAlias('@webroot') .'/uploads/'.$ucType.'/'.$ucID.'/';

        if($fileType == 1){
            $uploadPath .= "images/";
        }elseif($fileType == 2){
            $uploadPath .= "videos/";
        }
        
        return $uploadPath;
    }

    public function getFileBasePath($ucType="",$ucID="",$fileType=""){
        if($ucType == 1){
            $ucType = "/university";
        }else if($ucType == 2){
            $ucType = "/college";
        }
        
        if($ucID !=""){
            $ucID = "/".$this->getEncryptID($ucID);
        }

        if($fileType == 1){
            $fileType = "/images";
        }elseif($fileType == 2){
            $fileType = "/videos";
        }
        
        return Url::home(true).'uploads'.$ucType.$ucID.$fileType."/";
    }

    public function videoThumb($source,$destination){
        $direcotry = Yii::getAlias('@ffmpegPath');
        chdir($direcotry);
        $command = "ffmpeg -y -i ".$source." -vframes 1   ".$destination." 2>&1";
        exec( $command, $output, $return_var );
    }

    public function getCourseCode($code){
        return "C".str_pad($code, 4, '0', STR_PAD_LEFT);
    }
    public function getUniversityCode($code){
        return "U".str_pad($code, 4, '0', STR_PAD_LEFT);
    }
    public function getCollegeCode($code){
        return "C".str_pad($code, 4, '0', STR_PAD_LEFT);
    }
}
