<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reserva".
 *
 * @property integer $id
 * @property string $nome
 * @property string $numeroTelefone
 * @property integer $quantidade_pessoas
 * @property string $horario
 * @property integer $id_mesa
 */
class Reserva extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reserva';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'numeroTelefone', 'quantidade_pessoas', 'horario', 'id_mesa'], 'required'],
            [['quantidade_pessoas', 'id_mesa'], 'integer'],
            [['nome'], 'string', 'max' => 60],
            [['numeroTelefone'], 'string', 'max' => 25],
            [['horario'], 'string', 'max' => 10],
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
            'numeroTelefone' => 'Numero Telefone',
            'quantidade_pessoas' => 'Quantidade Pessoas',
            'horario' => 'Horario',
            'id_mesa' => 'Id Mesa',
        ];
    }
}
