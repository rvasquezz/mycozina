<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\IdentityInterface;
use app\modules\admin\models\Modulo;
use app\modules\admin\models\Acciones;
use app\modules\admin\models\Controlador;
use app\modules\admin\models\AccionGrupo;
use app\modules\admin\models\Grupo;
use \Exception;

/**
 * This is the model class for table "seguridad.usuarios".
 *
 * @property integer $id_usuario
 * @property integer $cedula
 * @property string $login
 * @property string $password
 * @property string $email
 *
 * @property Direccion $idDireccion
 * @property Persona $cedula0
 */
class SeguridadUsuarios extends \yii\db\ActiveRecord implements IdentityInterface {

    public $authKey;
    public $accessToken;
    public $confirmar;
    public $password_repeat;
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['cedula', 'password'], 'required'],
            [['cedula'], 'integer'],
            [['cedula'], 'unique', 'message' => 'cedula duplicada o repetida'],
            [['login'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 70],
            [['password'], 'string', 'max' => 64],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"contraseña no son iguales" ]
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_usuario' => Yii::t('app', 'Id Usuario'),
            'cedula' => Yii::t('app', 'Cedula'),
            'login' => Yii::t('app', 'Login'),
            'password' => Yii::t('app', 'Password'),
            'email' => Yii::t('app', 'Email')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCedula0() {
        return $this->hasOne(Persona::className(), ['cedula' => 'cedula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona0() {
        return $this->hasOne(Persona::className(), ['cedula' => 'cedula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeguridadUsuarioGrupos() {
        return $this->hasMany(UsuarioGrupo::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGrupos() {
        return $this->hasMany(\app\modules\admin\models\Grupo::className(), ['id_grupo' => 'id_grupo'])->viaTable(\app\modules\admin\models\UsuarioGrupo::tableName(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username) {
        return static::findOne(['login' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return strcmp(trim($this->password), md5(trim($password))) == 0;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token
        ]);
    }

    public static function hasAccess($module, $controller = null, $action = null) {
        try {
            if (strcmp(strtoupper($module), "SIAP") == 0 && strcmp(strtoupper($controller), "DEFAULT") == 0 && strcmp(strtoupper($action), "INDEX") == 0) {
                return true;
            }
            if (\Yii::$app->user->isGuest)
                return false;
            $usuario = SeguridadUsuarios::findOne(\Yii::$app->user->identity->id);
            if ($usuario == null)
                return false;

            if ($usuario->isAdmin()) {
                return true;
            }
            if ($module == null) {
                return false;
            }
            $modulo = Modulo::findOne(['descripcion' => strtoupper($module)]);
            if ($controller == null) {//tiene acceso al modulo
                if ($modulo) {
                    foreach ($usuario->idGrupos as $grupo) {
                        $grupo instanceof Grupo;
                        foreach ($grupo->idControladores as $controlador) {
                            $controlador instanceof Controlador;
                            if ($controlador->id_modulo == $modulo->id_modulo)
                                return true;
                        }
                    }
                }
            }
            else if ($action == null) {// tiene acceso al modulo y el controaldor sin importar la accion
                $controlador = Controlador::findOne(['id_modulo' => $modulo->id_modulo, 'descripcion' => strtoupper($controller)]);
                if ($modulo && $controlador) {
                    $controlador instanceof Controlador;
                    foreach ($usuario->idGrupos as $grupo) {
                        $grupo instanceof Grupo;
                        foreach ($grupo->idControladores as $controladorPermiso) {
                            if ($controlador->id_controlador == $controladorPermiso->id_controlador && $controlador->id_modulo == $modulo->id_modulo)
                                return true;
                        }
                    }
                }
            }
            else {
                $controlador = Controlador::findOne(['id_modulo' => $modulo->id_modulo, 'descripcion' => strtoupper($controller)]);
                $accion = Acciones::findOne([ 'id_controlador' => $controlador->id_controlador, 'descripcion' => strtoupper($action)]);
                if ($modulo && $controlador && $accion) {
                    $accion instanceof Acciones;
                    $controlador instanceof Controlador;
                    foreach ($usuario->idGrupos as $grupo) {
                        $grupo instanceof Grupo;
                        $permiso = AccionGrupo::findOne([
                                    'id_accion' => $accion->id_accion,
                                    'id_controlador' => $controlador->id_controlador,
                                    'id_grupo' => $grupo->id_grupo,
                                ]);
                        if ($permiso) {
                            return true;
                        }
                    }
                }
            }
        } catch (Exception $ex) {
            
        }
        return false;
    }

    public function isAdmin() {
        foreach ($this->idGrupos as $grupo) {
            $grupo instanceof Grupo;
            if ($grupo->administrador)
                return true;
        }
        return false;
    }

    public function getAcciones() {
        $items = [];
        foreach ($this->idGrupos as $grupo) {
            $grupo instanceof Grupo;
            foreach ($grupo->idAcciones as $accion) {
                $accion instanceof Acciones;
                $items["Modulo: " . strtoupper($accion->idControlador->idModulo->descripcion) . " - Controlador: " . str_ireplace("controller", "", $accion->idControlador->descripcion)][$accion->id_accion] = Yii::t('app', $accion->descripcion);
            }
        }
    }

    public function getPermisos() {
        $items = [];
        foreach ($this->idGrupos as $grupo) {
            $items[$grupo->id_grupo] = $grupo->nombre;
        }
        return $items;
    }

}
