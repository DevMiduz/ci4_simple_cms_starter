<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
    <?=form_open('content_types/create', ['method' => 'post'])?>

    <?=form_label('Title:', 'title')?>
    <?=form_input('title', is_null(old('title')) ? "" : old('title'))?>
    <?=validation_show_error('title')?>

    <p>
        <?= session()->getFlashdata('message') ?>
        <?= session()->getFlashdata('error') ?>
    </p>

    <p>
        <?=form_submit('save_submit', 'Save')?>
    </p>
    <?=form_close()?>

    <a href="/content_types">Go Back</a>
<?= $this->endSection() ?>