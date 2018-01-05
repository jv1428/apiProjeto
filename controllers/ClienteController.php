<?php
namespace app\controllers;

use yii\rest\ActiveController;
use app\models\Cliente;
use yii\filters\auth\HttpBasicAuth;

class ClienteController extends ActiveController
{
    public $modelClass = 'app\models\Cliente';

    public function actionFiltro($id_user)
    {
        $dados = Cliente::find()
            ->join('JOIN', 'user', 'user.id = cliente.id_user')
            ->where('user.id = :id_user', [':id_user' => $id_user])
            ->all();

        return $dados;
    }

    public function behaviors()
    {
        return [
            'basicAuth' => [
                'class' => \yii\filters\auth\HttpBasicAuth::className(),
            ],
        ];
    }
}