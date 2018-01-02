<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:30
 */

namespace app\controllers;


use yii\rest\ActiveController;
use app\models\Estado;

class EstadoController extends ActiveController
{
    public $modelClass = 'app\models\Estado';

    public function actionFiltroAcabado($id_user)
    {
        $dados = Estado::find()
            ->all();

        return $dados;
    }


}
