<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Acciones;
use app\modules\admin\models\AccionesSearch;
use app\components\AitController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccionesController implements the CRUD actions for Acciones model.
 */
class AccionesController extends AitController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Acciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Acciones model.
     * @param integer $id_accion
     * @param integer $id_controlador
     * @return mixed
     */
    public function actionView($id_accion, $id_controlador)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_accion, $id_controlador),
        ]);
    }

    /**
     * Creates a new Acciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Acciones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_accion' => $model->id_accion, 'id_controlador' => $model->id_controlador]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Acciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_accion
     * @param integer $id_controlador
     * @return mixed
     */
    public function actionUpdate($id_accion, $id_controlador)
    {
        $model = $this->findModel($id_accion, $id_controlador);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_accion' => $model->id_accion, 'id_controlador' => $model->id_controlador]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Acciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_accion
     * @param integer $id_controlador
     * @return mixed
     */
    public function actionDelete($id_accion, $id_controlador)
    {
        $this->findModel($id_accion, $id_controlador)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Acciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_accion
     * @param integer $id_controlador
     * @return Acciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_accion, $id_controlador)
    {
        if (($model = Acciones::findOne(['id_accion' => $id_accion, 'id_controlador' => $id_controlador])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
