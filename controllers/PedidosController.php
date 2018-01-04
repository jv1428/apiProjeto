<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:32
 */

namespace app\controllers;
use app\models\Pedidos;
use app\models\Estado;

use yii\rest\ActiveController;

class PedidosController extends ActiveController
{
    public $modelClass = 'app\models\Pedidos';

    public function actionAcabado($id_user)
    {
        $dados = Estado::find()
            ->join('JOIN', 'estado', 'estado.id = artigo.id_estado')
            ->where('estado.tipo = Acabado')
            ->all();

        return $dados;
    }

    public function actionPorfazer($id_user)
    {
        $dados = Estado::find()
            ->join('JOIN', 'estado', 'estado.id = artigo.id_estado')
            ->where('estado.tipo = Por Fazer')
            ->all();

        return $dados;
    }

    public function actionAfazer($id_user)
    {
        $dados = Estado::find()
            ->join('JOIN', 'estado', 'estado.id = artigo.id_estado')
            ->where('estado.tipo = A Fazer')
            ->all();

        return $dados;
    }
}