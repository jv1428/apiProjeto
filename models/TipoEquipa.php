<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_equipa".
 *
 * @property integer $id
 * @property string $tipo
 * @property string $detalhes
 *
 * @property Equipa[] $equipas
 */
class TipoEquipa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_equipa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo'], 'string', 'max' => 25],
            [['detalhes'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
            'detalhes' => 'Detalhes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipas()
    {
        return $this->hasMany(Equipa::className(), ['id_tipo_equipa' => 'id']);
    }
}
