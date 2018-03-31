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
echo "</table>";
?> 
