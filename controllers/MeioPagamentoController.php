<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:31
 */

namespace app\controllers;
use app\models\MeioPagamento;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

class MeioPagamentoController extends ActiveController
{
    public $modelClass = 'app\models\MeioPagamento';

//    public function behaviors()
//    {
//        return [
//            'basicAuth' => [
//                'class' => \yii\filters\auth\HttpBasicAuth::className(),
//            ],
//        ];
//    }

}