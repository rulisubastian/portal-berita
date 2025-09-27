<?php

    use yii\helpers\Html;
    use yii\widgets\ListView;

    /** @var array $topNews */
    /** @var string|null $category */

    $this->registerCssFile('@web/css/custom.css');

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
                            <h6 class="mb-1 justify-content-center">
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
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'col-md-6 mb-4'],
                'layout' => "
                    <div class='row'>{items}</div>
                    <div class='d-flex justify-content-center mt-3'>
                        <div class='wrapper-pgn'>
                            <div class='pgn pgn-default'>
                                {pager}
                            </div>
                        </div>".
                        // <div class='mouse'>
                        //     <svg class='arrow' width='25' height='26' viewBox='0 0 25 26' fill='none' xmlns='http://www.w3.org/2000/svg'>
                        //         <path d='M2 0.5C4.45643 15.9142 8.93338 21.7892 24.5 25.5' stroke='#636363'/>
                        //         <path d='M2 1L1 5.5' stroke='#636363'/>
                        //         <path d='M2 1L5 5' stroke='#636363'/>
                        //     </svg>
                        //     <img src='https://static.wixstatic.com/media/10b249_db895fd83b974becb711dcea248fde75~mv2.gif' alt=''>
                        // </div>
                    "</div>",
                'itemView' => function ($news, $topNews) {
                    return $this->render('news', ['news' => $news, 'topNews' => $topNews]);
                },
                'pager' => [
                    'class' => \app\components\CustomPager::class,
                    'prevPageLabel' => '‹',
                    'nextPageLabel' => '›',
                ],
            ]) ?>
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
                    <small class="text-muted "><?= date('d M Y', strtotime($news['publishedAt'])) ?></small>
                    <p class="mb-0 fw-bold justify-content-center">
                        <?= Html::a(Html::encode($news['title']), $news['url'], ['target' => '_blank', 'class' => 'text-dark']) ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const pagesBlock = document.querySelector('.pages');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');

    if (!pagesBlock) return; // tidak ada pagination -> stop

    // WHEEL (desktop) — gunakan passive:false agar preventDefault bekerja
    pagesBlock.addEventListener('wheel', function(e) {
        // hanya horizontal scroll behaviour, untuk vertical convert ke horizontal
        if (Math.abs(e.deltaY) > 0) {
            e.preventDefault();
            pagesBlock.scrollLeft += e.deltaY; // atau * 1.5 untuk lebih cepat
        }
    }, { passive: false });

    // prev/next click (jika ada elemen prev/next di layout)
    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            pagesBlock.scrollBy({ left: -160, behavior: 'smooth' });
        });
    }
    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            pagesBlock.scrollBy({ left: 160, behavior: 'smooth' });
        });
    }

    // TOUCH (mobile swipe)
    let startX = 0;
    let startScroll = 0;
    pagesBlock.addEventListener('touchstart', function(e) {
        startX = e.touches[0].pageX;
        startScroll = pagesBlock.scrollLeft;
    }, { passive: true });

    pagesBlock.addEventListener('touchmove', function(e) {
        const x = e.touches[0].pageX;
        const walk = startX - x; // how much finger moved
        pagesBlock.scrollLeft = startScroll + walk;
    }, { passive: false });

    // optional: keyboard support (make container focusable)
    pagesBlock.tabIndex = 0;
    pagesBlock.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowRight') pagesBlock.scrollBy({ left: 120, behavior: 'smooth' });
        if (e.key === 'ArrowLeft') pagesBlock.scrollBy({ left: -120, behavior: 'smooth' });
    });
});
</script>
