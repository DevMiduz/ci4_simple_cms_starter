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
                <th><?=$row[$table_key]?></th>
            <?php endforeach; ?>
        </tr>

        <tr>
            <a href="/tags/show/<?= $tag['id'] ?>">view</a>|<a href="/tags/edit/<?= $tag['id'] ?>">edit</a>|<a href="/tags/delete/<?= $tag['id'] ?>">delete</a>
        </tr>
    <?php endforeach; ?>
</table>
<?= $this->endSection() ?>