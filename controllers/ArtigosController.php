<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:37
 */

namespace app\controllers;

use app\models\Artigo;
use app\models\TipoArtigo;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

class ArtigosController extends ActiveController
{
//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//
//        $behaviors['authenticator'] = [
//            'class' => \yii\filters\auth\HttpBasicAuth::className(),
//            'auth' => [$this, 'auth']
//        ];
//
//        return $behaviors;
//    }

    public $modelClass = 'app\models\Artigo';

    public function actionFiltro($tipo)
    {
        $dados = Artigo::find()
            ->join('JOIN', 'tipo_artigo', 'tipo_artigo.id = artigo.id_tipo_artigo')
            ->where('tipo_artigo.nome = :tipo', [':tipo' => $tipo])
            ->all();

        return $dados;
    }

//    public function auth($username, $password_hash)
//    {
//
//        $user = \app\models\User::findOne(['username' => $username, 'password_hash' => $password_hash]);
//
//        return $user;
//    }
}