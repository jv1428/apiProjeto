<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipa".
 *
 * @property integer $id
 * @property string $nome
 * @property integer $id_tipo_equipa
 *
 * @property Empregado[] $empregados
 * @property TipoEquipa $idTipoEquipa
 */
class Equipa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_equipa'], 'required'],
            [['id_tipo_equipa'], 'integer'],
            [['nome'], 'string', 'max' => 25],
            [['id_tipo_equipa'], 'exist', 'skipOnError' => true, 'targetClass' => TipoEquipa::className(), 'targetAttribute' => ['id_tipo_equipa' => 'id']],
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
            'id_tipo_equipa' => 'Id Tipo Equipa',
        ];
    }

    public function afterSave($insert, $changedAttributes){

        parent::afterSave($insert, $changedAttributes);

        $id=$this->id;
        $id_tipo_artigo=$this->id_tipo_artigo;
        $nome=$this->nome;


        $myObj=new \stdClass();
        $myObj->id=$id;
        $myObj->id_tipo_artigo=$id_tipo_artigo;
        $myObj->nome=$nome;
        $myJSON= json_encode($myObj);

        if($insert)
            $this->FazPublish("INSERTEQUIPA",$myJSON);
        else
            $this->FazPublish("UPDATEEQUIPA",$myJSON);
    }

    public function afterDelete()
    {
        parent::afterDelete();

        $prod_id= $this->id;
        $myObj=new \stdClass();
        $myObj->id=$prod_id;
        $myJSON= json_encode($myObj);

        $this->FazPublish("DELETEEQUIPA",$myJSON);
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
    public function getEmpregados()
    {
        return $this->hasMany(Empregado::className(), ['id_equipa' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoEquipa()
    {
        return $this->hasOne(TipoEquipa::className(), ['id' => 'id_tipo_equipa']);
    }
}
