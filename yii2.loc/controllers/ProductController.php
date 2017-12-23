<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 03.09.2017
 * Time: 21:09
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;

class ProductController extends AppController
{
    public function actionView($id)
    {
        //$id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if(empty($product))
            throw new \yii\web\HttpException(404, 'Такого товара не существует.');
//        $product = Product::find()->with('category')->where(['id' => $id])->limit(1)->one();
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $this->setMeta('E_SHOPPER |'. $product->name, $product->keywords, $product>description );
        return $this->render('view', compact('product','hits'));
    }

    public function actionShow($id)
    {
        //$id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        $this->layout = false;
        return $this->render('img-modal', compact('product'));
    }
}