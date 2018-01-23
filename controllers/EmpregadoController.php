<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:38
 */

namespace app\controllers;


use app\models\Empregado;
use app\models\User;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

class EmpregadoController extends ActiveController
{
    public $modelClass = 'app\models\Empregado';

    public function actionFiltro($id_user)
    {
        $dados = Empregado::find()
            ->join('JOIN', 'user', 'user.id = empregado.id_user')
            ->where('user.id = :id_user', [':id_user' => $id_user])
            ->all();

        return $dados;
    }

//    public function behaviors()
//    {
//        return [
//            'basicAuth' => [
//                'class' => \yii\filters\auth\HttpBasicAuth::className(),
//            ],
//        ];
//    }
}