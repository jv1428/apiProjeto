<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:37
 */

namespace app\controllers;

use app\models\Artigo;
use app\models\TipoArtigo;
use yii\rest\ActiveController;

class ArtigoController extends ActiveController
{
    public $modelClass = 'app\models\Artigo';

    public function actionFiltro($tipo)
    {
        $dados = Artigo::find()
            ->join('JOIN', 'tipo_artigo', 'tipo_artigo.id = artigo.id_tipo_artigo')
            ->where('tipo_artigo.nome = :tipo', [':tipo' => $tipo])
            ->all();

        return $dados;
    }
}