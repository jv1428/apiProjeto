<?php
namespace app\controllers;

use yii\rest\ActiveController;
use app\models\Cliente;

class ClienteController extends ActiveController
{
    public $modelClass = 'app\models\Cliente';

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

    public function actionFiltro($id_user)
    {
        $dados = Cliente::find()
            ->join('JOIN', 'user', 'user.id = cliente.id_user')
            ->where('user.id = :id_user', [':id_user' => $id_user])
            ->all();

        return $dados;
    }
}