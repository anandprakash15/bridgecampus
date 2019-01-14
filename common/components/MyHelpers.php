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


 class MyHelpers extends Component{


    public $update_msg = '';
    public $create_msg = '';
    public $error_msg = '';
    public $siteTitle = '';
    public $convertURL = '';
    
    public $mailserverurl = "";
    public $bulkSmsEmailURL = "";

    public $masterbucket = '';
    public $bucketname = '';
    public $masterbucketview = '';
    public $examType = array();
    public $democompanyid = '';
    public $logo = "";
    public $colors = array();
    //public $liccompanyid = '';
    //public $liccompanysubcompanyid = '';

    public $smsusername = '';
    public $smshash = '';
    public $smssendsms_url = "";
    public $smssender = '';
    public $videoinbucket = '';
    public $casestudycompanyid = '';
    public $bouncedmaillimit = 5;
    public $cronjoburl = '';
    public $ConfigurationSetName = '';

    public function init()
    {

      if(Yii::$app->awsconfig == 'test'){
        $this->cronjoburl = 'http://mailer.welonline.com/alphalearnbulkmail/bulkmailcom.php';
        $this->ConfigurationSetName = 'mail_set_alphalearn_local';
        $this->casestudycompanyid = 9;
        $this->update_msg = 'Updated successfully';
        $this->create_msg = 'Created successfully';
        $this->error_msg = 'Error while saving data';
        $this->siteTitle = 'Alphalearn';
        if(isset(Yii::$app->user->identity->awsconfig->id) && !empty(Yii::$app->user->identity->awsconfig->id)){
              $this->convertURL = Yii::$app->user->identity->awsconfig->convertURL;
              $this->videoinbucket = Yii::$app->user->identity->awsconfig->videoinbucket;
              $this->mailserverurl = Yii::$app->user->identity->awsconfig->mailserverurl;
              $this->bulkSmsEmailURL = Yii::$app->user->identity->awsconfig->bulkSmsEmailURL;
              $this->masterbucket = Yii::$app->user->identity->awsconfig->masterbucket;
              $this->bucketname = Yii::$app->user->identity->awsconfig->bucketname;
              $this->masterbucketview = Yii::$app->user->identity->awsconfig->masterbucketview;
              $this->smsusername = Yii::$app->user->identity->awsconfig->smsusername;
              $this->smshash = Yii::$app->user->identity->awsconfig->smshash;
              $this->smssendsms_url = Yii::$app->user->identity->awsconfig->smssendsms_url;
              $this->smssender = Yii::$app->user->identity->awsconfig->smssender;
        }else{
              
              $this->convertURL = 'http://convert.alphalearn.com/testconvert.php';
              $this->videoinbucket = "testvideoin.alphalearn.com";
              $this->mailserverurl = "http://mailer.welonline.com/alphalearn_mail.php";
              $this->bulkSmsEmailURL = "http://mailer.welonline.com/alphalearnbulk_mail.php";
              $this->masterbucket = 'https://s3.ap-south-1.amazonaws.com/test.alphalearn.com';
              $this->bucketname = 'test.alphalearn.com';
              $this->masterbucketview = 'https://testcloud.alphalearn.com';
              $this->smsusername = 'manish@horizzon.com';
              $this->smshash = 'a7ce7be95586ad05ca2fc83121d0cfc6090280bc';
              $this->smssendsms_url = "http://mailer.welonline.com/wecare_sms.php";
              if(isset(Yii::$app->user->identity->companyID) && !empty(Yii::$app->user->identity->companyID) && Yii::$app->user->identity->companyID!=9){
                $this->smssender = 'AlphaL';
              }else{
                $this->smssender = 'CARETR';
              }
        }
        

        $this->examType = ['0'=>'Sequential Question Sets','1'=>'Random Question Sets','2'=>'Random Questions'];
        $this->democompanyid = '6';
        $this->logo = "https://s3.ap-south-1.amazonaws.com/test.alphalearn.com/defaultlogo.png";
        $this->colors = ['#7cb5ec','#f15c80','#90ed7d','#C6F9D2','#CECEFF', '#FFCAFF', '#D0CCCD', '#FFCC99', '#FFCBB9','#EAEC93','#D7FBE6', '#FFCACA', '#00FF00','#CCCCB3'];
        //$this->liccompanyid = 7;
        //$this->liccompanysubcompanyid = 4;
        
        
      }else if(Yii::$app->awsconfig == 'production'){
        $this->cronjoburl = 'http://mailer.welonline.com/alphalearnbulkmail/bulkmailcom.php';
        $this->ConfigurationSetName = 'mail_set_alphalearn';
        
        $this->casestudycompanyid = 9;
        $this->update_msg = 'Updated successfully';
        $this->create_msg = 'Created successfully';
        $this->error_msg = 'Error while saving data';
        $this->siteTitle = 'Alphalearn';
        $this->videoinbucket = "videoin.alphalearn.com";
        $this->convertURL = 'http://convert.alphalearn.com/convert.php';
        
        $this->mailserverurl = "http://mailer.welonline.com/alphalearn_mail.php";
        $this->bulkSmsEmailURL = "http://mailer.welonline.com/alphalearnbulk_mail.php";

        $this->masterbucket = 'https://s3.ap-south-1.amazonaws.com/content.alphalearn.com';
        $this->bucketname = 'content.alphalearn.com';
        $this->masterbucketview = 'https://cloud.alphalearn.com';
        $this->examType = ['0'=>'Sequential Question Sets','1'=>'Random Question Sets','2'=>'Random Questions'];
        $this->democompanyid = '6';
        $this->logo = "https://s3.ap-south-1.amazonaws.com/content.alphalearn.com/defaultlogo.png";
        $this->colors = ['#7cb5ec','#f15c80','#90ed7d','#C6F9D2','#CECEFF', '#FFCAFF', '#D0CCCD', '#FFCC99', '#FFCBB9','#EAEC93','#D7FBE6', '#FFCACA', '#00FF00','#CCCCB3'];
        //$this->liccompanyid = 7;
        //$this->liccompanysubcompanyid = 4;
        $this->smsusername = 'manish@horizzon.com';
        $this->smshash = 'a7ce7be95586ad05ca2fc83121d0cfc6090280bc';
        $this->smssendsms_url = "http://mailer.welonline.com/wecare_sms.php";
        if(isset(Yii::$app->user->identity->companyID) && !empty(Yii::$app->user->identity->companyID) && Yii::$app->user->identity->companyID!=9){
          $this->smssender = 'AlphaL';
        }else{
          $this->smssender = 'CARETR';
        }
      }else{
        echo "AWS Config Not Correct";
      }
        
        parent::init();
    }

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

    public static function allowtptotrainee()
    {
      return [0 => 'sachin.kamble@horizzon.com', 1 => 'kishore.gandhi@care-cart.com'];
    }

    public static function getStatus()
    {
        return [0 => 'Enable', 1 => 'Disabled', 2=> 'Deleted',3=>'Reset Password'];
    }

    public static function getPaymentmode()
    {
        return [0 => 'NEFT/RTGS', 1 => 'Cheque/Draft'];
    }

    public static function getUserStatus()
    {
      return [0 => 'Registered', 1=> 'Disabled', 4 => 'Enrolled','5'=>'Empanelled'];
    }

    public static function getSurveyrating()
    {
      return [1 => '1 to 5', 2=> '1 to 10'];
    }

    public static function getMailtrackingstatus()
    {
      return [1 => 'Delivered', 2=> 'Bounced', 3=> 'Complaint'];
    }
    
    public static function getMandatoryoption()
    {
      return [1 => '1', 2=> '2', 3 => '3', 4=>'4', 0=>'All'];
    }

    public static function mailstatus()
    {
      return [1 => 'Sent', 2 => 'Delivered', 3=> 'Bounced', 4=>'Complaint', 5=>'Opened', 6=>'Rejects', 7=>'Clicked', 8=>'Errors'];
    }
    
    public function getSmslimit()
    {
       return $license = License::find()->where(['companyID'=>$this->findCompanyID()])->orderby('id desc')->one();
    }

    public static function getACM()
    {
      return [0 => 'Anyorder', 1 => 'Sequence'];
    }

    public static function getCertificateissue()
    {
      return [1 => 'When Course Duration Ends', 2 => 'When Course Progress is 100%', 3 => 'Based on Assignment & Exam Passing Percentage'];
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
    
    /*public function reciptno($id,$companyID)
    {

      $maxuniqueID  = Yii::$app->db->createCommand("select max(receipt)as ID from transaction left join user on user.id = transaction.userID where transaction.status = 'authorized' and user.companyID = $companyID order by transaction.id")->queryOne();

      if(!empty(array_filter($maxuniqueID))){
        $uniqueID  = $maxuniqueID['ID']  += 1;
      }else{
        $uniqueID = 1;
      }
      $update = Yii::$app->db->createCommand("UPDATE transaction SET receipt='$uniqueID' WHERE id=$id")->execute();
    }*/

    public function AssignUniqueID($userID,$companyID)
    {
      $companyconfig = Config::find()->where(['companyID'=>$companyID])->one();

      $prefix = '';
      $sf = 0;
      if(!empty($companyconfig)){
        if($companyconfig->enableuniqueid == 0){
          $unique = $companyconfig->startingfrom;
          $recount = strlen($unique);
          $maxuniqueID  = Yii::$app->db->createCommand("select max(rollno)as ID from user where companyID = $companyID and id!=$userID order By id desc")->queryOne();
          if(!empty(array_filter($maxuniqueID))){
            $uniqueID  = $maxuniqueID['ID']  += 1;
          }else{
            $uniqueID = $companyconfig->startingfrom;
          }
          $update = Yii::$app->db->createCommand("UPDATE user SET rollno='$uniqueID' WHERE id=$userID")->execute();
        }
      }
    }

    public function transationrecipno($id)
    {
       $maxuniqueID  = Yii::$app->db->createCommand("select max(receipt)as ID from transaction where status = 'authorized' order By id desc")->queryOne();
          if(!empty(array_filter($maxuniqueID))){
            $uniqueID  = $maxuniqueID['ID']  += 1;
          }else{
            $uniqueID = 1;
          }
          $update = Yii::$app->db->createCommand("UPDATE transaction SET receipt='$uniqueID' WHERE id=$id")->execute();
    }


    

    public static function getProgresseffect($effect = 0,$viewas = 'Consider In Progress?')
    {
      return '<input type="hidden" id="coursedocuments-effectonprogress" class="form-control" name="CourseDocuments[effectonprogress]" value="'.$effect.'">
          <div class="form-group">
            <label class="control-label col-sm-2" >'.$viewas.'</label>
            <div class="col-sm-8">
             <div class="btn-group btn-toggle-progress"> 
                        <label class="btn btn-sm btn-default yesprogress">YES</label>
                        <label class="btn btn-sm btn-success noprogress">NO</label>
                      </div>
            <div class="help-block help-block-error "></div>
            </div>
          </div>';
    }

    public static function getAllowfastforword($effect = 0,$viewas = 'Allow Fast Forword')
    {
      return '<input type="hidden" id="coursedocuments-allowfastforword" class="form-control" name="CourseDocuments[allowfastforword]" value="'.$effect.'">
          <div class="form-group">
            <label class="control-label col-sm-2" >'.$viewas.'</label>
            <div class="col-sm-8">
             <div class="btn-group btn-toggle-allowfastforword"> 
                        <label class="btn btn-sm btn-default yesallowfastforword">YES</label>
                        <label class="btn btn-sm btn-success noallowfastforword">NO</label>
                      </div>
            <div class="help-block help-block-error "></div>
            </div>
          </div>';
    }

    public static function getAllowfastforwordjs()
    {
      return '$("document").ready(function(){
                if($("#coursedocuments-allowfastforword").val() == 1){
                  $(".btn-toggle-allowfastforword").find(".btn").toggleClass("btn-success btn-default");
                  $(".noallowfastforword").removeClass("active");
                  $(".yesallowfastforword").addClass("active");
                }else{
                  $(".yesallowfastforword").removeClass("active");
                  $(".noallowfastforword").addClass("active");
                }

                 $(".btn-toggle-allowfastforword").click(function() {
                   $(this).find(".btn").toggleClass("active");  
                    
                    if ($(this).find(".btn-success").size()>0) {
                      $(this).find(".btn").toggleClass("btn-success btn-default");
                    }
                    if ($(this).find(".btn-default").size()>0) {
                      var tex = $(this).find(".active").text();
                      if(tex == "YES"){
                        $("#coursedocuments-allowfastforword").val(1);
                      }else{
                        $("#coursedocuments-allowfastforword").val(0);
                      }
                    }
                });
              })';
    }

    public static function getEffectonprogressjs()
    {
      return '$("document").ready(function(){
               if($("#coursedocuments-effectonprogress").val() == 1){
                  $(".btn-toggle-progress").find(".btn").toggleClass("btn-success btn-default");
                  $(".noprogress").removeClass("active");
                  $(".yesprogress").addClass("active");
                }else{
                  $(".yesprogress").removeClass("active");
                  $(".noprogress").addClass("active");
                }
                 $(".btn-toggle-progress").click(function() {
                   $(this).find(".btn").toggleClass("active");  
                    
                    if ($(this).find(".btn-success").size()>0) {
                      $(this).find(".btn").toggleClass("btn-success btn-default");
                    }
                    if ($(this).find(".btn-default").size()>0) {
                      var tex = $(this).find(".active").text();
                      if(tex == "YES"){
                        $("#coursedocuments-effectonprogress").val(1);
                      }else{
                        $("#coursedocuments-effectonprogress").val(0);
                      }
                    }
                });
              })';
    }
    /*Used to include form ajax submition in course document view*/
    public static function getFormsubmitjs($checkCourseAutomated = null)
    {
      return '$("document").ready(function(){

          if($("#coursedocuments-secure").val() == 1){
            $(".btn-toggle").find(".btn").toggleClass("btn-success btn-default");
            $(".no").removeClass("active");
            $(".yes").addClass("active");
          }else{
            $(".yes").removeClass("active");
            $(".no").addClass("active");
          }

    var checkCourseAutomated = "'.$checkCourseAutomated.'";
        $(".btn-toggle").click(function() {
           $(this).find(".btn").toggleClass("active");  
            
            if ($(this).find(".btn-success").size()>0) {
              $(this).find(".btn").toggleClass("btn-success btn-default");
            }
            if ($(this).find(".btn-default").size()>0) {
              var tex = $(this).find(".active").text();
              if(tex == "YES"){
                $("#viewasslide").show();
                $("#coursedocuments-secure").val(1);
                if(checkCourseAutomated){
                  $(".timespenddiv").show();
                   $("#checkCourseAutomated").val(1);
                   $("#timespendfield").val(1);
                }
              }else{
                $("#viewasslide").hide();
                $("#coursedocuments-secure").val(0);
                if(checkCourseAutomated){
                  $(".timespenddiv").hide();
                  $("#checkCourseAutomated").val("");
                  $("#timespendfield").val("");
                }
              }
            }
        });


    /*Check unchecked secure*/
          
          if(checkCourseAutomated){
           $("#coursedocuments-secure").change(function() {
             if($(this).val() == 1){
               $(".timespenddiv").show();
               $("#checkCourseAutomated").val(1);
               $("#timespendfield").val(1);
             }
             else
             {
              $(".timespenddiv").hide();
              $("#checkCourseAutomated").val("");
              $("#timespendfield").val("");
            }    
          });
        }

    var url;
    var fsize = "";
    var timeout = 1000;
    var courseDocID = $("body").find("li.cousedocumentclick.active").attr("data-chapter");
          
          $("#upload_form").on("beforeSubmit", function(e) {
            url = $(this).attr("action");
            $.ajax({    
            type: "POST",  
            url: url,  
            data: new FormData(this),
            contentType: false,
            cache: false,
            async:true,
            processData:false,
            beforeSend:function(xhr, settings){
              $(".buttondisable").attr("disabled","disabled");
              if($("#coursedocuments-url").val()!=""){
                var slideExist = $("#slideExist").val();
                if(slideExist!= "undefined" && slideExist == 1){
                  slideconfirmation(courseDocID);
                }
                $(".pr").show();
              }
             },
             xhr: function() {
              var xhr = new window.XMLHttpRequest();
              xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                  var percentComplete = parseInt(evt.loaded * 100/ evt.total);
                  progressBar(percentComplete);
                //Do something with upload progress here
                }
              }, false);

             return xhr;
           },

            success:function(data){
              if(data){
                if(data == "xmlerror"){
                  xmlerror();
                  return false;
                }
                if(data == "videoupdate"){
                  setTimeout(function(){
                    success();
                  }, 5000);
                }else{
                  success();
                }
              }else{
                error(data);
              } 
            },
            error: function(data) {
              console.log("error"+data);
              error(data);  
            }
          });
        }).on("submit", function(e){
            e.preventDefault();
        });

        function slideconfirmation(courseDocID){
          if(confirm("You had added Notes to your previous PPT Slides. Would you like to keep these Notes or delete them?")){
            $.ajax({
               url: "../slide-content/deleteslide",
               type: "POST",
               data: {courseDocID: courseDocID},
               success: function(data) {
                return true;
               },
               error: function(e) {
                 console.log(e.message);
               }
             });
            
          }
          return true;
        }


        function success(){
           location.reload();
          /*if (typeof courseDocID == "undefined") {
           location.reload();
          }else{
            $("body").find("#doc-"+courseDocID).trigger("click");
          }*/
        }

        function error(data=""){
         $(".progress-bar").removeClass("progress-bar-success").addClass("progress-bar-danger");
         $(".progress-bar span").text("oops! error occurred, refresh and try again...");
         console.log("Something went wrong : "+data);
        }

        function xmlerror(msg){
         $(".progress-bar").removeClass("progress-bar-success").addClass("progress-bar-danger");
         $(".progress-bar span").text("Not Valid Tincan Content.");
        }

        })';
    }


    public static function getslidemodel()
    {
      return '<div class="modal fade" id="sliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" id="serverresponse">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title slidertitle"></h4>
            </div>
            <div class="modal-body sliderbody">

          </div>
        </div>
        </div>
      </div>';
    }


    public static function getStarrating()
    {
      return '<div id="ratingmodal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Course Rating: <span class="crd"></span></h4>
          </div>
          <div class="modal-body">
            <center><label class="control-label ratingmodaltitle" style="font-size: 16px;"></label>'.
                StarRating::widget([
                  'name' => 'ratingstart',
                  'id' => 'ratingstart',
                  'value' => 1,
                  'pluginOptions' => [
                    'min' => 1,
                    'max' => 5,
                    'step' => 1,
                    'size' => 'sm',
                    'starCaptions' => [
                        1 => 'Very Poor',
                        2 => 'Poor',
                        3 => 'Ok',
                        4 => 'Good',
                        5 => 'Very Good',  
                    ],
                    'starCaptionClasses' => [
                        1 => 'text-danger',
                        2 => 'text-warning',
                        3 => 'text-info',
                        4 => 'text-primary',
                        5 => 'text-success',
                    ],
                ],
              ]).'</center>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-sm submitrating">Submit</button>
              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Skip</button>
            </div>
          </div>

        </div>
      </div>';
    }


   public static function getajaxformsubmitslide()
    {
      return '$("document").ready(function(){
  
          $("#ajaxformsubmit").on("beforeSubmit", function(e) {
            url = $(this).attr("action");
            $.ajax({    
            type: "POST",  
            url: url,  
            data: new FormData(this),
            contentType: false,
            cache: false,
            async:true,
            processData:false,

            success:function(data){
              if(data){
                success();
              }else{
                console.log(data);
              } 
            },
            error: function(data) {
 
              console.log("error"+data);
              error(data);  
            }
          });
        }).on("submit", function(e){
            e.preventDefault();
        });

        function success(){
          $("#sliderModal").modal("hide"); 
           //location.reload();
        }
        })';
    }

    

    public static function getSwitchandprogresshtml($secure = 0,$viewas = 'viewas',$edit = false)
    {
      $pointer = null;
        if($edit){
          if($viewas!='viewas'){
            $pointer = 'style="pointer-events: none;"';
          }else{
            $pointer = 'style="pointer-events: none; display:none;"';
          }  
        }
      if(!$edit){
        if($viewas=='viewas'){
          $pointer = 'style="pointer-events: none; display:none;"';
        }
      }
      return '<div class="form-group pr" style="display: none;">
                <label class="control-label col-sm-2" ></label>
                <div class="col-sm-8">
                 <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <span>0%</span>
                  </div>
                </div>
              </div>
            </div>

            <input type="hidden" id="coursedocuments-secure" class="form-control" name="CourseDocuments[secure]" value="'.$secure.'">

          <div class="form-group" '.$pointer.'>
            <label class="control-label col-sm-2" >'.$viewas.'</label>
            <div class="col-sm-8">
             <div class="btn-group btn-toggle"> 
                        <label class="btn btn-sm btn-default yes">YES</label>
                        <label class="btn btn-sm btn-success no">NO</label>
                      </div>
            <div class="help-block help-block-error "></div>
            </div>
          </div>';
    }

    public static function getDoctypeicon($name,$color)
    {
        switch ($name) {
            case 'HTML':
                return "<i class='fa fa-file-text-o' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
            case 'PDF':
                return "<i class='fa fa-file-pdf-o' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
            case 'Video':
                return "<i class='fa fa-play' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
             case 'Doc':
                return "<i class='fa fa-file-word-o' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
             case 'PPT':
                return "<i class='fa fa-file-powerpoint-o' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
            case 'Excel':
                return "<i class='fa fa-file-excel-o' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
            case 'Image':
                return "<i class='fa fa-file-image-o' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
            case 'Assessment':
                return "<i class='fa fa-question-circle' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
            case 'Poll':
                return "<i class='fa fa-pie-chart' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
            case 'Link':
                return "<i class='fa fa-link' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
            case 'Slides':
                return "<i class='fa fa-file-pdf-o' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
            case 'Practice Test':
                return "<i class='fa fa-question-circle-o' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
            case 'SCORM':
                return "<i class='fa fa-file-archive-o' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
            case 'Assignment':
                return "<i class='fa fa-list-alt' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
            case 'Survey':
                return "<i class='fa fa-bar-chart' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           padding-top: 3px;
                        '></i>";
                break;
            default:
                return "<i class='folderinout fa fa-folder-o' data-toggle='tooltip1' title='$name' style='
                           font-size: 18px;
                           color: $color;
                           float:left;
                           padding-top: 3px;
                        '></i>";
                break;
        }
    }


    public static function getQueryStatus()
    {
        return [0 => 'Pending', 1=>'Replied'];
    }

    public static function getEnrollmentstatus()
    {
        return [0 => 'Enrolled', 1=>'Unenrolled',2=>'Completed'];
    }

    public static function insertRow($row){

        $result = false;
        $data = '\\'.$row->className();

        $model = new $data($row->getAttributes());
        $model->id = null;

        if($model->save()){
            $result = $model->id;
        }else{
          print_r($model);
          exit;
        }

        return $result;
    }

    public function getOnlylogo($companyID)
    {
        $srclogo = "defaultlogo.png";
        $tarlogo = $this->createAwslogo($companyID).$srclogo;
        \Yii::$app->amazonservices->copyFilePublic($srclogo,$tarlogo);
    }


