<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <ul class="catalog category-products">
                        <?=\app\components\MenuWidget::widget(['tpl' => 'menu'])?>
                    </ul><!--/category-productsr-->

                    <div class="brands_products"><!--brands_products-->
                        <h2>Бренды</h2>
                        <div class="brands-name">
                           <!-- <?php /*foreach ($categories as $item):*/?>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="<?/*= \yii\helpers\Url::to(['category/view', 'id' => $item['id']]) */?>"><?/*= $item['name'].'('.ArrayHelper::getValue($data, 'cnt').')';*/?></a></li>
                                </ul>
                            --><?php /*endforeach;*/?>
                            <ul class="nav nav-pills nav-stacked">
                            <?=\app\components\MenuWidget::widget(['tpl' => 'categories'])?>
                            </ul>
                        </div>
                    </div><!--/brands_products-->
                    <div class="price-range"><!--price-range-->

                    </div><!--/price-range-->

                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->

                    <h2 class="title text-center"><?= $category->name?></h2>
                    <?php if(!empty($products)):?>
                        <?php $i = 0; foreach ($products as $product):?>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                   <?php $mainImg = $product->getImage(); ?>
                                    <?= Html::img($mainImg->getUrl(), ['alt' => $product->name])?>
                                    <h2>$<?= $product->price ?></h2>
                                    <p><a href="<?= \yii\helpers\Url::to(['product/view','id' => $product->id])?>"><?= $product->name ?></a></p>
                                    <a href="<?=\yii\helpers\Url::to(['cart/add', 'id' => $product->id])?>"
                                       data-id="<?=$product->id?>" class="btn btn-default add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>Добавить в корзину</a>
                                </div>
                                <!--<div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>-->
                                <?php if($product->new): ?>
                                    <?= Html::img("@web/images/home/new.png", ['alt' => 'Новинка','class' => 'new']); ?>
                                <?php endif; ?>
                                <?php if($product->sale): ?>
                                    <?= Html::img("@web/images/home/sale.png", ['alt' => 'Распродажа', 'class' => 'new']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                        <?php $i++ ?>
                        <?php if($i % 3 == 0):?>
                            <div class="clearfix"></div>
                        <? endif; ?>
                        <?php endforeach;?>
                        <div class="clearfix"></div>
                        <?php // подключаем постраничную навигацию
                        echo LinkPager::widget([
                            'pagination' => $pages,
                        ]);
                        ?>
                    <?php else:?>
                        <h2>В этой категории товары временно отсутствуют</h2>
                    <? endif; ?>

                    <!--<ul class="pagination">
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">&raquo;</a></li>
                    </ul>-->
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>