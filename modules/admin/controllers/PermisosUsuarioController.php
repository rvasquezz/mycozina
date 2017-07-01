<?php

namespace app\modules\admin\controllers;

use Yii;
use app\components\AitController;
use app\modules\admin\models\SeguridadUsuarios;
use app\modules\admin\models\SeguridadUsuariosSearch;
use app\modules\admin\models\UsuarioGrupo;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\Grupo;
use app\modules\admin\models\Modulo;
use \Exception;

/**
 * PermisosUsuarioController implements the CRUD actions for Usuario model permissions.
 */
class PermisosUsuarioController extends AitController
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
     * Lists all UsuarioGrupo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeguridadUsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing PermisosUsuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_grupo
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        try
        {
            if(Yii::$app->request->post("SeguridadUsuarios"))
            {
                foreach( $model->seguridadUsuarioGrupos as $usuarioGrupo)
                {
                    $usuarioGrupo->delete();
                }
                foreach (Yii::$app->request->post("SeguridadUsuarios") as $grupos)
                {
                    foreach ($grupos as $grupo)
                    {
                        $usuarioGrupo = new UsuarioGrupo();
                        $usuarioGrupo->id_usuario = $model->id_usuario;
                        $usuarioGrupo->id_grupo = $grupo;
                        $usuarioGrupo->save();
                    }
                }
                return $this->actionIndex();
            }
        }
        catch (Exception $ex)
        {
            if ($ex->getMessage() != null && $ex->getMessage() != "")
                $model->addError("idGrupos", $ex->getMessage());
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the UsuarioGrupo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_grupo
     * @param integer $id_usuario
     * @return UsuarioGrupo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_usuario)
    {
        if( ($model = SeguridadUsuarios::findOne( $id_usuario )) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
                $usuario = SeguridadUsuarios::findOne( Yii::$app->request->post('id') );
                if( $usuario )
                {
                    $grupo = Grupo::findOne( Yii::$app->request->post('grupo') );
                    if( $grupo )
                    {
                        $tipo = intval( Yii::$app->request->post('tipo') );
                        if($tipo == 1) {
                            $model = new UsuarioGrupo();
                            $model->id_grupo = $grupo->id_grupo;
                            $model->id_usuario = $usuario->id_usuario;
                            $model->save();
                        }
                        else if( $tipo == -1 )
                        {
                            $model = UsuarioGrupo::findOne( [ 'id_grupo'=>$grupo->id_grupo, 'id_usuario'=>$usuario->id_usuario ] );
                            if( $model )
                                $model->delete();
                        }
                        return ['success'=>true];
                    }
                }
            }
        }
        catch (\yii\db\IntegrityException $ex)
        {
            return ['success'=>false, 'message' => "El usuario ya tiene los permisos asignados."];
        }
        catch(Exception $ex)
        {
            return ['success'=>false, 'message' => $ex->getMessage()];
        }
        return ['success'=>false, 'message' => "No se pudo procesar la solicitud."];
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
            $return = [ 'success' => false, 'message' => "No se pudo procesar la solicitud."];
            if( \Yii::$app->request->isAjax )
            {
                Yii::$app->response->format = 'json';
                $usuario = SeguridadUsuarios::findOne( Yii::$app->request->post("id") );
                $available = Grupo::getGrupos();
                $assigned = $usuario->getPermisos();
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

}
