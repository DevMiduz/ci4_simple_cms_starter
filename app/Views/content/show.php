<?= $this->extend('layouts/content') ?>

<?php
    $parsedown = new Parsedown();
?>

<?= $this->section('content') ?>
    
    <?=$parsedown->text($content['content_body'])?>
    <a href="/content">Go Back</a>
<?= $this->endSection() ?>