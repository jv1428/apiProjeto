<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fatura".
 *
 * @property integer $id
 * @property integer $id_meio_pagamento
 * @property integer $id_pedidos
 * @property string $data_fatura
 * @property string $obs
 * @property integer $nif
 *
 * @property MeioPagamento $idMeioPagamento
 * @property Pedidos $idPedidos
 */
class Fatura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fatura';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_meio_pagamento', 'id_pedidos'], 'required'],
            [['id_meio_pagamento', 'id_pedidos', 'nif'], 'integer'],
            [['data_fatura'], 'safe'],
            [['obs'], 'string', 'max' => 250],
            [['id_meio_pagamento'], 'exist', 'skipOnError' => true, 'targetClass' => MeioPagamento::className(), 'targetAttribute' => ['id_meio_pagamento' => 'id']],
            [['id_pedidos'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::className(), 'targetAttribute' => ['id_pedidos' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_meio_pagamento' => 'Id Meio Pagamento',
            'id_pedidos' => 'Id Pedidos',
            'data_fatura' => 'Data Fatura',
            'obs' => 'Obs',
            'nif' => 'Nif',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMeioPagamento()
    {
        return $this->hasOne(MeioPagamento::className(), ['id' => 'id_meio_pagamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPedidos()
    {
        return $this->hasOne(Pedidos::className(), ['id' => 'id_pedidos']);
    }
}
