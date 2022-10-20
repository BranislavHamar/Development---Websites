<?php

		// **************************************************
		//  Country configuration settings
		// **************************************************


      include("config.php");
         

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



		// **************************************************
		//  Login if database exists
		// **************************************************





      	$DB_connection = mysqli_connect($cfg_DB_hostname, $cfg_DB_username, $cfg_DB_password, $cfg_DB_name) or die("Could Not Connect To Database");

      	//$DB_select = mysqli_select_db($DB_connection, $cfg_DB_name) or die("Could Not Choose Database");

        mysqli_query($DB_connection,"SET NAMES 'utf8' " );

      

              		// **************************************************

              		// 1. Include Dynamic Php Functions

              		// **************************************************

              		// GENERAL



              			   include("includes/php/fn_general.php");



                  // PAGE SPECIFIC

                       If ($senderaccount == "" OR $crn == "") {

                          include("includes/php/entry.php");

                       } else {

                          include("includes/php/main.php");

                       }



              		// **************************************************

              		// 2. Choose appropriate templates

              		// **************************************************

                  // PAGE SPECIFIC

                                			



                          $TplFile = "tpl_main.html"; // Main template



                       

              		// **************************************************

              		// 3. Generate Final Page

              		// **************************************************

              		

              			  echo ShowPage($TplFile);







		// **************************************************

		//  Logout if database exists

		// **************************************************

    

      mysqli_close($DB_connection);

           

//echo $setup_database;

?>

