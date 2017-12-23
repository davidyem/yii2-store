<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 31.08.2017
 * Time: 15:45
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use yii\db\Query;


class CategoryController extends AppController
{
    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $category = Category::find()->all();
        $this->setMeta('E_SHOPPER');
        return $this->render('index', compact('hits','category'));
    }

    public function actionView($id)
    {
        //$id = Yii::$app->request->get('id');
        $category = Category::findOne($id);
        $categories = Category::find()->all();
        if(empty($category))
            throw new \yii\web\HttpException(404, 'Такой категории не существует.');
//        $products = Product::find()->where(['category_id' => $id])->all();
        $query = Product::find()->where(['category_id' => $id]); //получили object
        $pages = new Pagination(['totalCount' => $query->count(),
            'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('E_SHOPPER |'. $category->name, $category->keywords, $category->description );
        return $this->render('view', compact('products','pages', 'category', 'categories','data'));
    }



    public function actionSearch()
    {
        $q = trim(Yii::$app->request->get('q'));
        $this->setMeta('E_SHOPPER | Поиск: ' . $q);
        if(!$q)
            return $this->render('search');
        $id = Yii::$app->request->get('id');
        $category = Category::findOne($id);
        $query= Product::find()->where(['like' ,'name', $q]); //получили object
        $pages = new Pagination(['totalCount' => $query->count(),
            'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('products', 'pages', 'q', 'category'));

    }
}
