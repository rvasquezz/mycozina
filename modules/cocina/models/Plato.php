<?php

namespace app\modules\cocina\models;

use Yii;

/**
 * This is the model class for table "plato".
 *
 * @property int $id_plato
 * @property string $nombre
 * @property string $descripcion
 * @property int $precio
 * @property int $id_persona
 * @property int $id_plato_det
 * @property string $activo
 * @property string $fecha_create
 */
class Plato extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plato';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'precio', 'id_persona', 'id_plato_det', 'activo', 'fecha_create'], 'required'],
            [['precio', 'id_persona', 'id_plato_det'], 'integer'],
            [['fecha_create'], 'safe'],
            [['nombre'], 'string', 'max' => 30],
            [['descripcion'], 'string', 'max' => 70],
            [['activo'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_plato' => Yii::t('app', 'Id Plato'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'precio' => Yii::t('app', 'Precio'),
            'id_persona' => Yii::t('app', 'Id Persona'),
            'id_plato_det' => Yii::t('app', 'Id Plato Det'),
            'activo' => Yii::t('app', 'Activo'),
            'fecha_create' => Yii::t('app', 'Fecha Create'),
        ];
    }
}
