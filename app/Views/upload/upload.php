<!DOCTYPE html>
<?php helper('html'); ?>
<? if ($js != '') : ?>

<script type="text/javascript" src="public/<?=$js;?>">

<? endif;?>
<html lang="en">
<head>
  <meta charset="UTF-8">
<?php echo link_tag('upload.css')?>
    <title>Upload Form</title>
</head>
<body>
<div class="container">
  <form class="form">
    <div class="file-upload-wrapper" data-text="Select your file!">
      <button id="dark-mode-toggle">Toggle Dark Mode</button>
    </div>
  </form>
</div>
    <div class="body"></div>
    <body class="dark-mode">

    </body>

<?php foreach ($errors as $error): ?>
    <li><?= esc($error) ?></li>
<?php endforeach ?>

<?= form_open_multipart('upload/upload') ?>
    <input type="file" name="userfile" size="20">
    <br><br>
    <input type="submit" value="upload">
</form>

</body>
</html>
