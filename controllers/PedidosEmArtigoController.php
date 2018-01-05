<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:33
 */

namespace app\controllers;
use app\models\PedidosEmArtigo;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

class PedidosEmArtigoController extends ActiveController
{
    public $modelClass = 'app\models\PedidosEmArtigo';

//    public function behaviors()
//    {
//        return [
//            'basicAuth' => [
//                'class' => \yii\filters\auth\HttpBasicAuth::className(),
//            ],
//        ];
//    }
}