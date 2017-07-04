<?php

namespace app\modules\cocina\models;

use Yii;

/**
 * This is the model class for table "modalidad".
 *
 * @property int $id_modalidad
 * @property string $descripcion
 */
class Modalidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modalidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_modalidad' => Yii::t('app', 'Id Modalidad'),
            'descripcion' => Yii::t('app', 'Descripcion'),
        ];
    }
}
