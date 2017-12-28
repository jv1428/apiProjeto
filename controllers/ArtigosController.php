<?php
/**
 * Created by PhpStorm.
 * User: Utilizador
 * Date: 28/12/2017
 * Time: 13:32
 */

namespace app\controllers;
use yii\rest\ActiveController;

class ArtigosController extends ActiveController
{
    public $modelClass = 'app\models\Artigo';
}