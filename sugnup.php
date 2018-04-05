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
	                <label for="">Логин</label>
	                <input class="form-control" type="text" name="login">
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

