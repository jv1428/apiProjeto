<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_artigo".
 *
 * @property integer $id
 * @property string $nome
 * @property string $detalhes
 */
class TipoArtigo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_artigo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'string', 'max' => 25],
            [['detalhes'], 'string', 'max' => 100],
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
            'detalhes' => 'Detalhes',
        ];
    }

    public function afterSave($insert, $changedAttributes){

        parent::afterSave($insert, $changedAttributes);

        $id=$this->id;
        $detalhes=$this->detalhes;
        $nome=$this->nome;

        $myObj=new \stdClass();
        $myObj->id=$id;
        $myObj->detalhes=$detalhes;
        $myObj->nome=$nome;
        $myJSON= json_encode($myObj);

        if($insert)
            $this->FazPublish("INSERTTIPOARTIGO",$myJSON);
        else
            $this->FazPublish("UPDATETIPOARTIGO",$myJSON);
    }

    public function afterDelete()
    {
        parent::afterDelete();

        $prod_id= $this->id;
        $myObj=new \stdClass();
        $myObj->id=$prod_id;
        $myJSON= json_encode($myObj);

        $this->FazPublish("DELETETIPOARTIGO",$myJSON);
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
}
