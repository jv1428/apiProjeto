<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:33
 */

namespace app\controllers;

use app\models\PedidosEmArtigo;
use app\models\Pedidos;

use yii\rest\ActiveController;

class PedidosEmArtigoController extends ActiveController
{
    public $modelClass = 'app\models\PedidosEmArtigo';

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


}