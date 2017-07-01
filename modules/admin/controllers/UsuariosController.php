<?php

namespace app\modules\admin\controllers;

use Yii;
use app\components\AitController;
use app\models\HtmlHelpers;
use app\modules\admin\models\Persona;
use app\modules\admin\models\SeguridadUsuarios;
use app\modules\admin\models\SeguridadUsuariosSearch;
use app\modules\admin\models\UsuarioGrupo;
use app\modules\bienes\models\BienesNCodigoBien;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

/**
 * UsuariosController implements the CRUD actions for SeguridadUsuarios model.
 */
class UsuariosController extends AitController
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
     * Lists all SeguridadUsuarios models.
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
     * Displays a single SeguridadUsuarios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SeguridadUsuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        try{
            $model = new SeguridadUsuarios();
            $person= new Persona();
            if($model->load(Yii::$app->request->post())) 
            {
                $model->password = md5($model->password);
                if($model->save()){

                    Yii::$app->session->setFlash('success','Usuario creado éxitosamente!!');
                    return $this->redirect(['create', 'model' => $model,'person'=>$person ]);
                }
                else
                {
                    echo var_dump($model->getErrors());
                    return;
                }
            }
            else 
            {
		          return $this->render('create', ['model' => $model,'person'=>$person ]);
            }
        }//try
        catch(Exception $ex){}
        return false;
    }//create

    /**
     * Updates an existing SeguridadUsuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
            $model = $this->findModel($id);
            $person= Persona::find()->where(['cedula'=>$model->cedula])->one();

        if ($model->load(Yii::$app->request->post())) {

            $model->password = md5($model->password);
                        if($model->save()){
                Yii::$app->session->setFlash('success','Usuario Actualizado!!');
                               $model->password='';
                                $person->correoe=trim($person->correoe);
                                return $this->render('update', [
                                    'model' => $model,
                                    'person'=>$person
            ]);

            }

        } else {

            $model->password='';
            $person->correoe=trim($person->correoe);
            return $this->render('update', [
                'model' => $model,
                'person'=>$person
            ]);
        }
    }

    /**
     * Deletes an existing SeguridadUsuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
     public function actionDelete($id)
      {

          $usuario= UsuarioGrupo::find()->where(['id_usuario'=>$id])->all();

          foreach ($usuario as $usuarios) 
          {
              $usuarios->delete();
          }
          Yii::$app->session->setFlash('info','Usuario desactivado');
          return $this->redirect(['index']);
      }

    /**
     * Finds the SeguridadUsuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SeguridadUsuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SeguridadUsuarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionAuto() {
        $request = trim($_POST['keyword']);
        if ($request != "") {
            $data = array();
            echo json_encode($request);
        }
        else {
            $data = array('false' => 'no se encuentra');
        }
    }


    /*accion para buscar si existe prsona en formulario crear usuario*/

    public function actionBuscarpersona() {
        $return = array('success' => 'false', 'mensaje' =>'');
        if (\yii::$app->request->isAjax) {
            $personas = \app\modules\admin\models\Persona::find()->where(['cedula' => \yii::$app->request->post('cedula')])->one();
            $validar = \app\modules\admin\models\SeguridadUsuarios::find()->where(['cedula' => \yii::$app->request->post('cedula')])->one();
            if($personas){
                if($personas->sexo=='F'){$personas->sexo=0;}else{$personas->sexo=1;}
                $return = array('success' => 'true', 'nombres' => trim($personas->nombres),
                                'cedula'=>trim($personas->cedula),
                                'apellidos' => trim($personas->apellidos),
                                'direccion'=>trim($personas->direccion),
                                'fnacimiento'=>trim($personas->fnacimiento),
                                'telefono'=>trim($personas->tlf1),
                                'correo'=>trim($personas->correoe),
                                'sexo'=>trim($personas->sexo));
            }     
            else 
            {
 
                $return = array('false' => 'true', 'nombre1' => '', 'nombre2'=>'','apellido1'=>'','apellido2'=>'' );

            }
        }
        echo json_encode($return);
        return;
    }

    public function actionInsertapersona() {
        Yii::$app->response->format = 'json';
        if(Yii::$app->request->isAjax) {
            $cedula = Yii::$app->request->post('cedula');
            $nombres = Yii::$app->request->post('nombres');
            $apellidos = Yii::$app->request->post('apellidos');
            $direccion = Yii::$app->request->post('direccion');
            $fnacimiento= Yii::$app->request->post('fnacimiento');
            $tlf1= Yii::$app->request->post('tlf1');
            $correoe=Yii::$app->request->post('correoe');
            $sexo= Yii::$app->request->post('sexo');
            if($sexo=='0'){$sexo='F';}else{$sexo='M';}
            $persona = new \app\modules\admin\models\Persona();
            $persona->cedula = trim($cedula);
            $persona->nombres= trim($nombres);
            $persona->apellidos = trim($apellidos);
            $persona->direccion = trim($direccion);

            $array_fechaentrada= explode('-',trim($fnacimiento));
            $fecha= $array_fechaentrada[2].'-'.$array_fechaentrada[1].'-'.$array_fechaentrada[0];
            $persona->fnacimiento =$fecha ;

            $persona->correoe=trim($correoe);
            $persona->sexo=trim($sexo);
            $persona->tlf1=trim($tlf1);
            $persona->save();
            // Yii::$app->session->setFlash('success','Datos de la persona registrado éxitosamente!');
            return['mensaje'=>'Persona registrada exitosamente','cedula'=>$persona->cedula];
        }
        else{
            return['mensajemalo'=>'no guarda'];
        }
    }

     public function actionActualizapersona() {

        if(Yii::$app->request->isAjax) {
            $cedula = Yii::$app->request->post('cedula');
            $nombres = Yii::$app->request->post('nombres');
            $apellidos = Yii::$app->request->post('apellidos');
            $direccion = Yii::$app->request->post('direccion');
            $fnacimiento= Yii::$app->request->post('fnacimiento');
            $tlf1= Yii::$app->request->post('tlf1');
            $correoe=Yii::$app->request->post('correoe');
            $sexo= Yii::$app->request->post('sexo');
            if($sexo=='0'){$sexo='F';}else{$sexo='M';}
            $persona =Persona::findOne(trim($cedula));
            $persona->cedula = trim($cedula);
            $persona->nombres= trim($nombres);
            $persona->apellidos = trim($apellidos);
            $persona->direccion = trim($direccion);
            $persona->fnacimiento = trim($fnacimiento);
            $persona->correoe=trim($correoe);
            $persona->sexo=trim($sexo);
            $persona->tlf1=trim($tlf1);
            $persona->update();
            Yii::$app->session->setFlash('success','Datos actualizados!!');
            return['mensaje'=>'exito'];
        }
        else{
            return['mensajemalo'=>'no guarda'];
        }
    }

    public function actionValidar() {
        $return = array('success' => 'false', 'mensaje' =>'');
        if (\yii::$app->request->isAjax) {
            $validar = \app\modules\admin\models\SeguridadUsuarios::find()->where(['cedula' => \yii::$app->request->post('cedula')])->one();
            if($validar){
                $return = array('success' => 'true', 'cedula' => trim($validar->cedula) , 'login'=>trim($validar->login));
            }
            else {
                $return = array('false' => 'true', 'mensaje' => 'no se encuentra cedula de usuario');
            }
        }
        echo json_encode($return);
        return;
    }//acction validar

    /* accion parra llamar nombre de unidad ejecutora cuando cuando usuario existe */



 public function actionRestablecer()
    {
        $model = new SeguridadUsuarios();

		
        if(Yii::$app->request->post()) {
            $idusuario=Yii::$app->user->Identity->id_usuario;
            $usuario= SeguridadUsuarios::find()->where(['id_usuario'=>$idusuario])->one();
            $usuario->password=md5(Yii::$app->request->post('password'));
            $usuario->update();
                echo "<script> alert('Contraseña Fue Actualizada..');
                      </script>";
             
                echo "<script> window.location= 'index.php';  </script>";
                //return $this->redirect(Yii::$app->homeUrl);
            
        }
        
            else{
            return $this->render('restablecer',['model'=>$model]);
            }
    }//restablecer

}//usuarioscontroller
