<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:27
 */

namespace app\controllers;


use yii\rest\ActiveController;
use app\models\Equipa;
use yii\filters\auth\HttpBasicAuth;

class EquipaController extends ActiveController
{
    public $modelClass = 'app\models\Equipa';

    public function actionFiltro($tipo)
    {
        $dados = Equipa::find()
            ->join('JOIN', 'tipo_equipa', 'tipo_equipa.id = equipa.id_tipo_equipa')
            ->where('tipo_equipa.tipo = :tipo', [':tipo' => $tipo])
            ->all();

        return $dados;
    }

    public function behaviors()
    {
        return [
            'basicAuth' => [
                'class' => \yii\filters\auth\HttpBasicAuth::className(),
            ],
        ];
    }
}