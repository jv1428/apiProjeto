<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artigo".
 *
 * @property integer $id
 * @property integer $id_tipo_artigo
 * @property string $nome
 * @property string $detalhes
 * @property string $preco
 * @property integer $quantidade
 * @property string $imagem_artigo
 *
 * @property TipoArtigo $idTipoArtigo
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
            [['id_tipo_artigo', 'imagem_artigo'], 'required'],
            [['id_tipo_artigo', 'quantidade'], 'integer'],
            [['preco'], 'number'],
            [['nome'], 'string', 'max' => 25],
            [['detalhes'], 'string', 'max' => 100],
            [['imagem_artigo'], 'string', 'max' => 200],
            [['id_tipo_artigo'], 'exist', 'skipOnError' => true, 'targetClass' => TipoArtigo::className(), 'targetAttribute' => ['id_tipo_artigo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tipo_artigo' => 'Id Tipo Artigo',
            'nome' => 'Nome',
            'detalhes' => 'Detalhes',
            'preco' => 'Preco',
            'quantidade' => 'Quantidade',
            'imagem_artigo' => 'Imagem Artigo',
        ];
    }

    public function afterSave($insert, $changedAttributes){

        parent::afterSave($insert, $changedAttributes);

        /*$id=$this->id;
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
        $myJSON= json_encode($myObj);*/

        if($insert)
            //$this->FazPublish("INSERTARTIGO",$myJSON);
        $this->FazPublish("Artigo", ("O artigo com o id ".$this->id." foi Adicionado!"));
        else
            //$this->FazPublish("UPDATEARTIGO",$myJSON);
        $this->FazPublish("Artigo", ("O artigo com o id ".$this->id." foi editado!"));
    }

    public function afterDelete()
    {
        parent::afterDelete();

        $prod_id= $this->id;
        /*$myObj=new \stdClass();
        $myObj->id=$prod_id;
        $myJSON= json_encode($myObj);*/

        $this->FazPublish("Artigo", ("O artigo com o id ".$this->id." foi eliminado!"));
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
    public function getIdTipoArtigo()
    {
        return $this->hasOne(TipoArtigo::className(), ['id' => 'id_tipo_artigo']);
    }
}
