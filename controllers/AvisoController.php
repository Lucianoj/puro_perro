<?php

namespace app\controllers;

use app\models\ContactarForm;
use app\models\User;
use Yii;
use app\models\Perro;
use app\models\Aviso;
use app\models\search\AvisoSearchAdvanced;
use app\models\search\AvisoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ReportForm;
use yii\web\UploadedFile;

/**
 * AvisoController implements the CRUD actions for Aviso model.
 */
class AvisoController extends Controller
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
     * Lists all Aviso models.
     * @return mixed
     */
    public function actionIndex($tipo = 0, $id = 0)
    {
        if(isset($_GET['AvisoSearch']['busqueda_avanzada'])) {
            $busqueda_avanzada = $_GET['AvisoSearch']['busqueda_avanzada'];
        }else{
            $busqueda_avanzada = 0;
        }
        if ($tipo == 0 && $id == 0) {
            $searchModel =  new AvisoSearch(['busqueda_avanzada' => $busqueda_avanzada]);
        } else {
            if ($tipo != 0 && $id == 0)
                $searchModel = new AvisoSearch(['tipo_aviso_id' => $tipo, 'estado_aviso_id' => 1]);
            elseif ($tipo == 0 && $id != 0)
                $searchModel = new AvisoSearch(['created_by' => $id]);
            else
                $searchModel = new AvisoSearch(['tipo_aviso_id' => $tipo, 'created_by' => $id, 'estado_aviso_id' => 1]);
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tipo' => $tipo,
            'id' => $id,
        ]);
    }

    /**
     * Lists all Aviso models.
     * @return mixed
     */
    public function actionBusqueda()
    {
        $searchModel = new AvisoSearch(['busqueda_avanzada' => true]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('_search_advanced', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /** Lists all Aviso models of user.
    * @return mixed
    */
    public function actionIndexAdmin($estado = 0)
    {

        $searchModel = $estado == 0 ? new AvisoSearch() : new AvisoSearch(['estado_aviso_id' => $estado]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexAdmin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'estado' => $estado,
        ]);
    }

    /**
     * Displays a single Aviso model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelPerro = Perro::findOne(['id' => $model->perro_id]);
        $modelUser = User::findOne(['id' => $model->created_by]);
        return $this->render('view', [
            'model' => $model,
            'modelPerro' => $modelPerro,
            'modelUser' => $modelUser,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Gracias por contactarnos. Le responderemos tan pronto como sea posible.');
            } else {
                Yii::$app->session->setFlash('error', 'Hubo un error enviando el mail.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single Aviso model.
     * @param integer $id
     * @return mixed
     */
    public function actionReport($id)
    {
        $model = new ReportForm();
        $modelAviso = $this->findModel($id);
        $modelPerro = Perro::findOne(['id' => $modelAviso->perro_id]);
        $modelUser = User::findOne(['id' => $modelAviso->created_by]);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->user_id = $modelUser->id;
            $model->email = $modelUser->email;
            $model->aviso_id = $modelAviso->id;
            $model->contact(Yii::$app->params['adminEmail']);
            $modelAviso->estado_aviso_id = 3; // 3 = Reportado
            $modelAviso->save();
            $this->redirect(['aviso/view', 'id' => $modelAviso->id]);

        } else {
            return $this->render('report_form', [
                'model' => $model,
                'modelAviso' => $modelAviso,
                'modelPerro' => $modelPerro,
                'modelUser' => $modelUser,
            ]);
        }
    }

    /**
     * Displays a single Aviso model.
     * @param integer $id
     * @return mixed
     */
    public function actionContactar($id)
    {
        $model = new ContactarForm();
        $modelAviso = $this->findModel($id);
        $modelPerro = Perro::findOne(['id' => $modelAviso->perro_id]);
        $modelUser = User::findOne(['id' => $modelAviso->created_by]);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->user_id = $modelUser->id;
            $model->email = $modelUser->email;
            $model->aviso_id = $modelAviso->id;
            $model->contact();
            $this->redirect(['aviso/view', 'id' => $id]);
        } else {
            return $this->render('contactar_form', [
                'model' => $model,
                'modelAviso' => $modelAviso,
                'modelPerro' => $modelPerro,
                'modelUser' => $modelUser,
            ]);
        }
    }

    private function ordenarFechaParaGuardar($fecha) {
        //Si la fecha es la de la base, debera ser YYYY-MM-DD
        $separador = '-';
        $auxFechaDia = substr($fecha, 0, 2);
        $auxFechaMes = substr($fecha, 3, 2);
        $auxFechaAnio = substr($fecha, 6, 4);

        // devuelve dd/mm/aaaa HH:MM
        return $auxFechaAnio.$separador.$auxFechaMes.$separador.$auxFechaDia;
    }

    /**
     * Creates a new Aviso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tipo_aviso = 0)
    {
        $model = new Aviso();
        $modelPerro = new Perro();

        if ($model->load(Yii::$app->request->post())) {

            $model->estado_aviso_id = 1; // 1 = Abierto
            if (($model->fecha_evento == '') or ($model->fecha_evento == null)) {
                $model->fecha_evento = date('Y-m-d');
             } else {
                $model->fecha_evento = $this->ordenarFechaParaGuardar($model->fecha_evento);
            }
            $model->save();
            $modelPerro->load(Yii::$app->request->post());

            $modelPerro->file = UploadedFile::getInstance($modelPerro, 'file');
            if($modelPerro->file == null) {
                $imageName = 'dog_without_name.png';
                $modelPerro->foto = 'uploads/'.$imageName;
            } else {
                $imageName = $modelPerro->nombre;
                $modelPerro->file->saveAs('uploads/'.$imageName.'.'.$modelPerro->file->extension);
                $modelPerro->foto = 'uploads/'.$imageName.'.'.$modelPerro->file->extension;
            }

            switch ($model->tipo_aviso_id) {
                case 1: {
                    $modelPerro->estado_perro_id = 1; // Perdido
                    break;
                }
                case 2:{
                    $modelPerro->estado_perro_id = 2; // Encontrado
                    break;
                }
                case 3:{
                    $modelPerro->estado_perro_id = 5; // Adopción
                    break;
                }
            }
            $modelPerro->created_at = $model->created_at;
            $modelPerro->created_by = $model->created_by;
            $modelPerro->updated_at = $model->updated_at;
            $modelPerro->updated_by = $model->updated_by;

            $ok = $modelPerro->validate();
            $ok = $ok && $modelPerro->save();

            $model->perro_id = $modelPerro->id;
            $ok = $ok && $model->validate();
            $ok = $ok && $model->save();
            return $ok? $this->redirect(['view', 'id' => $model->id]): $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelPerro' => (empty($modelPerro)) ? [new Perro] : $modelPerro,
                'tipo_aviso' => $tipo_aviso,
            ]);
        }
    }

    /**
     * Updates an existing Aviso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelPerro = Perro::findOne(['id' => $model->perro_id]);
        $foto = $modelPerro->foto;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelPerro->load(Yii::$app->request->post());

            $model->fecha_evento = $this->ordenarFechaParaGuardar($model->fecha_evento);

            $modelPerro->file = UploadedFile::getInstance($modelPerro, 'file');
            if($modelPerro->file == null) {
                if($foto == null) {
                    $imageName = 'dog_without_name.png';
                    $modelPerro->foto = 'uploads/'.$imageName;
                }
            } else {
                $imageName = $modelPerro->nombre;
                $modelPerro->file->saveAs('uploads/'.$imageName.'.'.$modelPerro->file->extension);
                $modelPerro->foto = 'uploads/'.$imageName.'.'.$modelPerro->file->extension;
            }

            switch ($modelPerro->estado_perro_id) {
                case 3:{ // 3 = reencontrado con su dueño
                    if($model->tipo_aviso_id == 1 || $model->tipo_aviso_id == 2)
                    $model->estado_aviso_id = 2; // 2 = cerrado
                    break;
                }
                case 6:{ // 6 = Adoptado
                    if($model->tipo_aviso_id == 3)
                        $model->estado_aviso_id = 2; // 2 = cerrado
                    break;
                }
                default: break;
            }
            $modelPerro->updated_at = $model->updated_at;
            $modelPerro->updated_by = $model->updated_by;


            $ok = $modelPerro->validate();
            $ok = $ok && $modelPerro->save();

            $model->perro_id = $modelPerro->id;
            $ok = $ok && $model->validate();
            $ok = $ok && $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelPerro' => $modelPerro,
                'tipo_aviso' => $model->tipo_aviso_id,
            ]);
        }
    }

    /**
     * Deletes an existing Aviso model.
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
     * Finds the Aviso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aviso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aviso::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetDataGoogleMaps($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        echo curl_exec($ch);
    }
}
