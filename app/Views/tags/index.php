<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<a href="/tags/new">New Item</a>

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

            <td>| <a href="/tags/show/<?= $row['id'] ?>">view</a> | <a href="/tags/edit/<?= $row['id'] ?>">edit</a> | <a href="/tags/delete/<?= $row['id'] ?>">delete</a> |</td>
        </tr>
    <?php endforeach; ?>
</table>
<?= $this->endSection() ?>