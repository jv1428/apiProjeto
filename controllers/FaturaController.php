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
    public function actionFiltro($id_user)
    {
        $dados = Estado::find()
            ->where('estado.tipo = Acabado', [':id_user' => $id_user])
            ->all();

        return $dados;
    }
}