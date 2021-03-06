<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $fnacimiento;
    public $sexo;
    public $nombres;
    public $apellidos;
    public $tlf1;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [['fnacimiento'], 'safe'],
            ['sexo', 'string'],
            ['email', 'trim'],
            [['nombres','apellidos','username', 'email'], 'required'],
            [['tlf1'], 'integer'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'La dirección de correo ya existe'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
             ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Los passwords no coinciden'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->fnacimiento = $this->fnacimiento;
        $user->sexo = $this->sexo;
        $user->nombres = $this->nombres;
        $user->apellidos = $this->apellidos;
        $user->tlf1 = $this->tlf1;

        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
