<?php $this->layout('view::Layout/layout.html.php'); ?>

<?php $this->start('assets');
echo $this->assets(['view::Events/events.js'], ['inline'=> false]);
$this->stop(); ?>

<?php $this->start('title');
echo $this->wh("page");
$this->stop(); ?>

<div id="target">

</div>
