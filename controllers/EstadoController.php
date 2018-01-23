<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:30
 */

namespace app\controllers;


use yii\rest\ActiveController;
use app\models\Estado;
use yii\filters\auth\HttpBasicAuth;

class EstadoController extends ActiveController
{
    public $modelClass = 'app\models\Estado';

//    public function behaviors()
//    {
//        return [
//            'basicAuth' => [
//                'class' => \yii\filters\auth\HttpBasicAuth::className(),
//            ],
//        ];
//    }
}
