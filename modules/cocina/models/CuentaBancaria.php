<?php

namespace app\modules\cocina\models;

use Yii;

/**
 * This is the model class for table "cuenta_bancaria".
 *
 * @property string $id_cuenta_bancaria
 * @property string $cuenta
 * @property int $id_persona
 */
class CuentaBancaria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuenta_bancaria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuenta', 'id_persona'], 'required'],
            [['id_persona'], 'integer'],
            [['cuenta'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cuenta_bancaria' => Yii::t('app', 'Id Cuenta Bancaria'),
            'cuenta' => Yii::t('app', 'Cuenta'),
            'id_persona' => Yii::t('app', 'Id Persona'),
        ];
    }
}
