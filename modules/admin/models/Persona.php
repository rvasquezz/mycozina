<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property int $id_persona
 * @property string $tlf1
 * @property string $tlf2
 * @property string $apellidos
 * @property string $fnacimiento
 * @property string $nacionalidad
 * @property string $nombres
 * @property string $sexo
 * @property int $id_persona_det
 * @property string $fecha_create
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
            [['id_persona', 'apellidos', 'nombres', 'id_persona_det', 'fecha_create'], 'required'],
            [['id_persona', 'id_persona_det'], 'integer'],
            [['fnacimiento', 'fecha_create'], 'safe'],
            [['tlf1', 'tlf2'], 'string', 'max' => 20],
            [['apellidos', 'nombres'], 'string', 'max' => 60],
            [['nacionalidad', 'sexo'], 'string', 'max' => 1],
            [['id_persona'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_persona' => Yii::t('app', 'Id Persona'),
            'tlf1' => Yii::t('app', 'Tlf1'),
            'tlf2' => Yii::t('app', 'Tlf2'),
            'apellidos' => Yii::t('app', 'Apellidos'),
            'fnacimiento' => Yii::t('app', 'Fnacimiento'),
            'nacionalidad' => Yii::t('app', 'Nacionalidad'),
            'nombres' => Yii::t('app', 'Nombres'),
            'sexo' => Yii::t('app', 'Sexo'),
            'id_persona_det' => Yii::t('app', 'Id Persona Det'),
            'fecha_create' => Yii::t('app', 'Fecha Create'),
        ];
    }
}
