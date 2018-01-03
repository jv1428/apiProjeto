<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_equipa".
 *
 * @property integer $id
 * @property string $tipo
 * @property string $detalhes
 *
 * @property Equipa[] $equipas
 */
class TipoEquipa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_equipa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo'], 'string', 'max' => 25],
            [['detalhes'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
            'detalhes' => 'Detalhes',
        ];
    }

    public function afterSave($insert, $changedAttributes){

        parent::afterSave($insert, $changedAttributes);

        $id=$this->id;
        $detalhes=$this->detalhes;
        $tipo=$this->tipo;

        $myObj=new \stdClass();
        $myObj->id=$id;
        $myObj->detalhes=$detalhes;
        $myObj->tipo=$tipo;
        $myJSON= json_encode($myObj);

        if($insert)
            $this->FazPublish("INSERTTIPOEQUIPA",$myJSON);
        else
            $this->FazPublish("UPDATETIPOEQUIPA",$myJSON);
    }

    public function afterDelete()
    {
        parent::afterDelete();

        $prod_id= $this->id;
        $myObj=new \stdClass();
        $myObj->id=$prod_id;
        $myJSON= json_encode($myObj);

        $this->FazPublish("DELETETIPOEQUIPA",$myJSON);
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
    public function getEquipas()
    {
        return $this->hasMany(Equipa::className(), ['id_tipo_equipa' => 'id']);
    }
}
