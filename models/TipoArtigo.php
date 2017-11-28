<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_artigo".
 *
 * @property integer $id
 * @property string $nome
 * @property string $detalhes
 */
class TipoArtigo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_artigo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'string', 'max' => 25],
            [['detalhes'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'detalhes' => 'Detalhes',
        ];
    }
}
