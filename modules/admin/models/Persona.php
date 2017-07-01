<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property integer $cedula
 * @property string $correoe
 * @property string $tlf1
 * @property string $tlf2
 * @property string $apellidos
 * @property string $direccion
 * @property string $fnacimiento
 * @property string $nacionalidad
 * @property string $nombres
 * @property string $sexo
 *
 * @property Usuario[] $usuarios
 * @property SeguridadUsuarios[] $seguridadUsuarios
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cedula', 'apellidos', 'direccion', 'nombres'], 'required'],
            [['cedula'], 'integer'],
            [['fnacimiento'], 'safe'],
            [['correoe'], 'string', 'max' => 70],
            [['tlf1', 'tlf2'], 'string', 'max' => 20],
            [['apellidos', 'nombres'], 'string', 'max' => 60],
            [['direccion'], 'string', 'max' => 255],
            [['nacionalidad', 'sexo'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cedula' => Yii::t('app', 'Cedula'),
            'correoe' => Yii::t('app', 'Correoe'),
            'tlf1' => Yii::t('app', 'Tlf1'),
            'tlf2' => Yii::t('app', 'Tlf2'),
            'apellidos' => Yii::t('app', 'Apellidos'),
            'direccion' => Yii::t('app', 'Direccion'),
            'fnacimiento' => Yii::t('app', 'Fnacimiento'),
            'nacionalidad' => Yii::t('app', 'Nacionalidad'),
            'nombres' => Yii::t('app', 'Nombres'),
            'sexo' => Yii::t('app', 'Sexo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['persona' => 'cedula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeguridadUsuarios()
    {
        return $this->hasMany(SeguridadUsuarios::className(), ['cedula' => 'cedula']);
    }
}
