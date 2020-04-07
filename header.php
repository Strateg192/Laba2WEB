<?php 
    session_start();
    $isHaveUserName = isset($_SESSION['username']);
    $username = $isHaveUserName ? $_SESSION['username'] : "";
  ?>
<div style="
    border: 1px solid black;
    display: grid;
    grid-template-columns: auto auto; ">
    <div style="border: 1px solid black; padding: 5px;">
        <a href="http://lgtu.ru/">Главная</a>
    </div>
    <div style="border: 1px solid black; text-align: right; padding: 5px;">
        <?php if($isHaveUserName)
        { ?>
            <a>Привет, <?php echo $username; ?> </a>
            <a href="http://lgtu.ru/exit.php">Выход</a>
        <?php } 
        else
        { ?>
            <a href="http://lgtu.ru/signin.php">Авторизация</a>
              /
              <a href="http://lgtu.ru/registr.php">Регистрация</a>
        <?php }
        ?>
    </div>
</div>