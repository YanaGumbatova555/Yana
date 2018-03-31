<html>
<head>
<Title>Интернет-магазин</Title>
<style type="text/css">
    body { background-color:
 #fff; border-top: solid 10px #000;
 color: #333; font-size: .85em;
 margin: 20; padding: 20;
 font-family: "Segoe UI",
 Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; 
margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em;
 text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; 
border: 0 none; }
</style>
</head>

<?php 
require_once('db.php'); 
if (isset($_POST['submit'])) { 
$user_username = $_POST['username']; 
$user_password = $_POST['password']; 
if (!empty($user_username) && !empty($user_password)) { 
$_SESSION['logged_user'] = $_POST['username']; 
$sql_select = "SELECT 'id', 'login' FROM users WHERE login = '$user_username' AND password = '$user_password'"; 
$stmt = $conn->query($sql_select); 
$stmt->execute(); 
$data = $stmt->fetchAll(); 
} 
else { 
echo '<div style = "color: red; text-align: center;">Поля заполнены неправельно!</div><hr>'; 
} 
} 
?> 

<!DOCTYPE html> 
<html> 
<head> 
<meta charset="utf-8"> 
<link rel="stylesheet" href="/css/style.css"> 
<link rel="stylesheet" href="/css/font-awesome.css"> 
<title>Авторизация</title> 
</head> 
<body> 

<div class="container"> 
<?php if (empty($_SESSION['logged_user'])) : ?> 
<img src="img/lock.png"> 
<form class="" action="index.php" method="post"> 
<div class="dws-input"> 
<input type="text" name="username" placeholder="Введите логин" value="<?php echo @$_POST['username']; ?>"> 
</div> 
<div class="dws-input"> 
<input type="password" name="password" placeholder="Введите пароль">
</div> 
<input class="dws-submit" type="submit" name="submit" value="Войти"> 
<br> 
<a href="\sugnup.php">Регистрация</a> 
</form> 

<?php elseif($_SESSION['logged_user'] == 'Admin') : ?> 

<div style="padding: 10px;"> 
<h1 style="color: white;">Добро пожаловать, <span style="color: #eec30a;"><?php echo $_SESSION['logged_user']; ?></span></h1> 
</div> 

<hr> 

<div style="padding: 45px;font-size: 2.1em;"> 
<p><a href="\table-bd.php" style="color: #ee7e0a;">Панель администратора</a></p> 
<p><a href="\exit.php" style="color: #f0f0f0;">Выйти</a></p> 
</div> 


<?php else : ?> 
<div style="padding: 10px;"> 
<h1 style="color: white;">Добро пожаловать, <span style="color: #eec30a;"><?php echo $_SESSION['logged_user']; ?></span></h1> 
</div> 

<hr> 

<div style="padding: 45px;font-size: 2.1em;"> 
<p><a href="\personal.php" style="color: #ee7e0a;">Мой профиль</a></p> 
<p><a href="\exit.php" style="color: #f0f0f0;">Выйти</a></p> 
</div> 
<?php endif; ?> 

</div> 
</body> 
</html>
