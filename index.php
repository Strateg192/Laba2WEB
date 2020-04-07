<?php session_start();
  include 'db.php';
  function createLinkPost($i, $haveLink)
  {
    if($haveLink)
    {
      $str = '<a href="http://lgtu.ru/?numberblock='. $i .'">'. ($i+1) . ' </a>';
      return $str;
    }
    else
    {
      $str = '<a href="#">'. ($i+1) . ' </a>';
      return $str;
    }
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

    <title>Студенческий файлообменник</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/offcanvas.css" rel="stylesheet">
    <style>
      TD, TH 
      {
        text-align: center;
        padding: 5px; /* Поля вокруг текста */
        border: 1px solid black; /* Рамка вокруг ячеек */
      }
    </style>
</head>

  <body class="bg-light">
      <div style="display: grid; grid-template-columns: auto min-content;">
        <div style="display: flex;">
            
        </div>
            <div style="display: flex; grid-column-start: 2; grid-row-start: 1;">
            <?php if(!isset($_SESSION['username'])) { ?>
              <a href="signin.php">Авторизация</a>
              /
              <a href="registr.php">Регистрация</a>
            <?php } else { ?>
              <p>Добро пожаловать <?php echo $_SESSION['username']; ?> </p>
              <br/>
              <a href="exit.php">Выход</a>
            <?php } ?>
            </div>
      </div>
      <?php if(isset($_SESSION['username']) && isset($_SESSION['login'])) { ?>
      <form>
        <button formaction="createPost.php">Добавить пост</button>
      </form>
      <?php } ?>
    <main role="main" class="container" style="margin-top: 100px;">
      <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="bootstrap-outline.svg" alt="" width="48" height="48">
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">Bootstrap</h6>
          <small>Since 2011</small>
        </div>
      </div>

      <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6>
        <table style="width: 100%;">
                    <tr> 
                      <td>Название</td>
                      <td>Дата и время</td>
                      <td>Автор</td>
                    </tr>
          <?php
            $countPostsOnOneBlock = 5;
            $numberblock = 0;
            if(isset($_GET['numberblock']))
            {
               $numberblock = $_GET['numberblock'];
            }
            $posts = ($db->query('select * from getblockposts('.$numberblock.');')->fetchAll(PDO::FETCH_ASSOC));
            foreach($posts as $key)
            { ?>
                    <tr> 
                      <td> <?php echo $key['postname']; ?> </td>
                      <td> <?php $tmpdate = strtotime($key['datecreating']);
                                        echo date('d.m.Y H:i:s', $tmpdate); ?> </td>
                      <td> <?php echo $key['username']; ?> </td>
                    </tr>
            <?php }
          ?>
          </table>
        <div style="text-align: center;">
            <?php
            $sql = 'select count(*) from "posts"';
            $countblocks = ($db->query($sql)->fetch(PDO::FETCH_LAZY))['count']; //на странице отображается блок
            $countblocks /= $countPostsOnOneBlock;
            $countblocks = $countblocks < 1 && $countblocks > 0 ? 1 : $countblocks;
            $countblocks = (int)$countblocks;
            $CBL = 9; //количество чисел в линии
            if($countblocks > $CBL)
            {
              if($numberblock >= ($CBL+1)/2 && $countblocks-$numberblock > ($CBL+1)/2)
              { 
                echo createLinkPost(0, true);
                ?>
                <a href="#"> ... </a>
              <?php 
                for($i = (int)($numberblock-floor(($CBL-4)/2)); $i < $numberblock; ++$i)
                { 
                  echo createLinkPost($i, true); 
                } ?>
                <a href="#"> <?php echo $numberblock+1; ?> </a>
                <?php
                for($i = $numberblock+1; $i < $numberblock+round(($CBL-4)/2); ++$i)
                { 
                  echo createLinkPost($i, true);
                } ?>
                <a href="#">...</a>
                <?php
                echo createLinkPost($countblocks-1, true);
              }
              else if ($numberblock < ($CBL+1)/2)
              {
                for($i = 0; $i < $numberblock; ++$i)
                { 
                  echo createLinkPost($i, true); 
                } 
                echo createLinkPost($numberblock, false);
                for($i = $numberblock+1; $i < $CBL-2; ++$i)
                { 
                  echo createLinkPost($i, true);
                } ?>
                <a href="#">...</a>
                <?php
                echo createLinkPost($countblocks-1, true);
              }
              else
              { 
                echo createLinkPost(0, true);
                ?>
                <a href="#"> ... </a>
                <?php 
                for($i = $countblocks-$CBL+2; $i < $numberblock; ++$i)
                { 
                  echo createLinkPost($i, true); 
                }
                echo createLinkPost($numberblock, false); 
                for($i = $numberblock+1; $i < $countblocks; ++$i)
                { 
                  echo createLinkPost($i, true);
                }
              }
            }
            else
            {
                for($i = 0; $i < $countblocks; ++$i)
                { ?>
                    <a href="<?php echo 'http://lgtu.ru/?numberblock='.$i; ?>"> <?php echo $i+1; ?> </a>
                <?php }
            }
            ?>
        </div>
      </div>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="jquery-slim.min.js"><\/script>')</script>
    <script src="popper.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="holder.min.js"></script>
    <script src="offcanvas.js"></script>
  </body>
</html>

<?php ?>