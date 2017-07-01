<?php

namespace app\modules\admin\controllers;

use Yii;
use app\components\AitController;
use app\modules\admin\models\AccionGrupo;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccionGrupoController implements the CRUD actions for AccionGrupo model.
 */
class AccionGrupoController extends AitController
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

    public function getViewPath()
    {
        return Yii::getAlias('@admin/views/accion-grupo');
    }

    /**
     * Lists all AccionGrupo models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->redirect('/admin/grupo');
    }

    /**
     * Displays a single AccionGrupo model.
     * @param integer $id_accion
     * @param integer $id_controlador
     * @param integer $id_grupo
     * @return mixed
     */
    public function actionView($id_accion, $id_controlador, $id_grupo)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_accion, $id_controlador, $id_grupo),
        ]);
    }

    /**
     * Creates a new AccionGrupo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        return $this->redirect('/admin/grupo');
    }

    /**
     * Updates an existing AccionGrupo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_accion
     * @param integer $id_controlador
     * @param integer $id_grupo
     * @return mixed
     */
    public function actionUpdate($id_accion, $id_controlador, $id_grupo)
    {
        return $this->redirect('/admin/grupo');
    }

    /**
     * Deletes an existing AccionGrupo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_accion
     * @param integer $id_controlador
     * @param integer $id_grupo
     * @return mixed
     */
    public function actionDelete($id_accion, $id_controlador, $id_grupo)
    {
        return $this->redirect('/admin/grupo');
    }

    /**
     * Finds the AccionGrupo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_accion
     * @param integer $id_controlador
     * @param integer $id_grupo
     * @return AccionGrupo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_accion, $id_controlador, $id_grupo)
    {
        if (($model = AccionGrupo::findOne(['id_accion' => $id_accion, 'id_controlador' => $id_controlador, 'id_grupo' => $id_grupo])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
