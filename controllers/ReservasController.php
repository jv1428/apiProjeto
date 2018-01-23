<?php
/**
 * Created by PhpStorm.
 * User: Utilizador
 * Date: 04/01/2018
 * Time: 11:50
 */

namespace app\controllers;


use app\models\Reserva;
use app\models\User;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;


class ReservasController extends ActiveController
{
    public $modelClass = 'app\models\Reserva';


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

    public function actionFiltro($hora)
    {
        $dados = Reserva::find()->where(['like','horario', $hora])->all();

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