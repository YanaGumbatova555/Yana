<?php
require_once('db1.php');

  if (isset($_POST['submit'])) {
    
    $user_lastname = $_POST['lastname'];
    $user_password = $_POST['password'];
    
    
    if (!empty($user_lastname) && !empty($user_password)) {
      $_SESSION["lastname"] = $user_lastname;
      $sql_select = "SELECT 'id', 'lastname' FROM signup WHERE lastname = '$user_lastname' AND password = '$user_password'";
      $stmt = $conn->query($sql_select);
      $stmt->execute();
      $data = $stmt->fetchAll();
    }
    else {
      echo 'Поля заполнены не верно';
    }
  }
 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/style2.css">
    <title>Вход</title>
  </head>
  <body>
    <div class="container">
 
      
      <form class="" action="index.php" method="post">
        <div class="dws-input">
          <input type="text" name="lastname" placeholder="Введите логин...">
        </div>
        <div class="dws-input">
          <input type="password" name="password" placeholder="Введите пароль...">
        </div>
        <input class="dws-submit" type="submit" name="submit" value="Войти">
        <br>
        <a href="\sugnup.php">Регистрация</a>
      </form>


    </div>
  </body>
</html>
