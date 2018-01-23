<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:32
 */

namespace app\controllers;
use app\models\Pedidos;
use app\models\Estado;
use app\models\User;

use app\models\PedidosEmArtigo;
use yii\rest\ActiveController;

class PedidosController extends ActiveController
{
    public $modelClass = 'app\models\Pedidos';


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

    public function actionAcabado()
    {
        $dados = Estado::find()
            ->join('JOIN', 'estado', 'estado.id = artigo.id_estado')
            ->where('estado.tipo = Acabado')
            ->all();

        return $dados;
    }

    public function actionPorfazer()
    {
        $dados = Estado::find()
            ->join('JOIN', 'estado', 'estado.id = artigo.id_estado')
            ->where('estado.tipo = Por Fazer')
            ->all();

        return $dados;
    }

    public function actionAfazer()
    {
        $dados = Estado::find()
            ->join('JOIN', 'estado', 'estado.id = artigo.id_estado')
            ->where('estado.tipo = A Fazer')
            ->all();

        return $dados;
    }


}