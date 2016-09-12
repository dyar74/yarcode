<?php

namespace backend\controllers;

use Yii;
use common\models\Portfolio;
use backend\models\PortfolioSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * PortfolioController implements the CRUD actions for Portfolio model.
 */
class PortfolioController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'create', 'update', 'delete','view', 'upload'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all Portfolio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PortfolioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Portfolio model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Portfolio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Portfolio();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Portfolio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Portfolio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /** Upload porfolio decriptons image files
     *
     */


    public function actionUpload()
    {

        $uploadedFile = UploadedFile::getInstanceByName('upload');

        $mime = FileHelper::getMimeType($uploadedFile->tempName);
        $file = time()."_".$uploadedFile->name;

        $url = Yii::$app->params['frontend_base_url'] . '/img/portfolio/description/' . $file;

        $uploadPath =Yii::getAlias('@frontend') .'/web/img/portfolio/description/' . $file;
        //extensive suitability check before doing anything with the file…
        if ($uploadedFile==null)
        {
            $message = "No file uploaded.";
        }
        else if ($uploadedFile->size == 0)
        {
            $message = "The file is of zero length.";
        }
        else if ($mime!="image/jpeg" && $mime!="image/png")
        {
            $message = "The image must be in either JPG or PNG format. Please upload a JPG or PNG instead.";
        }
        else if ($uploadedFile->tempName==null)
        {
            $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
        }
        else {
            $message = "";
            $move = $uploadedFile->saveAs($uploadPath);
            if(!$move)
            {
                $message = "Error moving uploaded file. Check the script is granted Read/Write/Modify permissions.";
            }
        }
        $funcNum = $_GET['CKEditorFuncNum'] ;
        $CKEditor = $_GET['CKEditor'] ;
        // Optional: might be used to provide localized messages.
        $langCode = $_GET['langCode'] ;

        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
    }

    /**
     * Finds the Portfolio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Portfolio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Portfolio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