/******
**This function will generate**** 
**all Demo course regarding given companyID****
******/
    public function getDemocourses($companyID,$userID)
    {
        $democompanyid = $this->democompanyid; 

        $demoData = Courses::find()->joinWith(['dcourseChapters'])->where(['courses.companyID'=>$democompanyid])->all();
        //print_r($demoData);
/*       echo $encID = $this->getEncryptID($companyID);
        exit;*/
        /*$course = $courseChapter = $courseDoc = $que = $poll = [];*/
        /*Document which are uploaded on AWS*/
        $docsLinkedWithAws = [2,5,6,7,8,14];

        $srclogo = "defaultlogo.png";
        $tarlogo = $this->createAwslogo($companyID).$srclogo;
        \Yii::$app->amazonservices->copyFilePublic($srclogo,$tarlogo);

        if(!empty($demoData)){
          foreach ($demoData as $row) {
            $row->companyID = $companyID;
            /*No Trainer will assign by deafult*/
            $row->assignTrainer = 0;
            $row->certificateissue = NULL;
            $demoCourseID = $row->id;
            //AWS folder for Source File
            $srcAWSFolder = $this->createAwsFolder($democompanyid,$demoCourseID);
            $courseID = $this->insertRow($row);
            $assignTrainer_c = Yii::$app->db->createCommand("UPDATE courses SET assignTrainer=$userID WHERE id=$courseID")->execute();

            //$course[] = $courseID;

            if($courseID && !empty($row->dcourseChapters)){

            /******Insert into user Enrollment Table******/

            $userEnrollment = new UserEnrollment();
            $userEnrollment->userID = $userID;
            $userEnrollment->courseID = $courseID;
            $userEnrollment->completedPercent = 0;
            $userEnrollment->createdDate = date('Y-m-d');
            $userEnrollment->endDate = date('Y-m-d',strtotime($userEnrollment->createdDate. " + 1 year"));
            $userEnrollment->issuedcertificate = 1;/*no*/
            $userEnrollment->issuedDate = '0000-00-00 00:00:00';
            $userEnrollment->unenrolledDate = '0000-00-00 00:00:00';
            $userEnrollment->save();

            
            /******Insert into user Enrollment Table******/


            //AWS Target folder for Source File
             $targetAWSFolder = $this->createAwsFolder($companyID,$courseID);

                foreach ($row->dcourseChapters as $value) {
                    $value->courseID = $courseID;

                    $chapterID = $this->insertRow($value);

                    //$courseChapter[] = $chapterID;

                    if($chapterID && !empty($value->dcourseDocuments)){

                      foreach ($value->dcourseDocuments as $value) {

                        $value->chapterID = $chapterID;
                        $courseDocumentID = $this->insertRow($value);
                        //$courseDoc[] = $courseDocumentID;

                        if($courseDocumentID){

                            if(in_array($value->documentTypeID,$docsLinkedWithAws)){

                            /*If secure*/
                            if($value->secure == 1 && $value->documentTypeID != 3){
                            /**** Get old File Path ****/
                            $srcFile = $srcAWSFolder.$this->getEncryptID($value->id).$value->version;

                             /*** Make copy on aws server ***/
                             $encID = $this->getEncryptID($courseDocumentID);
                             /*$newFile with folder and content path*/
                             $newFile = $targetAWSFolder.$encID.$value->version.'/'.$encID.$value->version;

                             \Yii::$app->amazonservices->copyFolder($srcFile,$newFile);
                            }

                            /*If not secure OR video type*/
                            if($value->secure == 0  || ($value->documentTypeID == 3 && $value->secure == 1)){
                                 
                             /**** Get old File Path ****/
                             $srcFile = $srcAWSFolder.$this->getEncryptID($value->id).$value->version.$value->url;

                               /*** Make copy on aws server ***/
                            $newFile = $targetAWSFolder.$this->getEncryptID($courseDocumentID).$value->version.$value->url;

                            \Yii::$app->amazonservices->copyFile($srcFile,$newFile);
                            }
                          }

                       /*For Question and Question Answers*/
                       if(!empty($value->question)){ 

                        foreach ($value->question as $value) {
                            $value->courseDocID = $courseDocumentID;

                            $qid = $this->insertRow($value);
                            //$que[] = $qid;

                            if($qid  && !empty($value->answerOptions)){
                               foreach ($value->answerOptions as $value){
                                   $value->questionID = $qid;
                                   $this->insertRow($value);
                              }
                           }
                        }
                      }

                      /*For Survey and Survey Option*/
                       if(!empty($value->survey)){ 

                        foreach ($value->survey as $value) {
                            $value->courseDocID = $courseDocumentID;
                            $qid = $this->insertRow($value);
                            //$que[] = $qid;

                            if($qid  && !empty($value->answerOptions)){
                               foreach ($value->answerOptions as $value){
                                   $value->questionID = $qid;
                                   $this->insertRow($value);
                              }
                           }
                        }
                      }

                       /*For Poll and Poll Answers*/
                       if(!empty($value->poll)){

                        foreach ($value->poll as $value) {
                            $value->courseDocID = $courseDocumentID;

                            $pollID = $this->insertRow($value);
                            //$poll[] = $pollID;

                            if($pollID  && !empty($value->pollAnswers)){
                               foreach ($value->pollAnswers as $value){
                                   $value->pollID = $pollID;
                                   $this->insertRow($value);
                              }
                           }
                        }
                     }


                }/*End of courseDocumentID*/

               }/*end of foreach for dcourseDocuments*/
             }/*end of if for dcourseDocuments*/

            }/*end of foreach for dcourseChapters*/
          }/*end of if for dcourseChapters*/

        }/*end of foreach for demoData*/
       }/*end of if for demoData*/

       /*Query Result which get executed*/
         /*  echo "<br>course : ".print_r($course);
           echo "<br>courseChapter : ".print_r($courseChapter);
           echo "<br>courseDoc : ".print_r($courseDoc);
           echo "<br>que : ".print_r($que);
           echo "<br>poll : ".print_r($poll);*/
    }
    





    public function getCopycourse($postdata)
    {
     
      
      $courseid = '';
      $iscopycontent = '';
      $examcopy = '';
      if(isset($postdata['cid'])){
        $courseid = $postdata['cid'];
      }
      if(isset($postdata['cpc'])){
        $iscopycontent = $postdata['cpc'];
      }

      if(isset($postdata['ecp'])){
        $examcopy = $postdata['ecp'];
      }

        
        $coursetitle = $postdata['ctitle'];
        //$examtitle = $postdata['etitle'];
       // $examcopy = $postdata['ecp'];

        $demoData = Courses::find()->joinWith(['dcourseChapters'])->where(['courses.id'=>$courseid])->all();

        $exam = Exam::find()->joinWith(['examInstructions','examQuestions1','examSets'])->where(['exam.courseID'=>$courseid,'exam.sequenceRandom'=>2])->all();
        /*print_r($exam);
        exit;*/
        $democompanyid =  $companyID =  Yii::$app->user->identity->companyID;

        /*$course = $courseChapter = $courseDoc = $que = $poll = [];*/
        /*Document which are uploaded on AWS*/
        $docsLinkedWithAws = [2,3,5,6,7,8,14];
        $user = '';
        if(isset($postdata['scompany']) && !empty($postdata['scompany'])){
          $user = User::find()->where(['companyID'=>$postdata['scompany'],'roleID'=>2])->andWhere(['<>','status',2])->one();
          if(!empty($user)){
            $companyID =  $user->companyID;
          }
        }

        

        /*$srclogo = "defaultlogo.png";
        $tarlogo = $this->createAwslogo($companyID).$srclogo;
        \Yii::$app->amazonservices->copyFilePublic($srclogo,$tarlogo);*/

        if(!empty($demoData)){
          foreach ($demoData as $row) {
            $cc = rand(10000,99999);
            $row->companyID = $companyID;
            if(!empty($coursetitle)){
              $row->title = $coursetitle;
            }else{
              $row->title = 'Copy of '.$row->title;
            }
            
            /*No Trainer will assign by deafult*/
            if(!empty($user)){
              $row->assignTrainer = $user->id;
            }else{
              $row->assignTrainer = $row->assignTrainer;
            }
            if($row->certificateissue == 0){
              $row->certificateissue = null;
            }

            if($row->is_locked == 0){
              $row->configID == Yii::$app->user->identity->config->id;
            }else{
              $config = Config::find()->where(['companyID'=>$companyID])->one();
              $row->configID = $config->id;
            }
            
            $row->courseCode = "$cc";

            if(Yii::$app->session->get('user.idbeforeswitch')){
              $row->departmentID = '0';
              $row->designationID = '0';
            }

            $demoCourseID = $row->id;
            //$row->certificate = $row->certificate;
            //AWS folder for Source File
            $courseID = $this->insertRow($row);
            $srcAWSFolder = $this->createAwsFolder($democompanyid,$demoCourseID);
            $targetAWSFolder = $this->createAwsFolder($companyID,$courseID);

            if(!empty($row->certificate)){
              $srcFilecer = $srcAWSFolder.$row->certificate;
               $newFilecer = $targetAWSFolder.$row->certificate;
              \Yii::$app->amazonservices->copyFilePublic($srcFilecer,$newFilecer);
            }

            if(!empty($row->thumbnail)){
              $srcFilecer = $srcAWSFolder.$row->thumbnail;
              $newFilecer = $targetAWSFolder.$row->thumbnail;

              \Yii::$app->amazonservices->copyFilePublic($srcFilecer,$newFilecer);
            }

            

           // $assignTrainer_c = Yii::$app->db->createCommand("UPDATE courses SET assignTrainer=$userID WHERE id=$courseID")->execute();

            //$course[] = $courseID;

      /************ Exam Copy **************/
            if(!empty($exam) && $examcopy == 1){
              foreach ($exam as  $value) {
                /*if(!empty($examtitle)){
                  $value->examTitle = $examtitle;
                }else{
                  $value->examTitle = 'Copy of '.$value->examTitle;
                }*/
                
                $value->examTitle = $coursetitle;

                $value->courseID = $courseID;
                $examID = $this->insertRow($value);
                if(!empty($value->examInstructions)){
                  $eit = $value->examInstructions;
                  $eit->examID = $examID;
                  $instructionID = $this->insertRow($eit);
                }

                if(!empty($value->examQuestions1)){
                  foreach ($value->examQuestions1 as $value) {
                    $value->examID = $examID;
                    $examQuestionID = $this->insertRow($value);
                    if(!empty($value->examAnsOptionspaper)){
                      foreach ($value->examAnsOptionspaper as $value) {
                        $value->examQuestionID = $examQuestionID;
                        $examQuestionoptionID = $this->insertRow($value);
                      }
                    }
                  }
                }
              }
            }
          /************ End Exam Copy **************/

            if($courseID && !empty($row->dcourseChapters)){
                /******Insert into user Enrollment Table******/
                for ($i=1; $i <=2 ; $i++) { 
                  $userEnrollment = new UserEnrollment();
                  if($i==1){
                    if(!empty($user)){
                      $userEnrollment->userID = $user->id;
                    }else{
                      $userEnrollment->userID = $row->assignTrainer;
                    }
                  }else{
                      $userEnrollment->userID = Yii::$app->user->identity->id;
                  }
                  $userEnrollment->courseID = $courseID;
                  $userEnrollment->completedPercent = 0;
                  $userEnrollment->createdDate = date('Y-m-d');
                  $userEnrollment->endDate = date('Y-m-d',strtotime($userEnrollment->createdDate. " + 1 year"));
                  $userEnrollment->issuedcertificate = 1;/*no*/
                  $userEnrollment->issuedDate = '0000-00-00 00:00:00';
                  $userEnrollment->unenrolledDate = '0000-00-00 00:00:00';
                  $userEnrollment->save();
                }
            
            
            /******Insert into user Enrollment Table******/


            //AWS Target folder for Source File
             
                if($iscopycontent == 1){
                  foreach ($row->dcourseChapters as $value) {
                      $value->courseID = $courseID;

                      $chapterID = $this->insertRow($value);

                      //$courseChapter[] = $chapterID;

                      if($chapterID && !empty($value->dcourseDocuments)){

                        foreach ($value->dcourseDocuments as $value) {

                          $value->chapterID = $chapterID;
                          $courseDocumentID = $this->insertRow($value);
                          //$courseDoc[] = $courseDocumentID;

                          if($courseDocumentID){

                              if(in_array($value->documentTypeID,$docsLinkedWithAws)){

                              /*If secure*/
                              if($value->secure == 1 && $value->documentTypeID != 3){
                              /**** Get old File Path ****/
                              $srcFile = $srcAWSFolder.$this->getEncryptID($value->id).$value->version;

                               /*** Make copy on aws server ***/
                               $encID = $this->getEncryptID($courseDocumentID);
                               /*$newFile with folder and content path*/
                               $newFile = $targetAWSFolder.$encID.$value->version.'/'.$encID.$value->version;

                               \Yii::$app->amazonservices->copyFolder($srcFile,$newFile);
                              }

                              /*If not secure OR video type*/
                              if($value->secure == 0  || ($value->documentTypeID == 3 && $value->secure == 1)){
                                   
                               /**** Get old File Path ****/
                               $srcFile = $srcAWSFolder.$this->getEncryptID($value->id).$value->version.$value->url;

                                 /*** Make copy on aws server ***/
                              $newFile = $targetAWSFolder.$this->getEncryptID($courseDocumentID).$value->version.$value->url;

                              \Yii::$app->amazonservices->copyFile($srcFile,$newFile);
                              }
                            }

                         /*For Question and Question Answers*/
                         if(!empty($value->question)){ 

                          foreach ($value->question as $value) {
                              $value->courseDocID = $courseDocumentID;

                              $qid = $this->insertRow($value);
                              //$que[] = $qid;

                              if($qid  && !empty($value->answerOptions)){
                                 foreach ($value->answerOptions as $value){
                                     $value->questionID = $qid;
                                     $this->insertRow($value);
                                }
                             }
                          }
                        }

                        /*For Survey and Survey Option*/
                         if(!empty($value->survey)){ 

                          foreach ($value->survey as $value) {
                              $value->courseDocID = $courseDocumentID;
                              $qid = $this->insertRow($value);
                              //$que[] = $qid;

                              if($qid  && !empty($value->answerOptions)){
                                 foreach ($value->answerOptions as $value){
                                     $value->questionID = $qid;
                                     $this->insertRow($value);
                                }
                             }
                          }
                        }

                         /*For Poll and Poll Answers*/
                         if(!empty($value->poll)){

                          foreach ($value->poll as $value) {
                              $value->courseDocID = $courseDocumentID;

                              $pollID = $this->insertRow($value);
                              //$poll[] = $pollID;

                              if($pollID  && !empty($value->pollAnswers)){
                                 foreach ($value->pollAnswers as $value){
                                     $value->pollID = $pollID;
                                     $this->insertRow($value);
                                }
                             }
                          }
                       }


                  }/*End of courseDocumentID*/
                }
               }/*end of foreach for dcourseDocuments*/
             }/*end of if for dcourseDocuments*/

            }/*end of foreach for dcourseChapters*/
          }/*end of if for dcourseChapters*/

        }/*end of foreach for demoData*/
       }/*end of if for demoData*/
    }

    public static function getCommonreportcondtion($typeid = 0, $formatyii2 = false,$userid = null,$roleid=null)
    {
        $par = '';
        if(empty($userid)){
            $userid = Yii::$app->user->identity->id;
        }

        /*if(empty($roleid)){
            $roleid = Yii::$app->user->identity->roleID;
        }*/
        
        if($formatyii2 == false){
            $par = " AND ";
        }
            switch ($typeid) {
                case '1':
                $par .= "user_enrollment.unenrolledDate != '0000-00-00 00:00:00' ";
                break;

                case '2':
                $par .= "user_enrollment.unenrolledDate = '0000-00-00 00:00:00' and user_enrollment.endDate < date(now())";
                break;

                case '3':
                $par .= "user_enrollment.unenrolledDate = '0000-00-00 00:00:00' ";
                break;
                default:

                $par .= "user_enrollment.unenrolledDate = '0000-00-00 00:00:00' and user_enrollment.endDate >= date(now())";

            }
            if($formatyii2 == false){
                $par .= " and user.status!=2 and user.roleID=3 group by user_enrollment.id ";
            }

            if(!empty($roleid)){
                $par .= " and user_enrollment.userID=$userid";
            }else{
               $roleid = Yii::$app->user->identity->roleID;
            }

            if($roleid == 3){
                $par .= " and user_enrollment.userID=$userid";
            }

            return $par;
    }


