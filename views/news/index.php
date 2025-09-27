<?php

use yii\helpers\Html;

/** @var array $topNews */
/** @var string|null $category */

$this->title = "Portal Berita";
?>

<div class="site-index">

    <!-- HERO / TOP HEADLINES -->
    <?php if (!empty($topNews)): ?>
        <div class="row mb-4">
            <!-- Berita Utama -->
            <div class="col-md-8">
                <?php $mainNews = $topNews[0]; ?>
                <div class="card bg-dark text-white border-0 shadow-lg">
                    <img src="<?= Html::encode($mainNews['urlToImage']) ?>" 
                         class="card-img" 
                         alt="<?= Html::encode($mainNews['title']) ?>" 
                         style="height:420px; object-fit:cover; opacity:0.8;">
                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                        <h3 class="card-title fw-bold">
                            <?= Html::a(Html::encode($mainNews['title']), $mainNews['url'], ['target' => '_blank', 'class' => 'text-white text-decoration-none']) ?>
                        </h3>
                        <p class="card-text small text-light">
                            <?= Html::encode(mb_substr($mainNews['description'] ?? '', 0, 120)) ?>...
                        </p>
                        <span class="badge bg-primary">
                            <?= Html::encode($mainNews['source']['name'] ?? 'Unknown') ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Berita Samping -->
            <div class="col-md-4">
                <h5 class="fw-bold border-bottom pb-2">Top Picks</h5>
                <?php foreach (array_slice($topNews, 1, 4) as $news): ?>
                    <div class="d-flex mb-3">
                        <?php if (!empty($news['urlToImage'])): ?>
                            <img src="<?= Html::encode($news['urlToImage']) ?>"
                                 class="me-3 rounded"
                                 style="width:100px; height:70px; object-fit:cover;">
                        <?php endif; ?>
                        <div>
                            <h6 class="mb-1">
                                <?= Html::a(Html::encode($news['title']), $news['url'], ['target' => '_blank', 'class' => 'text-dark']) ?>
                            </h6>
                            <small class="text-muted"><?= date('d M Y', strtotime($news['publishedAt'])) ?></small>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- KONTEN BERITA + SIDEBAR -->
    <div class="row">
        <!-- List Berita -->
        <div class="col-md-8">
            <h4 class="fw-bold mb-3">Berita Terbaru</h4>
            <div class="row">
                <?php foreach (array_slice($topNews, 5) as $news): ?>
                    <div class="col-md-6 mb-4">
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
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <h5 class="fw-bold border-bottom pb-2">Kategori</h5>
            <ul class="list-group mb-4">
                <li class="list-group-item"><a href="/news/index?category=general">Umum</a></li>
                <li class="list-group-item"><a href="/news/index?category=business">Bisnis</a></li>
                <li class="list-group-item"><a href="/news/index?category=entertainment">Hiburan</a></li>
                <li class="list-group-item"><a href="/news/index?category=health">Kesehatan</a></li>
                <li class="list-group-item"><a href="/news/index?category=science">Sains</a></li>
                <li class="list-group-item"><a href="/news/index?category=sports">Olahraga</a></li>
                <li class="list-group-item"><a href="/news/index?category=technology">Teknologi</a></li>
            </ul>

            <h5 class="fw-bold border-bottom pb-2">Trending</h5>
            <?php foreach (array_slice($topNews, 0, 5) as $news): ?>
                <div class="mb-3">
                    <small class="text-muted"><?= date('d M Y', strtotime($news['publishedAt'])) ?></small>
                    <p class="mb-0 fw-bold">
                        <?= Html::a(Html::encode($news['title']), $news['url'], ['target' => '_blank', 'class' => 'text-dark']) ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
