<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Авторизация</title>
    <style>
    .container {
      width: 300px;
      height: 320px;
      margin: 200px auto 0 auto;
      text-align: center;
      background-color: #afacaa;
    }
    .sub {
      text-align: center;
      margin-left: 90px;
      width: 95px;
      height: 30px;
    }
    .form-control {
      width: 270px;
    }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
      	<div class="col-sm-4">
          <form class="" action="authorization.php" method="post">
            <legend><h1>Авторизация</h1></legend>
            <div class="form-group">
              <label for="">Логин</label>
              <input class="form-control" type="text" name="username" value="">
            </div>
            <div class="form-group">
              <label for="">Пароль</label>
              <input class="form-control" type="password" name="password" value="">
            </div>
            <input class="sub" type="submit" name="submit" value="Войти">
            <br><br>
            <a href="\sugnup.php" style="font-size: 14px; margin-left: 100px;">Регистрация</a>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>

<?php
try 
{
  $conn = new PDO("sqlsrv:server = tcp:servgumb.database.windows.net,1433; Database = db1", "Yana", "Sobachka.1");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) 
{
print("Error connecting to SQL Server.");
die(print_r($e));
}

if (isset($_POST['submit'])) {
$login = $_POST['login'];
$password = $_POST['password'];
  
$err = array(); 
if(empty($login)) {
$err[] = 'Поле "Логин" не заполненно!';
}
elseif(empty($password)) {
$err[] = 'Поле пароль не заполненно!';
}

$sql_insert = "INSERT INTO table1 (login, password) VALUES (?,?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bindValue(1, $login);
$stmt->bindValue(2, $password);
$stmt->execute();
echo '<div style= "color: blue; text-align: center;">Добро пожаловать!</div><hr>';

$sql_select = "SELECT * FROM table1";
$stmt = $conn->query($sql_select);
$registrants = $stmt->fetchAll();
if(count($registrants) > 0) 
{
echo "<table>";
echo "<tr><th>login-</th></br>";
  echo "<th>password</th></tr>";
}
foreach($registrants as $registrant) 
{
echo "<tr><td>".$registrant['login']."</td>";
echo "<td>".$registrant['password']."</td></tr>";
}
echo "</table>";
}
?> 
