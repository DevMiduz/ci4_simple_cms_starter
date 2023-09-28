<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
    <?=form_open('content_types/update/' . $content_type['id'], ['method' => 'post'])?>

    <?=form_label('Title:', 'title')?>
    <?=form_input('title', is_null(old('title')) ? $content_type['title'] : old('title'))?>
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

    <table>
        <tr>
            <?php foreach ($table_keys as $table_key) : ?>
                <th><?=$table_key?></th>
            <?php endforeach; ?>
            
            <th>actions</th>
        </tr>

        <?php foreach ($table_rows as $row) : ?>
            <tr>
                <?php foreach ($table_keys as $table_key) : ?>
                    <td><?=$row[$table_key]?></td>
                <?php endforeach; ?>

                <td>| <a href="/content/<?= $row['id'] ?>">view</a> | <a href="/content/edit/<?= $row['id'] ?>">edit</a> | <a href="/content/delete/<?= $row['id'] ?>">delete</a> |</td>
            </tr>
        <?php endforeach; ?>
    </table>

<?= $this->endSection() ?>