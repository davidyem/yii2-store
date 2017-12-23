<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 30.08.2017
 * Time: 17:41
 */

namespace app\components;
use yii\base\Widget;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\db\Query;

class MenuWidget extends Widget
{
    public $tpl;
    public $data; //array of categories
    public $tree; //array tree
    public $menuHtml;
    public $model;

    public function init ()
    {
        parent::init();
        if( $this->tpl === null ) {
            $this->tpl ='menu';
        }
        $this->tpl .= '.php';

    }

    public function run ()
    {
        //get cache
        if($this->tpl == 'menu.php'){
            $menu = Yii::$app->cache->get('menu');
            if($menu) return $menu;
        }
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        //set cache
        if($this->tpl == 'menu.php'){
            Yii::$app->cache->set('menu', $this->menuHtml, 60);
        }
        return $this->menuHtml;

        /*$cache = Yii::$app->cache;
        return $cache->getOrSet('menu',function () {
            $this->data = Category::find()->indexBy('id')->asArray()->all();
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
            return $this->menuHtml;
        }, 60);*/
    }

    protected function getTree(){
        $tree = [];
        foreach ($this->data as $id=>&$node) {
            if(!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = ''){
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category, $tab);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab){
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }
}