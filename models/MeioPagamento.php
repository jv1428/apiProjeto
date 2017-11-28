<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meio_pagamento".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property Fatura[] $faturas
 */
class MeioPagamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meio_pagamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 25],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Fatura::className(), ['id_meio_pagamento' => 'id']);
    }
}
