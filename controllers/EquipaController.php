<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:27
 */

namespace app\controllers;


use yii\rest\ActiveController;
use app\models\Equipa;
use app\models\User;
use yii\filters\auth\HttpBasicAuth;

class EquipaController extends ActiveController
{
    public $modelClass = 'app\models\Equipa';

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

    public function actionFiltro($tipo)
    {
        $dados = Equipa::find()
            ->join('JOIN', 'tipo_equipa', 'tipo_equipa.id = equipa.id_tipo_equipa')
            ->where('tipo_equipa.tipo = :tipo', [':tipo' => $tipo])
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