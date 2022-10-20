<?php

////// 
/////  1. b-form.validate.php
/////  2. b-form.insert.php
/////  3. b-form.email.php
/////  4. b-form.detail.php


    function form_function() {

    global $wpdb;
        
		ob_start();

    $post01 = ""; $post02 = ""; $post03 = ""; $post04 = ""; $post05 = ""; $post06 = ""; $post07 = ""; $post08 = "";
    $post09 = ""; $post10 = ""; $post11 = ""; $post12 = ""; $post13 = ""; $post14 = ""; $post15 = ""; $post16 = "";    
    $post17 = ""; $post18 = ""; $post19 = ""; $post20 = ""; $post21 = ""; $post22 = ""; $post23 = ""; $post24 = "";
    $post25 = ""; $post26 = ""; $post27 = ""; $post28 = ""; $post29 = ""; $post30 = ""; $post31 = ""; $post32 = ""; 
    $post33 = ""; $post34 = ""; $post35 = ""; $post36 = ""; $post37 = ""; $post38 = ""; $post39 = ""; $post40 = "";
    $post41 = ""; $post42 = "";

   
		 if ( isset($_POST['submit']) ) 
     {

          /// Validate
          include 'b-form.validate.php';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
          /// If validation successfull 
          If ($result=='') {
                  
                            include 'b-form.insert.php';
                            include 'b-form.email.php';
                                               
                            //clean variables
                            $post01 = ""; $post02 = ""; $post03 = ""; $post04 = ""; $post05 = ""; $post06 = ""; $post07 = ""; $post08 = "";
                            $post09 = ""; $post10 = ""; $post11 = ""; $post12 = ""; $post13 = ""; $post14 = ""; $post15 = ""; $post16 = "";    
                            $post17 = ""; $post18 = ""; $post19 = ""; $post20 = ""; $post21 = ""; $post22 = ""; $post23 = ""; $post24 = "";
                            $post25 = ""; $post26 = ""; $post27 = ""; $post28 = ""; $post29 = ""; $post30 = ""; $post31 = ""; $post32 = ""; 
                            $post33 = ""; $post34 = ""; $post35 = ""; $post36 = ""; $post37 = ""; $post38 = ""; $post39 = ""; $post40 = "";
                            $post41 = ""; $post42 = "";
                                  
                          } else {
                        
                            echo '<pre>';   
                     		    echo "<h2 style='color:red;'>Je potrebné vyplniť nasledovné povinné polia:</h2>";
                      		  echo "<span style='color:red;'>".$result."</span>";
                            echo "</pre>";
                        
                         }

		} 


  If (!isset($_POST['submit']) OR $result<>'') 
       {

         include 'b-form.detail.php';

       }
       
		return ob_get_clean();

} 
?>