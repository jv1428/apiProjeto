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


class ReservasController extends ActiveController
{
    public $modelClass = 'app\models\Reserva';

    public function actionFiltro($hora)
    {
        $dados = Reserva::find()->where(['like','horario', $hora])->all();

        return $dados;
    }
}