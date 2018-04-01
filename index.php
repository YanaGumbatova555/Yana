<!DOCTYPE html>
<html>
<head>
<?php include_once "header.php" ?>
<?php include_once "leftblock.php" ?>
<?php include_once "footer.php" ?> 
<link  href="/reset.css" rel="stylesheet" type="text/css"/>  
<link  href="/style.css" rel="stylesheet" type="text/css"/>  
<title>Интернет-магазин</title> 

</head>

<body>
    
<div id="blockbody">  
    
           <div id="block-cart">    
               <p>Моя корзина (<span class="count">0</span>)<span id="corner" class="corner-down"></span></p>
                   <div>
                       <p>Товаров: <span class="count">0</span></p>
                       <p>На сумму: <span price="0" id="price">0</span></p>
                       <a href="">Оформить</a>
           </div> 
   </div> 
    <div id="block-content">   
    
        <p class="messagecart"></p>
        
        <ul id="listing">
            <li>
                <div class="fixblock">
                    <center><img src="1.jpeg" /></center>
                </div>
              <p class="price-tovar">2 500 руб</p>
             <p price="2500" rel="1" class="add-tovar"></p>
           </li>
             
          <li>
                <div class="fixblock">
                    <center><img src="2.jpg" /></center>
                </div>
              <p class="price-tovar">2 500 руб</p>
             <p price="2500" rel="1" class="add-tovar"></p>
        </li>      
            
       <li>
                <div class="fixblock">
                    <center><img src="3.jpg" /></center>
                </div>
              <p class="price-tovar">2 500 руб</p>
             <p price="2500" rel="1" class="add-tovar"></p>
           </li>
                        
        <li>
                <div class="fixblock">
                    <center><img src="4.jpg" /></center>
                </div>
              <p class="price-tovar">2 500 руб</p>
             <p price="2500" rel="1" class="add-tovar"></p>
           </li>
  </div>
 
</body>
  
</html>

