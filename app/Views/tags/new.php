<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
    <?=form_open('tags/create', ['method' => 'post'])?>

    <?=form_label('Title:', 'name')?>
    <?=form_input('title', is_null(old('title')) ? "" : old('title'))?>
    <?=validation_show_error('title')?>

    <p>
        <?= session()->getFlashdata('message') ?>
        <?= session()->getFlashdata('error') ?>
    </p>

    <p>
        <?=form_submit('create_submit', 'Create')?>
    </p>
    <?=form_close()?>

    <a href="/tags">Go Back</a>
<?= $this->endSection() ?>