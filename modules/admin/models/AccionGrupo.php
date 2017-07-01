<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "seguridad.accion_grupo".
 *
 * @property integer $id_accion
 * @property integer $id_controlador
 * @property integer $id_grupo
 *
 * @property SeguridadAcciones $idAccion
 * @property SeguridadGrupo $idGrupo
 */
class AccionGrupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_grupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_accion', 'id_controlador', 'id_grupo'], 'required'],
            [['id_accion', 'id_controlador', 'id_grupo'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_accion' => Yii::t('app', 'Id Accion'),
            'id_controlador' => Yii::t('app', 'Id Controlador'),
            'id_grupo' => Yii::t('app', 'Id Grupo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAccion()
    {
        return $this->hasOne(Acciones::className(), ['id_accion' => 'id_accion', 'id_controlador' => 'id_controlador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGrupo()
    {
        return $this->hasOne(Grupo::className(), ['id_grupo' => 'id_grupo']);
    }
}
