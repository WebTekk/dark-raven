<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#222222">
    <meta name="author" content="Marc Wilhelm">
    <meta name="description" content="A Slim template">
    <meta name="keywords" content="Slim, template">
    <meta name=“robots” content=“nofollow”>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <base href="<?= $this->wh("root") ?>">
    <link rel="canonical" href="<?= $this->wh("canonical") ?>"/>
    <link rel="icon" href="favicon.ico">
    <script src="js/jquery.min.js"></script>
    <script src="js/script.js"></script>

    <?= $this->section('assets') ?>
    <?= $this->assets('view::Layout/layout.css', ['inline' => false]) ?>
    <title><?= $this->wh("page") ?></title>

</head>
<body>
<div id="header">
    <div id="leftspace"></div>
    <div id="head1" class="headerLink"><a href="<?= $this->wh("root") ?>">Home</a></div>
    <div id="head2" class="headerLink"><a href="<?= $this->wh("root") ?>events">Events</a></div>
</div>
<div id="content">
    <div id="container">
        <?= $this->section('content') ?>
    </div>
    <div id="footer">Footer</div>
</div>
</body>
</html>
