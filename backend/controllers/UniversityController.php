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
use common\models\Approved;
use common\models\Accredite;
use common\models\Accredited;
use common\models\CourseDetails;
use common\models\search\FacilitySearch;
use common\models\Facility;
use common\models\search\ReviewSearch;
use common\models\Review;
use common\models\CollegeUniversityAdvpurpose;
use common\models\search\CollegeUniversityAdvpurposeSearch;


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

    
    public function actionFacility($id)
    {
        $this->layout= "university";
        $university = $this->findModel($id);

        $searchModel = new FacilitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$university->id,'university');
        
        return $this->render('facility', [
            'university' => $university,
            'dataProvider'=> $dataProvider,
            'searchModel'=> $searchModel,
        ]);
    }

    public function actionFacilityDetails($id,$fid = null)
    {
        $this->layout= "university";
        $university = $this->findModel($id);

         if (($model = Review::findOne(['id'=>$rid])) == null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           \Yii::$app->getSession()->setFlash('success', 'Successfully.');
           return $this->redirect(['facility','id'=>Yii::$app->params['uID'],'type'=>1]);
       }


       return $this->render('facility-details', [
        'model' => $model,
        'university' => $university,
    ]);
   }

    public function actionReview($id){
        $this->layout= "university";
        $university = $this->findModel($id);

        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$university->id,'university');
        
        return $this->render('review', [
            'university' => $university,
            'dataProvider'=> $dataProvider,
            'searchModel'=> $searchModel,
        ]);
    }

    public function actionReviewDetails($id,$rid = null)
    {
        $this->layout= "university";
        $university = $this->findModel($id);

        if (($model = Review::findOne(['id'=>$rid])) == null) {
            $model = new Review();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           \Yii::$app->getSession()->setFlash('success', 'Successfully.');
           return $this->redirect(['review','id'=>$id]);
        }
        return $this->render('review-details', [
            'model' => $model,
            'university' => $university,
        ]);
    }


    public function actionCourseDetails($id)
    {
        $this->layout= "university";
        $universityandcourse = UniversityCollegeCourse::findOne($id);
        Yii::$app->params['uTitle'] = $universityandcourse->university->name;
        Yii::$app->params['uID'] = $universityandcourse->university->id;

        if (($model = CourseDetails::findOne(['uccID'=>$id])) == null) {
            $model = new CourseDetails();
        }
        $model->uccID = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           \Yii::$app->getSession()->setFlash('success', 'Successfully.');
           return $this->redirect(['courses','id'=>Yii::$app->params['uID']]);
       }


       return $this->render('course-details', [
            'model' => $model,
            'universityandcourse' => $universityandcourse,
        ]);
    }

    public function actionAdvertiseMaterials($id)
    {
        $this->layout= "university";
        $university = $this->findModel($id);

        $searchModel = new CollegeUniversityAdvpurposeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$university->id,'university');
        
        return $this->render('advertise-materials', [
            'university' => $university,
            'dataProvider'=> $dataProvider,
            'searchModel'=> $searchModel,
        ]);
    }

    public function actionAdvertiseMaterialsDetails($id,$fid = null)
    {
        $this->layout= "university";
        $university = $this->findModel($id);

        if (($model = CollegeUniversityAdvpurpose::findOne(['id'=>$fid])) == null) {
            $model = new CollegeUniversityAdvpurpose();
        }
        
        $model->coll_univID  = $id;
        $model->type = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           \Yii::$app->getSession()->setFlash('success', 'Successfully.');
           return $this->redirect(['advertise-materials','id'=>Yii::$app->params['uID']]);
       }


       return $this->render('advertise-materials-details', [
        'model' => $model,
        'university' => $university,
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

            $model->approved_by = implode(",",(array) $model->approved_by);
            $model->accredited_by = implode(",",(array) $model->accredited_by);
            
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
            'approved_by' => [],
            'accredited_by' => [],
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
        $approved_by = $accredited_by = [];

        if(!empty($model->approved_by)){

            $approved_by = ArrayHelper::map(Approved::find()->where(new \yii\db\Expression("id IN(".$model->approved_by.")"))->asArray()->all(),'id','name');
            $model->approved_by = explode(",",$model->approved_by);
        }

        if(!empty($model->accredited_by)){

            $accredited_by = ArrayHelper::map(Accredited::find()->where(new \yii\db\Expression("id IN(".$model->accredited_by.")"))->asArray()->all(),'id','name');
            $model->accredited_by = explode(",",$model->accredited_by);
        }

        if ($model->load(Yii::$app->request->post())) {

            $model->approved_by = implode(",",(array) $model->approved_by);
            $model->accredited_by = implode(",",(array) $model->accredited_by);

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
            'approved_by' => $approved_by,
            'accredited_by'=>$accredited_by,
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
        $model = $this->findModel($id);
        $fBasePath = Yii::$app->myhelper->getFileBasePath(1,$model->id);

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


    public function actionDeleteFile($id,$property){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $model = University::findOne($id);
        $filename = $model->$property;
        $model->$property = "";
        if($model->save()){
            $uploadPath = Yii::$app->myhelper->getUploadPath(1,$id);
            @unlink($uploadPath.$filename);
            return ['success'=>false];
        }

    }
    public function actionDeleteGalleryFile($id){
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


    public function actionCourses($id){
        $this->layout= "university";
        $university = $this->findModel($id);

        $searchModel = new UniversityCollegeCourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$university->id,'university');
        
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

    public function actionUniversityList($q = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select(["id", new \yii\db\Expression("name AS text")])
            ->from('university')
            ->where(['like', 'name', $q])
            ->andWhere(['status'=>1])
            ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        return $out;
    }


    public function actionUniversityCourses($q = null,$universityID=null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select(["courses.id", new \yii\db\Expression("courses.name AS text")])
            ->from('courses')
            ->where(['like', 'name', $q]);
            if($universityID != null){
            
                $query->leftJoin("university_college_course","courses.id = university_college_course.courseID ")
                ->andWhere(['university_college_course.universityID'=>$universityID]);
            }
            
            
            $query->andWhere(['courses.status'=>1])
            ->groupBy(['courses.id'])
            ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        return $out;
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