/*    public static function getQueryReplyFor()
    {
        return [1 => 'Technical Support', 0 => 'Faculty'];
    }*/

    public static function getLicensetype()
    {
        return ['P' => 'Post Paid', 'Pr' => 'Prepaid', 'F'=>'Free Trial'];
    }

    public static function getLicensebillingtype()
    {
        return [1 => 'Monthly', 3 => 'Quarterly', 6=>'Semi Quarterly', 12=>'Yearly'];
    }

    


    public static function getTotalEnrollment($userID)
    {
        $par = MyHelpers::getCommonreportcondtion(2,true,$userID,3);
        $total_enrollment = Yii::$app->db->createCommand("SELECT count(user.id) AS total_enrollment from user_enrollment left join user on user.id = user_enrollment.userID 
            where $par GROUP BY user.id")->queryOne(); 

        return empty($total_enrollment["total_enrollment"])? 0 : $total_enrollment['total_enrollment'];
    }

    public static function getLicence()
    {
        $companyid = Yii::$app->user->identity->companyID;
        $userID = Yii::$app->user->identity->id;

        //$par = MyHelpers::getCommonreportcondtion(0,false);
        $usedlicences = Yii::$app->db->createCommand("SELECT user_enrollment.id , user.id AS userID from user_enrollment left join user on user.id = user_enrollment.userID 
            where user.companyID = $companyid AND user_enrollment.unenrolledDate = '0000-00-00 00:00:00' and user_enrollment.endDate >= date(now()) and user.status!=2 and user.roleID=3 group by user.id")->queryAll();

        $total_enrollment = count($usedlicences);

        if(Yii::$app->user->identity->roleID == 6){

          $licence = License::find()->where(['companyID'=>$companyid])->orderBy(['id'=>SORT_DESC])->one();
          $total_licence = $licence['noOfLicense'];   

        }else{

          $licence = License::find()->where(['userID'=>$userID,'companyID'=>$companyid])->orderBy(['id'=>SORT_DESC])->one();
        }
        
        $remaining_licence = 10000;
        if($licence['licenseType'] != 'P')
        {
          $remaining_licence = $licence['noOfLicense'] - $total_enrollment;
        }
    
        return ['total_enrollment'=>$total_enrollment,'total_licence'=>$licence['noOfLicense'],'remaining_licence' => $remaining_licence,'usedlicences'=>$usedlicences,'licenseType'=>$licence['licenseType']];

    }

   

    public function issuecertificate($uids,$courseID,$notify_email=0)
    {
 
      $createddate = date('Y-m-d H:i:s');
      $sourse = $this->masterbucket.'/'.$this->createAwsFolderother($this->findCompanyID(),$courseID).'certificate.docx';
      $destination = $this->masterbucket.'/'.$this->createAwsFolderother($this->findCompanyID(),$courseID).'certificate/';
      $details = UserEnrollment::find()->joinWith(['course','user as user2'])->where(['in','user_enrollment.id',$uids])->all();
      $arraylist = [];
      $userIDandCourseid = [];
      $bulkmail = array();
      $bulkmail['companyID'] = Yii::$app->user->identity->companyID;
      if(!empty($details)){
          $i = 0;
          foreach ($details as  $value) {
             $eneid = CustomUrlRule::encryptor("encrypt",$value['id']);
             $arraylist[$i]['enrollmentid'] = $eneid;
             $arraylist[$i]['coursename'] = $value['course']['title'];
             $arraylist[$i]['username'] = $value['user']['fullname'];
             $arraylist[$i]['enddate'] = date('F, Y',strtotime($value['endDate']));
             $userIDandCourseid[$value['userID']] = $value['courseID'];
             
             $bulkmail['to'][$i] = ['email'=>$value['user']['email'],'fullname'=>ucfirst($value['user']['fullname']),'courseName'=>$value['course']['title'],'courseID'=>$courseID,'eid'=>$eneid];
             $i++;
          }
      }
      if(!empty($arraylist))
      {
        if($this->convertserver($arraylist,CustomUrlRule::encryptor("encrypt",$courseID),$sourse,$destination,'certificate')){
          $updateeid = implode(",", $uids);
          Yii::$app->db->createCommand("UPDATE user_enrollment SET issuedcertificate='0',issuedDate = '$createddate' WHERE id in($updateeid)")->execute();
          if($notify_email == 1){
            if(isset($bulkmail['to']) && !empty($bulkmail['to'])){
              Yii::$app->myhelper->mailfunctionalitybulk($type='CertificateIssued',$bulkmail); 
              /*foreach ($details as $key => $value) {
                
              }*/
            }
             // Yii::$app->myhelper->mailfunctionality($type='CertificateIssued',$userid,$courseid,null,Yii::$app->user->identity->companyID,null); 
            }
            \Yii::$app->getSession()->setFlash('Success', 'Certificate has been issued Successfully.');
           return true;
            exit;
          }
        }else{
          echo "error";
          exit;
        }
      }


    public function certificatepreview($course)
    {
      $createddate = date('Y-m-d H:i:s');
      $sourse = $this->masterbucket.'/'.$this->createAwsFolderother($this->findCompanyID(),$course->id).'certificate.docx';
      $destination = $this->masterbucket.'/'.$this->createAwsFolderother($this->findCompanyID(),$course->id).'certificate/preview/';

      $arraylist = [];
      $cenc = CustomUrlRule::encryptor("encrypt",$course->id);
      $arraylist[0]['enrollmentid'] = $cenc;
      $arraylist[0]['coursename'] = $course->title;
      $arraylist[0]['username'] = Yii::$app->user->identity->fullname;
      $arraylist[0]['enddate'] = date('F, Y',strtotime($course->end_date));
   
      if($this->convertserver($arraylist,$cenc,$sourse,$destination,'certificatepreview')){
         $src = $destination.$cenc.'.pdf';
         header("Location: $src");
         exit;
      }
    }

    public function convertserver($arraylist,$courseID,$sourse,$destination,$type){

        ini_set('max_execution_time', 259200);
        $bucket = Yii::$app->myhelper->bucketname;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_URL, $this->convertURL);
        curl_setopt($ch, CURLOPT_NOPROGRESS, false);
        //curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, array($this,'progress'));
        //most importent curl assues @filed as file field
        $post_array = array(
            "users"=>$arraylist,
            "type"=>$type,
            "courseID"=>$courseID,
            "sourse"=>$sourse,
            "dest_file"=>$destination,
            "companyid"=>CustomUrlRule::encryptor("encrypt",Yii::$app->myhelper->findCompanyID()),
            "bucket" => $bucket,
            "project" => 'betaalphalearn',
        );

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_array));
        $response = curl_exec($ch);
        
        curl_close($ch);
        return $response;

    }

    public static function getResult()
    {
      return [4 => 'Last Attempted',1 => 'Not Attempted', 2 => 'Fail', 3=> 'Pass'];
    }

    public static function getAssignmentshowresult()
    {
      return [1 => 'Percentage', 2 => 'Marks', 3=> 'Grade'];
    }

    

    public static function getCouserduration()
    {
        return ['0'=> 'Days',30 => '1 Month',60 => '2 Months', 90=> '3 Months', 180=> '6 Months', 270=> '9 Months', 365=> '1 Year', 730=> '2 Years', 1095=> '3 Years'];
    }

    public static function getCstructure()
    {
        return [0 => 'Single Subject', 1 => 'Multiple Subject'];
    }

    public static function getScormversion()
    {
        return [0 => 'Tincan', 1 => 'SCORM 1.2 / 2004'];
    }

    public static function getAssignto()
    {
        return [0 => 'Course', 1 => 'Batch'];
    }

    public static function getChangestatus()
    {
        return [0 => 'Enable', 1 => 'Disable', 2=> 'Delete'];
    }
    
    public static function getExamStatus()
    {
        return [0 => 'Enabled', 1 => 'Disabled'];
    }

    public static function getActiveinactive()
    {
        return [0 => 'Active', 1 => 'In Active'];
    }

    public static function getActivedisable()
    {
        return [0 => 'Active', 1 => 'Disabled'];
    }

    public static function getAnnouncementsentto()
    {
        return [0 => 'Course', 1 => 'Batch'];
    }

    

    /*Get Company wise Faculty List*/
    public function getFacultyList($withadminandmanger = false){
        $companyID = Yii::$app->user->identity->companyID;
        if($withadminandmanger){
          $roleID = [4,2,6];
        }else{
          $roleID = 4;/*for Faculty*/
        }
        
        $result = '';
        $model = User::find()
        ->where(['companyID'=>$companyID,'roleID'=>$roleID])->andWhere(['<>','status',2])
        ->all();
        if(!empty($model)){
            $result = ArrayHelper::map($model, 'id', 'fullname');
        }

        return $result;
    }

    /*Get Company wise Course List*/
    public function getCoursesList(){
        $companyID = $this->findCompanyID();
        $result = '';
        $roleID = Yii::$app->user->identity->roleID;
        $userID = Yii::$app->user->identity->id;
        $subcompanyID = Yii::$app->user->identity->subcompanyID;

        /*If Trainer*/
        $query = Courses::find();
        $query->where(['courses.companyID'=>$companyID]);
        if($roleID == 4){
          $query->andWhere(['courses.assignTrainer'=>$userID]); 
        }

        if($roleID == 7){
          $query->joinWith(['userEnrollmentsWithUser']);
          $query->andWhere(['enrolleduser.subcompanyID'=>$subcompanyID]); 
        }

        if($roleID == 8){
          $query->joinWith(['userEnrollmentsWithUser']);
          $query->andWhere(['enrolleduser.companyManagerID'=>$userID]); 
        }

        $model = $query->all();
        if(!empty($model)){
            $result = ArrayHelper::map($model, 'id', 'title');
        }
        return $result;
    }

    public function getOrganizationList()
    {
      $companyID = $this->findCompanyID();
      $query = Organization::find()->where(['companyID'=>$companyID])->orderBy('name')->all();
      $result = ArrayHelper::map($query, 'id', 'name');
      return $result;
    }


    public static function getEncryptID($value)
    {
        return CustomUrlRule::encryptor("encrypt",$value);
    }

    public  function getDecryptID($value){
        return CustomUrlRule::encryptor("decrypt",$value);
    }

    public  function createAwsFolder($companyID,$folderID){
        return $this->getEncryptID($companyID).'/'.$this->getEncryptID($folderID).'/';
    }

    public  function createAwsFolderbyname($companyID,$folderID){
        return $this->getEncryptID($companyID).'/'.$folderID.'/';
    }

    public  function createAwslogo($companyID){
        return $this->getEncryptID($companyID).'/';
    }

    public  function createAwsFolderother($companyID,$courseID,$secure=null,$version = null){
        if(!empty($secure)){
            return $this->getEncryptID($companyID).'/'.$this->getEncryptID($courseID).'/'.$this->getEncryptID($secure).$version.'/';
        }else{
            return $this->getEncryptID($companyID).'/'.$this->getEncryptID($courseID).'/';
        }
        
    }


    public function getAwsFolderPath($companyID,$folderID){
        return $this->masterbucket.'/'.$this->getEncryptID($companyID).'/'.$this->getEncryptID($folderID).'/';
    }

    public static function getRandomcolor($id)
    {
        $array = ['1'=>'#34495e','2' => '#34495e','3' => '#9b59b6', '4' => '#9b59b6', '5' => '#3498db', '6'=>'#62cb31','7' => '#62cb31','8' => '#e74c3c', '9' => '#e67e22', '10' => '#c0392b'];
        return $array[$id];
    }

    public static function getCss()
    {
        $print = '';
        if(isset(Yii::$app->user->identity->companyui) && !empty(Yii::$app->user->identity->companyui)){
            if(!empty(Yii::$app->user->identity->companyui->breadcrumb)){
                $breadcrumb = Yii::$app->user->identity->companyui->breadcrumb;
                $print .=".breadcrumb {
                            padding: 8px 15px;
                            margin-bottom: 20px;
                            list-style: none;
                            background-color: $breadcrumb;
                            border-radius: 4px;
                        }";
            }
            if(!empty(Yii::$app->user->identity->companyui->breadcrumbFont)){
                $breadcrumbFont = Yii::$app->user->identity->companyui->breadcrumbFont;
                $print .=".breadcrumb > li a{
                        color: $breadcrumbFont;
                    }
                    .breadcrumb > .active {
                          color: $breadcrumbFont;
                        }
                        .breadcrumb > li {
                          color: $breadcrumbFont;
                        }
                    ";
            }
            if(!empty(Yii::$app->user->identity->companyui->titleBarFont)){
                $titleBarFont = Yii::$app->user->identity->companyui->titleBarFont;
                $print .=".navbar-collapse > ul > li > a {
                                color: $titleBarFont;
                            }";

            }
        }
        return "<style>".
        $print
        ."</style>";

    }


    public static function getYesNo($rev = false)
    {
      if($rev){
        return [0 => 'No', 1 => 'Yes'];
      }else{
        return [0 => 'Yes', 1 => 'No'];
      }
      
    }

    public static function getIsapprove()
    {
      return [1 => 'No Approval Needed',0 => 'Admin / Manager']; 
    }

    public static function getAssignmenttype()
    {
      return [0 => 'Manually',1 => 'Automated - On Completion of Selected Modules']; 
    }

    public static function getAssignmentstatus()
    {
      return [1 => 'Pending',2 => 'Approved',3=>'Rejected']; 
    }



    /*This Function Result is case sensetive;*/
    public static function getMyRole($id=null){
        
        if($id == null){
          $id = Yii::$app->user->id;
        }
        if(!\Yii::$app->user->isGuest && !empty($id)){

         $result = \app\models\User::find()->joinWith('role')->where(['user.id'=>$id])->one();

         if(isset($result)  && !empty($result)){
            return strtolower($result->role->name);
         }
            return 'guest';
        }
    }

    public static function getDepartments(){
     $companyID = Yii::$app->user->identity->companyID;
     $departments = ArrayHelper::map(\app\models\Department::find()->where(['companyID'=>$companyID])->all(),'id','name');
     return $departments;
    }

    public static function getDesignations(){
     $companyID = Yii::$app->user->identity->companyID;
     $designations = ArrayHelper::map(\app\models\Designation::find()->where(['companyID'=>$companyID])->all(),'id','name');
     return $designations;
    }

    public function getSubcompnay(){
     $companyID = Yii::$app->user->identity->companyID;
     $SubCompany = ArrayHelper::map(\app\models\SubCompany::find()->where(['companyID'=>$companyID])->all(),'id','name');
     return $SubCompany;
    }

    public  function getRole($index = true){
      if(!$index){
        if(isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->roleID == 6){
          if(Yii::$app->user->identity->config->issubcompany == 0){
            return  ArrayHelper::map(Role::find()->where(['not in','id', [6,1,2,5]])->all(), 'id', 'name');
          }else{
            return  ArrayHelper::map(Role::find()->where(['not in','id', [6,1,2,5,7,8]])->all(), 'id', 'name');
          }
          
        }elseif(isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->companyID == Yii::$app->liccomponent->liccompanyid){
          if(Yii::$app->user->identity->config->issubcompany == 0){
            return  ArrayHelper::map(Role::find()->where(['not in','id', [6,1,2]])->all(), 'id', 'name');
          }else{
            return  ArrayHelper::map(Role::find()->where(['not in','id', [6,1,2,7,8]])->all(), 'id', 'name');
          }
        }else{
          if(Yii::$app->user->identity->config->issubcompany == 0){
            return  ArrayHelper::map(Role::find()->where(['not in','id', [1,2,5]])->all(), 'id', 'name');
          }else{
            return  ArrayHelper::map(Role::find()->where(['not in','id', [1,2,5,7,8]])->all(), 'id', 'name');
          }
          
        }
      }
      
        /*$allow tech support creation*/
        $default = [1,2];
        $isConnect = MyHelpers::isConnect();
        if(!$isConnect){
            $default = [1,2];/*Disallow Faculty creation*/
        }
        return  ArrayHelper::map(Role::find()->where(['not in','id', $default])->all(), 'id', 'name');
    }


  public static function getCompanymanager(){
    return ArrayHelper::map(
        \app\models\User::find()->where(['companyID'=>Yii::$app->user->identity->companyID,'roleID'=>8])->orderBy('fname')->asArray()->all(),
        'id',
        function($model, $defaultValue) {
            return $model['fname'].' '.$model['lname'];
        }
    );
  }
    public static function getCourses(){

         if(!\Yii::$app->user->isGuest){

            $result = ArrayHelper::map(\app\models\Courses::find()->all(), 'id', 'title');

            return $result;
        }
        return null;
    }

    public function getExamType(){
        return $this->examType;
    }

