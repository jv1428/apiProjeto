<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:33
 */

namespace app\controllers;
use app\models\PedidosEmArtigo;

use yii\rest\ActiveController;

class PedidosEmArtigoController extends ActiveController
{
    public $modelClass = 'app\models\PedidosEmArtigo';

    public function actionFiltro()
    {
        $dados = PedidosEmArtigo::find()
            ->all();

        return $dados;
    }
}