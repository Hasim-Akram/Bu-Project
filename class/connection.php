<?php
		
	
		//---------------------------  Database Connection Start----------------------------//
		
		//$con = mysqli_connect("localhost","root","","db_university") or die ("could not connect");

		mysql_connect("localhost","root","") or die ("could not connect");
		mysql_select_db("db_university") or die ("No database found..!!");
		//---------------------------  Database Connection End----------------------------//
		

?>