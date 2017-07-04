<?php

namespace app\modules\cocina\models;

use Yii;

/**
 * This is the model class for table "reserva".
 *
 * @property int $id_reserva
 * @property int $id_persona
 * @property int $id_modalidad
 * @property int $cantidad
 * @property string $fecha_create
 * @property int $id_mesa
 */
class Reserva extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reserva';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_persona', 'id_modalidad', 'cantidad', 'fecha_create'], 'required'],
            [['id_persona', 'id_modalidad', 'cantidad', 'id_mesa'], 'integer'],
            [['fecha_create'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_reserva' => Yii::t('app', 'Id Reserva'),
            'id_persona' => Yii::t('app', 'Id Persona'),
            'id_modalidad' => Yii::t('app', 'Id Modalidad'),
            'cantidad' => Yii::t('app', 'Cantidad'),
            'fecha_create' => Yii::t('app', 'Fecha Create'),
            'id_mesa' => Yii::t('app', 'Id Mesa'),
        ];
    }
}
