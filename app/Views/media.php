<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Size</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($media as $item): ?>
        <tr>
            <td><?= $item['filename'] ?></td>
            <td><?= $item['mediatype'] ?></td>
            <td><?= $item['id'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
