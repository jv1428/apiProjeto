<?php
/**
 * Created by PhpStorm.
 * User: Vieira
 * Date: 12/12/2017
 * Time: 16:38
 */

namespace app\controllers;


use yii\rest\ActiveController;

class Empregado extends ActiveController
{
    public $modelClass = 'app\models\Empregado';
}