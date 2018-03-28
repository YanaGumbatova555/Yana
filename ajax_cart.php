<?

//connect to the database

include("./cfg/connect.inc.php");
include("./cfg/tables.inc.php");
include("./cfg/general.inc.php");
include("./cfg/appearence.inc.php");
include("./cfg/functions.php");
include("./cfg/language_list.php");
include("./cfg/product_conf.inc.php");
include("./cfg/votes.inc.php");

@mysql_connect(DB_HOST,DB_USER,DB_PASS) or die (db_error());
@mysql_select_db(DB_NAME) or die (db_error());

session_start();

	//current language session variable
	if (!isset($_SESSION["current_language"]) ||
		$_SESSION["current_language"] < 0 || $_SESSION["current_language"] > count($lang_list))
			$_SESSION["current_language"] = 0; //set default language
	//include a language file
	if (isset($lang_list[$_SESSION["current_language"]]) && file_exists("./languages/".$lang_list[$_SESSION["current_language"]]->filename))
		include("./languages/".$lang_list[$_SESSION["current_language"]]->filename); //include current language file
	else
	{
		die("<font color=red><b>ERROR: Couldn't find language file!</b></font>");
	}


if (isset($_GET["add2cart"]) && $_GET["add2cart"]>0) //add product to cart with productID=$add
		{	
			$q = mysql_query("select in_stock from ".PRODUCTS_TABLE." where productID='".$_GET["add2cart"]."'") or die (db_error());
			$is = mysql_fetch_row($q); $is = $is[0];

			//$_SESSION[gids] contains product IDs
			//$_SESSION[counts] contains product quantities ($_SESSION[counts][$i] corresponds to $_SESSION[gids][$i])
			//$_SESSION[gids][$i] == 0 means $i-element is 'empty'

			if (!isset($_SESSION["gids"]))
			{
				$_SESSION["gids"] = array();
				$_SESSION["counts"] = array();
				$characterArray = array();
				$characterCounts = array();

			}
			//check for current item in the current shopping cart content
			$found=0;
			if (!isset($_GET["p"])) {$_GET["p"] = 0;}
			for ($i=0; $i<count($_SESSION["gids"]);$i++)
			    if ($_SESSION["gids"][$i][0] == $_GET["add2cart"] && $_SESSION["gids"][$i][1]==$_GET["p"])
				{$_SESSION["counts"][$i][0]++;
				 $_SESSION["counts"][$i][1]++;
				if ($_GET["kr"]>0) {$_SESSION["counts"][$i][2]++; $_SESSION["gids"][$i][2]==$_GET["kr"];}
				if ($_GET["n"]>0)
					{
					if ($_GET["n"]==1 || $_GET["n"]==3) 
						{$_SESSION["counts"][$i][3]+="0.5";} 
					else 	{$_SESSION["counts"][$i][3]++;}
					if ($_GET["n"]>2) 
						{$_SESSION["gids"][$i][3] = 4;}
					else 	{$_SESSION["gids"][$i][3] = 2;}
					}
				if ($_GET["d"]>0) {$_SESSION["counts"][$i][4]++; $_SESSION["gids"][$i][4]=$_GET["d"];}
				$found=1;
				}

			if ($found==0) //no item - add it to $gids array
			{
				$characterArray[0] = $_GET["add2cart"];
				$characterArray[1] = $_GET["p"];
				$characterArray[2] = $_GET["kr"];
				$characterArray[3] = $_GET["n"];
				$characterArray[4] = $_GET["d"];

				
				$characterCounts[0] = 1;
				$characterCounts[1] = 1;
				if ($_GET["kr"]>0) {$characterCounts[2] = 1;} else {$characterCounts[2] = 0;}
				if ($_GET["n"]>0) {$characterCounts[3] = 1;} else {$characterCounts[3] = 0;}
				if ($_GET["d"]>0) {$characterCounts[4] = 1;} else {$characterCounts[4] = 0;}
			
				$_SESSION["gids"][] = $characterArray;
				$_SESSION["counts"][] = $characterCounts;
			}
		}

	//calculate shopping cart value
	$k=0;
	$cnt = 0;
	if (isset($_SESSION["gids"])) //...session vars
	{
		for ($i=0; $i<count($_SESSION["gids"]); $i++)
		  if ($_SESSION["gids"][$i])
		  {
			$qprice = mysql_query("SELECT Prdct1, Prdct2, Prdct3, Prdct4, Prdct5, Prdct6, Prdct7, Crtr1, Crtr2, Crtr3, Crtr4, Crtr5, Crtr6, Crtr7, Crtr8, enable FROM ".CHARACTER_TABLE." WHERE productID='".$_SESSION["gids"][$i][0]."'") or die (db_error());
			$rprice = mysql_fetch_row($qprice);

			if ($rprice[15]=1)
				{
				$cr1pr = $_SESSION["gids"][$i][1]; //тип полотна
				$cr2pr = $_SESSION["gids"][$i][2]+6; //тип коробки
				$cr3pr = $_SESSION["gids"][$i][3]+8; //тип наличника
				$cr4pr = $_SESSION["gids"][$i][4]+12; //тип доборов			

				$cnt += $_SESSION["counts"][$i][0]+$_SESSION["counts"][$i][2]+$_SESSION["counts"][$i][3]+$_SESSION["counts"][$i][4];

				while ($rprice[$cr1pr]==0) {$cr1pr++;}
				$_SESSION["gids"][$i][1] = $cr1pr;

				$k += $_SESSION["counts"][$i][0]*$rprice[$cr1pr]+$_SESSION["counts"][$i][2]*$rprice[$cr2pr]+$_SESSION["counts"][$i][3]*$rprice[$cr3pr]+$_SESSION["counts"][$i][4]*$rprice[$cr4pr];
				}
			else	{
				$qpr = mysql_query("SELECT Price FROM ".PRODUCTS_TABLE." WHERE productID='".$_SESSION["gids"][$i][0]."'") or die (db_error());
				$pr = mysql_fetch_row($qprice);

				$cnt += $_SESSION["counts"][$i][0];
				$k += $_SESSION["counts"][$i][0]*$rp[0];
				}
		  }
	}


			//minimal

			if (($k < CONF_MINIMAL_SUMM) || ($cnt < CONF_MINIMAL_COUNT)) 
				{
				 $_SESSION["minimal"][0] = CONF_MINIMAL_PRODUCT;
				 $_SESSION["minimal"][1] = CONF_MINIMAL_COST;
				 //$k += CONF_MINIMAL_COST;
				 //$cnt++;
				}
			else {unset($_SESSION["minimal"]);}

	if ($cnt>0)
	    {echo $cnt." ".CART_CONTENT_NOT_EMPTY."&nbsp;&nbsp;&nbsp;<a href=\"index.php?shopping_cart=yes\">".show_price($k)."</a>";}
	else
	    {echo CART_CONTENT_EMPTY."&nbsp;&nbsp;&nbsp; <a href=\"index.php?shopping_cart=yes\">".show_price($k)."</a>";}

	echo "<br>".$_SESSION["gids"][$i][1];

?>
