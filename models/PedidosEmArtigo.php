<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedidos_em_artigo".
 *
 * @property integer $id_artigo
 * @property integer $id_pedidos
 * @property string $obs
 *
 * @property Artigo $idArtigo
 * @property Pedidos $idPedidos
 */
class PedidosEmArtigo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedidos_em_artigo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_artigo', 'id_pedidos'], 'required'],
            [['id_artigo', 'id_pedidos'], 'integer'],
            [['obs'], 'string', 'max' => 100],
            [['id_artigo'], 'exist', 'skipOnError' => true, 'targetClass' => Artigo::className(), 'targetAttribute' => ['id_artigo' => 'id']],
            [['id_pedidos'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::className(), 'targetAttribute' => ['id_pedidos' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_artigo' => 'Id ArtigoController',
            'id_pedidos' => 'Id PedidosController',
            'obs' => 'Obs',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdArtigo()
    {
        return $this->hasOne(Artigo::className(), ['id' => 'id_artigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPedidos()
    {
        return $this->hasOne(Pedidos::className(), ['id' => 'id_pedidos']);
    }
}
