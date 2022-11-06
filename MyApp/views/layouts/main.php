<?php

use app\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header>
    <h1>HEADER</h1>
    <a href="<?=Url::to(['site/hello'], true);?>"> hello </a><br>
    <a href="<?=Url::to(['site/index'], true);?>"> main page </a><br>
    <a href="<?=Url::to(['contact/index'], true);?>"> go to contact </a><hr>
</header>

<main>
    <?= $content ?>
</main>
<hr>
<footer>
    <h1>FOOTER</h1>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
