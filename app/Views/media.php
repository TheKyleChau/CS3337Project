<!DOCTYPE html>
<html>
<head>
    <title>Media List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }

        .media-item {
            display: flex;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        .media-item-image {
            flex: 0 0 100px;
            margin-right: 10px;
        }

        .media-item-image img {
            max-width: 500px;
            max-height: 500px;
        }

        .media-item-details {
            flex-grow: 1;
        }

        .media-item-details h3 {
            margin-top: 0;
        }

        .media-item-details p {
            margin-bottom: 5px;
        }

        .media-item-actions {
            flex: 0 0 50px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .media-item-actions button {
            margin-bottom: 10px;
        }

        .media-item-caption {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Media List</h1>
    <div class="media-list">
      <center>
        <div>
            <form action="<?= site_url('upload') ?>" method="get">
                <button type="submit">Upload</button>
            </form>
        </div>
      </center>
        <?php foreach ($media as $item): ?>
            <div class="media-item">
                <div class="media-item-image">
                    <img src="<?= base_url('/' . $item['url']) ?>" alt="Image">
                </div>
                <div class="media-item-details">
                    <h3><?= $item['filename'] ?></h3>
                    <p>Type: <?= $item['mediatype'] ?></p>
                    <p>ID: <?= $item['id'] ?></p>
                    <p>Caption: <?= $item['caption'] ?></p>
                </div>
                <div class="media-item-actions">
                    <form action="<?= site_url("upload/delete/{$item['id']}") ?>" method="post">
                        <button type="submit">Delete</button>
                    </form>
                    <form action="<?= site_url("upload/update-caption/{$item['id']}") ?>" method="post">
                        <textarea name="caption" rows="3" class="media-item-caption"><?= $item['caption'] ?></textarea>
                        <button type="submit">Update Caption</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
