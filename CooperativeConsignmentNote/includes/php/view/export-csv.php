<?php
          
 		// **************************************************
		//  Country configuration settings
		// **************************************************


      include("../../../config.php");

      $App_Version = "1.0";

    // *******************************************************
    // CHECK ORIGIN IP ADDRESS TO ALLOW TNT ONLY
    // *******************************************************

    If ($restrict_ip == "Y") {

        if (!in_array($_SERVER['REMOTE_ADDR'], $allow_ip) AND !isset($_COOKIE["CC"])) {
         echo "<h1>Your IP address <i>".$_SERVER['REMOTE_ADDR']."</i> is not authorized for this page.</h1>";
         exit;
        }

       setcookie("CC", "Admin", mktime(0, 0, 0, 1, 1, 2038));

    
    }


   
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      	$DB_Connection = mysqli_connect($cfg_DB_hostname, $cfg_DB_username, $cfg_DB_password, $cfg_DB_name) or die("Could Not Connect To Database");

                                        if ($cfg_csfl_dateformat == "1") {  // DD.MM.YYYY
                                                  $sql = "%d.%m.%Y";
                                              } else if ($cfg_csfl_dateformat == "2"){  // YYYY.MM.DD
                                                  $sql = "%Y.%m.%d";
                                              }


   
        $sql = "SELECT a.id, STR_TO_DATE(CollectionDate, '".$sql."') AS CollectionDate, a.UserName, a.BookingNumber, a.SenderAccount, a.ConsignmentNumber, a.SenderEmail, a.FlagMarketing
                                            FROM 
                                              cc_".$cfg_Sender_Country_Code."_dat_shipments AS a 
                                            ORDER BY a.id ASC
                                            ";
                                                  
        $sql_query = mysqli_query($DB_Connection,$sql); 
      
                   echo "ID;SENDER_COUNTRY;COLLECTION_DATE;USERNAME;BOOKING_NUMBER;SENDER_ACCOUNT;CONSIGNMENT_NUMBER;SENDER_EMAIL;FLAG_MARKETING".PHP_EOL;
        
            while ($row = mysqli_fetch_array($sql_query)) {
            
                  echo  $row["id"].";".$cfg_Sender_Country_Code_big.";".$row["CollectionDate"].";".$row["UserName"].";".$row["BookingNumber"].";".$row["SenderAccount"].";".$row["ConsignmentNumber"].";".$row["SenderEmail"].";".$row["FlagMarketing"].PHP_EOL;
            
            } 
?>