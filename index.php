<?php
include("include/db_connect.php");
session_start();

If ($_POST["submit_enter"])
 {
    $login = $_POST["input_login"];
    $pass  = $_POST["input_pass"];
    
  
 if ($login && $pass)
  { 

    $result = mysqli_query($connection, "SELECT * FROM users WHERE user_name = '$login' AND user_password = '$pass'");
If (mysqli_num_rows($result) > 0)
  {
    $row = mysqli_fetch_array($result);
    $_SESSION['auth_admin'] = 'yes_auth'; 


    header("Location: admin.php");
  }else
  {
        $msgerror = "Невірний логін або(та) Пароль."; 
  }

        
    }else
    {
        $msgerror = "Заповніть всі поля!";
    }
 
 }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Тестовое задание</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=cp1251"/>
</head>
<body>
    <div id="form">
        <form name="form_add" enctype='multipart/form-data' method="post" action="handler.php">
            <input type="hidden" value="" name="action">
            <h3>Имя</h3>
            <p><input type="text" name="name" ></p>
            <h3>Почта</h3>  
            <input type="text" name="mail" > 
            <h3>Задача</h3> 
            <textarea name="textarea"></textarea>
            <h3>Картинка</h3>
            <input type="file" name="file" >
            <br>    
            
        </form>
        <br>
        <input type="button" value="Добавить" onclick="document.forms['form_add'].action.value='save'; document.forms['form_add'].submit();"> 
        <input type="button" value="Предварительный просмотр" onclick="document.forms['form_add'].action.value='view'; document.forms['form_add'].target='_blank'; document.forms['form_add'].submit();">
    </div>
    <div id="block-pass-login" >
    <?php
        if ($msgerror)
        {
            echo '<p id="msgerror" >'.$msgerror.'</p>';
            
        }
    ?>
        <form method="post" >
            <ul id="pass-login" type="none">
                <li>
                    <h3>Логін</h3>
                    <input type="text" name="input_login" /></li>
                <li>
                    <h3>Пароль</h3>
                    <input type="password" name="input_pass" />
                </li>
            </ul>
            <p align="right"><input type="submit" name="submit_enter" id="submit_enter" value="Вхід" /></p>
        </form>
    </div>
</body>
</html>
<style type="text/css">
    body{
        padding: 50px;
    }
    input{
        height: 30px;
        margin-bottom: 15px;
    }
    #block-pass-login{
        margin-top: 50px;
        border: 1px solid;
        padding: 10px;
        width: 170px;
    }

</style>
