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

}

