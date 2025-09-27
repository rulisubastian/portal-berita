<?php
use yii\helpers\Html;
?>
<h1>Search Results for: <?= Html::encode($query) ?></h1>
<ul>
<?php foreach ($results as $news): ?>
    <li>
        <a href="<?= $news['url'] ?>" target="_blank">
            <?= Html::encode($news['title']) ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>
