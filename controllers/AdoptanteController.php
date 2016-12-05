<?php

namespace app\controllers;

use Yii;
use app\models\Adoptante;
use app\models\search\AdoptanteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;

/**
 * AdoptanteController implements the CRUD actions for Adoptante model.
 */
class AdoptanteController extends Controller
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
     * Lists all Adoptante models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdoptanteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Adoptante model.
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
     * Creates a new Adoptante model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($user_id = 0)
    {
        $model = new Adoptante();
        $modelUser = User::findOne(['id' => $user_id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['user/view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'user_id' => $user_id,
                'modelUser' => $modelUser,
            ]);
        }
    }

    /**
     * Updates an existing Adoptante model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($user_id)
    {

        $model = $this->findModel(['user_id' => $user_id]);
        $modelUser = User::findOne(['id' => $user_id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['user/view', 'id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'user_id' => $user_id,
                'modelUser' => $modelUser,
            ]);
        }
    }

    /**
     * Deletes an existing Adoptante model.
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
     * Finds the Adoptante model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Adoptante the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Adoptante::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
