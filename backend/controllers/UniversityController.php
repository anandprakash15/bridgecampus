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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', 'Created Successfully.');
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', 'Updated Successfully.');
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
        $fBasePath = '../../uploads/'.$uID."/images/";

        $fileList = UniversityGallery::find()->where(['universityID'=>$university->id,'type'=>$type])->all();
        $allowedFileExtensions = ['jpg','jpeg','png'];
        if($type == 2){
            $fileType = "video";
            $fBasePath = '../../uploads/'.$uID."/videos/";
            $allowedFileExtensions = ['mp4','avi','mkv'];
        }
    
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
        
        $uID = Yii::$app->myhelper->getEncryptID($id);
        if(!empty($uID))
        {
            if($type == 1)
            {
                $uplaodPath = Yii::getAlias('@backend') .'/uploads/'.$uID."/images/";
            }
            if($type == 2)
            {
                $uplaodPath = Yii::getAlias('@backend') .'/uploads/'.$uID."/videos/";
            }
            
            $successfiles = [];
            $errorfiles = [];
            FileHelper::createDirectory($uplaodPath,0775,true);
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
                    $filePath = $uplaodPath.$model->url;
                    if($file->saveAs($filePath)){
                        array_push($successfiles, $file->name);

                        if($type == 2){
                            //-vf scale=300:300
                            $thumbPath = $uplaodPath.$filename."-thumb.png";
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
        $ucmodel = new UniversityCourse();
        $ucmodel->scenario = UniversityCourse::SCENARIO_UC_CREATE;


        $oldCourses = ArrayHelper::getColumn(UniversityCourse::find()->where(['universityID'=>$university->id])->asArray()->all(),'courseID');
        
        $ucmodel->courseID = $oldCourses;

        $ucmodel->universityID = $university->id;

        if ($ucmodel->load(Yii::$app->request->post())) {

            $newCourse = array_diff((array)$ucmodel['courseID'], (array)$oldCourses);

            $deletedCourse = array_diff((array)$oldCourses,(array)$ucmodel['courseID']);    
            foreach ($newCourse as $key => $courseID) {
                $nucmodel = new UniversityCourse();
                $nucmodel->universityID = $university->id;
                $nucmodel->courseID = $courseID;
                $nucmodel->save();    
            }

            if(!empty($deletedCourse))
            {
                UniversityCourse::deleteAll(['universityID' => $university->id, 'courseID' =>  array_values($deletedCourse)]);
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
