<?php

namespace backend\controllers;

use Yii;
use common\models\College;
use common\models\University;
use common\models\Courses;
use common\models\search\CollegeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\web\Response;
use yii\bootstrap\ActiveForm;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use common\models\UniversityCollegeCourse;
use common\models\search\UniversityCollegeCourseSearch;
use common\models\CollegeGallery;
use yii\web\UploadedFile;
use common\models\Approved;
use common\models\Accredite;
use common\models\Accredited;
use common\models\Affiliate;
use common\models\CourseDetails;
use yii\helpers\ArrayHelper;
use common\models\search\FacilitySearch;
use common\models\Facility;
use common\models\search\ReviewSearch;
use common\models\Review;
use common\models\CollegeUniversityAdvpurpose;
use common\models\search\CollegeUniversityAdvpurposeSearch;

/**
 * CollegeController implements the CRUD actions for College model.
 */
class CollegeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all College models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CollegeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single College model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout= "college";
        $model = $this->findModel($id);
        $fBasePath = Yii::$app->myhelper->getFileBasePath(2,$model->id);

        if(!empty($model->approved_by)){
            $model->approved_by = ArrayHelper::map(Approved::find()->where(new \yii\db\Expression("id IN(".$model->approved_by.")"))->asArray()->all(),'id','name');
        }else{
            $model->approved_by = [];
        }

        if(!empty($model->accredited_by)){
            $model->accredited_by = ArrayHelper::map(Accredited::find()->where(new \yii\db\Expression("id IN(".$model->accredited_by.")"))->asArray()->all(),'id','name');
        }else{
            $model->accredited_by = [];
        }

        return $this->render('view', [
            'model' => $model,
            'fBasePath'=>$fBasePath
        ]);  
    }


    public function actionCourses($id){
        $this->layout= "college";
        $college = $this->findModel($id);

        $searchModel = new UniversityCollegeCourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$college->id,'college');
        
        return $this->render('courses', [
            'college' => $college,
            'dataProvider'=> $dataProvider,
            'searchModel'=> $searchModel,
        ]);
    }


    public function actionCourseDetails($id,$uccID = null)
    {
        $this->layout= "college";
        $college = $this->findModel($id);
        Yii::$app->params['cTitle'] = $college->name;
        Yii::$app->params['cID'] = $college->id;

        if($uccID==null){
            $uccModel = new UniversityCollegeCourse();
            $model = new CourseDetails();
        }else{
            $uccModel = UniversityCollegeCourse::findOne($uccID);
            $model = CourseDetails::findOne(['uccID'=>$uccModel->id]);
        }
        $university =  $course = [];

        if(!empty($uccModel->universityID)){
            $university = ArrayHelper::map(University::find()->where(['id'=>$uccModel->universityID])->asArray()->all(),'id','name');
        }


        if($uccModel->courseID){
            $course = ArrayHelper::map(Courses::find()->where(['id'=>$uccModel->courseID])->asArray()->all(),'id','name');
        }

        $uccModel->collegeID = $college->id;
        if ($model->load(Yii::$app->request->post()) && $uccModel->load(Yii::$app->request->post())) {
             $uccModel->status = 1;
            if($uccModel->save()){
               $model->uccID =  $uccModel->id;
              
               if($model->save()){
                \Yii::$app->getSession()->setFlash('success', 'Successfully.');
               }else{
                print_r($model);exit;
               }
            }else{
                 print_r($uccModel);exit;
            }
        
         return $this->redirect(['courses','id'=>$college->id]);
        }
        

        return $this->render('course-details', [
            'model' => $model,
            'uccModel'=>$uccModel,
            'college' => $college,
            'university' => $university,
            'course' => $course,
        ]);
    }

    public function actionGallery($id,$type){
        $this->layout= "college";
        $college = $this->findModel($id);
        $fileType = "image";
        $fileList = CollegeGallery::find()->where(['collegeID'=>$college->id,'type'=>$type])->all();
        $allowedFileExtensions = ['jpg','jpeg','png'];
        if($type == 2){
            $fileType = "video";
            $allowedFileExtensions = ['mp4','avi','mkv'];
        }
        $fBasePath = Yii::$app->myhelper->getFileBasePath(2,$college->id,$type);

        return $this->render('gallery', [
            'college' => $college,
            'fileList' => $fileList,
            'type'=> $type,
            'allowedFileExtensions'=> $allowedFileExtensions,
            'fileType'=>$fileType,
            'fBasePath' => $fBasePath
        ]);
    }

    public function actionFileUpload($id,$type)
    {

        if(!empty($id))
        {
            $uploadPath = Yii::$app->myhelper->getUploadPath(2,$id,$type);
            
            $successfiles = [];
            $errorfiles = [];
            FileHelper::createDirectory($uploadPath,0775,true);
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $files = UploadedFile::getInstancesByName('ufiles');

            foreach ($files as $key => $file) {
                $model = new CollegeGallery();
                $model->type = $type;
                $model->collegeID = $id;
                $filename = time().$key;
                $model->url = $filename.'.'.pathinfo($file->name, PATHINFO_EXTENSION);
                $model->status = 1;

                if($model->save()){
                    array_push($successfiles, $file->name);
                    $filePath = $uploadPath.$model->url;
                    if($file->saveAs($filePath)){
                        array_push($successfiles, $file->name);

                        if($type == 2){
                            //-vf scale=300:300
                            $thumbPath = $uploadPath.$filename."-thumb.png";
                            /*C:\\ffmpeg\\bin\\*/
                            $cmd = 'ffmpeg -y -i '.$filePath.' -vframes 1   '.$thumbPath." 2>&1";
                            exec($cmd, $output, $return);
                        }
                    }
                }else{
                   // print_r($model);exit;
                    array_push($errorfiles, $file->name);
                }   
            }
            $message =  "Successfully uploaded Files ".implode(", ", $successfiles);
            $message .=  "<br>Error Files ".implode(", ", $errorfiles);

            return ['success'=>$message];
        }
    }

    public function actionDeleteFile($id,$property){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $model = College::findOne($id);
        $filename = $model->$property;
        $model->$property = "";
        if($model->save()){
            $uploadPath = Yii::$app->myhelper->getUploadPath(2,$id);
            @unlink($uploadPath.$filename);
            return ['success'=>false];
        }

    }
    public function actionDeleteGalleryFile($id){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $file = CollegeGallery::findOne($id);

        if(!empty($file))
        {
            if($file->delete()){
                $uploadPath = Yii::$app->myhelper->getUploadPath(2,$file->collegeID,$file->type);
                @unlink($uploadPath.$file->url);
                if($file->type == 2){
                    @unlink($uplaodPath.pathinfo($file->url, PATHINFO_FILENAME)."-thumb.png");
                }
                return ['success'=>true];
            }
        }
        return ['error'=>true,'msg'=>'Error occured while deleting the file.'];
    }



    public function actionFacility($id)
    {
        $this->layout= "college";
        $college = $this->findModel($id);

        $searchModel = new FacilitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$college->id,'college');
        
        return $this->render('facility', [
            'college' => $college,
            'dataProvider'=> $dataProvider,
            'searchModel'=> $searchModel,
        ]);
    }

    public function actionFacilityDetails($id,$fid = null)
    {
        $this->layout= "college";
        $college = $this->findModel($id);

        if (($model = Facility::findOne(['id'=>$fid])) == null) {
            $model = new Facility();
        }
        
        $model->coll_univID  = $id;
        $model->type = 2;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', 'Successfully.');
            return $this->redirect(['facility','id'=>$college->id,'type'=>2]);
        }

        return $this->render('facility-details', [
            'model' => $model,
            'college' => $college,
        ]);
    }

    /**
     * Creates a new College model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new College();

        if ($model->load(Yii::$app->request->post())) {
            $model->approved_by = implode(",",(array) $model->approved_by);
            $model->accredited_by = implode(",",(array) $model->accredited_by);
            $model->affiliate_to = implode(",",(array) $model->affiliate_to);

            $logoImg = UploadedFile::getInstance($model, 'logoImg');
            if(!empty($logoImg))
            {
                $model->logourl = "logo.".pathinfo($logoImg->name, PATHINFO_EXTENSION);
            }
            if($model->save()){
                $uploadPath = Yii::$app->myhelper->getUploadPath(2,$model->id);
                FileHelper::createDirectory($uploadPath,0775,true);
                 if(!empty($logoImg))
                {
                    $logoImg->saveAs($uploadPath.$model->logourl);
                }
                \Yii::$app->getSession()->setFlash('success', 'Created Successfully.');
            }else{
                \Yii::$app->getSession()->setFlash('error', 'Error occured while creating.');
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'approved_by' => [],
            'accredited_by' => [],
            'affiliate_to'=>[]
        ]);
    }

    /**
     * Updates an existing College model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout= "college";
        $model = $this->findModel($id);
        
        $oldlogoURL = $model->logourl;
        $approved_by = $accredited_by = $affiliate_to = [];
        if(!empty($model->approved_by)){
           
            $approved_by = ArrayHelper::map(Approved::find()->where(new \yii\db\Expression("id IN(".$model->approved_by.")"))->asArray()->all(),'id','name');
            $model->approved_by = explode(",",$model->approved_by);
        }

        if(!empty($model->accredited_by)){
           
            $accredited_by = ArrayHelper::map(Accredited::find()->where(new \yii\db\Expression("id IN(".$model->accredited_by.")"))->asArray()->all(),'id','name');
            $model->accredited_by = explode(",",$model->accredited_by);
        }

        if(!empty($model->affiliate_to)){
           
            $affiliate_to = ArrayHelper::map(Affiliate::find()->where(new \yii\db\Expression("id IN(".$model->affiliate_to.")"))->asArray()->all(),'id','name');
            $model->affiliate_to = explode(",",$model->affiliate_to);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->approved_by = implode(",",(array) $model->approved_by);
            $model->accredited_by = implode(",",(array) $model->accredited_by);
            $model->affiliate_to = implode(",",(array) $model->affiliate_to);

            $uploadPath = Yii::$app->myhelper->getUploadPath(2,$model->id);
            FileHelper::createDirectory($uploadPath,0775,true);
            
            $logoImg = UploadedFile::getInstance($model, 'logoImg');
            if(!empty($logoImg))
            {
                $model->logourl = "logo.".pathinfo($logoImg->name, PATHINFO_EXTENSION);
            }

            if($model->save()){
                if(!empty($logoImg))
                {
                    @unlink($uploadPath.$oldlogoURL);
                    $logoImg->saveAs($uploadPath.$model->logourl);
                }

                \Yii::$app->getSession()->setFlash('success', 'Created Successfully.');
            }else{
                \Yii::$app->getSession()->setFlash('error', 'Error occured while creating.');
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'approved_by' => $approved_by,
            'accredited_by'=>$accredited_by,
            'affiliate_to'=>$affiliate_to
        ]);
    }



     public function actionAdvertiseMaterials($id)
    {
        $this->layout= "college";
        $college = $this->findModel($id);

        $searchModel = new CollegeUniversityAdvpurposeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$college->id,'college');
        
        return $this->render('advertise-materials', [
            'college' => $college,
            'dataProvider'=> $dataProvider,
            'searchModel'=> $searchModel,
        ]);
    }

    public function actionAdvertiseMaterialsDetails($id,$fid = null)
    {
        $this->layout= "college";
        $college = $this->findModel($id);

        if (($model = CollegeUniversityAdvpurpose::findOne(['id'=>$fid])) == null) {
            $model = new CollegeUniversityAdvpurpose();
            $model->scenario = "create";

        }
       
        $model->coll_univID  = $id;
        $model->type = 2;
        $imgPreview = [];
        $oldImg = "";
        $uploadPath = Yii::$app->myhelper->getUploadPath(2,$college->id)."advertisement/";
        $fViewPath= Yii::$app->myhelper->getFileBasePath(2,$college->id)."advertisement/";
        if(!empty($model->url)){
          $imgPreview = [$fViewPath.$model->url];
          $oldImg = $uploadPath.$model->url;
        }
        //print_r($model);exit;
        if ($model->load(Yii::$app->request->post())) {
            $urlImage = UploadedFile::getInstance($model, 'urlImage');

            if(!empty($urlImage))
            {
                $model->url = time().".".pathinfo($urlImage->name, PATHINFO_EXTENSION);
                $model->urlImage = $urlImage->name;
            }
            if($model->save()){
                
                FileHelper::createDirectory($uploadPath,0777,true);
                if(!empty($urlImage))
                {
                    $urlImage->saveAs($uploadPath.$model->url);
                    if($oldImg != ""){
                        @unlink($oldImg);
                    }
                }
            }
           \Yii::$app->getSession()->setFlash('success', 'Successfully.');
           return $this->redirect(['advertise-materials','id'=>$college->id]);
        }


        return $this->render('advertise-materials-details', [
            'model' => $model,
            'college' => $college,
            'imgPreview'=>$imgPreview,
        ]);
     }

    public function actionReview($id){
        $this->layout= "college";
        $college = $this->findModel($id);

        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$college->id,'college');
        
        return $this->render('review', [
            'college' => $college,
            'dataProvider'=> $dataProvider,
            'searchModel'=> $searchModel,
        ]);
    }

    public function actionReviewDetails($id,$rid = null)
    {
        $this->layout= "college";
        $college = $this->findModel($id);

        $model = Review::findOne(['id'=>$rid]);    
        if (($model = Review::findOne(['id'=>$rid])) == null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           \Yii::$app->getSession()->setFlash('success', 'Successfully.');
           return $this->redirect(['review','id'=>$id]);
       }


       return $this->render('review-details', [
            'model' => $model,
            'college' => $college,
        ]);
    }

    /**
     * Deletes an existing College model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the College model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return College the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = College::findOne($id)) !== null) {
            Yii::$app->params['cTitle'] = $model->name;
            Yii::$app->params['cID'] = $model->id;
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionValidate($id = "")
    {
     if($id != "")
     {
        $model = $this->findModel($id);  
    }else{
        $model = new College();
    }

    if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ActiveForm::validate($model);
    }
}
}
