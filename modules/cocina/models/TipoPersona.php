<?php

namespace app\modules\cocina\models;

use Yii;

/**
 * This is the model class for table "tipo_persona".
 *
 * @property string $id_tipo_persona
 * @property string $nombre
 */
class TipoPersona extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_persona';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_persona' => Yii::t('app', 'Id Tipo Persona'),
            'nombre' => Yii::t('app', 'Nombre'),
        ];
    }
}
