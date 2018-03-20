<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Регистрация</title>
    <style>
    .container {
      width: 300px;
      height: 620px;
      margin: 100px auto 0 auto;
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
    label {
      float: left;
    }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
            <form method="post" action="sugnup.php">
              <legend><h1>Регистрация</h1></legend>
              <div class="form-group">
                <label for="" >Фамилия</label>
                <input class="form-control" type="text" name="lastname" value="">
              </div>
              <div class="form-group">
                <label for="">Имя</label>
                <input class="form-control" type="text" name="name" value="">
              </div>
              <div class="form-group">
                <label for="">Отчество</label>
                <input class="form-control" type="text" name="middlename">
              </div>
              <div class="form-group">
                <label for="">Email</label>
                <input class="form-control" type="text" name="Email">
              </div>
              <div class="form-group">
                <label for="">Пароль</label>
                <input class="form-control" type="password" name="password">
              </div>
              <div class="form-group">
                <label>Повторите пароль</label>
                <input class="form-control" type="password" name="password2">
              </div>
              <input class="sub" type="submit" name="submit" value="Регистрация">
            </form>
        </div>
      </div>
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
$lastname = $_POST['lastname'];
$name = $_POST['name'];
$middlename = $_POST['middlename'];
$Email = $_POST['Email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
  
$err = array(); 
if(empty($lastname)) {
$err[] = 'Поле "Фамилия" незаполненно!';
}
elseif(empty($name)) {
$err[] = 'Поле Имя незаполненно!';
}
elseif(empty($middlename)) {
$err[] = 'Поле Отчество незаполненно!';
}  
elseif(empty($Email)) {
$err[] = 'Поле E-mail незаполненно!';
}
elseif(empty($password)) {
$err[] = 'Поле пароль незаполненно!';
}
elseif($password != $password2) {
$err[] = 'Неправельно заполнен пароль2!';
}

$sql_insert = "INSERT INTO table1 (lastname, name, middlename, Email, password, password2) VALUES (?,?,?,?,?,?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bindValue(1, $lastname);
$stmt->bindValue(2, $name);
$stmt->bindValue(3, $middlename);
$stmt->bindValue(4, $Email);
$stmt->bindValue(5, $password);
$stmt->bindValue(6, $password2);
$stmt->execute();
echo '<div style= "color: blue; text-align: center;">Вы зарегистрированны!</div><hr>';
$sql_select = "SELECT * FROM table1";
$stmt = $conn->query($sql_select);
$registrants = $stmt->fetchAll();
if(count($registrants) > 0) 
{
echo "<table>";
echo "<tr><th>lastname     </th></tr>";
echo "<tr><th>name     </th></tr>";
echo "<tr><th>middlename    </th></tr>";
echo "<tr><th>Email    </th></tr>";
}
foreach($registrants as $registrant) 
{
echo "<tr><td>".$registrant['lastname']."</td>";
echo "<td>".$registrant['name']."</td>";
echo "<td>".$registrant['middlename']."</td>";
echo "<td>".$registrant['Email']."</td></tr>";
}
echo "</table>";
}
?> 
