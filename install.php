<?php

/*****************************************************************************
 *                                                                           *
 * Shop-Script FREE                                                          *
 * Copyright (c) 2004 Articus consulting group. All rights reserved.         *
 *                                                                           *
 ****************************************************************************/

	//installation routine
	
	ini_set("display_errors", "1");

	session_start();

	if (isset($_POST["install"]))
	{
		if (!is_writable("./cfg/connect.inc.php"))
		{
			$error = "Ошибка перезаписи файла cfg/connect.inc.php.";
		}
		else
		{
			$f = @fopen("./cfg/connect.inc.php","w");
			$s = "<?php
	//database connection settings

	define('DB_HOST', '".$_POST["db_host"]."'); // database host
	define('DB_USER', '".$_POST["db_user"]."'); // username
	define('DB_PASS', '".$_POST["db_pass"]."'); // password
	define('DB_NAME', '".$_POST["db_name"]."'); // database name
	define('ADMIN_LOGIN', '".base64_encode($_POST["admin_login"])."'); //administrator's login
	define('ADMIN_PASS', '".md5($_POST["admin_pass"])."'); //administrator's login

	//database tables
	if(file_exists(\"./cfg/tables.inc.php\")) include(\"./cfg/tables.inc.php\");

?>";
?><?php

			fputs($f,$s);
			fclose($f);

		}

		if (!is_writable("./cfg/general.inc.php"))
		{
			$error = "Ошибка перезаписи файла cfg/connect.inc.php.";
		}
		else
		{
			$f = @fopen("./cfg/general.inc.php","w");
			$s = "<?php
	define('CONF_SHOP_NAME', '".$_POST["shop_name"]."');
	define('CONF_SHOP_DESCRIPTION', '".$_POST["shop_name"].", powered by Shop-Script');
	define('CONF_SHOP_KEYWORDS', '".$_POST["shop_name"].", powered by Shop-Script');
	define('CONF_SHOP_URL', '".$_POST["shop_url"]."');
	define('CONF_GENERAL_EMAIL', '".$_POST["general_email"]."');
	define('CONF_ORDERS_EMAIL', '".$_POST["general_email"]."');
	define('CONF_CURRENCY_USD', '30.76');
	define('CONF_CURRENCY_EUR', '45.26');
	define('CONF_CURRENCY_AUTO', '1');
	define('CONF_CURRENCY_ID_LEFT', '');
	define('CONF_CURRENCY_ID_RIGHT', ' руб.');
	define('CONF_CURRENCY_ISO3', 'RUR');
?>";

			fputs($f,$s);
			fclose($f);
		}



		//try to connect to the database using new settings and register administrator
		include("./cfg/connect.inc.php");

		//choose database file to include
		include("./includes/database/mysql.php");

		$sel = NULL;
		$conn = db_connect(DB_HOST,DB_USER,DB_PASS);
		if ($conn)
		{
			if (!(db_select_db(DB_NAME))) //database connect failed
			{
				$error =  "Ошибка доступа к базе данных ".DB_NAME."<br>Убедитесь, что база данных существует, и у пользователя, логин и пароль которого Вы ввели, есть права на доступ к этой базе данных<br>(эти данные могут быть получены в службе поддержки Вашего хостинг провайдера)";
			}

		}
		else
			$error = "Ошибка соединения с базой данных.<br>Пожалуйста, убедитесь, что Вы правильно указываете адрес базы данных,<br>а также имя пользователя и пароль для доступа к ней<br>(эти данные могут быть получены в службе поддержки Вашего хостинг провайдера)";


		if (!isset($error)) //successful!
		{
			//create tables
			include("./includes/database/install/mysql.php");

			$_SESSION["log"] = $_POST["admin_login"];
			$_SESSION["pass"] = $_POST["admin_pass"];

			if (isset($_POST["fill_db"])) //fill DB with demo content
			{
				//fill products and categories tables
				$helper = "[#%int!g%#]"; //helper
				if (file_exists("./cfg/demo_database.sql"))
				{
					$f = implode("",file("./cfg/demo_database.sql"));
					$f = explode("INSERT INTO",$f);

					for ($i=1; $i<count($f); $i++)
					{
						db_query(trim("INSERT INTO ".str_replace($helper,"INSERT INTO",$f[$i]))) or die (db_error());
					}
				}

			}

		}
	}

	if (!is_writable("./cfg/connect.inc.php"))
	{
		$error = "Нет прав на перезапись файла cfg/connect.inc.php. Продолжение установки невозможно.<br>
Пожалуйста, установите права на доступ к файлам и папкам согласно инструкциям по установке";
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Установка Shop-Script FREE «Lego Edition»</title>
<link rel="stylesheet" type="text/css" href="images/backend/install.css" />
<script type="text/javascript">
	function validate()
	{
		if (document.form.admin_login.value.length == 0)
		{
			alert("Пожалуйста, введите логин администратора");
			return false;
		}
		if (document.form.admin_pass.value.length == 0)
		{
			alert("Пожалуйста, введите пароль администратора");
			return false;
		}
		if (document.form.db_host.value.length == 0)
		{
			alert("Пожалуйста, введите адрес базы данных");
			return false;
		}
		if (document.form.db_user.value.length == 0)
		{
			alert("Пожалуйста, введите логин базы данных");
			return false;
		}
		if (document.form.db_name.value.length == 0)
		{
			alert("Пожалуйста, введите название базы данных");
			return false;
		}
		return true;
	}
</script>
</head>

<body>
<div id="container">
  <div id="header"><img src="./css/css_default/image/logo0000.png" alt="OpenCart" title="OpenCart" /></div>
  <div id="content">
    <div id="content_top"></div>
    <div id="content_middle">
      <h1>Установка Shop-Script FREE 2.0 «Lego Edition»</h1>
      <div style="width: 100%; display: inline-block;">
<?php
	if (isset($_POST["install"]) && !isset($error))
	{
		echo "Установка успешно завершена!
<br />
<br />
<b>Спасибо за Ваш выбор Shop-Script FREE!</b>
<br />
<br />Shop-Script FREE - это PHP скрипты, предоставляющие основные возможности для создания интернет магазинов:
<br />- управление каталогом продукции
<br />- виртуальная корзина покупателя
<br />- оформление заказов
<br />- оптимизирован для поисковых систем
<br />а также многое другое!
<br />
<br />
Вы сможете измениить введенные ранее данные в <a href=\"admin.php\">панели администрирования</a>.
<br />
<br />
<br />

";
		echo "
<form action=\"index.php\" name=\"form2\" method=\"post\" enctype=\"multipart/form-data\" id=\"form2\" >
<input type=\"checkbox\" name=\"del_install\" /> Удалить установочный файл
<input type=\"hidden\" name=\"install_comlite\" />
</form>
<br />
<br />
<br />
<div style=\"text-align: center;\"><a onclick=\"document.getElementById('form2').submit()\" class=\"button\"><span class=\"button_left button_continue\"></span><span class=\"button_middle\">На главную страницу магазина</span><span class=\"button_right\"></span></a></div>
";
	}
	else
	{
?>

	<div style="float: left; width: 569px;">
	  <form action="install.php" name="form" method="post" enctype="multipart/form-data" id="form" >

	    <p>1. Основные настройки магазина</p>
	    <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 15px;">
	      <table>
		<tr>
		  <td width="185">Название магазина:</td>
		  <td><input type="text" name="shop_name" value="<?php echo isset($_POST["shop_name"]) ? $_POST["shop_name"]:"Shop-Script Free";?>" /></td>
		</tr>
		<tr>
		  <td>URL магазина:</td>
		  <td><input type="text" name="shop_url" value="<?php echo isset($_POST["shop_url"]) ? $_POST["shop_url"]:"";?>" /></td>
		</tr>
		<tr>
		  <td>Контактный email адрес Вашего магазина:</td>
		  <td><input type="text" name="general_email" value="<?php echo isset($_POST["general_email"]) ? $_POST["general_email"]:"";?>" /></td>
		</tr>
	      </table>
	    </div>
	    <p>2. Логин и пароль администратора магазина</p>
	    <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 15px;">
	      <table>
		<tr>
		  <td width="185"><span class="required">*</span>Логин:</td>
		  <td><input type="text" name="admin_login" value="<?php echo isset($admin_login) ? $admin_login:"admin";?>" /></td>
		</tr>
		<tr>
		  <td><span class="required">*</span>Пароль:</td>
		  <td><input type="text" name="admin_pass" value="<?php echo isset($admin_pass) ? $admin_pass:"";?>" /></td>
		</tr>
	      </table>
	    </div>
	    <p>3. Укажите настройки подключения к базе данных (MySQL)</p>
	    <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 15px;">
	      <table>
		<tr>
		  <td width="185"><span class="required">*</span>Адрес базы данных (host):</td>
		  <td><input type="text" name="db_host" <?php echo isset($_POST["db_host"]) ? " value=\"".$_POST["db_host"]."\"":" value=\"localhost\"";?> /><br /></td>
		</tr>
		<tr>
		  <td><span class="required">*</span>Имя пользователя (логин):</td>
		  <td><input type="text" name="db_user" <?php echo isset($_POST["db_user"]) ? " value=\"".$_POST["db_user"]."\"":"";?> /><br /></td>
		</tr>
		<tr>
		  <td>Пароль:</td>
		  <td><input type="text" name="db_pass" <?php echo isset($_POST["db_pass"]) ? " value=\"".$_POST["db_pass"]."\"":"";?> /></td>
		</tr>
		<tr>
		  <td><span class="required">*</span>Имя базы данных:</td>
		  <td><input type="text" name="db_name" <?php echo isset($_POST["db_name"]) ? " value=\"".$_POST["db_name"]."\"":"";?> /><br /></td>
		</tr>
	      </table>
	      <br />
	      <input type="checkbox" name="fill_db" checked="checked" /> Заполнить базу данных магазина демонстрационными товарами 
	    </div>
<?php
	if (is_writable("./cfg/connect.inc.php"))
	{
		echo "<div style=\"text-align: right;\"><a onclick=\"javascript: if (validate(this)==true) {document.getElementById('form').submit()}\" class=\"button\"><span class=\"button_left button_continue\"></span><span class=\"button_middle\">Установить</span><span class=\"button_right\"></span></a></div>";
	}
?>
	    <input type="hidden" name="install" value="true" />
	  </form>
	</div>
	<div style="float: right; width: 205px; height: 400px; padding: 10px; color: #663300; border: 1px solid #FFE0CC; background: #FFF5CC;">
<?php
	if (isset($error)) {echo "<p><font color=red>$error</font>";}
	else {echo "Перед установкой, пожалуйста, внимательно ознакомьтесь с <a href=\"http://www.shop-script.ru/documentation/shop-script-free.pdf\" target=\"_blank\">Руководством Пользователя Shop-Script FREE</a>, в котором представлена информация по установке и использованию продукта.";}
?>
	</div>
<?php
	}
?>
      </div>
    </div>
    <div id="content_bottom"></div>
  </div>
  <div id="footer"><a onclick="window.open('http://www.shop-script.ru');">Project Homepage</a>|<a onclick="window.open('http://www.shop-script.ru/overview/');">Documentation</a>|<a onclick="window.open('http://forum.webasyst.ru/viewforum.php?id=13');">Support Forums</a></div>
</div>
</body>
</html>