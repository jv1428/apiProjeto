<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedidos".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_mesa
 * @property integer $id_estado
 * @property string $data_pedido
 *
 * @property Fatura[] $faturas
 * @property User $idUser
 * @property Mesa $idMesa
 * @property Estado $idEstado
 * @property PedidosEmArtigo[] $pedidosEmArtigos
 * @property Artigo[] $idArtigos
 */
class Pedidos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedidos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_mesa', 'id_estado'], 'required'],
            [['id', 'id_user', 'id_mesa', 'id_estado'], 'integer'],
            [['data_pedido'], 'safe'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_mesa'], 'exist', 'skipOnError' => true, 'targetClass' => Mesa::className(), 'targetAttribute' => ['id_mesa' => 'id']],
            [['id_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['id_estado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id UserController',
            'id_mesa' => 'Id MesaController',
            'id_estado' => 'Id EstadoController',
            'data_pedido' => 'Data Pedido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Fatura::className(), ['id_pedidos' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMesa()
    {
        return $this->hasOne(Mesa::className(), ['id' => 'id_mesa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstado()
    {
        return $this->hasOne(Estado::className(), ['id' => 'id_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidosEmArtigos()
    {
        return $this->hasMany(PedidosEmArtigo::className(), ['id_pedidos' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdArtigos()
    {
        return $this->hasMany(Artigo::className(), ['id' => 'id_artigo'])->viaTable('pedidos_em_artigo', ['id_pedidos' => 'id']);
    }
}
