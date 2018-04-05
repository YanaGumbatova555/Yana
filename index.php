<?php 
try { $conn = new PDO("sqlsrv:server = tcp:karl.database.windows.net,1433; Database = basa", "Anastasiya", "L4x78tm2p1"); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} 
catch (PDOException $e) { 
print("Ошибка подключения к SQL Server."); 
die(print_r($e)); 
} 
//Проверка заполнения при ножатии кнопки. Если поля пустые ничего в БД не записывается. 
if(!empty($_POST)) { 
try { 
$tel = $_POST['tel']; 
$password = $_POST['password']; 
//Регистрация 
// Insert data 
//Запись в БД 
$sql_insert = 
"INSERT INTO registration_tbl (tel, password) 
VALUES (?,?)"; 
$stmt = $conn->prepare($sql_insert); 
$stmt->bindValue(1, $tel); 
$stmt->bindValue(2, $password); 
$stmt->execute(); 
} 
//Вывод ошибку 
catch(Exception $e) { 
die(var_dump($e)); 
} 
echo "<h3>Your're registered!</h3>"; 
} 
//Вывод таблицы 
$sql_select = "SELECT * FROM registration_tbl"; 
$stmt = $conn->query($sql_select); 
$registrants = $stmt->fetchAll(); 
//Условие. Если количество записей больше 0, тогда выводится записи полей. В противном случае выводится ошибка о регестрации. 
if(count($registrants) > 0) { 
echo "<h2>Зарегестрированные</h2>"; 
echo "<table>"; 
echo "<tr><th>tel</th>"; 
echo "<th>password</th>"; 
foreach($registrants as $registrant) { 
echo "<tr><td>".$registrant['tel']."</td>"; 
echo "<td>".$registrant['password']."</td>"; 
} 
echo "</table>"; 
} else 
{ 
echo "<h3>Вы не зарегестрированны</h3>"; 
} 
?>
