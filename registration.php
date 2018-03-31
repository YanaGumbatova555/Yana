<html>
<head>
<title>Интернет-магазин</title>
<?php include_once "header.php" ?>
  <?php include_once "leftblock.php" ?>
  
  <div class="content">
  
    <form action="query-registration.php">
      <label>Логин:</label><br>
      <input type="text" name="login"><br>
      <label>Пароль:</label><br>
      <input type="password" name="password"><br>
      <label>Имя:</label><br>
      <input type="text" name="name"><br>
      <label>Фамилия:</label><br>
      <input type="text" name="surname"><br>
      <input type="submit" name="submit">
    </form>
  </div>
    
  <?php include_once "footer.php" ?>
</html>
