<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<fieldset>
<p>
    <label>ID: <?=$tag['id']?></label>
    <label>Title: <?=$tag['title']?></label>
</p>
</fieldset>

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

    <a href="/tags">Go Back</a>
<?= $this->endSection() ?>