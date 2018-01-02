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
            'id_user' => 'Id UserController',
            'id_equipa' => 'Id Equipa',
            'n_empregado' => 'N EmpregadoController',
            'salario' => 'Salario',
            'horas' => 'Horas',
            'horario' => 'Horario',
        ];
    }

    public function afterSave($insert, $changedAttributes){

        parent::afterSave($insert, $changedAttributes);

        $id=$this->id;
        $detalhes=$this->detalhes;
        $id_tipo_artigo=$this->id_tipo_artigo;
        $imagem_artigo=$this->imagem_artigo;
        $nome=$this->nome;
        $preco=$this->preco;
        $quantidade=$this->quantidade;

        $myObj=new \stdClass();
        $myObj->id=$id;
        $myObj->detalhes=$detalhes;
        $myObj->id_tipo_artigo=$id_tipo_artigo;
        $myObj->imagem_artigo=$imagem_artigo;
        $myObj->nome=$nome;
        $myObj->preco=$preco;
        $myObj->quantidade=$quantidade;
        $myJSON= json_encode($myObj);

        if($insert)
            $this->FazPublish("INSERTARTIGO",$myJSON);
        else
            $this->FazPublish("UPDATEARTIGO",$myJSON);
    }

    public function afterDelete()
    {
        parent::afterDelete();

        $prod_id= $this->id;
        $myObj=new \stdClass();
        $myObj->id=$prod_id;
        $myJSON= json_encode($myObj);

        $this->FazPublish("DELETEARTIGO",$myJSON);
    }



    public function FazPublish($canal,$msg)
    {
        $server = "127.0.0.1";
        $port = 1883;
        $username = ""; // set your username
        $password = ""; // set your password
        $user_id = "phpMQTT-publisher"; // unique!
        $mqtt = new \app\mosquitto\phpMQTT($server, $port, $user_id);

        if ($mqtt->connect(true, NULL, $username, $password)) {
            $mqtt->publish($canal, $msg, 0);
            $mqtt->close();
        } else {
            file_put_contents("debug.output", "Timeout!");
        }
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
