<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:31
 */

namespace app\controllers;


use yii\rest\ActiveController;
use app\models\Fatura;
use yii\filters\auth\HttpBasicAuth;

class FaturaController extends ActiveController
{
    public $modelClass = 'app\models\Fatura';

    public function actionComnif()
    {
        $dados = Fatura::find()
            ->where('fatura.nif IS NOT NULL')
            ->all();

        return $dados;
    }

    public function actionSemnif()
    {
        $dados = Fatura::find()
            ->where('fatura.nif IS NULL')
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