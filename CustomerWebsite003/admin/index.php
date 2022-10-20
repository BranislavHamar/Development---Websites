<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  S*E*T*U*P
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

session_start();

    // **************************************************
		//  MySQL Database usage
		// **************************************************

    //   --------------------
         $DB_hostname = "ddddd";
         $DB_username = "eeeee";
         $DB_password = "44444";
         $DB_name		  = "55555";

    // **************************************************
		//  Which content will be editable first
		// **************************************************

//         $setup_default_go = 2;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		// **************************************************
		//  Login if database exists
		// **************************************************

      	@mysql_connect($DB_hostname, $DB_username, $DB_password) or die("Could Not Connect To Database");
      	@mysql_select_db($DB_name) or die("Could Not Choose Database");
//      	@mysql_query ("SET NAMES 'UTF8'");

      
              		// **************************************************
              		// 1. Include Dynamic Php Functions
              		// **************************************************
              		// Category functions are accessed 
              		// within Showpage() function

              		// GENERAL
              			  include("includes/php/fn_general.php");

              		// **************************************************
              		// 2. Choose appropriate templates
              		// **************************************************
              			
                      if (!isset($_SESSION['sid'])){
              								$TplFile = "tpl_login.html"; // Homepage template;
              				} else {
              			          $TplFile = "tpl_main.html"; // Main template
              		      }
              		// **************************************************
              		// 3. Generate Final Page
              		// **************************************************
              		
              			  echo ShowPage($TplFile);



		// **************************************************
		//  Logout if database exists
		// **************************************************
    
        @mysql_close();
           
//echo $setup_database;
?>
