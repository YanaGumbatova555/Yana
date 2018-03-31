<?php 
require_once('db1.php'); 
if (isset($_POST['submit'])) { 
$user_username = $_POST['username']; 
$user_password = $_POST['password']; 
if (!empty($user_username) && !empty($user_password)) { 
$_SESSION['logged_user'] = $_POST['username']; 
$sql_select = "SELECT 'id', 'login' FROM users WHERE login = '$user_username' AND password = '$user_password'"; 
$stmt = $conn->query($sql_select); 
$stmt->execute(); 
$data = $stmt->fetchAll(); 
} 
else { 
echo '<div style = "color: red; text-align: center;">Поля заполнены неправельно!</div><hr>'; 
} 
} 
?> 
