<?php

namespace app\modules\cocina\models;

use Yii;

/**
 * This is the model class for table "persona_det".
 *
 * @property int $id_persona_det
 * @property int $id_tipo_persona
 * @property int $id_cuenta_bancaria
 * @property int $id_ubicacion
 * @property int $id_persona
 * @property string $fecha_create
 * @property string $comentario
 */
class PersonaDetalle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona_det';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_persona', 'id_ubicacion', 'id_persona', 'fecha_create'], 'required'],
            [['id_tipo_persona', 'id_cuenta_bancaria', 'id_ubicacion', 'id_persona'], 'integer'],
            [['fecha_create'], 'safe'],
            [['comentario'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_persona_det' => Yii::t('app', 'Id Persona Det'),
            'id_tipo_persona' => Yii::t('app', 'Id Tipo Persona'),
            'id_cuenta_bancaria' => Yii::t('app', 'Id Cuenta Bancaria'),
            'id_ubicacion' => Yii::t('app', 'Id Ubicacion'),
            'id_persona' => Yii::t('app', 'Id Persona'),
            'fecha_create' => Yii::t('app', 'Fecha Create'),
            'comentario' => Yii::t('app', 'Comentario'),
        ];
    }
}
