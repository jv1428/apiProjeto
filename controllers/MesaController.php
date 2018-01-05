<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:32
 */

namespace app\controllers;


use yii\rest\ActiveController;
use app\models\Mesa;
use yii\filters\auth\HttpBasicAuth;

class MesaController extends ActiveController
{
    public $modelClass = 'app\models\Mesa';

    public function behaviors()
    {
        return [
            'basicAuth' => [
                'class' => \yii\filters\auth\HttpBasicAuth::className(),
            ],
        ];
    }

}