<?php 
    session_start();
    include 'db.php';
    if(!isset($_GET['idpost']))
    {
        header('Location: http://lgtu.ru/');
        return;
    }
    $sql = 'select * from getpost('. ((int)$_GET['idpost']) .')';
    $post = ($db->query($sql))->fetchAll(PDO::FETCH_ASSOC);
    $sql = 'select * from getfiles('. ((int)$_GET['idpost']) .')';
    $files = ($db->query($sql))->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Пример на bootstrap 4: Скользящее меню - превратите расширяемую навигационную панель в скользящем меню. Версия v4.0.0">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <style>
        td, th
        {
            text-align: center;
            padding: 5px;
            border: 1px solid black;
        }
        .maingrid
        {
            display: grid;
            border: 1px black solid;
            text-align: center;
            grid-template-rows: auto auto auto auto;
        }
        .maingridName
        {
            font-size: 20px;
            padding: 10;
            grid-row: 1;
            border: 1px solid black;
        }
        .maingridDateAndAuthor
        {
            display: grid;
            grid-template-columns: auto auto;
        }
        .maingridDate
        {
            padding: 5;
            grid-column: 1;
            border: 1px solid black;
        }
        .maingridAuthor
        {
            padding: 5;
            grid-column: 2;
            border: 1px solid black;
        }
        .maingridFiles
        {
            border: 1px solid black;
            display: grid;
            grid-template-columns: auto min-content;
        }
        .maingridFile
        {
            border: 1px solid black;
            text-align: left;
            padding: 5;
        }
        .maingridDownload
        {
            border: 1px solid black;
            padding: 5;
        }
        .maingridText
        {
            border: 1px solid black;
            padding: 5;
        }
    </style>
    <title>Пост</title>
</head>
  <body>
    <?php include 'header.php'; ?>
    <div class="maingrid">
        <div class="maingridName"> <?php echo $post[0]['postname']; ?> </div>
        <div class="maingridDateAndAuthor">
            <div class="maingridDate"> <?php echo $post[0]['postdatecreating']; ?> </div>
            <div class="maingridAuthor"> <?php echo $post[0]['username']; ?> </div>
        </div>
        <div class="maingridText"> <?php echo $post[0]['posttext']; ?> </div>
        <div class="maingridFiles">
            <?php foreach($files as $key)
            { ?>
            <div class="maingridFile"> <?php echo basename($key["filelink"]); ?> </div>
            <div class="maingridDownload"><a href="http://lgtu.ru/getfiles.php/?idfile=<?php echo $key['idfile']; ?>">Скачать</a></div>
            <?php } 
            ?>
        </div>
    </div>
  </body>
</html>