/*   public function checkExternalFile($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $retCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $retCode;
    }*/

    public function getHomelogo($companyID = null){
        $currentURl = $_SERVER['HTTP_HOST'];
        $logo = $this->logo;
        if(!empty($companyID)){
            $checksubdomain = Config::find()->where(['companyID'=>$companyID])->one();
        }else{
            $checksubdomain = Config::find()->where(['s3DomainName'=>trim($currentURl)])->one();
        }
        if(!empty($checksubdomain)){
          if($checksubdomain->isdefaultlogo == 1){
            $logo = $this->masterbucket."/".$this->getEncryptID($checksubdomain->companyID)."/defaultlogo.png";
          }else{
            $logo = $this->masterbucket."/".$this->getEncryptID($checksubdomain->companyID)."/defaultlogo".$checksubdomain->logoversion.".png";
          }
        }
      return $logo;
    }


    public function getFavicon($companyID = null){
        $currentURl = $_SERVER['HTTP_HOST'];
        $favicon = 'default';
        if(!empty($companyID)){
            $checksubdomain = Config::find()->where(['companyID'=>$companyID])->one();
        }else{
           $exp = explode(".", $currentURl);
          array_pop($exp);
          $domain = implode(".", $exp);
          
          $checksubdomain = Config::find()->where(['like','s3DomainName',trim($domain)])->one();

          //$checksubdomain = Config::find()->where(['s3DomainName'=>trim($currentURl)])->one();
        }
        if(!empty($checksubdomain)){
          if($checksubdomain->isdefaultfavicon == 1){
            $favicon = 'default';
          }else{
            $favicon = $this->masterbucket."/".$this->getEncryptID($checksubdomain->companyID)."/favicon".$checksubdomain->faviconversion.".ico";
          }
        }
      return $favicon;
    }


    public static function findCompanyID(){
        $companyID = Yii::$app->user->identity->companyID;
        /*if(Yii::$app->user->identity->roleID == 1){
            $companyID = 1;
        }*/
        return $companyID;
    }


    public function ExamSchedularupdate($esid,$courseid,$enddate){

        #Check Exam is Prepared or Not#
        $companyID = Yii::$app->user->identity->companyID;
        $exam = Exam::find()->joinWith('course')->where(['courses.id'=>$courseid, 'courses.companyID'=>$companyID])->one();

        if(isset($exam) && !empty($exam)){

            $startdate = date('Y-m-d', strtotime($enddate . " -".$exam->beoc." days"));

            /*SET START DATE if ctype is exam*/
            if(isset($model->startDate) && !empty($model->startDate)){
                $startdate = $model->startDate;
            }

            //$enddate = date('Y-m-d',strtotime('+'.($exam->period - 1).' days', strtotime($startdate)));
            $enddate = date('Y-m-d',strtotime('+'.($exam->period).' days', strtotime($startdate)));

            $ExamSchedule = ExamSchedule::findOne($esid);
            $ExamSchedule->startDate = $startdate;
            $ExamSchedule->endDate = $enddate;
            $ExamSchedule->save();
            /*$ExamSchedule = new ExamSchedule;
            $ExamSchedule->userEnrollmentID = $enid;
            $ExamSchedule->examID = $exam->id;
            $ExamSchedule->startDate = $startdate;
            $ExamSchedule->endDate = $enddate;
            $ExamSchedule->scheduledon = new Expression('NOW()');
            $ExamSchedule->save();*/
        }
    }####End of user enrollment######

    /*Exam setting with user enrollment*/
    /*This will check if exam is prepared or not*/
    /*Will insert values in ExamSchedule table*/
    /*ExamSchedular(UserEnrollmentID,$courseid,$courseenddate)*/
    public function ExamSchedular($enid,$courseid,$enddate){

        #Check Exam is Prepared or Not#
        $companyID = $this->findCompanyID();
        $exam = Exam::find()->joinWith('course')->where(['courses.id'=>$courseid, 'courses.companyID'=>$companyID])->one();

        if(isset($exam) && !empty($exam)){

            $startdate = date('Y-m-d', strtotime($enddate . " -".$exam->beoc." days"));

            /*SET START DATE if ctype is exam*/
            if(isset($model->startDate) && !empty($model->startDate)){
                $startdate = $model->startDate;
            }

            //$enddate = date('Y-m-d',strtotime('+'.($exam->period - 1).' days', strtotime($startdate)));
            $enddate = date('Y-m-d',strtotime('+'.($exam->period).' days', strtotime($startdate)));

            $ExamSchedule = new ExamSchedule;
            $ExamSchedule->userEnrollmentID = $enid;
            $ExamSchedule->examID = $exam->id;
            $ExamSchedule->startDate = $startdate;
            $ExamSchedule->endDate = $enddate;
            $ExamSchedule->scheduledon = new Expression('NOW()');
            $ExamSchedule->save();
        }
    }####End of user enrollment######


    public function examUpdateSchedular($examid,$courseid,$beoc,$period,$startDate){

            $today = date('Y-m-d');

            $common = "examID=$examid AND exam_schedule.status=0 AND exam_schedule.rescheduledBy = 0 AND user_enrollment.courseID = $courseid AND user_enrollment.endDate > '$today' ";

            $check = $common." AND exam_schedule.attemptDate != '0000-00-00 00:00:00' ";

            $examBeinguse = ExamSchedule::find()->joinWith(['exam','userEnrollment'])->where($check)->one();

            if(!empty($examBeinguse)){
              return false;
            }

            $ExamSchedules = ExamSchedule::find()->joinWith(['exam','userEnrollment'])->where($common)->all();

             foreach ($ExamSchedules as  $ExamSchedule) {
             $enddate = $ExamSchedule->userEnrollment->endDate;

                $startdate = date('Y-m-d', strtotime($enddate . " -".$beoc." days"));

                /*SET START DATE if ctype is exam*/
                if(isset($startDate) && !empty($startDate)){
                    $startdate = $startDate;
                }

                $enddate = date('Y-m-d',strtotime('+'.($period - 1).' days', strtotime($startdate)));

                $ExamSchedule->startDate = $startdate;
                $ExamSchedule->endDate = $enddate;
                $ExamSchedule->save();
          }
          return true;
        }

        /*To Find Technical Support User for Company*/
        public function findTechnicalSupport(){
            $companyID = $this->findCompanyID();
            $result = $id = '';
            /*If Technical Support not being made send query to company*/
            $result = User::find()
            ->joinWith('role')
            ->where(['user.companyID'=>$companyID,'role.name'=>'Technical Support'])
            ->one();

            if(!empty($result)){
                $id = $result->id;
            }else{
                $result = User::find()
                ->joinWith('role')
                ->where(['user.companyID'=>$companyID,'role.name'=>'Admin'])
                ->one();
                $id = $result->id;
            }           

            return $id;
        }


        /*To Find Technical Support User for Company*/
        public function findMyFaculty($cid){
            $companyID = $this->findCompanyID();
            $result = $id = '';
            /*If Technical Support not being made send query to company*/
         /*  $result = Company::find()
            ->joinWith(['role','userEnrollments'])
            ->where(['user.companyID'=>$companyID,'role.name'=>'Trainer'])
            ->one();  */

            $result = Courses::find()
            ->joinWith(['trainer'])
            ->where(['user.companyID'=>$companyID,'courses.id'=>$cid])
            ->one(); 

            if(isset($result->trainer) && !empty($result->trainer)){
                $id = $result->trainer->id;
            }

            return $id;
        }

        public static function checkCourseAutomated($courseID){
            $result = false;
            $CheckCourseAutomated = Courses::find()->where(['id'=>$courseID])->one();
            if(isset($CheckCourseAutomated) && !empty($CheckCourseAutomated)){
                if($CheckCourseAutomated->isAutomated == 0){
                    $result = true;
                }
            }
            return $result;
        }

        /*Check Done and Undone*/
        public static function checkcourseDocumentReaded($doc_id,$ueid){

            $result = false;

            $checkDocumentReaded = \app\models\UserEnrollmentProgress::find()
            ->where(['courseDocID'=>$doc_id, 'userEnrollmentID'=>$ueid])
            ->one();

            if(isset($checkDocumentReaded) && !empty($checkDocumentReaded)){
                $result = true;
            }
            return $result;
        }

        /*Check Content Added into the Course*/
        public static function checkcContentAddedintoCourse($courseID){

            $result = false;
            $companyID = MyHelpers::findCompanyID();
            $query = "SELECT COUNT(course_documents.id)total FROM course_documents WHERE course_documents.chapterID IN (SELECT course_chapters.id FROM course_chapters WHERE  course_chapters.courseID = $courseID) ";

            $result = Yii::$app->db->createCommand($query)->queryOne()['total'];
            if($result){
              $result = true;
            }

            return $result;
        }


    public function otp($numbers)
    {
        $digit = substr(number_format(time() * rand(),0,'',''),0,6);
        $message = 'Your Onetime Password (OTP) is '.$digit.'. Please use this to login to the Learning Management System.';
        //$data = array('username' => $username, 'hash' => $hash, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
        $bulksms['sms'][] = array('username' => $this->smsusername, 'hash' => $this->smshash, 'numbers' => $numbers, "sender" => 'AlphaL', "message" => $message);
        $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulksms,'POST');
       // $this->curl_request_async($this->smssendsms_url,$data,'POST');
        return $digit;

    }

    public function announcementsms($numbers,$text)
    {
        $message = rawurlencode('Dear Trainee,%n'.$text);
        $data = array('username' => $this->smsusername, 'hash' => $this->smshash, 'numbers' => $numbers, "sender" => $this->smssender, "message" => $message);
        $this->curl_request_async($this->smssendsms_url,$data,'POST');
        return $message;
    }


    public function mailfunctionalityblock(){
      $subject = "Warning! Your Email Bounce Rate is High";
      $body = "Dear ".@Yii::$app->user->identity->fullname .", <br/><br/>
Please check your <b>Mail Activity Report from the Reports</b> section of AlphaLearn.<br/>
Your email bounce rate is more than the acceptable bounce rate.<br/>
The bounced email addresses have been added to our suppression list and no emails will be sent to these email addresses till you take corrective action to unblock them.<br/>
If the bounced rate of your account continues to be high, then your email sending functionality on AlphaLearn may be suspended<br/><br/>Best Regards,<br/>
Team AlphaLearn";

      $bulkarray['mailingdata'][0] =  ['email'=>@Yii::$app->user->identity->email,'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail,'cc'=>'helpdesk@horizzon.com'];
      $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
    }



    

public function mailfunctionalityEnrollmentRequest($data){
  $courselist = $this->getCoursesList();
  $paymenmode = $this->getPaymentmode();
      $subject = "Enrollment Request";
      $body = "Dear Support, <br/><br/>
      Enrollment Request Details <br/><br/>
      Name: ".ucfirst($data->fname).' '. $data->lname."<br/>
      Email: ".$data->email."<br/>
      Mobile: ".$data->mobile."<br/>
      Course: ".$courselist[$data->courseID]."<br/>
      Amount: ".$data->amount."<br/>
      Payment Mode: ".$paymenmode[$data->paymentmode]."<br/>
      Payment Date: ".date('d-m-Y',strtotime($data->paymentdate))."<br/>
      ";
      if($data->paymentmode == 0){
        $body .= "
         From Account No.: ".$data->fromacc."<br/>
         UTR No.: ".$data->utrno."<br/>
        ";
      }else{
        $body .= "
         Cheque/DD No.: ".$data->chequeno."<br/>
        ";
      }
      $body .= "<br/><br/>Best Regards,<br/>
      Team Care Trainings";

      $bulkarray['mailingdata'][0] =  ['email'=>'training@care-cart.com','subject'=>$subject,'body'=>$body,'cc'=>'support@care-trainings.com'];
      $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
  }



  public function mailsubcompanyvarifysignup($data,$company,$enddate,$s3DomainName){
      //$data['email'] = 'vicky@horizzon.com';
          $subject = "Sign Up Verification Confirmed";
          $content = "Dear ". ucfirst($data['fname']).' '.$data['lname'].", <br/> <br/>

          Your email address has been verified and your account has been created successfully. Please find below your account details
          <br/> <br/>

          Name: ".ucfirst($data['fname']).' '.$data['lname']."<br/>
          Email: ".$data['email']."<br/>
          Password: <<As chosen by you earlier>> <br/>
          Mobile: ".$data['mobile']." <br/>
          Company Name: ".$company->name."  <br/>
          Your Sub-Domain: https://".$s3DomainName."<br/>
          Backup URL: https://app.alphalearn.com <br/><br/>

          -----<br/>
          Thank You";
          $email = $data['email'];
          Yii::$app->params['maillogo'] = $this->logo;
          $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withfooter');
          $bulkarray['mailingdata'][0] =  ['email'=>$email,'subject'=>$subject,'body'=>$body, 'sendername'=>"AlphaLearn LMS",'senderemail'=>'noreply@alphalearn.com','bcc'=>'helpdesk@horizzon.com'];
      
        $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');

    }


    public function mailfunctionalityaftersignup($data,$company,$enddate,$s3DomainName){
      //$data['email'] = 'vicky@horizzon.com';
      for ($i=0; $i < 2 ; $i++) { 
        if($i == 0){
          $subject = "Welcome to Alphalearn LMS";
          $content = "Dear ". ucfirst($data['fname']).' '.$data['lname'].", <br/><br/> 

            Welcome to Alphalearn Learning Management System. <br/><br/> 

            Your Free Trial Account has been created so you can try Alphalearn risk free for 10 Days. <br/><br/> 

            Your account will be active till ". date("d-m-Y",strtotime($enddate))." <br/> <br/> 

            Your Login Details: <br/>
            URL: ".$s3DomainName."    (This may take a few hours to resolve.) <br/>
            Backup URL: https://app.alphalearn.com <br/>
            Your Username: ".$data['email']."<br/> <br/>

            If you have any queries or would like to provide us your valued feedback, please feel free to write to us on info@alphalearn.com <br/> <br/>


            Best Regards,  <br/>
            Alphalearn Team  <br/>
            info@alphalearn.com";
            $email = $data['email'];
            Yii::$app->params['maillogo'] = Yii::$app->myhelper->getHomelogo($company->id);
            $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withfooter');
        }else{

          $subject = "Alphalearn Sign Up Verification Confirmed";
          $content = "Dear ". ucfirst($data['fname']).' '.$data['lname'].", <br/> <br/>

          Sign Up Verification was successful for ".ucfirst($data['fname']).' '.$data['lname']." and the domain ".$s3DomainName." and Free Trial is active upto ".date("d-m-Y",strtotime($enddate))."<br/> <br/>

          Name: ".ucfirst($data['fname']).' '.$data['lname']."<br/>
          Email: ".$data['email']."<br/>
          Mobile: ".$data['mobile']." <br/>
          Company Name: ".$company->name."  <br/>
          Sub-Domain Request: ".$s3DomainName."<br/> <br/>

          Best Regards,  <br/>
          Alphalearn Team  <br/>
          info@alphalearn.com";
          $email = "helpdesk@horizzon.com";
          Yii::$app->params['maillogo'] = $this->logo;
          $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withfooter');
        }
        $bulkarray['mailingdata'][$i] =  ['email'=>$email,'subject'=>$subject,'body'=>$body, 'sendername'=>"AlphaLearn LMS",'senderemail'=>'noreply@alphalearn.com'];
      }
      
      $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');

    }


   


    public function mailfunctionalitybulk($type=null,$array=null){
      $bouncedEmailID = array();
      if(@Yii::$app->user->identity->config->blockmail == 0){
        return false;
        exit;
      }elseif(@Yii::$app->user->identity->config->blockmail == 1 && @Yii::$app->user->identity->roleID == 2){
        /*$mailtracking = Mailtracking::find()->select(['mailtracking.email','mailtracking.status'])->joinWith(['user'])->where(['user.companyID'=>@Yii::$app->user->identity->companyID,'mailtracking.status'=>2,'mailtracking.isSuppression'=>0])->andWhere(['<>','user.status',2])->groupBy('mailtracking.email')->all();
        $bouncedEmailID = array_column($mailtracking, 'email');*/

        /*if(!empty($bouncedEmailID)){
            $per = round(count($bouncedEmailID)/count($mailtracking)*100);
            if($per>=$this->bouncedmaillimit){
             // $this->mailfunctionalityblock();
            }
          }*/
      
      }

  $inarray = array("Announcement","CourseRequestReject","QueryCreated","QueryReplied");

      if(!in_array($type, $inarray)){
        if($type!="EnrollmentOrderEmail" && $type!="ForumReply"){
          $template = CompanyEmailtemplate::find()->where(['title'=>ucfirst($type),'cmpanyID'=>$array['companyID']])->one();
          if(empty($template))
          {
            $template = EmailTemplates::find()->where(['title'=>ucfirst($type)])->one();
            if(empty($template)){
              echo "Template Not Exist";
              exit;
            }
            $subject = $template->subject;
            $string = html_entity_decode($template->body);
          }else{
            if($template->blockmail == 1){
              return true;
            }
            $subject = $template->subject;
            $string = html_entity_decode($template->body);
          }
        }
        if(array_key_exists("companyID",$array)){
          $logo = Yii::$app->myhelper->getHomelogo($array['companyID']);
        }else{
          $logo = Yii::$app->myhelper->getHomelogo();
        }
      }

      switch ($type) {

        case 'NewQueryAlert':
          //$url = Yii::$app->user->identity->config->customdomain;
          $url = Html::a(Yii::$app->user->identity->config->customdomain, Yii::$app->user->identity->config->customdomain,[]);
          if(!empty($array)){
            $bulkarray = array();
            foreach ($array['to'] as  $key=>$value) {
              if(!in_array($value['email'], $bouncedEmailID)){
                $trans = array("<<Logo>>" => "", "<<Trainer Name>>" =>$value['traineename'], "<<URL>>" => $url, "<<Student Name>>" => $value['trainee'], "<<Course Name>>" => $value['course'], "<<Query>>" => $value['query']);
                Yii::$app->params['maillogo'] = $logo;
                $content = strtr($string,$trans);
                $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
              }
            }
           $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
          }

        break;

        case 'AssignmentDue':
          $bcc = '';
          //$url = Yii::$app->user->identity->config->customdomain;
          $url = Html::a(Yii::$app->user->identity->config->customdomain, Yii::$app->user->identity->config->customdomain,[]);
          if(!empty($array)){
            $bulkarray = array();
            foreach ($array['to'] as  $key=>$value) {
              if(!in_array($value['email'], $bouncedEmailID)){
                $trans = array("<<Logo>>" => "", "<<Student Name>>" =>$value['fullname'], "<<URL>>" => $url, "<<DueDate>>" => date('d-m-Y',strtotime($value['assignmentEnd'])), "<<Course Name>>" => $value['coursename'], "<<Module Name>>" => $value['modulename'], "<<Assignment Name>>" => $value['assignmentname']);
                //$body = strtr($string,$trans);

                Yii::$app->params['maillogo'] = $logo;
                $content = strtr($string,$trans);
                $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
              }
            }
           $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
          }

        break;

        case 'AssignmentSubmitted':
          $bcc = '';
          //$url = Yii::$app->user->identity->config->customdomain;
          $url = Html::a(Yii::$app->user->identity->config->customdomain, Yii::$app->user->identity->config->customdomain,[]);
          if(!empty($array)){
            $bulkarray = array();
            foreach ($array['to'] as  $key=>$value) {
              if(!in_array($value['email'], $bouncedEmailID)){
                $trans = array("<<Logo>>" => "", "<<Trainer Name>>"=>$value['tfullname'],"<<Student Name>>" =>$value['fullname'], "<<URL>>" => $url, "<<Course Name>>" => $value['coursename'], "<<Module Name>>" => $value['modulename'], "<<Assignment Name>>" => $value['assignmentname']);
                //$body = strtr($string,$trans);

                Yii::$app->params['maillogo'] = $logo;
                $content = strtr($string,$trans);
                $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
              }
            }
           $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
          }

        break;

        case 'AssignmentExtensionRequest':
          $bcc = '';
          //$url = Yii::$app->user->identity->config->customdomain;
          $url = Html::a(Yii::$app->user->identity->config->customdomain, Yii::$app->user->identity->config->customdomain,[]);
          if(!empty($array)){
            $bulkarray = array();
            foreach ($array['to'] as  $key=>$value) {
              if(!in_array($value['email'], $bouncedEmailID)){
                $trans = array("<<Logo>>" => "", "<<Trainer Name>>"=>$value['tfullname'],"<<Student Name>>" =>$value['fullname'], "<<URL>>" => $url, "<<Course Name>>" => $value['coursename'], "<<Module Name>>" => $value['modulename'], "<<Assignment Name>>" => $value['assignmentname']);
                //$body = strtr($string,$trans);

                Yii::$app->params['maillogo'] = $logo;
                $content = strtr($string,$trans);
                $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
              }
            }
           $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
          }

        break;

         case 'AssignmentDueDateExtended':
          $bcc = '';
          //$url = Yii::$app->user->identity->config->customdomain;
          $url = Html::a(Yii::$app->user->identity->config->customdomain, Yii::$app->user->identity->config->customdomain,[]);
          if(!empty($array)){
            $bulkarray = array();
            foreach ($array['to'] as  $key=>$value) {
              if(!in_array($value['email'], $bouncedEmailID)){
                $trans = array("<<Logo>>" => "", "<<Trainer Name>>"=>$value['tfullname'],"<<Student Name>>" =>$value['fullname'], "<<URL>>" => $url, "<<Course Name>>" => $value['coursename'], "<<Module Name>>" => $value['modulename'],"<<DueDate>>" => date('d-m-Y',strtotime($value['assignmentEnd'])), "<<Assignment Name>>" => $value['assignmentname']);
                //$body = strtr($string,$trans);

                Yii::$app->params['maillogo'] = $logo;
                $content = strtr($string,$trans);
                $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
              }
            }
           $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
          }

        break;

        case 'AssignmentExtensionRejected':
          $bcc = '';
          //$url = Yii::$app->user->identity->config->customdomain;
          $url = Html::a(Yii::$app->user->identity->config->customdomain, Yii::$app->user->identity->config->customdomain,[]);
          if(!empty($array)){
            $bulkarray = array();
            foreach ($array['to'] as  $key=>$value) {
              if(!in_array($value['email'], $bouncedEmailID)){
                $trans = array("<<Logo>>" => "", "<<Trainer Name>>"=>$value['tfullname'],"<<Student Name>>" =>$value['fullname'], "<<URL>>" => $url, "<<Course Name>>" => $value['coursename'], "<<Module Name>>" => $value['modulename'], "<<Assignment Name>>" => $value['assignmentname']);
                //$body = strtr($string,$trans);

                Yii::$app->params['maillogo'] = $logo;
                $content = strtr($string,$trans);
                $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
              }
            }
           $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
          }

        break;

        case 'AssignmentEvaluated':
          $bcc = '';
          //$url = Yii::$app->user->identity->config->customdomain;
          $url = Html::a(Yii::$app->user->identity->config->customdomain, Yii::$app->user->identity->config->customdomain,[]);
          if(!empty($array)){
            $bulkarray = array();
            foreach ($array['to'] as  $key=>$value) {
              if(!in_array($value['email'], $bouncedEmailID)){
                $trans = array("<<Logo>>" => "", "<<Student Name>>" =>$value['fullname'], "<<URL>>" => $url, "<<Course Name>>" => $value['coursename'], "<<Module Name>>" => $value['modulename'], "<<Assignment Name>>" => $value['assignmentname']);
                //$body = strtr($string,$trans);

                Yii::$app->params['maillogo'] = $logo;
                $content = strtr($string,$trans);
                $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
              }
            }
           $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
          }

        break;

        case 'EnrollmentOrderEmail':
              if(!empty($array)){
                $bulkarray = array();
                foreach ($array['to'] as  $key=>$value) {
                  if(!in_array($value['email'], $bouncedEmailID)){
                    $subject = " Enrollment to the Online Course - ".$value['course'];
                    $content = "Dear Trainee,<br/><br/>

You have been enrolled to the Online Course - <b>".$value['course']."</b>.<br/><br/>

The course material will be available till ".$value['courseEnd'].".<br/><br/>

To access your course material please login using the following information:<br/>
Username: ".$value['email']."<br/>
Password: ".$value['password']."<br/>
Login Link: https://www.care-trainings.com/login<br/><br/>

Once logged in, it is recommended that you change your password.<br/><br/>

For any academic/syllabus related queries, please call: 022 6754 3456 or write to us on training@care-cart.com <br/><br/>

For technical queries please call: 8879115978 or write to us on support@care-trainings.com <br/><br/>

All the Best,<br/>
CARE Training<br/>
https://www.care-trainings.com";

                  Yii::$app->params['maillogo'] = $logo;
                  //$content = strtr($string,$trans);
                  $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');


                    $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
                  }
                }
               $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
              }
        break;


        case 'QueryCreated':
              if(!empty($array)){
                $bulkarray = array();
                foreach ($array['to'] as  $key=>$value) {
                    $subject = "New Query from ".Yii::$app->user->identity->fullname;
                    $content = "Dear ".$value['fullname']."<br/><br/>  You have received a new Query. <br/><br/> Course: ".$value['courseName'].'<br/><br/> Created By: '.Yii::$app->user->identity->fullname.'<br/><br/><br/> All the best';
                    
                  //Yii::$app->params['maillogo'] = $logo;
                  //$content = strtr($string,$trans);
                  $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                    $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
                }
               $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
              }
        break;

        case 'ForumReply':
              if(!empty($array)){
                $bulkarray = array();
                foreach ($array['to'] as  $key=>$value) {
                    $subject = ucfirst($value['replyername'])." replied to your Post";
                    $content = "Dear ".$value['fullname']."<br/><br/>This is with regards to your post: ".$value['title']."<br/><br/>".ucfirst($value['replyername'])." has replied to yout post. <br/><br/>To view and comment further, please login to: ". Html::a(Yii::$app->user->identity->config->customdomain, Yii::$app->user->identity->config->customdomain,[])."<br/><br/>Best Regards,<br/>
                      AlphaLearn";
                    
                  Yii::$app->params['maillogo'] = $logo;
                  //$content = strtr($string,$trans);
                  $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');
                  
                  $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
                }
               $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
              }
        break;

        case 'QueryReplied':
              if(!empty($array)){
                $bulkarray = array();
                foreach ($array['to'] as  $key=>$value) {
                  $subject = "Your query no. ".$value['queryno']." has been resolved";
                  
                  $content = "Dear ".$value['fullname']."<br/><br/>  The following Query has been resolved. <br/><br/>Query No:".$value['queryno']."<br/><br/> Course: ".$value['courseName'].'<br/><br/> Please login to your learning management system to view the response. <br/><br/><br/> All the best';
                    
                    $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                    $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
                }
               $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
              }
        break;


        

        case 'UserRegistration':
              if(!empty($array)){
                $bulkarray = array();
                foreach ($array['to'] as  $key=>$value) {
                  if(!in_array($value['email'], $bouncedEmailID)){
                    $reset_url =  Html::a(Html::encode('Reset Password'), Url::to(['/site/reset', 'token' => $value['password_reset_token']], true));
                    $trans = array("<<Logo>>" => "", "<<Student Name>>" => $value['fullname'], "<<Student Email>>" => $value['email'], "<<Reset Link>>" => $reset_url, "<<Admin Name>>" => Yii::$app->user->identity->fullname, "<<Admin Email>>" => Yii::$app->user->identity->email);
                    //$body = strtr($string,$trans);

                  Yii::$app->params['maillogo'] = $logo;
                  $content = strtr($string,$trans);
                  $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');


                    $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
                  }
                }
               $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
              }
        break;

        case 'CourseRequestReject':
              if(!empty($array)){
                $bulkarray = array();
                foreach ($array['to'] as  $key=>$value) {
                    $subject = "Enrollment Request Rejected";
                    $content = "Dear ".$value['fullname']."<br/><br/>  This is an update regarding your request for enrollment to the Course: ".$value['courseName']."<br/><br/>Unfortunately, your request has been rejected.<br/><br/>For further information, please contact your Manager/Supervisor.<br/><br/><br/> All the Best";
                    
                    $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                    $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
                }
               $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
              }
        break;

        case 'UserRegistrationsetpassword':
              if(!empty($array)){
                $bulkarray = array();
                foreach ($array['to'] as  $key=>$value) {
                  if(!in_array($value['email'], $bouncedEmailID)){
                    $reset_url =  Html::a('Reset Password', Url::to(['/site/reset', 'token' => $value['password_reset_token']], true),[]);

                    $trans = array("<<Logo>>" => "", "<<Student Name>>" => $value['fullname'], "<<Student Email>>" => $value['email'], "<<password>>" => $value['password'], "<<siteurl>>" => Html::a(Yii::$app->user->identity->config->customdomain, Yii::$app->user->identity->config->customdomain,[]));
                    //$body = strtr($string,$trans);

                  Yii::$app->params['maillogo'] = $logo;
                  $content = strtr($string,$trans);
                  $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                    $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
                  }
                }
               $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
              }
          break;
          case 'CourseEnrollement':
                $bcc = '';
                //$url = 'http://'.Yii::$app->user->identity->config->customdomain;
                $url = Html::a(Yii::$app->user->identity->config->customdomain, Yii::$app->user->identity->config->customdomain,[]);

                if(@Yii::$app->user->identity->companyID == Yii::$app->carecomponent->carecompanyid){
                  $bcc = Yii::$app->carecomponent->bcc;
                }
                if(!empty($array)){
                  $bulkarray = array();
                  foreach ($array['to'] as  $key=>$value) {
                    if(!in_array($value['email'], $bouncedEmailID)){
                      $trans = array("<<Logo>>" => "", "<<Student Name>>" =>$value['fullname'], "<<URL>>" => $url, "<<Course End>>" => date('d-m-Y',strtotime($value['courseEnd'])), "<<Course Name>>" => $value['courseName'], "<<Trainer Name>>" => $value['trainerName'], "<<Trainer Email>>" => $value['temail']);
                      //$body = strtr($string,$trans);

                      Yii::$app->params['maillogo'] = $logo;
                      $content = strtr($string,$trans);
                      $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                      $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail,'bcc'=>$bcc];
                    }
                  }
                 $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
                }

                break;
            case 'CertificateIssued':
                if(!empty($array)){
                  $bulkarray = array();
                  foreach ($array['to'] as  $key=>$value) {
                    if(!in_array($value['email'], $bouncedEmailID)){
                      $downloadUrl = $this->masterbucket.'/'.$this->getEncryptID(Yii::$app->user->identity->companyID)."/".$this->getEncryptID($value['courseID'])."/certificate/".$value['eid'].".pdf";
                      $url = "<a href='$downloadUrl' download >Download Certificate</a>";
                      $trans = array("<<Logo>>" => "", "<<Student Name>>" => $value['fullname'],  "<<URL>>" => $url, "<<Course Name>>" =>trim($value['courseName']));
                     // $body = strtr($string,$trans);

                      Yii::$app->params['maillogo'] = $logo;
                      $content = strtr($string,$trans);
                      $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                      $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
                    }
                  }
                 $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
                }

              break;



          case 'Announcement':
                if(isset($array['announcementid']) && !empty($array['announcementid'])){
                  $announcement = $array['announcementid'];
                  $annoucDetails = Announcement::findOne($announcement);
                  $courseID = $annoucDetails->courseID;
                  $pushuuid = [];
                  if(!empty($annoucDetails)){
                    $nemail = $annoucDetails->sendEmail;
                    $nsms = $annoucDetails->sendSms;
                    $tdate = date('Y-m-d');
                    if($nemail == 1){
                        //$getsded = Yii::$app->db->createCommand("SELECT user.id,user.email,user.mobile,mobilefcm.code from user_enrollment left join user on user.id = user_enrollment.userID left join mobilefcm on mobilefcm.userID = user.id where user_enrollment.courseID = $courseID and user.status!=2 and user.roleID=3 and user_enrollment.unenrolledDate = '0000-00-00 00:00:00' and user_enrollment.endDate>='$tdate'")->queryAll();
						if($annoucDetails->sentTo == 0){
							$getsded = Yii::$app->db->createCommand("SELECT user.id,user.email,user.mobile,mobilefcm.code from user_enrollment left join user on user.id = user_enrollment.userID left join mobilefcm on mobilefcm.userID = user.id where user_enrollment.courseID = $courseID and user.status!=2 and user.roleID=3 and  user_enrollment.unenrolledDate = '0000-00-00 00:00:00' and user_enrollment.endDate>='$tdate' group by user.id")->queryAll();
						}else{
							$batchID = $annoucDetails->batchID;
							$getsded = Yii::$app->db->createCommand("SELECT user.id,user.email,user.mobile, mobilefcm.code from user_batch left join user on user.id = user_batch.userID left join mobilefcm on mobilefcm.userID = user.id where user_batch.batchID = $batchID and user.status!=2 group by user.id")->queryAll();
						}

                          if(!empty($getsded)){
                             $file = '';
                            if($annoucDetails->fileName != ""){
                              $fileurl = $this->masterbucket."/".$this->getEncryptID(Yii::$app->user->identity->companyID)."/announcement/".$annoucDetails->fileName;
                              $file = "View: <a href='".$fileurl."' download>Attachment</a>";
                            }
                            $bulkarray = array();
                            $subject = $annoucDetails->subject;
                            $bb = '';
                            if(!empty($file)){
                              $bb = $file."<br><br>";
                            }
                            $content = $annoucDetails->description.
                                    '<br><br>'.$bb.'
                            This is an automated email notification for Course Announcements. You can also view the same in Announcements section of your Learning Management System.';
                            //Yii::$app->params['maillogo'] = $logo;
                            //$content = strtr($string,$trans);
                            $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');
                            
                            foreach ($getsded as  $key=>$value) { 
                              if(!empty($value['code'])){
                                $pushuuid[] = $value['code'];
                              }
                              if(!in_array($value['email'], $bouncedEmailID)){
                                $bulkarray['mailingdata'][$key] =  ['email'=>$value['email'],'subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
                              }
                            }
                            if(!empty($pushuuid)){
                              Yii::$app->pushnotification->pushcurl($pushuuid, 'Announcement', $annoucDetails->subject,'announcement',$announcement,'Announcement');
                            }
                            $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
                          }
                      }
                      if($nsms == 1){
                        $batchID = $annoucDetails->batchID;
                        if($annoucDetails->sentTo == 1){
                           $getsded =  Yii::$app->db->createCommand("SELECT user.id, user.email,user.mobile from user_batch left join user on user.id = user_batch.userID where user_batch.batchID = $batchID and user.status!=2 group by user.id")->queryAll();
                        }else{
                          $getsded = Yii::$app->db->createCommand("SELECT user.id,user.email,user.mobile from user_enrollment left join user on user.id = user_enrollment.userID where user_enrollment.courseID = $courseID and user.status!=2 and user.roleID=3 and user_enrollment.unenrolledDate = '0000-00-00 00:00:00' and user_enrollment.endDate>='$tdate' group by user.id")->queryAll();
                        }

                        if(!empty($getsded)){

                          $bal = $array['announcementdetails']['smsbalance'] - count($getsded);
                          $sbid = $array['announcementdetails']['id'];
                            //Yii::$app->db->createCommand("UPDATE license SET smsbalance=$bal WHERE id = $sbid")->execute();
                            $bulksms = array();
                            $message = rawurlencode('Dear Trainee,%n'.$annoucDetails->smsText);
                            foreach ($getsded as $key=>$value) {
                              $mobilenoh[] = $value['mobile'];
                            }
                          $bulksms['sms'][] = array('username' => $this->smsusername, 'hash' => $this->smshash, 'numbers' => implode(',', $mobilenoh), "sender" => $this->smssender, "message" => $message);
                        $this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulksms,'POST');
                        //$this->announcementsms($value['mobile'],$annoucDetails->smsText);
                        }
                      }
                  }
                }
                  break;
        default:
          # code...
          break;
      }

    }

    public function tprequestmail($tpmodel)
    {
      $tp = TrainingProgram::findOne($tpmodel->trainingprogramID);
      if(!empty($tp)){
        $config = Config::find()->where(['companyID'=>$tp->companyID])->one();
        $subject = 'Request: '.$tp->title;
        $fullname = ucfirst($tpmodel->fname).' '.ucfirst($tpmodel->lname);
        $content = "Date: ".date('d-m-Y H:i',strtotime($tpmodel->requestedDate))."<br/>"."Name: ".$fullname."<br/>"."Email: ".$tpmodel->email."<br/>"."Mobile: ".$tpmodel->mobile;

        $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');
        //$body = "Test";
        $sendername = @$config->sendername;
        $senderemail = @$config->senderemail;
        $post_array = array(
            "to"=>'training@care-cart.com',
            "bcc"=>'cart@horizzon.com',
            "body"=>$body,
            "subject"=>$subject,
            "sendername"=>@Yii::$app->user->identity->config->sendername,
            "senderemail"=>@Yii::$app->user->identity->config->senderemail,
        );
        $this->curl_request_async($this->mailserverurl,$post_array,'POST');
      }
    }

  public function curl_request_asyncbulk($url, $post_array, $type='GET')
  {
    $insert = [];

    if(isset($post_array['mailingdata']) && !empty($post_array['mailingdata'])){
      $lastsentID = SentMailDetails::find()->select('mailsentID')->orderBy('id desc')->one();
      $lastsentID = (!empty($lastsentID))?$lastsentID->mailsentID + 1 : 1;
     
      foreach ($post_array['mailingdata'] as $key => $value) {
        $subject = (isset($value['subject']) && !empty($value['subject']) ? $value['subject'] : 'None');
        $body = (isset($value['body']) && !empty($value['body']) ? $value['body'] : 'None');
        $email = $value['email'];

        //$email = 'vicky@horizzon.com';

        $sendername = (isset($value['sendername']) && !empty($value['sendername']) ? $value['sendername'] : 'AlphaLearn LMS');
        $senderemail = (isset($value['senderemail']) && !empty($value['senderemail']) ? $value['senderemail'] : 'noreply@alphalearn.com');

        $insert[] = [$lastsentID,$subject,$body,$email,$sendername,$senderemail,0];
      }
    }


    if(!empty($insert))
    {
        try {
            Yii::$app->db->createCommand()
            ->batchInsert('sent_mail_details', ['mailsentID', 'subject','body','email','sendername','senderemail','status'], $insert)
            ->execute();

            $post_array = ['mailsentID'=>$lastsentID,'server'=>Yii::$app->awsconfig,'ConfigurationSetName'=>$this->ConfigurationSetName];

            $curl = curl_init();     
            curl_setopt($curl, CURLOPT_URL, $this->cronjoburl);
            curl_setopt ($curl, CURLOPT_POST, TRUE);
            curl_setopt ($curl, CURLOPT_POSTFIELDS, $post_array); 
            curl_setopt($curl, CURLOPT_USERAGENT, 'api');
            curl_setopt($curl, CURLOPT_TIMEOUT, 1); 
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl,  CURLOPT_RETURNTRANSFER, false);
            curl_setopt($curl, CURLOPT_FORBID_REUSE, true);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1);
            curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT, 10); 
            curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
            curl_exec($curl);   
            curl_close($curl);

        }catch(\yii\db\Exception $e){
   
        }
    }
    
    if(isset($post_array['sms']) && !empty($post_array['sms'])){
      $curl = curl_init();     
      curl_setopt($curl, CURLOPT_URL, $this->cronjoburl);
      curl_setopt ($curl, CURLOPT_POST, TRUE);
      curl_setopt ($curl, CURLOPT_POSTFIELDS, http_build_query($post_array)); 
      curl_setopt($curl, CURLOPT_USERAGENT, 'api');
      curl_setopt($curl, CURLOPT_TIMEOUT, 1); 
      curl_setopt($curl, CURLOPT_HEADER, 0);
      curl_setopt($curl,  CURLOPT_RETURNTRANSFER, false);
      curl_setopt($curl, CURLOPT_FORBID_REUSE, true);
      curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1);
      curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT, 10); 
      curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
      curl_exec($curl);   
      curl_close($curl);

    }




    /*$post_string = http_build_query($params);
    $parts=parse_url($url);
    $fp = fsockopen($parts['host'],
        isset($parts['port'])?$parts['port']:80,
        $errno, $errstr, 30);
    if('GET' == $type) $parts['path'] .= '?'.$post_string;
    $out = "$type ".$parts['path']." HTTP/1.1\r\n";
    $out.= "Host: ".$parts['host']."\r\n";
    $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
    $out.= "Content-Length: ".strlen($post_string)."\r\n";
    $out.= "Connection: Close\r\n\r\n";
    // Data goes in the request body for a POST request
    if ('POST' == $type && isset($post_string)) $out.= $post_string;
    //print_r($out);
    fwrite($fp, $out);
    $result = '';
    while (!feof($fp)) {
        $result .= fgets($fp, 128);
    }
    //echo $result;
    fclose($fp);*/
  }


        public function mailfunctionality($type=null,$uid=null,$cid=null,$end_date=null,$cmp_id=null,$cc_email=null,$announcement = null,$sms = null,$manullogo = null){

          $bouncedEmailID = array();
          if(isset(Yii::$app->user->identity->config->blockmail) && Yii::$app->user->identity->config->blockmail == 0){
            return false;
            exit;
          }elseif(isset(Yii::$app->user->identity->config->blockmail) && Yii::$app->user->identity->config->blockmail == 1 && Yii::$app->user->identity->roleID == 2){
            /*$mailtracking = Mailtracking::find()->select(['mailtracking.email','mailtracking.status'])->joinWith(['user'])->where(['user.companyID'=>@Yii::$app->user->identity->companyID,'mailtracking.status'=>2,'mailtracking.isSuppression'=>0])->andWhere(['<>','user.status',2])->groupBy('mailtracking.email')->all();
            $bouncedEmailID = array_column($mailtracking, 'email');*/

            /*if(!empty($bouncedEmailID)){
              $per = round(count($bouncedEmailID)/count($mailtracking)*100);
              if($per>=$this->bouncedmaillimit){
                //$this->mailfunctionalityblock();
              }
            }*/
            
          }

            $subject = $string = "";
            $user = User::findOne($uid);
            $course = Courses::find()->joinWith('trainer')->Where(['courses.id'=>$cid])->One();

            
            if(!empty($manullogo)){
              $logo = Yii::$app->myhelper->getHomelogo($cmp_id); 
            }else{
              if($type == 'FreeTrialSignup'){
                $logo = Yii::$app->myhelper->getHomelogo($this->democompanyid); 
              }else{
                $logo = Yii::$app->myhelper->getHomelogo(); 
              }
              
            }
            

            /*if(array_key_exists("companyID",$array)){
              $logo = Yii::$app->myhelper->getHomelogo($array['companyID']);
            }else{
              $logo = Yii::$app->myhelper->getHomelogo();
            }*/


            $serverurl = $this->mailserverurl;
            $reseturl = '';
            if(!empty($user)){
              if($user->companyID == Yii::$app->liccomponent->liccompanyid || $user->companyID == Yii::$app->carecomponent->carecompanyid){
                if($user->companyID == Yii::$app->liccomponent->liccompanyid){
                  $siteurl = Yii::$app->liccomponent->licSiteUrl;
                  $reseturl = $siteurl.'site/setpassword?token=';
                  $bcc = '';
                }else{
                  $siteurl = Yii::$app->carecomponent->careSiteUrl;
                  $bcc = Yii::$app->carecomponent->bcc;
                  $reseturl = $siteurl.'site/setpassword?token=';
                  //$bcc = 'vicky@horizzon.com';
                }
                $config = Config::find()->where(['companyID'=>$user->companyID])->one();
                $sendername = $config->sendername;
                $senderemail = $config->senderemail;
              }else{
                $siteurl = @Yii::$app->user->identity->config->customdomain;
                $sendername = @Yii::$app->user->identity->config->sendername;
                $senderemail = @Yii::$app->user->identity->config->senderemail;
              }

              $to = $user->email;
              $cc = @Yii::$app->user->identity->email;
            }else{
             $to = 'vicky@horizzon.com';
             $cc = 'vickypdh@horizzon.com';
             $bcc = '';
            }
            //$to = 'vicky@horizzon.com';
            /*if(in_array($to, $bouncedEmailID)){
              return false;
              exit;
            }*/

            //$to = 'vicky@horizzon.com';

           /* $to = 'vicky@horizzon.com';
            $cc = 'vickypdh@horizzon.com';*/
            
            $template = CompanyEmailtemplate::find()->where(['title'=>ucfirst($type),'cmpanyID'=>$cmp_id])->one();
          
          if($type!="Announcement"){
            if(empty($template) && empty($announcement))
            {
              $template = EmailTemplates::find()->where(['title'=>ucfirst($type)])->one();
              if(empty($template)){
                echo "Template Not Exist";
                exit;
              }
              $subject = $template->subject;
              $string = html_entity_decode($template->body);
            }else{
              if($template->blockmail == 1){
                return true;
              }
              $subject = $template->subject;
              $string = html_entity_decode($template->body);
            }
          }
           

            switch ($type) {
                case 'CourseEnrollement':
                $url = $siteurl;

                $trans = array("<<Logo>>" => "", "<<Student Name>>" => $user->fullname, "<<URL>>" => $url, "<<Course End>>" => date('d-m-Y',strtotime($end_date)), "<<Course Name>>" => $course->title, "<<Trainer Name>>" => $course->trainer->fullname, "<<Trainer Email>>" => $course->trainer->email);
                //$body = strtr($string,$trans);

                Yii::$app->params['maillogo'] = $logo;
                $content = strtr($string,$trans);
                $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                    if(!empty($cc_email)){
                        $post_array = array(
                            "to"=>$to,
                            "cc"=>$cc,
                            "bcc"=>$bcc,
                            "body"=>$body,
                            "subject"=>$subject,
                            "sendername"=>@Yii::$app->user->identity->config->sendername,
                            "senderemail"=>@Yii::$app->user->identity->config->senderemail,
                        );
                    }else{
                        $post_array = array(
                            "to"=>$to,
                            "body"=>$body,
                            "bcc"=>$bcc,
                            "subject"=>$subject,
                            "sendername"=>@Yii::$app->user->identity->config->sendername,
                            "senderemail"=>@Yii::$app->user->identity->config->senderemail,
                        );
                    }
                    $this->curl_request_async($serverurl,$post_array,'POST');
                    break;
                case 'ResetPassword':
                    
                    //$subject = "Your Password has been Reset.";
                    $resetdate = time();
                    $resettocken = Yii::$app->security->generateRandomString();
                    $update = Yii::$app->db->createCommand("UPDATE user SET status='3',password_reset_token='$resettocken', password_reset_date='$resetdate' WHERE id='$user->id'")->execute();
                    if($update)
                    {
                      if(!empty($reseturl)){
                        // $reset_url =  Html::a(Html::encode('Reset Password'), $reseturl.$resettocken);

                         $reset_url =  Html::a('Reset Password', $reseturl.$resettocken,[]);

                      }else{
                        //$reset_url =  Html::a(Html::encode('Reset Password'), Url::to(['/site/reset', 'token' => $resettocken], true));

                        $reset_url =  Html::a('Reset Password', Url::to(['/site/reset', 'token' => $resettocken], true),[]);

                      }


                      $config = Config::find()->where(['companyID'=>$user->companyID])->one();

                        $trans = array("<<Logo>>" => "", "<<Student Name>>" => $user->fullname,"<<Reset Link>>" => $reset_url, "<<Admin Name>>" => @Yii::$app->user->identity->fullname, "<<Admin Email>>" => @Yii::$app->user->identity->email);
                        //$body = strtr($string,$trans);

                        Yii::$app->params['maillogo'] = $logo;
                        $content = strtr($string,$trans);
                        $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');

                        $post_array = array(
                            "to"=>$to,
                            "body"=>$body,
                            "subject"=>$subject,
                            "sendername"=>@$config->sendername,
                            "senderemail"=>@$config->senderemail,
                        );

                        $this->curl_request_async($serverurl,$post_array,'POST');
                    }
                break;
                case 'UserRegistration':
                if(!empty($reseturl)){
                   $reset_url =  Html::a(Html::encode('Reset Password'), $reseturl.$user->password_reset_token);
                }else{
                  $reset_url =  Html::a(Html::encode('Reset Password'), Url::to(['/site/reset', 'token' => $user->password_reset_token], true));
                }
                $trans = array("<<Logo>>" => "", "<<Student Name>>" => $user->fullname, "<<Student Email>>" => $user->email, "<<Reset Link>>" => $reset_url, "<<Admin Name>>" => @Yii::$app->user->identity->fullname, "<<Admin Email>>" => @Yii::$app->user->identity->email);
                Yii::$app->params['maillogo'] = $logo;
                $content = strtr($string,$trans);
                $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');
                $post_array = array(
                        "to"=>$to,
                        "body"=>$body,
                        "subject"=>$subject,
                        "sendername"=>@Yii::$app->user->identity->config->sendername,
                        "senderemail"=>@Yii::$app->user->identity->config->senderemail,
                    );
                $this->curl_request_async($serverurl,$post_array,'POST');
                break;
                case 'FreeTrialSignup':
                $verifylink = 0;
                $to = $sms;
                    $reset_url =  Html::a('Verify Email & Choose Password', Url::to(['/site/reset', 'token' => $cc_email,'signup'=>true], true),[]);

                    Yii::$app->params['maillogo'] = $this->logo;
                    $trans = array("<<Logo>>" => "", "<<Admin Name>>" => $end_date, "<<Verify Link>>" => $reset_url);

                    $content = strtr($string,$trans);
                    
                    $body = Yii::$app->mailer->render('freetrial',['content'=>$content],'../mail/layouts/withfooter');

                    $post_array = array(
                            "to"=>$to,
                            "bcc"=>'helpdesk@horizzon.com',
                            "body"=>$body,
                            "subject"=>$subject
                        );
                    $this->curl_request_async($serverurl,$post_array,'POST');
                break;

                case 'ResellerNewCompanySignup':
                $verifylink = 0;
                $to = $sms;
                    $reset_url =  Html::a('Verify Email & Choose Password', Url::to(['/site/reset', 'token' => $cc_email,'signup'=>true], true),[]);

                    Yii::$app->params['maillogo'] = $this->logo;
                    $trans = array("<<Logo>>" => "", "<<Admin Name>>" => $end_date, "<<Verify Link>>" => $reset_url);

                    $content = strtr($string,$trans);
                    
                    $body = Yii::$app->mailer->render('freetrial',['content'=>$content],'../mail/layouts/withfooter');

                    $post_array = array(
                            "to"=>$to,
                            "bcc"=>'helpdesk@horizzon.com',
                            "body"=>$body,
                            "subject"=>$subject
                        );
                    $this->curl_request_async($serverurl,$post_array,'POST');
                break;

                case 'UserRegistrationsetpassword':
                
                $trans = array("<<Logo>>" => "", "<<Student Name>>" => $user->fullname, "<<Student Email>>" => $user->email, "<<password>>" => $end_date, "<<siteurl>>" => $siteurl);
               // $body = strtr($string,$trans);
                Yii::$app->params['maillogo'] = $logo;
                $content = strtr($string,$trans);
                $body = Yii::$app->mailer->render('common',['content'=>$content],'../mail/layouts/withoutfooter');
                $post_array = array(
                        "to"=>$to,
                        "body"=>$body,
                        "subject"=>$subject,
                        "sendername"=>$sendername,
                        "senderemail"=>$senderemail,
                    );
                $this->curl_request_async($serverurl,$post_array,'POST');
                break;
                default:
                break;
            }
    }



     public function testmail(){
      $subject = "Warning! Your Email Bounce Rate is High";

      echo $body = Yii::$app->mailer->render('test',[],'../mail/layouts/withoutfooter');
      exit;
      $bulkarray['mailingdata'][0] =  ['email'=>'vicky@horizzon.com','subject'=>$subject,'body'=>$body, 'sendername'=>@Yii::$app->user->identity->config->sendername,'senderemail'=>@Yii::$app->user->identity->config->senderemail];
      //$this->curl_request_asyncbulk($this->bulkSmsEmailURL,$bulkarray,'POST');
    }
    

    public function curl_request_async($url, $post_array, $type='GET')
    {
      if(isset($post_array['to']) && !empty($post_array['to'])){
        $insert = [];
        $lastsentID = SentMailDetails::find()->select('mailsentID')->orderBy('id desc')->one();
        $lastsentID = (!empty($lastsentID))?$lastsentID->mailsentID + 1 : 1;

          $subject = (isset($post_array['subject']) && !empty($post_array['subject']) ? $post_array['subject'] : 'None');
          $body = (isset($post_array['body']) && !empty($post_array['body']) ? $post_array['body'] : 'None');
          $email = $post_array['to'];

          $sendername = (isset($post_array['sendername']) && !empty($post_array['sendername']) ? $post_array['sendername'] : 'AlphaLearn LMS');
          $senderemail = (isset($post_array['senderemail']) && !empty($post_array['senderemail']) ? $post_array['senderemail'] : 'noreply@alphalearn.com');

          //$email = 'vicky@horizzon.com';

          $awsmessageID = \Yii::$app->amazonservices->sendEmail($email,$subject,$body,$sendername,$senderemail);

          $insert[] = [$lastsentID,$subject,$body,$email,$sendername,$senderemail,$awsmessageID,1];

          Yii::$app->db->createCommand()
              ->batchInsert('sent_mail_details', ['mailsentID', 'subject','body','email','sendername','senderemail','awsmessageID','status'], $insert)
              ->execute();

      }

      if(isset($post_array['bcc']) && !empty($post_array['bcc'])){
        $insert = [];
        $lastsentID = SentMailDetails::find()->select('mailsentID')->orderBy('id desc')->one();
        $lastsentID = (!empty($lastsentID))?$lastsentID->mailsentID + 1 : 1;

          $subject = (isset($post_array['subject']) && !empty($post_array['subject']) ? $post_array['subject'] : 'None');
          $body = (isset($post_array['body']) && !empty($post_array['body']) ? $post_array['body'] : 'None');
          $email = $post_array['bcc'];

          $sendername = (isset($post_array['sendername']) && !empty($post_array['sendername']) ? $post_array['sendername'] : 'AlphaLearn LMS');
          $senderemail = (isset($post_array['senderemail']) && !empty($post_array['senderemail']) ? $post_array['senderemail'] : 'noreply@alphalearn.com');

          //$email = 'vicky@horizzon.com';

          $awsmessageID = \Yii::$app->amazonservices->sendEmail($email,$subject,$body,$sendername,$senderemail);

          $insert[] = [$lastsentID,$subject,$body,$email,$sendername,$senderemail,$awsmessageID,1];

          Yii::$app->db->createCommand()
              ->batchInsert('sent_mail_details', ['mailsentID', 'subject','body','email','sendername','senderemail','awsmessageID','status'], $insert)
              ->execute();

      }


      /*if(!empty($insert))
      {
          try {
              Yii::$app->db->createCommand()
              ->batchInsert('sent_mail_details', ['mailsentID', 'subject','body','email','sendername','senderemail','status'], $insert)
              ->execute();
          }catch(\yii\db\Exception $e){
     
          }
      }
*/
      

      //$curl = curl_init();     

      //$post['test'] = 'examples daata'; // our data todo in received
      /*curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt ($curl, CURLOPT_POST, TRUE);
      curl_setopt ($curl, CURLOPT_POSTFIELDS, $post); 
      curl_setopt($curl, CURLOPT_USERAGENT, 'api');
      curl_setopt($curl, CURLOPT_TIMEOUT, 1); 
      curl_setopt($curl, CURLOPT_HEADER, 0);
      curl_setopt($curl,  CURLOPT_RETURNTRANSFER, false);
      curl_setopt($curl, CURLOPT_FORBID_REUSE, true);
      curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1);
      curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT, 10); 
      curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
      curl_exec($curl);   
      curl_close($curl);*/



      /*foreach ($params as $key => &$val) {
        if (is_array($val)) $val = implode(',', $val);
        $post_params[] = $key.'='.urlencode($val);
      }
      $post_string = implode('&', $post_params);

      $parts=parse_url($url);

      $fp = fsockopen($parts['host'],
          isset($parts['port'])?$parts['port']:80,
          $errno, $errstr, 30);
      if('GET' == $type) $parts['path'] .= '?'.$post_string;
      $out = "$type ".$parts['path']." HTTP/1.1\r\n";
      $out.= "Host: ".$parts['host']."\r\n";
      $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
      $out.= "Content-Length: ".strlen($post_string)."\r\n";
      $out.= "Connection: Close\r\n\r\n";
      // Data goes in the request body for a POST request
      if ('POST' == $type && isset($post_string)) $out.= $post_string;
      //print_r($out);
      fwrite($fp, $out);
      while (!feof($fp)) {
           fgets($fp, 128);
      }
      fclose($fp);*/
    }

