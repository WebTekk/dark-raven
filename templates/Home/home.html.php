<?php $this->layout('view::Layout/layout.html.php'); ?>

<?php $this->start('assets');
echo $this->assets(['view::Home/home.css'], ['inline'=> false]);
$this->stop(); ?>

<?php $this->start('title');
echo $this->e("Home");
$this->stop(); ?>

<h1>Slim template</h1>
