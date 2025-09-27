<?php
    use yii\helpers\Html;
?>

<div class="card h-100 shadow-sm">
    <?php if (!empty($news['urlToImage'])): ?>
        <img src="<?= Html::encode($news['urlToImage']) ?>"
             class="card-img-top"
             alt="<?= Html::encode($news['title']) ?>"
             style="height:180px; object-fit:cover;">
    <?php endif; ?>
    <div class="card-body">
        <h6 class="card-title fw-bold">
            <?= Html::a(Html::encode($news['title']), $news['url'], ['target' => '_blank']) ?>
        </h6>
        <p class="card-text small text-muted">
            <?= Html::encode(mb_substr($news['description'] ?? '', 0, 100)) ?>...
        </p>
    </div>
</div>
