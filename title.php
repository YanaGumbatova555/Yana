<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Shop</title>
  <style>
   body {
    font: 11pt Arial, Helvetica, sans-serif; /* Рубленый шрифт текста */
    margin: 0; /* Отступы на странице */
   }
   h1 {
    font-size: 36px; /* Размер шрифта */
    margin: 0; /* Убираем отступы */
    color: #4C0B5F; /* Цвет текста */
   }
   h2 {
    margin-top: 0; /* Убираем отступ сверху */
   }
   #header { /* Верхний блок */
    background: #BDBDBD; /* Цвет фона */
    padding: 10px; /* Поля вокруг текста */
   }
   #sidebar { /* Левая колонка */
    float: left; /* Обтекание справа */
    border: 1px solid #333; /* Параметры рамки вокруг */
    width: 20%; /* Ширина колонки */
    padding: 5px; /* Поля вокруг текста */
    margin: 10px 10px 20px 5px; /* Значения отступов */
   }
   #content { /* Правая колонка */
    margin: 10px 5px 20px 25%; /* Значения отступов */
    padding: 5px; /* Поля вокруг текста */
    border: 1px solid #333; /* Параметры рамки */
   }
   #footer { /* Нижний блок */
    background: #6E6E6E; /* Цвет фона */
    padding: 5px; /* Поля вокруг текста */
    color: #fff; /* Цвет текста */
    clear: left; /* Отменяем действие float */
   }
   
   .sub {
    float: right;
    width: 95px;
    height: 30px;
   }
   
       
  </style>
 </head>
 <body>
  <div id="header">
  <div class="button_uznai1">
  <a href="\sugnup.php" class="button_uznai1_text">Регистрация</a>
  <a href="\index.php" class="button_uznai1_text">Вход</a>
  </div>
  <h1>Shop</h1>
  </div>
  
  <div id="sidebar">
    <p><a href="clouses_all.html">Женская одежда</a></p>
    <p><a href="clouses_all.html">Мужская одежда</a></p>
    <p><a href="clouses_all.html">Детская одежда</a></p>
    <p><a href="clouses_all.html">Обувь</a></p>
   <p><a href="clouses_all.html">Аксессуары</a></p>
  </div>
  
  <div id="content">
   <img src="/KXIDWaHd.png"></img>
  </div>
  
 <div id="footer">&copy; 2017-2018 </div>
 </body>
</html>
