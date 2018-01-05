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

    /*public function actionsLogin()
    {


        $actions = parent::actions();
        unset($actions['index'],$actions['view'],
            $actions['update'],$actions['delete']);
        return $actions;
    }*/

    public function actionUser($id)
    {
        $user = User::findOne(['id' => $id]);

        if ($user) {
            if ($clientes = Cliente::findOne(['id_user' => $id])) {
                return $clientes;
            } else if ($empregado = Empregado::findOne(['id_user' => $id])) {
                return $empregado;
            }

        }
    }
        //ficha
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
    }

    public function actionAutenticacao($nomeutilizador, $palavrapasse){

    }
}

