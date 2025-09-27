<?php
    use yii\helpers\Html;
    
    $this->registerCssFile('@web/css/news.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
    $this->registerCssFile("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css");
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        body {
            margin: 0;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #dbeafe, #f0f9ff);
        }
        .login-container {
            display: flex;
            height: 100%;
        }
        /* LEFT PANEL */
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: #fff;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .login-left img {
            max-width: 80%;
            height: auto;
            margin-bottom: 2rem;
        }
        /* RIGHT PANEL */
        .login-right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f9fafb;
        }
        .login-box {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 100%;
            max-width: 420px;
        }
        .nav-tabs {
            border-bottom: none;
            justify-content: center;
        }
        .nav-tabs .nav-link {
            border: none;
            font-weight: 600;
            color: #6b7280;
        }
        .nav-tabs .nav-link.active {
            color: #1d4ed8;
            border-bottom: 3px solid #1d4ed8;
        }
        .btn-primary {
            background: linear-gradient(to right, #2563eb, #3b82f6);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(to right, #1d4ed8, #2563eb);
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="login-container">
        <div class="login-left">
            <img src="/images/portal-berita.png" alt="Portal Berita Illustration">
            <h2 class="fw-bold">Welcome to Portal Berita</h2>
            <p class="mt-2">Portal berita digital terpercaya untuk semua informasi terkini</p>
        </div>
        <div class="login-right">
            <div class="login-box">
                <?= $content ?>
            </div>
        </div>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
