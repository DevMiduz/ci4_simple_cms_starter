<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<a href="/content_types/new">New Item</a>

<p>
    <?= session()->getFlashdata('message') ?>
    <?= session()->getFlashdata('error') ?>
</p>

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

            <td>| <a href="/content_types/<?= $row['id'] ?>">view</a> | <a href="/content_types/edit/<?= $row['id'] ?>">edit</a> | <a class="delete-link" href="/content_types/delete/<?= $row['id'] ?>" onclick="app.delete_link_submit(event, this);">delete</a> |</td>
        </tr>
    <?php endforeach; ?>
</table>
<?= $this->endSection() ?>