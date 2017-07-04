<?php

namespace app\modules\cocina\models;

use Yii;

/**
 * This is the model class for table "plato_det".
 *
 * @property int $id_plato_det
 * @property int $id_plato
 * @property int $disponibles
 * @property int $reservados
 * @property string $inicia
 * @property string $limite
 * @property string $temina
 * @property int $id_modalidad
 */
class PlatoDetalle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plato_det';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_plato', 'disponibles', 'reservados', 'inicia', 'limite', 'temina', 'id_modalidad'], 'required'],
            [['id_plato', 'disponibles', 'reservados', 'id_modalidad'], 'integer'],
            [['inicia', 'limite', 'temina'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_plato_det' => Yii::t('app', 'Id Plato Det'),
            'id_plato' => Yii::t('app', 'Id Plato'),
            'disponibles' => Yii::t('app', 'Disponibles'),
            'reservados' => Yii::t('app', 'Reservados'),
            'inicia' => Yii::t('app', 'Inicia'),
            'limite' => Yii::t('app', 'Limite'),
            'temina' => Yii::t('app', 'Temina'),
            'id_modalidad' => Yii::t('app', 'Id Modalidad'),
        ];
    }
}
