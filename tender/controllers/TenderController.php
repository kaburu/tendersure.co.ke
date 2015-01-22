<?php

namespace app\controllers;

use Yii;
use app\models\Tender;
use app\models\TenderSearch;
use app\models\Category;
use app\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * TenderController implements the CRUD actions for Tender model.
 */
class TenderController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['create', 'update', 'uploadfile', 'index', 'deletefile'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tender models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TenderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tender model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionUploadfile($id) {
        $model = $this->findModel($id);        
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        $files = \yii\web\UploadedFile::getInstances($model, 'tenderfile');
        $rtnar = [];
        foreach ($files as $file):
            $f = new \app\models\File;
//        $file
            $fileModel = \mdm\upload\FileModel::saveAs($file, $model->uuid, '../upload');
//            $model->fileid = $fileModel->id;
//            $model->save();
            $f->name = $file->name;
            $f->size = $file->size;
            $f->url = \yii\helpers\Url::to(['/file', 'id' => $model->fileid]);
//            $f->thumbnailUrl = $f->url;
            $rtnar[]=$f;
        endforeach;
//            }
//        }

        return json_encode(['files'=>$rtnar]);
//        \yii\helpers\Url::to(['/file', 'id' => $model->file_id]);
    }
    
    
    public function actionDeletefile($id) {
        $model = $this->findModel($id);        
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        $files = \yii\web\UploadedFile::getInstances($model, 'tenderfile');
        $rtnar = [];
        foreach ($files as $file):
            $f = new \app\models\File;
            $fileModel = \mdm\upload\FileModel::saveAs($file, '../upload');
            $model->fileid = $fileModel->id;
            $model->save();
            $f->name = $file->name;
            $f->size = $file->size;
            $f->url = \yii\helpers\Url::to(['/file', 'id' => $model->fileid]);
//            $f->thumbnailUrl = $f->url;
            $rtnar[]=$f;
        endforeach;
//            }
//        }

        return json_encode(['files'=>$rtnar]);
//        \yii\helpers\Url::to(['/file', 'id' => $model->file_id]);
    }

    /**
     * Creates a new Tender model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Tender();
        $model->uuid = strval(intval(microtime(true)));

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uuid]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddcategory($id) {
        $model = new Category();
        $model->tenderuuid = $id;
        $command = Yii::$app->db->createCommand("select ifnull(max(categorynumber),0) as categorynumber from category where tenderuuid = '" . $id . "'");
        $result = $command->queryAll();
        $model->categorynumber = $result[0]['categorynumber'] + 1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('_addcategory', [
                        'model' => $model,
            ]);
        }
    }
    
    public function actionBidders($id) {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);

        return $this->render('tenderbidder', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Tender model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uuid]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tender model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tender model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Tender the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Tender::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
