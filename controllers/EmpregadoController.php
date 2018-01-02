<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:38
 */

namespace app\controllers;


use app\models\Empregado;
use app\models\User;
use yii\rest\ActiveController;

class EmpregadoController extends ActiveController
{
    public $modelClass = 'app\models\Empregado';

    public function actionFiltro($tipo)
    {
        $dados = Empregado::find()
            ->join('JOIN', 'user', 'user.id = empregado.id_user')
            ->where('tipo_artigo.nome = :tipo', [':tipo' => $tipo])
            ->all();

        return $dados;
    }
}