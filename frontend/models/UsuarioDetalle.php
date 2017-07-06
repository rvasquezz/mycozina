<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "usuario_det".
 *
 * @property int $id_usuario_det
 * @property int $id_tipo_usuario
 * @property int $id_ubicacion
 * @property int $id_usuario
 * @property string $fecha_create
 * @property string $comentario
 */
class UsuarioDetalle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario_det';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_usuario', 'id_ubicacion', 'id_usuario'], 'integer'],
            [['id_usuario', 'fecha_create'], 'required'],
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
            'id_usuario_det' => Yii::t('app', 'Id Usuario Det'),
            'id_tipo_usuario' => Yii::t('app', 'Id Tipo Usuario'),
            'id_ubicacion' => Yii::t('app', 'Id Ubicacion'),
            'id_usuario' => Yii::t('app', 'Id Usuario'),
            'fecha_create' => Yii::t('app', 'Fecha Create'),
            'comentario' => Yii::t('app', 'Comentario'),
        ];
    }
}
