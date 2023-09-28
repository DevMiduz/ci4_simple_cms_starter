<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<?= form_open_multipart('file_upload/upload', ['method' => 'post']) ?>
<?= form_label('File:', 'zipfile') ?>
<?= form_upload('zipfile', is_null(old('zipfile')) ? '' : old('zipfile'), ['accept' => '.zip']) ?>
<?= validation_show_error('zipfile') ?>

<br />

<p>
    <?= session()->getFlashdata('message') ?>
    <?= session()->getFlashdata('error') ?>
</p>

<p>
    <?= form_submit('upload_submit', 'Upload') ?>
</p>
<?= form_close() ?>


<?= $this->endSection() ?>