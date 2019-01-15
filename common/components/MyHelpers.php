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

  }
}
