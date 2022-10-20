<?php




		// **************************************************
		//  Configuration settings
		// **************************************************


      include("../../../config.php");

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



		// **************************************************
		//  Login if database exists
		// **************************************************

        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => DB Opening ...<br>";



      	$DB_connection = mysqli_connect($cfg_DB_hostname, $cfg_DB_username, $cfg_DB_password,$cfg_DB_name) or die("Could Not Connect To Database");
        mysqli_query($DB_connection,"SET NAMES 'utf8' " );

        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => JOB DONE!...<br>";
        
        ///////////////////////////////////
        // 1. CHECK & REMOVE OLD BOOKINGS
        ///////////////////////////////////  

        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => Checking & deleting old entries...<br>";

        If ($cfg_csfl_dateformat == "1") {
          $sql_date = "%d".$cfg_csfl_dateseparator."%m".$cfg_csfl_dateseparator."%Y";
        }else if ($cfg_csfl_dateformat == "2") {
          $sql_date = "%Y".$cfg_csfl_dateseparator."%m".$cfg_csfl_dateseparator."%d";        
        }
      
        $sql = "DELETE FROM cc_".$cfg_Sender_Country_Code."_dat_shipments
                                      WHERE STR_TO_DATE(CollectionDate,'".$sql_date."') < CURDATE() - INTERVAL ".$cfg_con_history." DAY";

        mysqli_query($DB_connection,$sql) or die(mysqli_error($DB_connection));
      
      
        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => JOB DONE!....<br>";

          
        //////////////////////////////
        // 2. CHECK CONSIGNMENT RANGE
        //////////////////////////////  

        $sql = mysqli_query($DB_connection,"SELECT (end-LEFT(lastused,8)) FROM cc_".$cfg_Sender_Country_Code."_cfg_conrange ORDER BY id DESC" );
        $row = mysqli_fetch_array($sql);
      
        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => Checking number of cons left: ".$row[0]."<br>";
        
      If ($row[0] <= $cfg_con_threshold ) {
      
        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => <span style='color:#FF0000'>ALERT: ".$cfg_cc_SubDomain_Name." - Low number of cons in range - ".$row[0]."</span><br>";

        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => Email alert sending....<br>";

          $headers = "MIME-Version: 1.0\n" ;
          $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
          $headers .= "X-Priority: 1 (Higuest)\n";
          $headers .= "X-MSMail-Priority: High\n";
          $headers .= "Importance: High\n";

        mail($cfg_email_alerts,"CC ALERT: ".$cfg_cc_SubDomain_Name." - Low number of cons in range - ".$row[0],"",$headers);
      }

        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => JOB DONE!....<br>";




// **************************************************
//  Logout if database exists
// **************************************************



        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => DB Closing ...<br>";

          mysqli_close($DB_connection);

        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => JOB DONE!....<br>";    







?>