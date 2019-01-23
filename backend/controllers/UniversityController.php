<?php

namespace backend\controllers;

use Yii;
use common\models\University;
use common\models\Courses;
use common\models\search\UniversitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use common\models\UniversityCollegeCourse;
use common\models\search\UniversityCollegeCourseSearch;
use yii\db\Query;
use yii\bootstrap\ActiveForm;
use common\models\UniversityGallery;

/**
 * UniversityController implements the CRUD actions for University model.
 */
class UniversityController extends Controller
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
     * Lists all University models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UniversitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Creates a new University model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new University();

        if ($model->load(Yii::$app->request->post())) {
            

            $bannerImg = UploadedFile::getInstance($model, 'bannerImg');
            if(!empty($bannerImg))
            {
                $model->bannerURL = "banner.".pathinfo($bannerImg->name, PATHINFO_EXTENSION);
            }

            $brochureFile = UploadedFile::getInstance($model, 'brochureFile');
            if(!empty($brochureFile))
            {
                $model->brochureurl = "brochure.".pathinfo($brochureFile->name, PATHINFO_EXTENSION);
            }
            
            $logoImg = UploadedFile::getInstance($model, 'logoImg');
            if(!empty($logoImg))
            {
                $model->logourl = "logo.".pathinfo($logoImg->name, PATHINFO_EXTENSION);
            }

            if($model->save()){
                $uploadPath = Yii::$app->myhelper->getUploadPath(1,$model->id);
                FileHelper::createDirectory($uploadPath,0775,true);
                if(!empty($bannerImg))
                {
                    $bannerImg->saveAs($uploadPath.$model->bannerURL);
                }
                if(!empty($brochureFile))
                {
                    $brochureFile->saveAs($uploadPath.$model->brochureurl);
                }

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
        ]);
    }

    /**
     * Updates an existing University model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout= "university";
        $model = $this->findModel($id);
        $oldbannerURL = $model->bannerURL;
        $oldbrochureURL = $model->brochureurl;
        $oldlogoURL = $model->logourl;

        if ($model->load(Yii::$app->request->post())) {
            
            $uploadPath = Yii::$app->myhelper->getUploadPath(1,$model->id);
            FileHelper::createDirectory($uploadPath,0775,true);

            $bannerImg = UploadedFile::getInstance($model, 'bannerImg');
            
            if(!empty($bannerImg))
            {

                $model->bannerURL = "banner.".pathinfo($bannerImg->name, PATHINFO_EXTENSION);
            }

            $brochureFile = UploadedFile::getInstance($model, 'brochureFile');
            if(!empty($brochureFile))
            {
                $model->brochureurl = "brochure.".pathinfo($brochureFile->name, PATHINFO_EXTENSION);
            }
            
            $logoImg = UploadedFile::getInstance($model, 'logoImg');
            if(!empty($logoImg))
            {
                $model->logourl = "logo.".pathinfo($logoImg->name, PATHINFO_EXTENSION);
            }

            if($model->save()){
                if(!empty($bannerImg))
                {
                    @unlink($uploadPath.$oldbannerURL);
                    $bannerImg->saveAs($uploadPath.$model->bannerURL);
                }
                if(!empty($brochureFile))
                {
                    @unlink($uploadPath.$oldbrochureURL);
                    $brochureFile->saveAs($uploadPath.$model->brochureurl);
                }

                if(!empty($logoImg))
                {
                    @unlink($uploadPath.$oldlogoURL);
                    $logoImg->saveAs($uploadPath.$model->logourl);
                }

                \Yii::$app->getSession()->setFlash('success', 'Updated Successfully.');
            }else{
                \Yii::$app->getSession()->setFlash('error', 'Error occured while update.');
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single University model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout= "university";
        $university = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionGallery($id,$type){
        $this->layout= "university";
        $university = $this->findModel($id);

        $uID = Yii::$app->myhelper->getEncryptID($id);
        $fileType = "image";

        $fileList = UniversityGallery::find()->where(['universityID'=>$university->id,'type'=>$type])->all();
        $allowedFileExtensions = ['jpg','jpeg','png'];
        if($type == 2){
            $fileType = "video";
            $allowedFileExtensions = ['mp4','avi','mkv'];
        }
        $fBasePath = Yii::$app->myhelper->getFileBasePath(1,$university->id,$type);

        return $this->render('gallery', [
            'university' => $university,
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
            $uploadPath = Yii::$app->myhelper->getUploadPath(1,$id,$type);
            
            $successfiles = [];
            $errorfiles = [];
            FileHelper::createDirectory($uploadPath,0775,true);
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $files = UploadedFile::getInstancesByName('ufiles');

            foreach ($files as $key => $file) {
                $model = new UniversityGallery();
                $model->type = $type;
                $model->universityID = $id;
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

    public function actionDeleteFile($id){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $file = UniversityGallery::findOne($id);
        if(!empty($file))
        {

            if($file->delete()){
                $uploadPath = Yii::$app->myhelper->getUploadPath(1,$file->universityID,$file->type);
                @unlink($uploadPath.$file->url);
                if($file->type == 2){
                    @unlink($uplaodPath.pathinfo($file->url, PATHINFO_FILENAME)."-thumb.png");
                }
                return ['success'=>true];
            }
        }
        return ['error'=>true,'msg'=>'Error occured while deleting the file.'];
    }



    public function actionReview($id){
        $this->layout= "university";
        $university = $this->findModel($id);
        return $this->render('gallery', [
            'university' => $university,
        ]);
    }


    public function actionCourses($id){
        $this->layout= "university";
        $university = $this->findModel($id);

        $searchModel = new UniversityCollegeCourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$university->id);
        
        return $this->render('courses', [
            'university' => $university,
            'dataProvider'=> $dataProvider,
            'searchModel'=> $searchModel,
        ]);
    }
    public function actionAddCourses($id){
        $this->layout= "university";
        $university = $this->findModel($id);
        $courses = ArrayHelper::map(Courses::find()->where(['status'=>1])->all(),'id','name');
        $ucmodel = new UniversityCollegeCourse();
        $ucmodel->scenario = UniversityCollegeCourse::SCENARIO_UC_CREATE;


        $oldCourses = ArrayHelper::getColumn(UniversityCollegeCourse::find()->where(['universityID'=>$university->id])->asArray()->all(),'courseID');


        
        $ucmodel->courseID = $oldCourses;

        $ucmodel->universityID = $university->id;

        if ($ucmodel->load(Yii::$app->request->post())) {

            $newCourse = array_diff((array)$ucmodel['courseID'], (array)$oldCourses);

            $deletedCourse = array_diff((array)$oldCourses,(array)$ucmodel['courseID']);    
            foreach ($newCourse as $key => $courseID) {
                $nucmodel = new UniversityCollegeCourse();
                $nucmodel->universityID = $university->id;
                $nucmodel->courseID = $courseID;
                $nucmodel->status = 1;
                if(!$nucmodel->save()){
                    //print_r($nucmodel);exit;
                }    
            }

            if(!empty($deletedCourse))
            {
                UniversityCollegeCourse::deleteAll(['universityID' => $university->id, 'courseID' =>  array_values($deletedCourse)]);
            }

            \Yii::$app->getSession()->setFlash('success', 'Courses successfully added in university '.$university->name.".");
            
            return $this->redirect(['courses','id'=>$university->id]);
        }

        
        return $this->render('add_courses', [
            'university' => $university,
            'courses'=>$courses,
            'ucmodel' => $ucmodel,
        ]);
    }

    /**
     * Deletes an existing University model.
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
     * Finds the University model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return University the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = University::findOne($id)) !== null) {
            Yii::$app->params['uTitle'] = $model->name;
            Yii::$app->params['uID'] = $model->id;
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
        $model = new University();
    }

    if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ActiveForm::validate($model);
    }
}

}
