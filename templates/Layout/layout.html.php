<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#222222">
    <meta name="author" content="Marc Wilhelm">
    <meta name="description" content="A Slim template">
    <meta name="keywords" content="Slim, template">
    <meta name=“robots” content=“nofollow”>
    <base href="<?= $this->wh("root") ?>">
    <link rel="canonical" href="<?= $this->wh("canonical") ?>"/>
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/mustache.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>

    <?= $this->section('assets') ?>
    <?= $this->assets('view::Layout/layout.css', ['inline' => false]) ?>
    <title><?= $this->wh("page") ?></title>

</head>
<body>

<!-- ################ Navbar start ############### -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a href="<?= $this->wh("root") ?>" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="<?= $this->wh("root") ?>events" class="nav-link">Events</a>
            </li>
        </ul>
    </div>
</nav>
<!-- ################# Navbar end ################## -->

<div>
    <div class="content">
        <?= $this->section('content') ?>
    </div>
</div>

<nav class="navbar fixed-bottom navbar-dark bg-dark">
    <div>by Tekk</div>
</nav>

<div id="loader">
    <div id="loading"></div>
</div>

</body>
</html>
