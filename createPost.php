<?php 
  session_start();
  if(!isset($_SESSION['username']) || !isset($_SESSION['login']))
  {
    header('Location: http://lgtu.ru/');
    return;
  }
  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Пример на bootstrap 4: Скользящее меню - превратите расширяемую навигационную панель в скользящем меню. Версия v4.0.0">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Создание поста</title>
</head>
  <body>
  <?php include 'header.php'; ?>
  <form action="createPostBack.php" method="POST" enctype="multipart/form-data">
      <label>Название:</label>
      <input type="text" name="namePost" placeholder="Навзание вашего поста">
      <br/>
      <label>Текст:</label>
      <input type="text" name="textPost" placeholder="Содержимое поста">
      <br/>
      <input type="hidden" name="MAX_FILE_SIZE" value="10240000" />
      <br/>
      <div>
        <input class="form-control" name="userfile[]" type="file" accept=".zip,.doc,.docx,.xls,.xlsx,.pdf,.jpg,.png" required multiple />
      </div>
      <br/>
      <button type="submit">Создать</button>
    </form>
  </body>
</html>