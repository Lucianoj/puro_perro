<?php

namespace app\controllers;

use Yii;
use app\models\CasosExito;
use app\models\search\CasosExitoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Aviso;
use app\models\Perro;
use yii\web\UploadedFile;

/**
 * CasosExitoController implements the CRUD actions for CasosExito model.
 */
class CasosExitoController extends Controller
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
     * Lists all CasosExito models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CasosExitoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CasosExito model.
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
     * Creates a new CasosExito model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_aviso, $id_perro)
    {
        $model = new CasosExito();
        $modelPerro = Perro::findOne(['id' => $id_perro]);
        $modelAviso = Aviso::findOne(['id' => $id_aviso]);


        if ($model->load(Yii::$app->request->post())) {

            $model->file = UploadedFile::getInstance($model, 'file');
            if($model->file == null) {
                $imageName = 'reencuentro.jpg';
                $model->foto_reencuentro = 'uploads/'.$imageName;
            } else {
                $imageName = $modelPerro->nombre.'_reencuentro';
                $model->file->saveAs('uploads/'.$imageName.'.'.$model->file->extension);
                $model->foto_reencuentro = 'uploads/'.$imageName.'.'.$model->file->extension;
            }


            $modelAviso->estado_aviso_id = 2;
            $modelAviso->save();

            $modelPerro->estado_perro_id = 3;
            $modelPerro->save();

            $model->save();

            return $this->redirect(['aviso/view', 'id' => $modelAviso->id, '$modelCasoExito' => $model]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'modelPerro' => $modelPerro,
                'modelAviso' => $modelAviso,
            ]);
        }
    }

    /**
     * Updates an existing CasosExito model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CasosExito model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CasosExito model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CasosExito the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CasosExito::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
