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


        $actions = parent::actions();
        unset($actions['index'],$actions['view'],
            $actions['update'],$actions['delete']);
        return $actions;



//        $login = User::find()
//            -> join('JOIN', 'cliente',  )

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
