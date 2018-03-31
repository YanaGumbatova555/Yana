<?php
$sql_insert = "INSERT INTO table1 (login, password, name, surname) VALUES (?,?,?,?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bindValue(1, $login);
$stmt->bindValue(2, $password);
$stmt->bindValue(3, $name);
$stmt->bindValue(4, $surname);

$stmt->execute();
echo '<div style= "color: blue; text-align: center;">Вы зарегистрированны!</div><hr>';
$sql_select = "SELECT * FROM table1";
$stmt = $conn->query($sql_select);
$registrants = $stmt->fetchAll();
if(count($registrants) > 0) 
{
echo "<table>";
echo "<tr><th>login-</th></br>";
echo "<th>password-</th></br>";
echo "<th>name-</th></br>";
  echo "<th>surname</th></tr>";
}
foreach($registrants as $registrant) 
{
echo "<tr><td>".$registrant['login']."</td>";
echo "<td>".$registrant['password']."</td>";
echo "<td>".$registrant['name']."</td>";
  echo "<td>".$registrant['surname']."</td></tr>";
}
?>
