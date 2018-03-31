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
