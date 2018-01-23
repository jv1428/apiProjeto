<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:34
 */

namespace app\controllers;

use app\models\User;
use app\models\Cliente;
use app\models\Empregado;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\auth\HttpBasicAuth;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';


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


    public function actionUser($username)
    {
        $user = User::findOne(['username' => $username]);

        if ($user) {
            if ($cliente = Cliente::findOne(['id_user' => $user->id])) {
                return ["tipo" => "cliente", "dados" => $cliente];
            } else if ($empregado = Empregado::findOne(['id_user' => $user->id])) {
                return ["tipo" => "empregado", "dados" => $empregado];
            } else {
                return ["tipo" => "admin"];
            }
        }
    }



        //ficha (deprecated)
    public function actionValidacao( $idvalidacao)
    {
        $model = new $this->modelClass;
        $utilizador = $model :: find()->where(['IdValidacao' => $idvalidacao])->one();
        if(is_null( $utilizador))
            echo "Erro durante validacao..." ;
        else
        {
            $utilizador->IdValidacao = " ";
            $utilizador->Estado= 2;
            if($utilizador->save ())
                echo "Operação realizada com sucesso" ;
            else
                echo "Impossivel validar registo" ;

        }
        throw new NotFoundHttpException("Não existe", 404);
    }


}

