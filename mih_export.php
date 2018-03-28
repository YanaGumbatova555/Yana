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


	$filename = "mysql_mih.txt";
	$filepath = "/tmp/".$filename;

	$qt = mysql_query("SHOW TABLES FROM ".DB_NAME);

	$f = fopen($filepath,"w");
	fputs($f,"/mihey/\r\n");

	while ($all_tables = mysql_fetch_row($qt))
		{
		$q = db_query("SELECT * FROM ".$all_tables[0]);
		while ($row = db_fetch_row($q))
			{
			$i=0;
			while ($i<count($row))
				{

				$row[$i]=str_replace("\"'","\"",$row[$i]);
				$row[$i]=str_replace("'\"","\"",$row[$i]);
				$row[$i]=str_replace("'","”",$row[$i]);
				$row[$i]="'".$row[$i]."'";
				$i++;
				}
			$p=implode(", ",$row);
			$file_row="INSERT INTO ".$all_tables[0]." VALUES(".$p.");\n";
			fputs($f,$file_row);
			}
		}
	fclose($f);
	$mm_type="application/octet-stream";

	header("Cache-Control: public, must-revalidate");
	header("Pragma: hack");
	header("Content-Type: " . $mm_type);
	header("Content-Length: " .(string)(filesize($filepath)) );
	header('Content-Disposition: attachment; filename="'.$filename.'"');
	header("Content-Transfer-Encoding: binary\n");

	readfile($filepath);
	unlink($filepath);

?>