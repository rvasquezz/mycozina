<?php

namespace app\modules\cocina\models;

use Yii;

/**
 * This is the model class for table "mesa".
 *
 * @property int $id_mesa
 * @property int $cantidad
 * @property int $puestos
 * @property int $id_persona
 * @property string $disponible
 */
class Mesa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mesa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cantidad', 'puestos', 'id_persona'], 'integer'],
            [['id_persona', 'disponible'], 'required'],
            [['disponible'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_mesa' => Yii::t('app', 'Id Mesa'),
            'cantidad' => Yii::t('app', 'Cantidad'),
            'puestos' => Yii::t('app', 'Puestos'),
            'id_persona' => Yii::t('app', 'Id Persona'),
            'disponible' => Yii::t('app', 'Disponible'),
        ];
    }
}
