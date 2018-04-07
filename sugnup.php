<?php

	require_once('db1.php');
	
	if (isset($_POST['submit'])) {
		
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
	$err[] = 'Поле "Имя" не заполненно!';
	}
	elseif($middlename = '') {
	$err[] = 'Поле "Отчество" не заполненно!';
	}  
	elseif($Email = '') {
	$err[] = 'Поле "E-mail" не заполненно!';
	}
	  elseif($login = '') {
	$err[] = 'Поле "Логин" не заполненно!';
	}
	elseif($password = '') {
	$err[] = 'Поле "Пароль" не заполненно!';
	}
	elseif($password != $password2) {
	$err[] = 'Не верно заполнен пароль!';
	}
	
	
	    if(empty($err)) {
        $sql_select = "SELECT * FROM table1 WHERE username = '$lastname'";
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
            
            echo '<div style= "color: black;">Вы зарегистрированны!</div><hr>';
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
	              <div class="dws-input">
<input type="text" name="lastname" placeholder="Введите фамилию...">
<input type="text" name="name" placeholder="Введите имя...">
<input type="text" name="middlename" placeholder="Введите отчество...">
<input type="text" name="Email" placeholder="Введите ваш адрес эл.почты...">
<input type="text" name="login" placeholder="Придумайте логин...">
<input type="password" name="password" placeholder="Придумайте пароль...">
<input type="password" name="password2" placeholder="Повторите пароль...">
			    </div>
<input class="sub" type="submit" name="submit" value="Регистрация">
	            </form>
	        </div>
	  </body>
	</html>
	  

