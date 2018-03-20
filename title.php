<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Авторизация</title>
    <style>
    .container {
      width: 300px;
      height: 320px;
      margin: 200px auto 0 auto;
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
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
      	<div class="col-sm-4">
          <form class="" action="index.html" method="post">
            <legend><h1>Авторизация</h1></legend>
            <div class="form-group">
              <label for="">Логин</label>
              <input class="form-control" type="text" name="username" value="">
            </div>
            <div class="form-group">
              <label for="">Пароль</label>
              <input class="form-control" type="password" name="password" value="">
            </div>
            <input class="sub" type="submit" name="submit" value="Войти">
            <br><br>
            <a href="\sugnup.php" style="font-size: 14px; margin-left: 100px;">Регистрация</a>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
