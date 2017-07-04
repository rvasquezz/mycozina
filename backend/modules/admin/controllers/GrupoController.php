<?php

namespace backend\modules\admin\controllers;

use Yii;
use common\components\AitController;
use backend\modules\admin\models\Grupo;
use backend\modules\admin\models\GrupoSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\admin\models\Acciones;
use backend\modules\admin\models\AccionGrupo;
use \Exception;
use backend\modules\admin\models\Modulo;

/**
 * GrupoController implements the CRUD actions for Grupo model.
 */
class GrupoController extends AitController
{

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function getViewPath() {
        return Yii::getAlias('@admin/views/grupo');
    }

    /**
     * Lists all Grupo models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new GrupoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Grupo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Grupo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
    {
        $model = new Grupo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_grupo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Grupo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_grupo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Grupo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Assign or revoke assignment to user
     * @param  integer $id
     * @param  string  $action
     * @return mixed
     */
    public function actionAsignarPermisos() {
        try
        {
            Yii::$app->response->format = 'json';
            if( Yii::$app->request->isAjax )
            {
                $grupo = Grupo::findOne( Yii::$app->request->post('id') );
                if( $grupo )
                {
                    $action = Acciones::findOne( Yii::$app->request->post('accion') );
                    if( $action )
                    {
                        $tipo = intval( Yii::$app->request->post('tipo') );
                        if($tipo == 1) {
                            $model = new AccionGrupo();
                            $model->id_grupo = $grupo->id_grupo;
                            $model->id_accion = $action->id_accion;
                            $model->id_controlador = $action->id_controlador;
                            $model->save();
                        }
                        else if( $tipo == -1 )
                        {
                            $model = AccionGrupo::findOne( [ 'id_accion'=>$action->id_accion, 'id_grupo'=>$grupo->id_grupo ] );
                            if( $model )
                                $model->delete();
                        }
                        return ['success'=>true];
                    }
                }
            }
        }
        catch(Exception $ex){}
        return ['success'=>false];
    }

    /**
     * Search roles of user
     * @param  integer $id
     * @param  string  $target
     * @param  string  $term
     * @return string
     */
    public function actionBuscarPermisos() {
        try
        {
            $return = [ 'success' => false];
            if( \Yii::$app->request->isAjax )
            {
                Yii::$app->response->format = 'json';
                $grupo = Grupo::findOne( Yii::$app->request->post("id") );
                $available = Modulo::getModulosControladores();
                $assigned = $grupo->getPermisos();
//                $permisosGrupo = $grupo->getPermisos();
//                $available = array_diff($available, $permisosGrupo);
//                $assigned = array_intersect($available, $permisosGrupo);
                
                $available = \yii\helpers\Html::listBox("list-available", NULL, $available, [ 'id' => 'list-available', "multiple"=>true, "size"=>"20", "style" => "width:100%"]);
                $assigned = \yii\helpers\Html::listBox("list-assigned", NULL, $assigned, [ 'id' => 'list-assigned', "multiple"=>true, "size"=>"20", "style" => "width:100%"]);
                
                $return = [ 'success' => true, 'available' => $available, 'assigned' => $assigned];
            }
        }
        catch(Exception $ex)
        {
            $return = [ 'success' => false, 'message' => $ex->getMessage()];
        }
        return $return;
    }

    /**
     * Finds the Grupo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Grupo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Grupo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
