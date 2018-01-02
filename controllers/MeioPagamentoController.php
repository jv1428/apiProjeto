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

class MeioPagamentoController extends ActiveController
{
    public $modelClass = 'app\models\MeioPagamento';

    public function actionFiltroAcabado()
    {
        $dados = MeioPagamento::find()
            ->all();

        return $dados;
    }
}