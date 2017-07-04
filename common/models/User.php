<?php
namespace common\models;

use Yii;
use backend\modules\admin\models\AccionGrupo;
use backend\modules\admin\models\Acciones;
use backend\modules\admin\models\Controlador;
use backend\modules\admin\models\Grupo;
use backend\modules\admin\models\Modulo;
use backend\modules\admin\models\UsuarioGrupo;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    // public function attributeLabels() {
    //     return [
    //         'id_usuario' => Yii::t('app', 'Id Usuario'),
    //         'cedula' => Yii::t('app', 'Cedula'),
    //         'login' => Yii::t('app', 'Login'),
    //         'password' => Yii::t('app', 'Password'),
    //         'email' => Yii::t('app', 'Email')
    //     ];
    // }

    public function getIdGrupos() {
        return $this->hasMany(Grupo::className(), ['id_grupo' => 'id_grupo'])->viaTable(UsuarioGrupo::tableName(), ['id_usuario' => 'id']);
    }

    public function getSeguridadUsuarioGrupos() {
        return $this->hasMany(UsuarioGrupo::className(), ['id_usuario' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    public static function hasAccess($module, $controller = null, $action = null) {
        try {
            if (strcmp(strtoupper($module), "SIAP") == 0 && strcmp(strtoupper($controller), "DEFAULT") == 0 && strcmp(strtoupper($action), "INDEX") == 0) {
                return true;
            }
            if (\Yii::$app->user->isGuest)
                return false;
            $usuario = User::findOne(\Yii::$app->user->identity->id);
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
