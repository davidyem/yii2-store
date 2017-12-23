<li>
    <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $category['id']]) ?>">
        <?= $category['name']?>
    </a>
    <?php if(isset($category['childs'])):?>
            <?= $this->getMenuHtml($category['childs'])?>
    <?php endif;?>
</li>