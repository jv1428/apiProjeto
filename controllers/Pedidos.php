<?php
/**
 * Created by PhpStorm.
 * User: Vieira
 * Date: 12/12/2017
 * Time: 16:32
 */

namespace app\controllers;


use yii\rest\ActiveController;

class Pedidos extends ActiveController
{
    public $modelClass = 'app\models\Pedidos';
}