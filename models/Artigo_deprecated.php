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
            [['id_tipo_ementa', 'imagem_artigo'], 'required'],
            [['id_tipo_ementa', 'quantidade'], 'integer'],
            [['preco'], 'number'],
            [['nome'], 'string', 'max' => 25],
            [['detalhes'], 'string', 'max' => 100],
            [['imagem_artigo'], 'string', 'max' => 200]
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
