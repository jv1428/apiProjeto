<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:32
 */

namespace app\controllers;
use app\models\Pedidos;

use yii\rest\ActiveController;

class PedidosController extends ActiveController
{
    public $modelClass = 'app\models\Pedidos';

    public function actionFiltro($id_user)
    {
        $dados = Pedidos::find()
            ->all();

        return $dados;
    }
}