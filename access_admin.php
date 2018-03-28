<?php
/*****************************************************************************
 *                                                                           *
 * Shop-Script FREE                                                          *
 * Copyright (c) 2005 WebAsyst LLC. All rights reserved.                     *
 *                                                                           *
 ****************************************************************************/
 
	ini_set("display_errors", "1");

	//admin mode access file

	session_start();

	include("./cfg/connect.inc.php");

	//current language
	include("./cfg/language_list.php");
	if (!isset($_SESSION["current_language"]) ||
		$_SESSION["current_language"] < 0 || $_SESSION["current_language"] > count($lang_list))
			$_SESSION["current_language"] = 0; //set default language

	if (isset($lang_list[$_SESSION["current_language"]]) && file_exists("./languages/".$lang_list[$_SESSION["current_language"]]->filename))
		include("./languages/".$lang_list[$_SESSION["current_language"]]->filename); //include current language file
	else
	{
		die("<font color=red><b>ERROR: Couldn't find language file!</b></font>");
	}

	if (isset($_POST["authorize"]))
	{
		if (!strcmp(base64_encode($_POST["login"]), ADMIN_LOGIN) && !strcmp(md5($_POST["password"]), ADMIN_PASS))
		{ //login ok
			$_SESSION["log"] = ADMIN_LOGIN;
			$_SESSION["pass"] = ADMIN_PASS;
			$_SESSION["admin"] = true;

			//redirect to the admin interface
			header("Location: admin.php");
		}
		else 
			if (!strcmp(base64_encode($_POST["login"]), MODER_LOGIN) && !strcmp(md5($_POST["password"]), MODER_PASS))
			{ //login ok
				$_SESSION["log"] =  MODER_LOGIN;
				$_SESSION["pass"] = MODER_PASS;
				$_SESSION["admin"] = false;

				//redirect to the admin interface
				header("Location: admin.php");
			}

		$errorStr = "Неверный логин или пароль!";
	}



?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="./images/backend/style-backend.css" />
<script type="text/javascript" src="./jscripts/jquery-1.js"></script>
<title><? echo ADMIN_TITLE; ?></title>
</head>
<body>

<div id="header">
  <div class="div1">
    <div class="div2"><? echo ADMIN_TITLE; ?></div>
    <div class="div3"><a href="index.php"><? echo ADMIN_BACK_TO_SHOP; ?></a></div>
  </div>
</div>
<div id="menu"></div>
<div id="login">
  <div class="div1"><? echo ACCESS; ?></div>
  <div class="div2">
    <? if ($errorStr != '' ) {echo '<div class="warning">'.ACCESS_ERROR.'</div>';} ?>
    <form action="access_admin.php" method="post" enctype="multipart/form-data" id="form">
      <input type="hidden" name="authorize" value="1">
      <table>
	<tbody>
	<tr>
          <td rowspan="3" align="center"><img src="./images/backend/login.png" alt="<? echo ACCESS; ?>"></td>
	</tr>
	<tr>
          <td><? echo ACCESS_LOGIN; ?>:<br>
            <input name="login" style="margin-top: 4px;" type="text" id="input_username" <?php if (isset($_POST["login"])) echo ' value="'.str_replace("\"","&quot;",stripslashes($_POST["login"])).'"';?> />
            <br>
            <br>
            <? echo ACCESS_PASS; ?>:<br>
            <input name="password" style="margin-top: 4px;" type="password" />
	  </td>
	</tr>
	<tr>
          <td align="right">
	<a onclick="$('#form').submit();" class="button">
		<span class="button_left button_login"></span><span class="button_middle"><? echo ACCESS_ENTER; ?></span><span class="button_right"></span>
	</a>
	  </td>
	</tr>
	</tbody>
      </table>
    </form>

    <script type="text/javascript"><!--
	$('#form input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form').submit();
		}
	});
	//--></script>
	<script type="text/javascript">
	// <![CDATA[
		function PMA_focusInput()
		{
		    var input_username = document.getElementById('input_username');
		    var input_password = document.getElementById('input_password');
		    if (input_username.value == '') {
		        input_username.focus();
		    } else {
		        input_password.focus();
 		   }
		}

		window.setTimeout('PMA_focusInput()', 500);
	// ]]>
	</script>

  </div>
  <div class="div3"></div>
</div>

</body>
</html>