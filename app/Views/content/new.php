<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
    <?=form_open('content/create', ['method' => 'post'])?>

    <?=form_label('Title:', 'title')?>
    <?=form_input('title', is_null(old('title')) ? "" : old('title'))?>
    <?=validation_show_error('title')?>

    <?=form_label('Description:', 'description')?>
    <?=form_textarea('description', is_null(old('description')) ? "" : old('description'), ['rows' => 4])?>
    <?=validation_show_error('description')?>

    <?=form_label('Content Body:', 'content_body')?>
    <?=form_textarea('content_body', is_null(old('content_body')) ? "" : old('content_body'), ['rows' => 12])?>
    <?=validation_show_error('content_body')?>

    <?=form_label('Content Type:', 'content_type_id')?>
    <?=form_dropdown('content_type_id', $content_types, is_null(old('content_type_id')) ? "" : old('content_type_id'))?>
    <?=validation_show_error('content_type_id')?>

    <?=form_label('Content Tags:', 'content_tags[]')?>
    <?=form_multiselect('content_tags[]', $tags, is_null(old('content_tags[]')) ? [] : old('content_tags[]'))?>
    <?=validation_show_error('content_tags[]')?>

    <?=form_label('Published:', 'published')?>
    <?=form_checkbox('published', true, is_null(old('published')) ? 0 : old('published'))?>
    <?=validation_show_error('published')?>

    <p>
        <?= session()->getFlashdata('message') ?>
        <?= session()->getFlashdata('error') ?>
    </p>

    <p>
        <?=form_submit('save_submit', 'Save')?>
    </p>
    <?=form_close()?>

    <a href="/content">Go Back</a>
<?= $this->endSection() ?>