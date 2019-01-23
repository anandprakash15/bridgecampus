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


    public static function getActiveInactive()
    {
        return [1 => 'Active', 0=>'Inactive'];
    }

    public static function getGender()
    {
        return ['M' => 'Male', 'F'=>'Female'];
    }

    public static function getFullPartTime()
    {
        return [1 => 'Full Time', 2=>'Part Time'];
    }

    public static function getCourseType()
    {
        return [1 => 'University', 2=>'autonomas'];
    }

    public static function getCDType()
    {
        return [1 => 'Certificate', 2=>'Degree'];
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
        return CustomUrlRule::encryptor("encrypt",$id);
    }

    public static function getDecryptID($id)
    {
        return CustomUrlRule::encryptor("decrypt",$id);
    }


    //ucType = university or college
    public function getUploadPath($ucType,$ucID,$fileType = ""){
        if($ucType == 1){
            $ucType = "university";
        }else{
            $ucType = "college";
        }

        $ucID = $this->getEncryptID($ucID);
        $uploadPath=Yii::getAlias('@backend') .'/uploads/'.$ucType.'/'.$ucID.'/';

        if($fileType == 1){
            $uploadPath .= "images/";
        }elseif($fileType == 2){
            $uploadPath .= "videos/";
        }
        
        return $uploadPath;
    }

    public function getFileBasePath($ucType,$ucID,$fileType=""){
        if($ucType == 1){
            $ucType = "university";
        }else{
            $ucType = "college";
        }
        $ucID = $this->getEncryptID($ucID);
        $fileViewPath =  '../../uploads/'.$ucType.'/'.$ucID.'/';
        if($fileType == 1){
            $fileViewPath .= "images/";
        }elseif($fileType == 2){
            $fileViewPath .= "videos";
        }
        
        return $fileViewPath;
    }
}
