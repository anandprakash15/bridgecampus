<?php

namespace backend\controllers;

use Yii;
use common\models\AdvertiseBanner;
use common\models\search\AdvertiseBannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * AdvertiseBannerController implements the CRUD actions for AdvertiseBanner model.
 */
class AdvertiseBannerController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all AdvertiseBanner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout= "advertise";
        $searchModel = new AdvertiseBannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdvertiseBanner model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdvertiseBanner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout= "advertise";
        $model = new AdvertiseBanner();

        if ($model->load(Yii::$app->request->post())) {
            $model->date_from = date('Y-m-d',strtotime($model->date_from));
            $model->to_date = date('Y-m-d',strtotime($model->to_date));

            $instituteImg = UploadedFile::getInstance($model, 'image');
            if(!empty($instituteImg))
            {
                $model->image = $instituteImg->name;;
            }

            if($model->save()) {
                $uploadPath = Yii::$app->myhelper->getUploadPath(2,$model->id);
                FileHelper::createDirectory($uploadPath,0775,true);
                if(!empty($instituteImg))
                {
                    $instituteImg->saveAs($uploadPath.$model->image);
                }
                \Yii::$app->getSession()->setFlash('success', 'Successfully.');
                return $this->redirect(['index']);
            } else {
                print_r($model->getErrors());
                exit();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AdvertiseBanner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
                $model->date_from = date('Y-m-d',strtotime($model->date_from));
                $model->to_date = date('Y-m-d',strtotime($model->to_date));

                $instituteImg = UploadedFile::getInstance($model, 'image');
                if(!empty($instituteImg))
                {
                    $model->image = $instituteImg->name;;
                }
                if($model->save()) {
                    $uploadPath = Yii::$app->myhelper->getUploadPath(2,$model->id);
                    FileHelper::createDirectory($uploadPath,0775,true);
                    if(!empty($instituteImg))
                    {
                        $instituteImg->saveAs($uploadPath.$model->image);
                    }
                    \Yii::$app->getSession()->setFlash('success', 'Successfully.');
                    return $this->redirect(['index']);
                }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AdvertiseBanner model.
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
     * Finds the AdvertiseBanner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdvertiseBanner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdvertiseBanner::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
