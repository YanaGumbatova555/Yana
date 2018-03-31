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
$login = $_POST['login'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
  
$err = array(); 
if(empty($lastname)) {
$err[] = 'Поле "Фамилия" не заполненно!';
}
elseif(empty($name)) {
$err[] = 'Поле Имя не заполненно!';
}
elseif(empty($middlename)) {
$err[] = 'Поле Отчество не заполненно!';
}  
elseif(empty($Email)) {
$err[] = 'Поле E-mail не заполненно!';
}
  elseif(empty($login)) {
$err[] = 'Поле Логин не заполненно!';
}
elseif(empty($password)) {
$err[] = 'Поле пароль не заполненно!';
}
elseif($password != $password2) {
$err[] = 'Неправельно заполнен пароль!';
}

$sql_insert = "INSERT INTO table1 (lastname, name, middlename, Email, login, password, password2) VALUES (?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bindValue(1, $lastname);
$stmt->bindValue(2, $name);
$stmt->bindValue(3, $middlename);
$stmt->bindValue(4, $Email);
  $stmt->bindValue(5, $login);
$stmt->bindValue(6, $password);
$stmt->bindValue(7, $password2);
$stmt->execute();
echo '<div style= "color: blue; text-align: center;">Вы зарегистрированны!</div><hr>';

$sql_select = "SELECT * FROM table1";
$stmt = $conn->query($sql_select);
$registrants = $stmt->fetchAll();
if(count($registrants) > 0) 
{
echo "<table>";
echo "<tr><th>lastname-</th></br>";
echo "<th>name-</th></br>";
echo "<th>middlename-</th></br>";
echo "<th>Email</th></br>";
  echo "<th>login</th></tr>";
}
foreach($registrants as $registrant) 
{
echo "<tr><td>".$registrant['lastname']."</td>";
echo "<td>".$registrant['name']."</td>";
echo "<td>".$registrant['middlename']."</td>";
echo "<td>".$registrant['Email']."</td>";
  echo "<td>".$registrant['login']."</td></tr>";
}
echo "</table>";
}
?> 
