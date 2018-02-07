<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:32
 */

namespace app\controllers;


use yii\rest\ActiveController;
use app\models\User;
use app\models\Mesa;

class MesaController extends ActiveController
{
    public $modelClass = 'app\models\Mesa';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\HttpBasicAuth::className(),
            'auth' => [$this, 'auth']
        ];

        return $behaviors;
    }

    public function auth($username, $password)
    {

        $user = User::findOne(['username' => $username]);

        if ($user->validatePassword($password)) {
            return $user;
        }

        return null;
    }

    public function actionMesa($id_mesa)
    {
        $mesa = Mesa::findOne(['id' => $id_mesa]);

        if ($mesa) {

            if($mesa->condicao == "ocupada") {
                $mesa->condicao = "livre";
            }
            else {
                $mesa->condicao = "ocupada";
            }

            if($mesa->save())
            {
                return ["mesa"=>$id_mesa, "condicao"=>$mesa->condicao];
            }
        }

        return null;
    }

}