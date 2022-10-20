<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  S*E*T*U*P
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // **************************************************
		//  Homepage existence (different to other pages)
		// **************************************************

    //    $setup_homepage = "no";
          $setup_homepage = "yes"; //tpl_homepage.html musts exists!

    // **************************************************
		//  Separate category header images
		// **************************************************

    //    $go_images = "no";
          $go_images = "yes"; //different images must exists!
    
          $go_images_name = "index_05"; //if images assigned _1, _2 prior to cat
          $go_images_ext = "jpg";

    // **************************************************
		//  Menu - actual category highlighted
		// **************************************************

          $go_menu_hl = "no";
    //    $go_menu_hl = "yes"; // actual css '.open' must be set
    
    // **************************************************
		//  MySQL Database usage
		// **************************************************

    //   $setup_database    = "no";
         $setup_database    = "yes";
    //   --------------------
         $DB_hostname = "localhost";
         $DB_username = "c0arirestaurant";
         $DB_password = "ts12345";
         $DB_name		  = "c0arirestaurant";


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		// **************************************************
		//  Login if database exists
		// **************************************************

        if ( $setup_database == "yes" ) {
              $log="in";
  	             include("includes/php/fn_connect.php");
          }

      
              		// **************************************************
              		// 1. Include Dynamic Php Functions
              		// **************************************************
              		// Category functions are accessed 
              		// within Showpage() function

              		// GENERAL
              			  include("includes/php/fn_general.php");

              		// LOCAL                    
//                      if ( $setup_homepage == "no" AND $go <> 0 )	{
                          
                          if ( $setup_database == "yes" ) {
                            include("includes/php/fn_go_db.php");}
                          elseif ( $setup_database == "no" ) {
                            include("includes/php/fn_go_nondb.php");
                            }
//                      }
              
              		// **************************************************
              		// 2. Choose appropriate templates
              		// **************************************************
              			
                      if ( $setup_homepage == "yes" AND $go == 0){
              								$TplFile = "tpl_homepage.html";} // Homepage template;
              				else {
              			          $TplFile = "tpl_main.html"; // Main template
              		      }
              		// **************************************************
              		// 3. Generate Final Page
              		// **************************************************
              		
              			  echo ShowPage($TplFile);



		// **************************************************
		//  Logout if database exists
		// **************************************************
    
        if ( $setup_database == "yes" ) {
               $log="out";
        	       include("includes/php/fn_connect.php");
           }
           
//echo $setup_database;
?>
