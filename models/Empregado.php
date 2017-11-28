<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empregado".
 *
 * @property integer $id_user
 * @property integer $id_equipa
 * @property integer $n_empregado
 * @property integer $salario
 * @property integer $horas
 * @property string $horario
 *
 * @property User $idUser
 * @property Equipa $idEquipa
 */
class Empregado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empregado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_equipa', 'n_empregado'], 'required'],
            [['id_user', 'id_equipa', 'n_empregado', 'salario', 'horas'], 'integer'],
            [['horario'], 'string', 'max' => 35],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_equipa'], 'exist', 'skipOnError' => true, 'targetClass' => Equipa::className(), 'targetAttribute' => ['id_equipa' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'id_equipa' => 'Id Equipa',
            'n_empregado' => 'N Empregado',
            'salario' => 'Salario',
            'horas' => 'Horas',
            'horario' => 'Horario',
        ];
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
    public function getIdEquipa()
    {
        return $this->hasOne(Equipa::className(), ['id' => 'id_equipa']);
    }
}
