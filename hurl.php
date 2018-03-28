<?php

	include("./cfg/connect.inc.php");
	include("./cfg/tables.inc.php");
	include("./includes/database/mysql.php");
	include("./cfg/general.inc.php");
	include("./cfg/appearence.inc.php");
	include("./cfg/functions.php");
	include("./cfg/category_functions.php");
	include("./cfg/language_list.php");

	//connect to database
	db_connect(DB_HOST,DB_USER,DB_PASS) or die (db_error());
	db_select_db(DB_NAME) or die (db_error());

$result=1;
	$q = db_query("SELECT * FROM ".CATEGORIES_TABLE);
	while ($row = db_fetch_row($q))
		{
		if ($row[12] == "") {$row[12]=to_url($row[1]).".html";}
		if ($row[9] == "") {$row[9]=$row[1];}
		if ($row[10] == "") {$row[10]=$row[1];}
		if ($row[11] == "") {$row[11]=$row[1];}
		db_query("UPDATE ".CATEGORIES_TABLE." SET meta_title='".$row[9]."', meta_keywords='".$row[10]."', meta_desc='".$row[11]."', hurl='".$row[12]."' WHERE categoryID='".$row[0]."'") or $result=0;
		}

	$q = db_query("SELECT * FROM ".PRODUCTS_TABLE);
	while ($row = db_fetch_row($q))
		{
		if ($row[16] == "") {$row[16]=to_url($row[2])."_".$row[0].".html";}
		if ($row[19] == "") {$row[19]=$row[2];}
		if ($row[20] == "") {$row[20]=$row[2];}
		if ($row[21] == "") {$row[21]=$row[2];}
		db_query("UPDATE ".PRODUCTS_TABLE." SET meta_title='".$row[19]."', meta_keywords='".$row[20]."', meta_desc='".$row[21]."', hurl='".$row[16]."' WHERE productID='".$row[0]."'") or $result=0;
		}

	$q = db_query("SELECT * FROM ".NEWS_TABLE);
	while ($row = db_fetch_row($q))
		{
		if ($row[7] == "") {$row[7]=$row[2];}
		if ($row[8] == "") {$row[8]=$row[2];}
		if ($row[9] == "") {$row[9]=$row[2];}
		db_query("UPDATE ".NEWS_TABLE." SET meta_title='".$row[7]."', meta_keywords='".$row[8]."', meta_desc='".$row[9]."' WHERE id='".$row[0]."'") or $result=0;
		}

	$q = db_query("SELECT * FROM ".PAGES_TABLE);
	while ($row = db_fetch_row($q))
		{
		if ($row[7] == "") {$row[7]=$row[2];}
		if ($row[8] == "") {$row[8]=$row[2];}
		if ($row[9] == "") {$row[9]=$row[2];}
		db_query("UPDATE ".PAGES_TABLE." SET meta_title='".$row[7]."', meta_keywords='".$row[8]."', meta_desc='".$row[9]."' WHERE id='".$row[0]."'") or $result=0;
		}
if ($result=1) {echo "Done!";} else {echo "error";}

?>