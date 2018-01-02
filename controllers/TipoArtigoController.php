<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:33
 */

namespace app\controllers;
use app\models\TipoArtigo;

use yii\rest\ActiveController;

class TipoArtigoController extends ActiveController
{
    public $modelClass = 'app\models\TipoArtigo';

    public function action()
    {
        $dados = TipoArtigo::find()
            ->all();

        return $dados;
    }
}