/*This function use to check connectivity between user and admin*/

    public static function isConnect(){
        
        $result = false;
        if(isset(Yii::$app->user->identity->config->isconnect) && Yii::$app->user->identity->config->isconnect == 0){
            $result = true;
        }
        return $result;

    }

    /*Display User Course Last Seen*/
    public static function getMyLastLogin($ueid){
      $query = "SELECT IF(user_doc_activities_log.outTime,user_doc_activities_log.outTime,user_doc_activities_log.inTime)outTime FROM `user_doc_activities` LEFT JOIN user_doc_activities_log ON user_doc_activities.id = user_doc_activities_log.userActivityID  WHERE user_doc_activities.userEnrollmentID = $ueid ORDER BY  `user_doc_activities_log`.`outTime` LIMIT 1 ";

      $result = Yii::$app->db->createCommand($query)->queryOne();
      if(isset($result) && !empty($result)){
        $result = date("d-m-Y H:i:s",strtotime($result['outTime']));
      }else{
       $result = 'Yet to Login';
      }

      return $result;
    }


    public static function getUserLastLogin($userID){

      $time = "Yet to Login";

      $result = \app\models\Activities::find()->where(['userID'=>$userID])->orderBy(['id'=>SORT_DESC])->one();
      if(isset($result->createdDate) && $result->createdDate != "0000-00-00 00:00:00"){
        $now = date("Y-m-d H:i:s");
        $date1 = date_create($result->createdDate);
        $date2 = date_create($now);
        $diff = date_diff($date1,$date2);
        $time = MyHelpers::getActualDiff($diff);
      }
      return $time;
    }

    public static function getActualDiff($diff){

       $time = "Yet to Login";
       if(!empty($diff)){
        if ($diff->y >0) {
          $time = ($diff->y > 1)?$diff->y." years ago":$diff->y." year ago";
        }elseif ($diff->m >0) {
          $time = ($diff->m > 1)?$diff->m." months ago":$diff->m." month ago";
        }elseif ($diff->d >0) {
          $time = ($diff->d > 1)?$diff->d." days ago":$diff->d." day ago";
        }elseif ($diff->h >0) {
          $time = ($diff->h > 1)?$diff->h." hours ago":$diff->h." hour ago";
        }elseif ($diff->i >0) {
          $time = ($diff->i > 1)?$diff->i." minutes ago":$diff->i." minute ago";
        }else{
          $time = ($diff->s > 1)?$diff->s." seconds ago":$diff->s." second ago";
        }
      }

      return $time;

    }

    public static function getPromptModal($id="",$class="", $headerTitleClass="",$headerTitleID="",$headerTitleText="Confirm",$body="Are you Sure?",$footer="",$yesLabel="Yes",$noLabel="No",$yesClass="btn-primary",$noClass="btn-default",$yesID="",$hideYes=false){

        $html = "<div class='modal fade $class' id='$id' role='dialog'>
        <div class='modal-dialog'><div class='modal-content'>";
          /*header*/

          $html .= "<div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 class='modal-title $headerTitleClass' id='$headerTitleID'>$headerTitleText</h4>
        </div>";

        /*body*/
        $html .= "<div class='modal-body'>$body</div>";

        /*footer*/
        $html .= "<div class='modal-footer'>";
        if($footer == ""){
          $html .= "<button type='button' class='btn $noClass btn-sm' data-dismiss='modal'>$noLabel</button>";
          if($hideYes == false){
            $html .= "<button type='button' id='$yesID' class='btn $yesClass btn-sm' data-dismiss='modal'>$yesLabel</button>";
          }
        }else{
          $html .= $footer;
        }

        $html .= "</div>";
        $html .= "</div></div></div>";

      return $html;
    }

    function getCheckPastQuery($courseID)
    {
      $userID = Yii::$app->user->id;
      $query = "SELECT IF(user_enrollment.endDate < date(now()),'Past','New')readunread FROM `user_enrollment` LEFT JOIN `courses` ON `user_enrollment`.`courseID` = `courses`.`id` LEFT JOIN `user` ON `courses`.`assignTrainer` = `user`.`id` WHERE user_enrollment.unenrolledDate = '0000-00-00 00:00:00' and user_enrollment.userID=$userID and user_enrollment.courseID=$courseID";
      $result = Yii::$app->db->createCommand($query)->queryAll();
      return $result;
      
      
    }

    /*Get Query Read Unread Count*/
    function getQueryReadUnread($courseID){
      $userID = Yii::$app->user->id;
      $query = "SELECT IF(isRead=1,'Read','Unread')readunread,COUNT(id)query from queries WHERE (msgFrom=$userID)  AND courseID=$courseID AND queryReplied=1 AND isRead=0 GROUP BY isRead order by id";
      $result = Yii::$app->db->createCommand($query)->queryAll();
      return $result;
    }

     function getAllQueryReadUnread(){
      $userID = Yii::$app->user->id;
      $query = "SELECT IF(isRead=1,'Read','Unread')readunread,COUNT(id)query from queries WHERE (msgFrom=$userID) AND queryReplied=1 AND isRead=0 GROUP BY isRead order by id";
      $result = Yii::$app->db->createCommand($query)->queryAll();
      return $result;
    }

    /*Get Query Read Unread*/
    function isQueryReaded($id){
      $result = \app\models\Queries::find()->where(['id'=>$id])->one();
      if(!empty($result)){
        if($result->isRead == 0 && $result->queryReplied == 1){
          return true;
        }
      }
      return false;
    }

    function isQueryRead($id){
      $result = \app\models\Queries::find()->where(['id'=>$id])->one();
      // print_r($result->queryReplied);
      // exit;
      if(!empty($result)){
        if($result->queryReplied == 0){
          return true;
        }
      }
      return false;
    }

    /*update to query readed*/
    function updateQueryStatus($id){
      // print_r($id);
      // exit;
      if($this->isQueryReaded($id) == false){
        Yii::$app->db->createCommand()
        ->update('queries', ['isRead' => 1], "(id=$id OR queryRepliedTo=$id)")
        ->execute();
      }
    }

    /*
      Replace Html image and link url with file name for wysiwyg
      use in create 
    */
    public static function replaceHtmlUrlCreate($description){
      $doc = new \DOMDocument();
      //@$doc->loadHTML($description);
      @$doc->loadHTML('<?xml encoding="UTF-8">' . $description);
      $images = $doc->getElementsByTagName('img');
      foreach ($images as $image) {
          $imagepath = $image->getAttribute('src');
          $temp = explode('?', $imagepath);
          $temp = explode('/', $imagepath);
          $newfilename = end($temp);
          if (strpos($newfilename, '_alphalearn_') !== false) { 
              $image->setAttribute('src',$newfilename);
          }
         //$doc->saveHTML();
      }

      $anchors = $doc->getElementsByTagName('a');
      foreach ($anchors as $anchor) {
          $imagepath = $anchor->getAttribute('href');
          $temp = explode('?', $imagepath);
          $temp = explode('/', $imagepath);
          $newfilename = end($temp);
          if (strpos($newfilename, '_alphalearn_') !== false) {
              $anchor->setAttribute('href',$newfilename);
          }
          //$doc->saveHTML();
      }

      //return preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $doc->saveHTML());

      return $doc->saveHTML();
    }

    /* On create and update move local image and files to AWS in wysyiwgy
       remove local file from user id folder
     */
    public static function moveHtmlDocToAws($courseID,$docID,$version)
    {
        $dir = Yii::$app->basePath.'/uploads/temp/'.Yii::$app->user->identity->id;
        if (is_dir($dir)) {
            $files = scandir($dir, 0);
            for($i = 2; $i < count($files); $i++){
                $url = $dir.'/'.$files[$i];
                if (file_exists($url)) {

                    CourseDocuments::uploadHtmlFiles($url,$courseID,$docID,$version,$files[$i]);
                }
                @unlink($url);
            }
        }
    }


    public  function createAwsFolderQuestions($companyID,$courseID,$docid,$qid){
        return $this->getEncryptID($companyID).'/'.$this->getEncryptID($courseID).'/'.$this->getEncryptID($docid).'/'.$this->getEncryptID($qid).'/';
        
    }


    public static function moveQuestionHtmlToAws($courseID,$docID,$qid)
    {
        $dir = Yii::$app->basePath.'/uploads/temp/'.Yii::$app->user->identity->id;
        if (is_dir($dir)) {
            $files = scandir($dir, 0);
            for($i = 2; $i < count($files); $i++){
                $url = $dir.'/'.$files[$i];
                if (file_exists($url)) {

                    CourseDocuments::uploadQuestionHtmlFiles($url,$courseID,$docID,$qid,$files[$i]);
                }
                @unlink($url);
            }
        }
    }

    public static function moveTrainingprogramToAws($tpid)
    {
        $dir = Yii::$app->basePath.'/uploads/temp/'.Yii::$app->user->identity->id;
        if (is_dir($dir)) {
            $files = scandir($dir, 0);
            for($i = 2; $i < count($files); $i++){
                $url = $dir.'/'.$files[$i];
                if (file_exists($url)) {
                    CourseDocuments::uploadTrainingprogramFiles($url,$tpid,$files[$i]);
                }
                @unlink($url);
            }
        }
    }

    public function getCloudFrontTrainingprogramUrl($description,$tpid)
    {
        $doc = new \DOMDocument();
        @$doc->loadHTML($description);
        $images = $doc->getElementsByTagName('img');
        foreach ($images as $image) {
            $imagepath = $image->getAttribute('src');
            $temp = explode('/', $imagepath);
            $newfilename = end($temp);
            if (strpos($newfilename, '_alphalearn_') !== false) {
             $geturl = $this->masterbucket.'/'.$this->getEncryptID(Yii::$app->user->identity->companyID).'/trainingprogram/'.$this->getEncryptID($tpid).'/'.$newfilename;

            // $awsobj = new AmazonServices();
             //$url = $awsobj->getCloudfronturl($geturl, '+20 minute');   
             $image->setAttribute('src',$geturl);
            }
            $doc->saveHTML();
        }


        $anchors = $doc->getElementsByTagName('a');
        foreach ($anchors as $anchor) {
            $imagepath = $anchor->getAttribute('href');
            $temp = explode('/', $imagepath);
            $newfilename = end($temp);
            if (strpos($newfilename, '_alphalearn_') !== false) {
             $geturl = $this->masterbucket.'/'.$this->getEncryptID(Yii::$app->user->identity->companyID).'/trainingprogram/'.$this->getEncryptID($tpid).'/'.$newfilename;
             $anchor->setAttribute('href',$geturl);
            }
            $doc->saveHTML();
        }
        return $doc->saveHTML();
    }

     //convert html file url to cloud front url in wysyiwgy
    public function getCloudFrontHtmlUrl($description,$companyID,$courseID,$docID,$version)
    {
        $doc = new \DOMDocument();
        @$doc->loadHTML($description);
        $images = $doc->getElementsByTagName('img');
        foreach ($images as $image) {
            $imagepath = $image->getAttribute('src');
            $temp = explode('/', $imagepath);
            $newfilename = end($temp);
            if (strpos($newfilename, '_alphalearn_') !== false) {
             $geturl = $this->masterbucket.'/'.$this->createAwsFolderother($companyID,$courseID).$this->getEncryptID($docID).$version.'/'.$newfilename;
            // $awsobj = new AmazonServices();
             //$url = $awsobj->getCloudfronturl($geturl, '+20 minute');   
             $image->setAttribute('src',$geturl);
            }
            $doc->saveHTML();
        }


        $anchors = $doc->getElementsByTagName('a');
        foreach ($anchors as $anchor) {
            $imagepath = $anchor->getAttribute('href');
            $temp = explode('/', $imagepath);
            $newfilename = end($temp);
            if (strpos($newfilename, '_alphalearn_') !== false) {
             $geturl = $this->masterbucket.'/'.$this->createAwsFolderother($companyID,$courseID).$this->getEncryptID($docID).$version.'/'.$newfilename;
             /*$awsobj = new AmazonServices();
             $url = $awsobj->getCloudfronturl($geturl, '+20 minute');   */
             $anchor->setAttribute('href',$geturl);
            }
            $doc->saveHTML();
        }
        return $doc->saveHTML();
    }

    public function getCloudFrontQuestionHtmlUrl($description,$companyID,$courseID,$docID,$qid)
    {
        $doc = new \DOMDocument();
        @$doc->loadHTML($description);
        $images = $doc->getElementsByTagName('img');
        foreach ($images as $image) {
            $imagepath = $image->getAttribute('src');
            $temp = explode('/', $imagepath);
            $newfilename = end($temp);
            if (strpos($newfilename, '_alphalearn_') !== false) {

              $geturl = $this->masterbucket.'/'.Yii::$app->myhelper->createAwsFolderQuestions(Yii::$app->user->identity->companyID,$courseID,$docID,$qid).$newfilename;

             $image->setAttribute('src',$geturl);
            }
            $doc->saveHTML();
        }


        $anchors = $doc->getElementsByTagName('a');
        foreach ($anchors as $anchor) {
            $imagepath = $anchor->getAttribute('href');
            $temp = explode('/', $imagepath);
            $newfilename = end($temp);
            if (strpos($newfilename, '_alphalearn_') !== false) {
             $geturl = $this->masterbucket.'/'.Yii::$app->myhelper->createAwsFolderQuestions(Yii::$app->user->identity->companyID,$courseID,$docID,$qid).$newfilename;
 
             $anchor->setAttribute('href',$geturl);
            }
            $doc->saveHTML();
        }
        return $doc->saveHTML();
    }

    


    public function generateUniqueRandomString($attribute, $length = 14) 
    {
            
    $randomString = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 14);
            
    if(!Transaction::findOne([$attribute => $randomString]))
        return $randomString;
        else
        return $this->generateUniqueRandomString($attribute, $length);          
    }

      /**
 * trims text to a space then adds ellipses if desired
 * @param string $input text to trim
 * @param int $length in characters to trim to
 * @param bool $ellipses if ellipses (...) are to be added
 * @param bool $strip_html if html tags are to be stripped
 * @return string 
 */
  public  function trimText($input, $length, $ellipses = true, $strip_html = true) {
    //strip tags, if desired
      if ($strip_html) {
        $input = strip_tags($input);
      }

    //no need to trim, already shorter than trim length
      if (strlen($input) <= $length) {
        return $input;
      }

    //find last space within length
      $last_space = strrpos(substr($input, 0, $length), ' ');
      $trimmed_text = substr($input, 0, $last_space);

    //add ellipses (...)
      if ($ellipses) {
        $trimmed_text .= '...';
      }

      return $trimmed_text;
    }

  // remove /r/n from ckeditor
  public function removeCkEditorTag($plainText)
  {
    $order   = array("\\r\\n", "\\n", "\\r", "<p>&nbsp;</p>");
    $replace = array(" ", " ", " ", "");
    return str_replace($order, $replace, $plainText); 
  }
  

