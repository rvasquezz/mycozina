<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "perfil".
 *
 * @property string $id_perfil
 * @property string $id_usuario
 * @property string $slogan
 * @property string $foto
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
            [['id_usuario', 'slogan', 'foto'], 'required'],
            [['id_usuario'], 'integer'],
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
            'id_usuario' => Yii::t('app', 'Id Usuario'),
            'slogan' => Yii::t('app', 'Slogan'),
            'foto' => Yii::t('app', 'Foto'),
        ];
    }
}
