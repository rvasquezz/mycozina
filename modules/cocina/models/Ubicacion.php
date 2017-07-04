<?php

namespace app\modules\cocina\models;

use Yii;

/**
 * This is the model class for table "ubicacion".
 *
 * @property int $id_ubicacion
 * @property string $latitud
 * @property string $longitud
 */
class Ubicacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ubicacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['latitud', 'longitud'], 'required'],
            [['latitud', 'longitud'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ubicacion' => Yii::t('app', 'Id Ubicacion'),
            'latitud' => Yii::t('app', 'Latitud'),
            'longitud' => Yii::t('app', 'Longitud'),
        ];
    }
}
