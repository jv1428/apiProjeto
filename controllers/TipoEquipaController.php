<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:34
 */

namespace app\controllers;


use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

class TipoEquipaController extends ActiveController
{
    public $modelClass = 'app\models\TipoEquipa';

//    public function behaviors()
//    {
//        return [
//            'basicAuth' => [
//                'class' => \yii\filters\auth\HttpBasicAuth::className(),
//            ],
//        ];
//    }
}