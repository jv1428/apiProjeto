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

class FaturaController extends ActiveController
{
    public $modelClass = 'app\models\Fatura';

    public function actionCnif()
    {
        $dados = Fatura::find()
            ->where('fatura.nif = NOT NULL')
            ->all();

        return $dados;
    }

    public function actionSnif()
    {
        $dados = Fatura::find()
            ->where('fatura.nif = NULL')
            ->all();

        return $dados;
    }
}