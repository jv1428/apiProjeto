<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artigo".
 *
 * @property integer $id
 * @property integer $id_tipo_ementa
 * @property string $nome
 * @property string $detalhes
 * @property string $preco
 * @property integer $quantidade
 *
 * @property PedidosEmArtigo[] $pedidosEmArtigos
 * @property Pedidos[] $idPedidos
 */
class Artigo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'artigo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_ementa'], 'required'],
            [['id_tipo_ementa', 'quantidade'], 'integer'],
            [['preco'], 'number'],
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
            'id_tipo_ementa' => 'Id Tipo Ementa',
            'nome' => 'Nome',
            'detalhes' => 'Detalhes',
            'preco' => 'Preco',
            'quantidade' => 'Quantidade',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidosEmArtigos()
    {
        return $this->hasMany(PedidosEmArtigo::className(), ['id_artigo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPedidos()
    {
        return $this->hasMany(Pedidos::className(), ['id' => 'id_pedidos'])->viaTable('pedidos_em_artigo', ['id_artigo' => 'id']);
    }
}
