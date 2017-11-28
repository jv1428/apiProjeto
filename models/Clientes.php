<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $id_user
 * @property string $email
 * @property string $numeroTelefone
 * @property string $morada
 *
 * @property User $idUser
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'email'], 'required'],
            [['id_user'], 'integer'],
            [['email'], 'string', 'max' => 45],
            [['numeroTelefone'], 'string', 'max' => 25],
            [['morada'], 'string', 'max' => 60],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'email' => 'Email',
            'numeroTelefone' => 'Numero Telefone',
            'morada' => 'Morada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
