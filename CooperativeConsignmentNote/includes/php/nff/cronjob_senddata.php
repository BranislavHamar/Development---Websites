<?php

//**** every 10 mins job ****
// OPEN DB
// SELECT ALL PRINTED=1 AND SENT=0 + JOIN DEPO INFORMACIE
// IF >0 RECORDS THEN
// CREATE NFF PER DEPO
// CONNECT FTP3, UPLOAD, DISCONNECT
// UPDATE DB
// 

// IF IP TNT DISPLAY RESULTS
//
// 1000 cons per week
// 200 cons per day
// 25 cons per hour
// 7 cons per 15 mins
//

// 1 con = 2kb
//

//
// DEPO SETUP: 
// 1. FTP3 ACCOUNT
// 2. TP 



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



///////////////////////
// 2. DATA - OPEN DB
///////////////////////

       
        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => Data downloading ...<br>";

              mysqli_set_charset($DB_connection,"utf8");

              $sql = mysqli_query($DB_connection,"SELECT a.*, b.*, d.Data_depo 
    															FROM cc_".$cfg_Sender_Country_Code."_dat_shipments AS a, cc_".$cfg_Sender_Country_Code."_cfg_services AS b,
    															     cc_".$cfg_Sender_Country_Code."_cfg_lmf AS c, cc_".$cfg_Sender_Country_Code."_cfg_routing AS d
                                  WHERE a.Service = b.Name 
                                    AND a.ShipmentType = b.Type
                                    AND IF('".$cfg_Sender_Country_Code_big."' = a.ReceiverCountry, 'D', 'I') = b.DomInt 
                                    AND UPPER(a.SenderTown) = UPPER(c.Townname) 
                                    AND a.SenderPostcode 
                                      BETWEEN c.postcode_from AND c.postcode_until 
                                    AND c.Destination_station = d.Destination_depo
                                    AND FlagPrinted = '1'
                                    AND FlagDataSent = '0'
                                   ORDER BY d.Data_depo ASC, a.id ASC  " );         



              if (!mysqli_num_rows($sql) > 0) {

                $miliseconds = explode(".",microtime(true));
                echo date("d.m.Y G.i:s.").$miliseconds[1]." => No data for download!<br>";
                $miliseconds = explode(".",microtime(true));
                echo date("d.m.Y G.i:s.").$miliseconds[1]." => DB Closing...<br>";
                
                mysqli_close($DB_connection);
                
                $miliseconds = explode(".",microtime(true));
                echo date("d.m.Y G.i:s.").$miliseconds[1]." => JOB DONE!...<br>";
                
                exit();

              }

                    

        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => JOB DONE!...<br>";

                    



///////////////////////

// 3. DATA - CREATE NFF 

///////////////////////


        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => NFF Data creating ...<br>";

          // Functions

            Function TNTNumberConversion($number,$type){ // Removes decimal separator, pads zeros to left and right, customizes per type of number

          //weight

                If ($type=="weight") {

                   If (strpos($number,".")) {

                    $number = explode(".",$number);
                    $number = str_pad($number[0],5,"0",STR_PAD_LEFT).str_pad($number[1],3,"0",STR_PAD_RIGHT);

                  } else {

                    $number = str_pad($number,5,"0",STR_PAD_LEFT)."000";

                  } 

            //volume                

                } ElseIf ($type=="volume") {

                  $number = round($number,3);
                  $number = str_replace(".","",$number);
                  $number = str_pad($number,7,"0",STR_PAD_LEFT);

                } ElseIf ($type=="value") {

                   If (strpos($number,".")) {

                    $number = explode(".",$number);
                    $number = str_pad($number[0],11,"0",STR_PAD_LEFT).str_pad($number[1],2,"0",STR_PAD_RIGHT);

                  } else {

                    $number = str_pad($number,11,"0",STR_PAD_LEFT)."00";

                  } 

                } ElseIf ($type=="dim") {

                   If (strpos($number,".")) {

                    $number = explode(".",$number);
                    $number = str_pad($number[0],5,"0",STR_PAD_LEFT).str_pad($number[1],1,"0",STR_PAD_RIGHT);

                  } else {

                    $number = str_pad($number,5,"0",STR_PAD_LEFT)."0";

                  } 

                }            

              return $number;

            }

          Function RemoveNationalChars($content){
            
            global $cfg_con_national_chars;
            
              $RemoveNationalChars = str_replace(array_keys($cfg_con_national_chars),array_values($cfg_con_national_chars),$content);
            
            return $RemoveNationalChars;
          
          }
          
          
          
            
          $nff_file = array();
          $sql_ids = array();
          $x = 0;
                        
          while (($row = mysqli_fetch_array($sql))) {
          
                                  
                                            $sql_ids[$x] = $row[0];
                                            $x++;
                                            
                                            //00 Record
                                            //Positions   1               9                            29                                                  38                                      53              63   65               79              114                       134                 139              142
                                            $nff_data =   str_pad("", 8). str_pad($cfg_Sender_Country_Code_big."_CC".$row['Data_depo']."_01M", 20). str_pad($row['SenderAccount'], 9,"0",STR_PAD_LEFT). str_pad($row['ConsignmentNumber'], 15). str_pad("", 10)."00"."1.001104090002".str_pad("", 35).str_pad("CC        ", 20).str_pad("1.1. ", 5).str_pad("  ", 3).str_pad("", 59).chr(13);
                                  
                                  
                                  
                                            //01 Record
                                              $totalweight        = ($row['Items_0']<>"" ? $row['Weight_0'] * $row['Items_0'] + $row['Weight_1'] * $row['Items_1'] + $row['Weight_2'] * $row['Items_2'] + $row['Weight_3'] * $row['Items_3'] + $row['Weight_4'] * $row['Items_4'] : $row['TotalWeight'] );          
                                              $nff_totalweight    = TNTNumberConversion($totalweight,"weight");
                                  
                                              $totalvolume        = ($row['Items_0']<>"" ? round($row['Length_0']*$row['Width_0']*$row['Height_0']/1000000*$row['Items_0'],3) + round($row['Length_1']*$row['Width_1']*$row['Height_1']/1000000*$row['Items_1'],3) + round($row['Length_2']*$row['Width_2']*$row['Height_2']/1000000*$row['Items_2'],3) + round($row['Length_3']*$row['Width_3']*$row['Height_3']/1000000*$row['Items_3'],3) + round($row['Length_4']*$row['Width_4']*$row['Height_4']/1000000*$row['Items_4'],3): round($row['TotalLength']*$row['TotalWidth']*$row['TotalHeight']/1000000*$row['TotalItems'],3));
                                              $nff_totalvolume    = TNTNumberConversion($totalvolume,"volume");
                                  
                                              $totalpieces        = ($row['Items_0']<>"" ? $row['Items_0'] + $row['Items_1'] + $row['Items_2'] + $row['Items_3'] + $row['Items_4'] : $row['TotalItems']);
                                              $nff_totalpieces    = str_pad($totalpieces,5,"0",STR_PAD_LEFT);
                                  
                                              $collectiondate     = explode($cfg_csfl_dateseparator,$row['CollectionDate']);

                                              if ($cfg_csfl_dateformat == "1") {  // DD.MM.YYYY
                                                  $collectiondate[2]  = (strlen($collectiondate[2]) == 2 ? "20".$collectiondate[2] : $collectiondate[2] );
                                                  $nff_collectiondate = $collectiondate[2].str_pad($collectiondate[1],2,"0",STR_PAD_LEFT).str_pad($collectiondate[0],2,"0",STR_PAD_LEFT)."0000";
                                              } else if ($cfg_csfl_dateformat == "2"){  // YYYY.MM.DD
                                                  $collectiondate[0]  = (strlen($collectiondate[0]) == 2 ? "20".$collectiondate[0] : $collectiondate[0] );
                                                  $nff_collectiondate = $collectiondate[0].str_pad($collectiondate[1],2,"0",STR_PAD_LEFT).str_pad($collectiondate[2],2,"0",STR_PAD_LEFT)."0000";
                                              }
                                              
                                              $nff_insurance      = ""; if ( $row['ServiceOption_0']=="IN" OR $row['ServiceOption_1']=="IN" OR $row['ServiceOption_2']=="IN" OR $row['ServiceOption_3']=="IN" ) { $nff_insurance = "Y"; } else { $nff_insurance = "N"; };
                                  
                                              $nff_dg             = ""; if ( $row['DGIndicator']=="Y" ) { $nff_dg = "Y"; } else { $nff_dg = "N"; };
                                  
                                              $nff_cashondelivery = ""; if ( $row['ServiceOption_0']=="CO" OR $row['ServiceOption_1']=="CO" OR $row['ServiceOption_2']=="CO" OR $row['ServiceOption_3']=="CO" ) { $nff_cashondelivery = "Y"; } else { $nff_cashondelivery = "N"; };
                                  
                                              $nff_customscontrol = ( $row['CustomsControl']=="1" ?  "Y" : "N" );
                                  
                                              
                                              if ($nff_dg == "Y") {
                                                $nff_serviceoption  = array($row['DGOption'],$row['ServiceOption_0'],$row['ServiceOption_1'],$row['ServiceOption_2']);                                              
                                              } else {
                                                $nff_serviceoption  = array($row['ServiceOption_0'],$row['ServiceOption_1'],$row['ServiceOption_2'],$row['ServiceOption_3']);
                                              }

                                              //CS option is either removed or not due to NFF missing CS value field                                              
                                              if ($cfg_con_option_CS == "N") {
                                                $nff_serviceoption = str_replace("CS","",$nff_serviceoption);
                                              }
                                              
                                             
                                            //Positions   1               9                                                                         29                                                  38                                      53               63    65    67                75                82                87                        90                        94                                                    107                                   110                                   113                                                            133                                                          157                   169                                                 182                                   185                                   188                           194                                                            254                           261                               264                               267                               270                               273                   274                  276       281             296                       299                               302                               305                               308                               311             321             322   323                 325             347             362                   363             373   374               580                                                       593                                         596               717                                                            747             778   780   782             783                             787             793   794   795   796   797             892                   893   894
                                            $nff_data .=  str_pad("", 8). str_pad($cfg_Sender_Country_Code_big."_CC".$row['Data_depo']."_01M", 20). str_pad($row['SenderAccount'], 9,"0",STR_PAD_LEFT). str_pad($row['ConsignmentNumber'], 15). str_pad("", 10). "01". "WW". $nff_totalweight. $nff_totalvolume. $nff_totalpieces. str_pad($row['div'], 3).  str_pad($row['Code'], 4). TNTNumberConversion($row['InsuranceValue'],"value").  str_pad($row['InsuranceCurrency'],3). str_pad($row['InsuranceCurrency'],3). str_pad(RemoveNationalChars($row['ShipmentDescription']),20).  str_pad(RemoveNationalChars($row['CustomerReference']),24).  $nff_collectiondate.  TNTNumberConversion($row['ShipmentValue'],"value"). str_pad($row['ShipmentCurrency'],3).  str_pad($row['ShipmentCurrency'],3).  substr($nff_totalvolume,1,7). str_pad(RemoveNationalChars($row['DeliveryInstruction']),60).  substr($nff_totalweight,1,7). str_pad($nff_serviceoption[0],3). str_pad($nff_serviceoption[1],3). str_pad($nff_serviceoption[2],3). str_pad($nff_serviceoption[3],3). $row['PaymentTerms']. $cfg_con_source_EDI. "00001".  str_pad("",15). str_pad($row['Code'], 3). str_pad($nff_serviceoption[0],3). str_pad($nff_serviceoption[1],3). str_pad($nff_serviceoption[2],3). str_pad($nff_serviceoption[3],3). str_pad("",10). $nff_insurance. "Y".  str_pad($nff_dg,2). str_pad("",22). str_pad("",15). $nff_cashondelivery.  str_pad("",10). "N".  str_pad("",206).  TNTNumberConversion($row['CashOnDeliveryValue'],"value"). str_pad($row['CashOnDeliveryCurrency'],3).  str_pad("",121).  str_pad(RemoveNationalChars($row['ShipmentDescription']),30).  str_pad("",31). "00". "00". str_pad("",1).  str_pad($row['DGUNNumber'],4).  str_pad("",6).  "N".  " ".  "N".  "B".  str_pad("",95). $nff_customscontrol.  "N".  str_pad("",56)      .chr(13);
                                  
                                  
                                            //03 Record S
                                            //Positions   1               9                                                                         29                                                  38                                      53               63    65    67               87                                  117                                 147                                 177                                  186+193                            202                                                    211                               261                                       264              280                              310                                 332+339         348            357              387                         390             440             490
                                            $nff_data .=  str_pad("", 8). str_pad($cfg_Sender_Country_Code_big."_CC".$row['Data_depo']."_01M", 20). str_pad($row['SenderAccount'], 9,"0",STR_PAD_LEFT). str_pad($row['ConsignmentNumber'], 15). str_pad("", 10). "03". "S ". str_pad("", 20). str_pad(RemoveNationalChars($row['SenderStreet1']), 30). str_pad(RemoveNationalChars($row['SenderStreet2']), 30). str_pad(RemoveNationalChars($row['SenderStreet3']), 30). str_pad($row['SenderPostcode'], 9).  str_pad($row['SenderPhone'], 16).  str_pad($row['SenderAccount'], 9, "0", STR_PAD_LEFT).  str_pad(RemoveNationalChars($row['SenderName']), 50).  str_pad($cfg_Sender_Country_Code_big, 3). str_pad("", 16). str_pad(RemoveNationalChars($row['SenderTown']), 30). str_pad(RemoveNationalChars($row['SenderContact']), 22). str_pad("",16). str_pad("",9). str_pad("",30).  str_pad($cfg_Sender_Country_Code_big,3).  str_pad("",50). str_pad("",50). str_pad("",61).chr(13);
                                  
                                            
                                  
                                            //03 Record R
                                            //Positions   1               9                                                                         29                                                  38                                      53               63    65    67               87                                    117                                    147                                   177                                   186+193                              202                                                    211                                 261                                  264              280                                310                                   332+339         348            357              387                                  390             440             490
                                            $nff_data .=  str_pad("", 8). str_pad($cfg_Sender_Country_Code_big."_CC".$row['Data_depo']."_01M", 20). str_pad($row['SenderAccount'], 9,"0",STR_PAD_LEFT). str_pad($row['ConsignmentNumber'], 15). str_pad("", 10). "03". "R ". str_pad("", 20). str_pad(RemoveNationalChars($row['ReceiverStreet1']), 30). str_pad(RemoveNationalChars($row['ReceiverStreet2']), 30). str_pad(RemoveNationalChars($row['ReceiverStreet3']), 30). str_pad($row['ReceiverPostcode'], 9).  str_pad($row['ReceiverPhone'], 16).  str_pad($row['ReceiverAccount'], 9, "0", STR_PAD_LEFT).  str_pad(RemoveNationalChars($row['ReceiverName']), 50).  str_pad($row['ReceiverCountry'], 3). str_pad("", 16). str_pad(RemoveNationalChars($row['ReceiverTown']), 30). str_pad(RemoveNationalChars($row['ReceiverContact']), 22). str_pad("",16). str_pad("",9). str_pad("",30).  str_pad($row['ReceiverCountry'],3).  str_pad("",50). str_pad("",50). str_pad("",61).chr(13);
                                  
                                  
                                            //03 Record C
                                            //Positions   1               9                                                                         29                                                  38                                      53               63    65    67               87                                  117                                 147                                 177                                  186+193                            202              211                               261                                       264              280                              310                                 332+339         348            357              387                         390             440             490
                                            $nff_data .=  str_pad("", 8). str_pad($cfg_Sender_Country_Code_big."_CC".$row['Data_depo']."_01M", 20). str_pad($row['SenderAccount'], 9,"0",STR_PAD_LEFT). str_pad($row['ConsignmentNumber'], 15). str_pad("", 10). "03". "C ". str_pad("", 20). str_pad(RemoveNationalChars($row['SenderStreet1']), 30). str_pad(RemoveNationalChars($row['SenderStreet2']), 30). str_pad(RemoveNationalChars($row['SenderStreet3']), 30). str_pad($row['SenderPostcode'], 9).  str_pad($row['SenderPhone'], 16).  str_pad("", 9).  str_pad(RemoveNationalChars($row['SenderName']), 50).  str_pad($cfg_Sender_Country_Code_big, 3). str_pad("", 16). str_pad(RemoveNationalChars($row['SenderTown']), 30). str_pad(RemoveNationalChars($row['SenderContact']), 22). str_pad("",16). str_pad("",9). str_pad("",30).  str_pad($cfg_Sender_Country_Code_big,3).  str_pad("",50). str_pad("",50). str_pad("",61).chr(13);
                                  
                                  
                                            //03 Record D
                                            //Positions   1               9                                                                         29                                                  38                                      53               63    65    67               87                                    117                                    147                                   177                                   186+193                              202              211                                 261                                  264              280                                310                                   332+339         348            357              387                                  390             440             490
                                            $nff_data .=  str_pad("", 8). str_pad($cfg_Sender_Country_Code_big."_CC".$row['Data_depo']."_01M", 20). str_pad($row['SenderAccount'], 9,"0",STR_PAD_LEFT). str_pad($row['ConsignmentNumber'], 15). str_pad("", 10). "03". "D ". str_pad("", 20). str_pad(RemoveNationalChars($row['ReceiverStreet1']), 30). str_pad(RemoveNationalChars($row['ReceiverStreet2']), 30). str_pad(RemoveNationalChars($row['ReceiverStreet3']), 30). str_pad($row['ReceiverPostcode'], 9).  str_pad($row['ReceiverPhone'], 16).  str_pad("", 9).  str_pad(RemoveNationalChars($row['ReceiverName']), 50).  str_pad($row['ReceiverCountry'], 3). str_pad("", 16). str_pad(RemoveNationalChars($row['ReceiverTown']), 30). str_pad(RemoveNationalChars($row['ReceiverContact']), 22). str_pad("",16). str_pad("",9). str_pad("",30).  str_pad($row['ReceiverCountry'],3).  str_pad("",50). str_pad("",50). str_pad("",61).chr(13);
                                  
                                  
                                            //02 Record
                                            // If multiple package lines
                                            If ($row['Items_0']<>"") {
                                  
                                  
                                  
                                              $i=0;
                                  
                                              while (isset($row['Items_'.$i]) AND $row['Items_'.$i]<>"" ) {
                                  
                                    
                                  
                                                      $nff_volume[$i] = ($row['Length_'.$i]*$row['Width_'.$i]*$row['Height_'.$i]/1000000);
                                  
                                                      $nff_volume[$i] = TNTNumberConversion($nff_volume[$i],"volume");
                                  
                                                      $nff_weight[$i] = TNTNumberConversion($row['Weight_'.$i],"weight");
                                  
                                        
                                  
                                                    //Positions   1               9                                                                         29                                                  38                                      53                                56              63    65                72                80                                              86                                             92                                             98                                              103+113
                                                    $nff_data .=  str_pad("", 8). str_pad($cfg_Sender_Country_Code_big."_CC".$row['Data_depo']."_01M", 20). str_pad($row['SenderAccount'], 9,"0",STR_PAD_LEFT). str_pad($row['ConsignmentNumber'], 15). str_pad($i+1, 3,"0", STR_PAD_LEFT). str_pad("", 7). "02". $nff_volume[$i]. $nff_weight[$i]. TNTNumberConversion($row['Length_'.$i],"dim").  TNTNumberConversion($row['Height_'.$i],"dim"). TNTNumberConversion($row['Width_'.$i],"dim").  str_pad($row['Items_'.$i],5,"0",STR_PAD_LEFT) . str_pad("",48).     chr(13);
                                  
                                                    $i++;
                                  
                                             }
                                  
                                            
                                  
                                            
                                  
                                            } else {
                                  
                                              $i=1;                                            
                                  
                                              //Positions   1               9                                                                         29                                                  38                                      53                                56              63    65                72                80                                               86                                              92                                              98                103+113
                                              $nff_data .=  str_pad("", 8). str_pad($cfg_Sender_Country_Code_big."_CC".$row['Data_depo']."_01M", 20). str_pad($row['SenderAccount'], 9,"0",STR_PAD_LEFT). str_pad($row['ConsignmentNumber'], 15). str_pad($i, 3,"0", STR_PAD_LEFT). str_pad("", 7). "02". $nff_totalvolume. $nff_totalweight. TNTNumberConversion($row['TotalLength'],"dim").  TNTNumberConversion($row['TotalHeight'],"dim"). TNTNumberConversion($row['TotalWidth'],"dim").  $nff_totalpieces. str_pad("",48).     chr(13);
                                              $i++;
                                            
                                  
                                            }
          
            $timestamp = date("YmdGi"); //YearMonthDayHourMinute = 59 seconds for one file with NFF data. Each 59 seconds new NFF file. FTP upload not covered.
            $nff_file[$row['Data_depo']] = "FD6CNFFCC".$row['Data_depo'].".".$timestamp."0000.0000";


            file_put_contents($nff_file[$row['Data_depo']], $nff_data, FILE_APPEND);
          
           echo "<p><strong>".$nff_file[$row['Data_depo']]."</strong></p>";
           echo "<pre>".$nff_data."</pre>";         
          
          
          }
          
        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => JOB DONE!...<br>";




////////////////////////
// 3. UPLOAD - UPLOAD FILE
////////////////////////



        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => FTP connecting... server ".$cfg_ftp_server." & user ".$cfg_ftp_user_name."<br>";
          
          set_time_limit(0);

          //-- Connection Settings

          $conn_id = @ftp_connect($cfg_ftp_server) ;        // set up basic connection
          $login_result = @ftp_login($conn_id, $cfg_ftp_user_name, $cfg_ftp_user_pass) ;   // login with username and password, or give invalid user message

          

          if ((!$conn_id) || (!$login_result)) {  // check connection

              // wont ever hit this, b/c of the die call on ftp_login

                $miliseconds = explode(".",microtime(true));
                echo date("d.m.Y G.i:s.").$miliseconds[1]." => <span style='color:#FF0000'>FTP connection has failed!</span>  <br>";
        
                $miliseconds = explode(".",microtime(true));
                echo date("d.m.Y G.i:s.").$miliseconds[1]." => <span style='color:#FF0000'>Attempted to connect to ".$cfg_ftp_server." for user ".$cfg_ftp_user_name."</span>";



                $headers = "MIME-Version: 1.0\n" ;
                $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
                $headers .= "X-Priority: 1 (Higuest)\n";
                $headers .= "X-MSMail-Priority: High\n";
                $headers .= "Importance: High\n";

                mail($cfg_email_alerts,"CC ALERT: ".$cfg_cc_SubDomain_Name." - FTP connection has failed, Attempted to connect to ".$cfg_ftp_server." for user ".$cfg_ftp_user_name,"",$headers);


              exit;

          } 


        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => JOB DONE!...<br>";

          

        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => NFF files uploading...<br>";

          $ftp_foldername = array_keys($nff_file);
          $i = 0;
                              
          while ($i < count($ftp_foldername)) {
          
          //          $destination_file = "incoming_".$ftp_foldername[$i]; //."_FAKE/"; where you want to throw the file on the webserver (relative to your login dir)
                    $destination_folder = "incoming_".$ftp_foldername[$i]."/"; //where you want to throw the file on the webserver (relative to your login dir)
                    $filename = "FD6CNFFCC".$ftp_foldername[$i].".".$timestamp."0000.0000";

          

                    
                    $upload = ftp_put($conn_id, $destination_folder.$filename, $filename, FTP_ASCII);  // upload the file
          
                    if (!$upload) {  // check upload status
          
                            $miliseconds = explode(".",microtime(true));
                            echo date("d.m.Y G.i:s.").$miliseconds[1]." => <span style='color:#FF0000'>ALERT: ".$cfg_cc_SubDomain_Name." - FTP upload of ".$filename." has failed!</span> <br>";
          
                              $headers = "MIME-Version: 1.0\n" ;
                              $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
                              $headers .= "X-Priority: 1 (Higuest)\n";
                              $headers .= "X-MSMail-Priority: High\n";
                              $headers .= "Importance: High\n";
                    
                            mail($cfg_email_alerts,"CC ALERT: ".$cfg_cc_SubDomain_Name." - FTP upload of ".$filename." has failed!","",$headers);

                            exit;
        
                    } else {
          
                              $miliseconds = explode(".",microtime(true));
                              echo date("d.m.Y G.i:s.").$miliseconds[1]." => FTP upload of ".$filename." has been sucessful!<br>";
          
                    }
          $i++;
          }
          
        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => JOB DONE!...<br>";
        


        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => FTP disconnecting...<br>";

        ftp_close($conn_id); // close the FTP stream 

        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => JOB DONE!...<br>";

                    

////////////////////////
// 4. DATA - UPDATE DB
////////////////////////  



      if (($conn_id) || ($login_result)) {  // check connection
          

        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => Data updating...<br>";
         
         $sql = "";
         $i = 0;
        
        while ($i < count($sql_ids)) {
         
             if ($i == 0) {$del = "'"; } else { $del = ",'";}
             
             $sql .= $del.$sql_ids[$i]."'";
             $i++;
        
        }
        
          $sql = "UPDATE cc_".$cfg_Sender_Country_Code."_dat_shipments AS a
                                      SET FlagDataSent = '1'
                                      WHERE a.id IN (".$sql.")";

        mysqli_query($DB_connection,$sql) or die(mysqli_error($DB_connection));
                                   
                    
        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => JOB DONE!...<br>";

      }


////////////////////////
// 4. FILE - REMOVE JUNK FILES
////////////////////////           

          $miliseconds = explode(".",microtime(true));
          echo date("d.m.Y G.i:s.").$miliseconds[1]." => Old NFF files searching & deleting ...<br>";
          
            $oldfiles = glob("*.0000");
            if ($oldfiles) {
              foreach ($oldfiles as $oldfiles) {
                unlink($oldfiles);
              }
            }
        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => JOB DONE!...<br>";


		// **************************************************
		//  Logout if database exists
		// **************************************************



        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => DB Closing ...<br>";

          mysqli_close($DB_connection);

        $miliseconds = explode(".",microtime(true));
        echo date("d.m.Y G.i:s.").$miliseconds[1]." => JOB DONE!....<br>";    







?>