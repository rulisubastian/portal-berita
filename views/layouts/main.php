<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use app\controllers\NewsController;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$this->registerCssFile('@web/css/news.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
$this->registerCssFile("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css");


$currentCategory = Yii::$app->request->get('category', 'business');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <div class="top-bar bg-white py-1 border-bottom">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="site-title">
                <span class="fw-light">SITUS</span> 
                <span class="fw-bold text-danger">PORTAL BERITA</span>
            </div>
            <div class="social-icons d-flex align-items-center">
                <a href="#" class="social-icon facebook me-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="social-icon twitter me-2"><i class="bi bi-twitter"></i></a>
                <a href="#" class="social-icon rss me-2"><i class="bi bi-rss"></i></a>
                <a href="#" class="social-icon youtube"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </div>

    <div class="main-menu bg-dark">
        <div class="container d-flex justify-content-between align-items-center">
            <nav class="navbar navbar-expand-md navbar-dark">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link <?= Yii::$app->controller->id === 'site' ? 'active' : '' ?>" 
                               href="<?= Yii::$app->homeUrl ?>">HOME</a>
                        </li>
                        <?php foreach (NewsController::categories() as $key => $label): ?>
                            <li class="nav-item">
                                <a class="nav-link <?= ($currentCategory === $key) ? 'active' : '' ?>"
                                   href="<?= Url::to(['/news/index', 'category' => $key]) ?>">
                                    <?= strtoupper($label) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </nav>
            <form class="d-flex ms-3" action="<?= \yii\helpers\Url::to(['news/search']) ?>" method="get">
                <input class="form-control form-control-sm" type="search" name="q" placeholder="Pencarian">
                <button class="btn btn-sm btn-light ms-1" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
