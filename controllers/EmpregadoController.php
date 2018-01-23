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

class EmpregadoController extends ActiveController
{
    public $modelClass = 'app\models\Empregado';

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
        $dados = Empregado::find()
            ->join('JOIN', 'user', 'user.id = empregado.id_user')
            ->where('user.id = :id_user', [':id_user' => $id_user])
            ->all();

        return $dados;
    }
}