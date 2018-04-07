<!DOCTYPE html>
	<html>
	  <head>
	    <meta charset="utf-8">
	    <link rel="stylesheet" href="/style1.css">
		  <title>Регистрация</title>
	  </head>
	  <body>
	    <div class="container">
		    <a href="/index.php"></a>
	            <form class="" action="sugnup.php" method="post">
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
	  </body>
	</html>
	

	<?php

	require_once('db1.php');
	
	if (isset($_POST['submit'])) 
	{
	$lastname = $_POST['lastname'];
	$name = $_POST['name'];
	$middlename = $_POST['middlename'];
	$Email = $_POST['Email'];
	$login = $_POST['login'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	  
	$err = array(); 
	if($lastname = '') {
	$err[] = 'Поле "Фамилия" не заполненно!';
	}
	elseif($name = '') {
	$err[] = 'Поле Имя не заполненно!';
	}
	elseif($middlename = '') {
	$err[] = 'Поле Отчество не заполненно!';
	}  
	elseif($Email = '') {
	$err[] = 'Поле E-mail не заполненно!';
	}
	  elseif($login = '') {
	$err[] = 'Поле Логин не заполненно!';
	}
	elseif($password = '') {
	$err[] = 'Поле пароль не заполненно!';
	}
	elseif($password != $password2) {
	$err[] = 'Не верно заполнен пароль!';
	}
	
	
	    if(empty($err)) {
        $sql_select = "SELECT * FROM signup WHERE username = '$lastname'";
        $stmt = $conn->query($sql_select);
        $stmt->execute();
        $data = $stmt->fetchAll();
		
		    
		    if(count($data) == 0) {
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
            
            echo '<div style= "color: white;">Вы зарегистрированны!</div><hr>';
        }
        else {
            echo '<div style = "color: red;">Такой пользователь уже существует!</div><hr>';
        }
    }
    else {
        echo '<div style = "color: red;">'.array_shift($err).'</div><hr>'; 
    }
}
?>    

