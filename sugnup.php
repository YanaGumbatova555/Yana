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

if(isset($_POST["submit"])) {
if($_POST["familiya"] =="" || $_POST["name"]=="" || $_POST["otchestvo"] ==""){echo "Введите свои данные";}
else{
try {
$familiya = $_POST['familiya'];
$name = $_POST['name'];
$otchestvo = $_POST['otchestvo'];
$birthday = $_POST['birthday'];
$inn = $_POST['inn'];
$telefon = $_POST['telefon'];
$adres = $_POST['adres'];

// Insert data 
$sql_insert = "INSERT INTO client_tbl (familiya,name,otchestvo, birthday, inn, telefon,adres) VALUES (?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bindValue(1, $familiya);
$stmt->bindValue(2, $name);
$stmt->bindValue(3, $otchestvo);
$stmt->bindValue(4, $birthday);
$stmt->bindValue(5, $inn);
$stmt->bindValue(6, $telefon);
$stmt->bindValue(7, $adres);
$stmt->execute();
}
catch(Exception $e) 
{
die(var_dump($e));
}
}
}
$sql_select = "SELECT * FROM client_tbl";
$stmt = $conn->query($sql_select);
$registrants = $stmt->fetchAll();
if(count($registrants) > 0) {
echo "<table>";
echo "<tr><th>familiya</th>";
echo "<th>name</th>";
echo "<th>otchestvo</th>";
echo "<th>birthday</th>";
echo "<th>inn</th>";
echo "<th>telefon</th>";
echo "<th>adres</th></tr>";
foreach($registrants as $registrant) {
echo "<tr><td>".$registrant['familiya']."</td>";
echo "<td>".$registrant['name']."</td>";
echo "<td>".$registrant['otchestvo']."</td>";
echo "<td>".$registrant['birthday']."</td>";
echo "<td>".$registrant['inn']."</td>";
echo "<td>".$registrant['telefon']."</td>";
echo "<td>".$registrant['adres']."</td></tr>";
}
echo "</table>";
}
else {
echo "<h3>Ни один пользователь не зарегистрирован.</h3>";
}


?>
