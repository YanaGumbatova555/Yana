<?
$dsn = "sqlsrv:server = tcp:servgumb.database.windows.net,1433; Database = insurance";
$login = "Yana";
$pass = "Sobachka.1";

try {
    $conn = new PDO($dsn, $login, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "CREATE TABLE table1(
    id INT NOT NULL IDENTITY(1,1) 
    PRIMARY KEY(id),
    lastname VARCHAR(30),
    name VARCHAR(30),
    middlename VARCHAR(30),
    Email VARCHAR(30),
    login VARCHAR(30),
    password VARCHAR(30),
    password2 VARCHAR(30)";
    $conn->query($sql);
    
    echo "<h3>Таблица создана!</h3>"; 
}
catch (PDOException $e) {
    print("Ошибка подключения к SQL Server.");
    die(print_r($e));
}
?>
