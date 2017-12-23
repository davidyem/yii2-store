<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 22.09.2017
 * Time: 19:14
 */

namespace app\modules\admin\controllers;
use yii\web\Controller;
class AppAdminController extends Controller
{
    public function behaviors ()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

}