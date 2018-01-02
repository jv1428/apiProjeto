<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:34
 */

namespace app\controllers;

use app\models\User;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function actionsLogin()
    {

//        $login = User::find()
//            -> join('JOIN', 'cliente',  )


        $dados = User::find()
            ->all();

        return $dados;
    }
}

    /*

        $dados = Artigo::find()
            ->join('JOIN', 'tipo_artigo', 'tipo_artigo.id = artigo.id_tipo_artigo')
            ->where('tipo_artigo.nome = :tipo', [':tipo' => $tipo])
            ->all();

        return $dados;
    }
}*/
