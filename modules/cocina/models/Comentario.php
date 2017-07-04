<?php

namespace app\modules\cocina\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property int $id_comentario
 * @property string $descripcion
 * @property string $calificacion
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'calificacion'], 'required'],
            [['descripcion'], 'string', 'max' => 250],
            [['calificacion'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_comentario' => Yii::t('app', 'Id Comentario'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'calificacion' => Yii::t('app', 'Calificacion'),
        ];
    }
}
