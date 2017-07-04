<?php

namespace app\modules\cocina\models;

use Yii;

/**
 * This is the model class for table "perfil".
 *
 * @property string $id_perfil
 * @property int $id_persona
 * @property string $slogan
 * @property string $foto
 * @property int $id_comentario
 */
class Perfil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perfil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_persona', 'slogan', 'foto'], 'required'],
            [['id_persona', 'id_comentario'], 'integer'],
            [['slogan'], 'string', 'max' => 250],
            [['foto'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_perfil' => Yii::t('app', 'Id Perfil'),
            'id_persona' => Yii::t('app', 'Id Persona'),
            'slogan' => Yii::t('app', 'Slogan'),
            'foto' => Yii::t('app', 'Foto'),
            'id_comentario' => Yii::t('app', 'Id Comentario'),
        ];
    }
}
