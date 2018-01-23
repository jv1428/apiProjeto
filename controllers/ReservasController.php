<?php
/**
 * Created by PhpStorm.
 * User: Utilizador
 * Date: 04/01/2018
 * Time: 11:50
 */

namespace app\controllers;


use app\models\Reserva;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;


class ReservasController extends ActiveController
{
    public $modelClass = 'app\models\Reserva';

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