/****************** Track Activity ******************************/  

  public function activitylog($message,$categories = 'activity')
  {
    if(!Yii::$app->session->get('user.idbeforeswitch')){
      Yii::info($message, $categories); 
    }
  }

  public function activitylogQuery($type,$id,$comment)
  {
    if(!Yii::$app->session->get('user.idbeforeswitch')){
      switch ($type) {
        case 'coursedocument':
          $act = Yii::$app->db->createCommand("SELECT courses.title,course_chapters.name, course_documents.name as cdname from course_documents left join course_chapters on course_chapters.id = course_documents.chapterID left join courses on courses.id = course_chapters.courseID where course_documents.id = $id")->queryOne();
          if(!empty($act)){
              $cnname = $act['title'].' > '.$act['name'].' > '.$act['cdname'];
              $this->activitylog("[".Yii::$app->user->identity->email."] [$cnname] [$comment]");
          }
          break;
        
        case 'coursemodule':
          $act = Yii::$app->db->createCommand("SELECT courses.title,course_chapters.name from course_chapters  left join courses on courses.id = course_chapters.courseID where course_chapters.id = $id")->queryOne();
          if(!empty($act)){
              $cnname = $act['title'].' > '.$act['name'];
              Yii::$app->myhelper->activitylog("[".Yii::$app->user->identity->email."] [$cnname] [$comment]");
          }
          break;


        case 'courseextend':
          $eid = implode(",", $id);
          $act = Yii::$app->db->createCommand("SELECT courses.title,user.email from user_enrollment left join courses on courses.id = user_enrollment.courseID left join user on user.id = user_enrollment.userID where user_enrollment.id in ($eid)")->queryAll();

          if(!empty($act)){
            foreach ($act as  $value) {
              $cnname = $value['email'].' > '.$value['title'];
              Yii::$app->myhelper->activitylog("[".Yii::$app->user->identity->email."] [$cnname] [$comment]");
            }
              
          }
          break;

        case 'courseenrolled':
          $eid = implode(",", $id);
          $act = Yii::$app->db->createCommand("SELECT courses.title,user.email from user_enrollment left join courses on courses.id = user_enrollment.courseID left join user on user.id = user_enrollment.userID where user_enrollment.id in ($eid)")->queryAll();

          if(!empty($act)){
            foreach ($act as  $value) {
              $cnname = $value['email'].' > '.$value['title'];
              Yii::$app->myhelper->activitylog("[".Yii::$app->user->identity->email."] [$cnname] [$comment]");
            } 
          }
          break;

        case 'courseunenrolled':
          $eid = implode(",", $id);
          $act = Yii::$app->db->createCommand("SELECT courses.title,user.email from user_enrollment left join courses on courses.id = user_enrollment.courseID left join user on user.id = user_enrollment.userID where user_enrollment.id in ($eid)")->queryAll();

          if(!empty($act)){
            foreach ($act as  $value) {
              $cnname = $value['email'].' > '.$value['title'];
              Yii::$app->myhelper->activitylog("[".Yii::$app->user->identity->email."] [$cnname] [$comment]");
            } 
          }
          break;

        case 'useraddedbatch':
          $batchid = $id['batchid'];
          $batch = Yii::$app->db->createCommand("SELECT batch.name from batch where batch.id = $batchid")->queryOne();

          $eid = implode(",", $id['userid']);
          $act = Yii::$app->db->createCommand("SELECT user.email from user where user.id in ($eid)")->queryAll();

          if(!empty($act)){
            foreach ($act as  $value) {
              $cnname = $value['email'].' > '.$batch['name'];
              Yii::$app->myhelper->activitylog("[".Yii::$app->user->identity->email."] [$cnname] [$comment]");
            } 
          }
          break;

        case 'userremovedbatch':
          $act = Yii::$app->db->createCommand("SELECT batch.name,user.email from user_batch  left join user on user.id = user_batch.userID left join batch on batch.id = user_batch.batchID where user_batch.id = $id")->queryOne();
          if(!empty($act)){
              $cnname = $act['email'].' > '.$act['name'];
              Yii::$app->myhelper->activitylog("[".Yii::$app->user->identity->email."] [$cnname] [$comment]");
          }
          break;

        case 'courseaddedbatch':
          $act = Yii::$app->db->createCommand("SELECT batch.name,courses.title from batch_courses  left join courses on courses.id = batch_courses.courseID left join batch on batch.id = batch_courses.batchID where user_batch.id = $id")->queryOne();
          if(!empty($act)){
              $cnname = $act['name'].' > '.$act['title'];
              Yii::$app->myhelper->activitylog("[".Yii::$app->user->identity->email."] [$cnname] [$comment]");
          }
          break;

        case 'courseremovedbatch':
          $act = Yii::$app->db->createCommand("SELECT batch.name,courses.title from batch_courses  left join courses on courses.id = batch_courses.courseID left join batch on batch.id = batch_courses.batchID where batch_courses.id = $id")->queryOne();
          if(!empty($act)){
              $cnname = $act['name'].' > '.$act['title'];
              Yii::$app->myhelper->activitylog("[".Yii::$app->user->identity->email."] [$cnname] [$comment]");
          }
          break;

        case 'useraddedbatch':
          $batchid = $id['batchid'];
          $batch = Yii::$app->db->createCommand("SELECT batch.name from batch where batch.id = $batchid")->queryOne();

          $eid = implode(",", $id['userid']);
          $act = Yii::$app->db->createCommand("SELECT user.email from user where user.id in ($eid)")->queryAll();

          if(!empty($act)){
            foreach ($act as  $value) {
              $cnname = $value['email'].' > '.$batch['name'];
              Yii::$app->myhelper->activitylog("[".Yii::$app->user->identity->email."] [$cnname] [$comment]");
            } 
          }
          break;
        case 'announcementsentuser':
          
          $act = Yii::$app->db->createCommand("SELECT user.email from announcementsent  left join user on user.id = announcementsent.userID where announcementsent.announcementID = $id->id")->queryAll();
          
          if(!empty($act)){
            foreach ($act as  $value) {
              $cnname = $value['email'].' > '.$id->subject;
              Yii::$app->myhelper->activitylog("[".Yii::$app->user->identity->email."] [$cnname] [$comment]");
            } 
          }
          break;
        default:
          # code...
          break;
      }
    }
  }
/****************** End Track Activity ******************************/  
//Return assignment score in percentage,marks or grade
public function getScore($type,$tmarks,$umarks,$grades = null)
{
  $per = 0;
  switch ($type) 
  {
    case '1':
    if($umarks != 0)
    {
     $per = round($umarks/$tmarks*100);
   }    
   $per .="%";
   break;
   case '2':
   $per = $umarks;
   break;
   case '3':
   if($umarks != 0)
   {
     $per = round($umarks/$tmarks*100);
   } 
   if($per!=0){
    $az = array('A','B','C','D','E','F');
    $explode = explode(",", $grades);
    $value = "";
    for ($i=0; $i < count($explode); $i++) { 
      if($per>$explode[$i]){
        $value = $explode[$i];
      }
    }  
    if(!empty($value)){
      array_pop($explode);
      $per = $az[array_search($value,array_reverse($explode))];
    }else{
      $per = "F";
    }
  }else{
    $per = "F";
  }
  break;
  default:
  $per .="%";
  break;
}
return $per;
}

}