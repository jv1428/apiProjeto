<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mesa".
 *
 * @property integer $id
 * @property integer $numero
 * @property string $condicao
 * @property integer $quantidade_pessoas
 *
 * @property Pedidos[] $pedidos
 */
class Mesa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mesa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero'], 'required'],
            [['numero', 'quantidade_pessoas'], 'integer'],
            [['condicao'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero' => 'Numero',
            'condicao' => 'Condicao',
            'quantidade_pessoas' => 'Quantidade Pessoas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::className(), ['id_mesa' => 'id']);
    }
}
