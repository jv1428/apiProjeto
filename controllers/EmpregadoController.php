<?php
/**
 * Created by PhpStorm.
 * UserController: Vieira
 * Date: 12/12/2017
 * Time: 16:38
 */

namespace app\controllers;


use yii\rest\ActiveController;

class EmpregadoController extends ActiveController
{
    public $modelClass = 'app\models\Empregado';
}