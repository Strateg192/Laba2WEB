<?php
    if(isset($_POST['login']) && isset($_POST['password']))
    {
        include 'db.php';
        //$sql = 'SELECT top 1 * from "user" WHERE login = \'' . $_POST['login'] . '\' and password = \'' . $hashpasw . '\'';
        $sql = 'SELECT * from "user" WHERE login = \'' . $_POST['login'] . '\' fetch first 1 rows only';
        //select count(*) from "user" where login = '6@1.ru' and password = '$2y$10$fOc7197wnLLlul0zTOZ6zuQzOKgpohOnbKrMspiPtyTRHK4H9vV72'
        //$row = $db->query($sql)->fetch(PDO::FETCH_NUM);
        $row = $db->query($sql)->fetch(PDO::FETCH_LAZY);
        if(password_verify($_POST['password'], $row['password']))
        {
            session_start();
            $_SESSION['username'] = $row['name'];
            $_SESSION['login'] = $row['login'];
        }
        header('Location: http://lgtu.ru/');
        return;
    }
?>