<?php

namespace backend\modules\admin\models;

use Yii;

/**
 * This is the model class for table "seguridad.grupo".
 *
 * @property integer $id_grupo
 * @property string $nombre
 * @property string $descripcion
 * @property boolean $administrador
 *
 * @property SeguridadAccionGrupo[] $seguridadAccionGrupos
 * @property SeguridadUsuarioGrupo[] $seguridadUsuarioGrupos
 * @property Usuario[] $idUsuarios
 * @property SeguridadAcciones[] $idAcciones
 */
class Grupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'required'],
            [['administrador'], 'boolean'],
            [['nombre'], 'string', 'max' => 25],
            [['descripcion'], 'string', 'max' => 255],
            [['nombre'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_grupo' => Yii::t('app', 'Id Grupo'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'administrador' => Yii::t('app', 'Administrador'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeguridadAccionGrupos()
    {
        return $this->hasMany(AccionGrupo::className(), ['id_grupo' => 'id_grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeguridadUsuarioGrupos()
    {
        return $this->hasMany(UsuarioGrupo::className(), ['id_grupo' => 'id_grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuarios()
    {
        return $this->hasMany(SeguridadUsuarios::className(), ['id_usuario' => 'id_usuario'])->viaTable('usuario_grupo', ['id_grupo' => 'id_grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAcciones()
    {
        return $this->hasMany(Acciones::className(), ['id_accion' => 'id_accion'])->viaTable(AccionGrupo::tableName(), ['id_grupo' => 'id_grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdControladores()
    {
        return $this->hasMany(Controlador::className(), ['id_controlador' => 'id_controlador'])->viaTable(AccionGrupo::tableName(), ['id_grupo' => 'id_grupo']);
    }
    
    public function getPermisos()
    {
        $items = [];
        foreach ($this->idAcciones as $accion)
        {
            $accion instanceof Acciones;
            $items[ "Modulo: ".strtoupper($accion->idControlador->idModulo->descripcion)." - Controlador: ".str_ireplace("controller", "", $accion->idControlador->descripcion)][$accion->id_accion] = Yii::t('app',  $accion->descripcion);
        }
        return $items;
    }
    
    public static function getGrupos()
    {
        $items = [];
        foreach ( self::find()->all() as $grupo )
        {
            $items[$grupo->id_grupo] = $grupo->nombre;
        }
        return $items;
    }
}
