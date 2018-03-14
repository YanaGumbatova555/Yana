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
    background: #0080c0; /* Цвет фона */
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
    background: #333; /* Цвет фона */
    padding: 5px; /* Поля вокруг текста */
    color: #fff; /* Цвет текста */
    clear: left; /* Отменяем действие float */
   }
  </style>
 </head>
 <body>
  <div id="header"><h1>Shop</h1></div>
  <div id="sidebar">
    <p><a href="b_all.html">Женская одежда</a></p>
    <p><a href="b_author.html">Мужская одежда</a></p>
    <p><a href="b_theme.html">Детская одежда</a></p>
    <p><a href="b_popular.html">Обувь</a></p>
    <p><a href="b_last.html">Аксессуары</a></p>
  </div>
  <div id="content">
   
    <p>корзина</p>
  
  </div>
  <div id="footer">&copy; Yana G</div>
 </body>
</html>