<head>
<link href="style.css" rel="stylesheet">
<?php include_once "connection.php"?>
</head>

<div class="header"> 
Это голова
  
<div class="loginform">   

<form action="login.php" method="get">
<label>Логин:</label><br>
<input type="text" name="name" placeholder="Введите ваш логин"><br>
<label>Пароль:</label><br>
<input type="password" name="password" placeholder="1234567890"><br>
<input type="submit" name="submit" value="Войти">
<button formaction="sugnup.php">Регистрация</button>
  </form>      
      </div>
    </div>
