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

        //IP and cookie doesn NOT exists
        if (!in_array($_SERVER['REMOTE_ADDR'], $allow_ip) AND !isset($_COOKIE["CC"])) {
         echo "<h1>Your IP address <i>".$_SERVER['REMOTE_ADDR']."</i> is not authorized for this page.</h1>";
         exit;
        }

       // Set cookie to PC allowed from external IP from config
       setcookie("CC", "Admin", mktime(0, 0, 0, 1, 1, 2038));

    
    }
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



		// **************************************************
		//  Login if database exists
		// **************************************************





      	$DB_Connection = mysqli_connect($cfg_DB_hostname, $cfg_DB_username, $cfg_DB_password, $cfg_DB_name) or die("Could Not Connect To Database");
         mysqli_query($DB_Connection,"SET NAMES 'utf8' " );

        

        


        // GET VALUE WITH PARAMETER TO DECODE
        function ReadUrl($UrlParam,$Decode)

    			{



    				if ( isset($_GET[$UrlParam]) ) {

            		$ReadUrl = $_GET[$UrlParam];
             
                
                    if ( $Decode == "Y"){
                      
            					$ReadUrl = urldecode($ReadUrl);
                                      
            				} else {

             					$ReadUrl = urlencode($ReadUrl);
             					
         					  }

            } else {
            
                  $ReadUrl = "";
            }

    					
              $ReadUrl = trim($ReadUrl);
              $ReadUrl = str_replace("'","''",$ReadUrl);
                      
              return $ReadUrl;

    			}        
                                        
            $get_TotalPackageType = "";
            $get_PackageType_0 = "";
            $get_PackageType_1 = "";
            $get_PackageType_2 = "";
            $get_PackageType_3 = "";
            $get_PackageType_4 = "";
            $get_Weight_0 = "";
            $get_Weight_1 = "";
            $get_Weight_2 = "";
            $get_Weight_3 = "";
            $get_Weight_4 = "";
         
            $ValidationMessage="";
            $stop=0;

            If (ReadUrl("CollectionDate","") == "")                                                                           { $ValidationMessage .= "<tr><td>Collection Date :: </td><td><input type='text' name='CollectionDate'></td><td>&nbsp;</td></tr>"; $stop=1;}
            If (ReadUrl("AccountNumber","") == "")                                                                            { $ValidationMessage .= "<tr><td>PaymentAccountNumber :: </td><td><input type='text' name='AccountNumber'></td><td>&nbsp;</td></tr>"; $stop=1;}
            If (ReadUrl("CC_CRN","") == "")                                                                                   { $ValidationMessage .= "<tr><td>CRN :: </td><td><input type='text' name='CC_CRN'></td><td>&nbsp;</td></tr>"; $stop=1;}
            If (ReadUrl("PaymentTerms","") <> "S" AND ReadUrl("PaymentTerms","") <> "R")                                      { $ValidationMessage .= "<tr><td>PaymentTerms :: </td><td><input type='text' name='PaymentTerms'></td><td><i>(S)ender or (R)eceiver pays</i></td></tr>"; $stop=1;} 
            If (ReadUrl("SenderAccount","") == "" AND ReadUrl("PaymentTerms","") == "R")                                      { $ValidationMessage .= "<tr><td>SenderAccount :: </td><td><input type='text' name='SenderAccount' value='0'></td><td>&nbsp;</td></tr>"; $stop=1;}
            If (ReadUrl("SenderName","") == "")                                                                               { $ValidationMessage .= "<tr><td>SenderName :: </td><td><input type='text' name='SenderName'></td><td>&nbsp;</td></tr>"; $stop=1;}
            If (ReadUrl("SenderStreet1","") == "")                                                                            { $ValidationMessage .= "<tr><td>SenderStreet1 :: </td><td><input type='text' name='SenderStreet1'></td><td>&nbsp;</td></tr>"; $stop=1;}
            If (ReadUrl("SenderTown","") == "" OR strpos(ReadUrl("SenderTown","Y"),",") == FALSE)                             { $ValidationMessage .= "<tr><td>SenderTown & SenderPostcode:: </td><td><input type='text' name='SenderTown'></td><td><i>Town, postcode</i></td></tr>"; $stop=1;}
            If (ReadUrl("SenderCountry","") == "")                                                                            { $ValidationMessage .= "<tr><td>SenderCountry :: </td><td><input type='text' name='SenderCountry'></td><td><i>Country name in english (eg. Slovakia)</i></td></tr>"; $stop=1;}
            If (ReadUrl("SenderContact","") == "")                                                                            { $ValidationMessage .= "<tr><td>SenderContact :: </td><td><input type='text' name='SenderContact'></td><td>&nbsp;</td></tr>"; $stop=1;}
            If (ReadUrl("SenderPhone1","") == "")                                                                             { $ValidationMessage .= "<tr><td>SenderPhone1 :: </td><td><input type='text' name='SenderPhone1'></td><td><i>Prefix<i></td></tr>"; $stop=1;}
            If (ReadUrl("SenderPhone2","") == "")                                                                             { $ValidationMessage .= "<tr><td>SenderPhone2 :: </td><td><input type='text' name='SenderPhone2'></td><td>&nbsp;</td></tr>"; $stop=1;}
            If (ReadUrl("ReceiverTown","") == "")                                                                             { $ValidationMessage .= "<tr><td>ReceiverTown :: </td><td><input type='text' name='ReceiverTown'></td><td><i>Town</i></td></tr>"; $stop=1;}
            If (ReadUrl("ReceiverPostcode","") == "")                                                                         { $ValidationMessage .= "<tr><td>ReceiverPostcode :: </td><td><input type='text' name='ReceiverPostcode'></td><td><i>Postcode</i></td></tr>"; $stop=1;}
            If (ReadUrl("ReceiverCountry","") == "")                                                                          { $ValidationMessage .= "<tr><td>ReceiverCountry :: </td><td><input type='text' name='ReceiverCountry'></td><td><i>Country code (eg. SK)</i></td></tr>"; $stop=1;}
            If (ReadUrl("ShipmentType","") <> "D" AND ReadUrl("ShipmentType","") <> "N")                                      { $ValidationMessage .= "<tr><td>ShipmentType :: </td><td><input type='text' name='ShipmentType'></td><td><i>(D)oc or (N)ondoc</i></td></tr>"; $stop=1;}

            If (ReadUrl("ServiceOption_0","Y")=="CO" OR ReadUrl("ServiceOption_1","Y")=="CO" OR ReadUrl("ServiceOption_2","Y")=="CO" OR ReadUrl("ServiceOption_3","Y")=="CO" OR ReadUrl("ServiceOption_4","Y")=="CO" OR ReadUrl("ServiceOption_5","Y")=="CO"){
              If (ReadUrl("CashOnDeliveryValue","") == "")                                                                    { $ValidationMessage .= "<tr><td>CashOnDeliveryValue :: </td><td><input type='text' name='CashOnDeliveryValue'></td><td><i>numeric value</i></td></tr>"; $stop=1;}
              If (ReadUrl("CashOnDeliveryCurrency","") == "")                                                                 { $ValidationMessage .= "<tr><td>CashOnDeliveryCurrency :: </td><td><input type='text' name='CashOnDeliveryCurrency'></td><td><i>currency code eg. EUR, PLN, RON,...</i></td></tr>"; $stop=1;}
            }
            
            If (ReadUrl("DGIndicator","") <> "Y" AND ReadUrl("DGIndicator","") <> "N" AND ReadUrl("ShipmentType","") == "N")  { $ValidationMessage .= "<tr><td>DGIndicator :: </td><td><input type='text' name='DGIndicator'></td><td><i>(Y)es or (N)o</i></td></tr>"; $stop=1;}
            If (ReadUrl("DGIndicator","") == "Y" AND ReadUrl("DGUNNumber","") == "")                                          { $ValidationMessage .= "<tr><td>DGUNNumber :: </td><td><input type='text' name='DGUNNumber'></td><td><i>Numeric value</i></td></tr>"; $stop=1;}
            If (ReadUrl("DGIndicator","") == "Y" AND ReadUrl("DGOption","") == "")                                            { $ValidationMessage .= "<tr><td>DGOption :: </td><td><input type='text' name='DGOption'></td><td><i>Service option code of DG</i></td></tr>"; $stop=1;}


            If (strlen(ReadUrl("Service","")) < 5)                                                                            { $ValidationMessage .= "<tr><td>Service :: </td><td><input type='text' name='Service'></td><td><i>Service name (eg. 12:00 Express)</i></td></tr>"; $stop=1;}
            If ((floatval(ReadUrl("TotalItems",""))+ floatval(ReadUrl("Items[0]","")))==0)                                    { $ValidationMessage .= "<tr><td>TotalItems :: </td><td><input type='text' name='TotalItems'></td><td>&nbsp;</td></tr>"; $stop=1;}
            If ((floatval(ReadUrl("TotalWeight","")) + floatval(ReadUrl("TotalSubWeight","")) + floatval(ReadUrl("Weight[0]","")))==0 AND ReadUrl("ShipmentType","") == "N")                    { $ValidationMessage .= "<tr><td>TotalWeight :: </td><td><input type='text' name='TotalWeight'></td><td><i>Average number per item</i></td></tr>"; $stop=1;}
            If ((floatval(ReadUrl("TotalLength",""))+ floatval(ReadUrl("Length[0]","")))==0 AND ReadUrl("ShipmentType","") == "N")                    { $ValidationMessage .= "<tr><td>TotalLength :: </td><td><input type='text' name='TotalLength'></td><td><i>Average number per item</i></td></tr>"; $stop=1;}
            If ((floatval(ReadUrl("TotalWidth",""))+ floatval(ReadUrl("Width[0]","")))==0 AND ReadUrl("ShipmentType","") == "N")                      { $ValidationMessage .= "<tr><td>TotalWidth :: </td><td><input type='text' name='TotalWidth'></td><td><i>Average number per item</i></td></tr>"; $stop=1;}
            If ((floatval(ReadUrl("TotalHeight",""))+ floatval(ReadUrl("Height[0]","")))==0 AND ReadUrl("ShipmentType","") == "N")                    { $ValidationMessage .= "<tr><td>TotalHeight :: </td><td><input type='text' name='TotalHeight'></td><td><i>Average number per item</i></td></tr>"; $stop=1;}
                                                
            If ( ReadUrl("CC_email","") <> "" AND ( strpos(ReadUrl("CC_email","Y"),"@") === FALSE OR strpos(ReadUrl("CC_email","Y"),".") === FALSE) )                                { $ValidationMessage .= "<tr><td>Email Address :: </td><td><input type='text' name='CC_email' value='".ReadUrl("CC_email","Y")."'></td><td>&nbsp;</td></tr>"; $stop=1;}




                        
            if ($stop==1) {

                echo "<html><title>TNT - Data upload</title><h1>WARNING - missing mandatory fields</h1><p>Data transfer failed due to missing mandatory fields from booking screen.<br>Please update following data manually to finish the process and check next screen if everything is inline.</p><form method='get' action=''><table>";
             
                      foreach($_GET as $name => $value) {
                        echo "<input type='hidden' name='".$name."' value='".$value."' />";
                      }                     
            
                        echo $ValidationMessage;
            
                echo "<tr><td>&nbsp;</td><td><input type='submit' value='continue'></td></tr></table></form><p style='font-size:10px;'>Message generated: ".date("d.m.Y H:i:s")." Version: ".$App_Version."</p></html>";            
            
            exit();
            
            
            } 
         
         
		// **************************************************
		//  Process form values to feed db fields properly
		// **************************************************         
         
         // covering housenumber and street combination. Converting "housenumber, street" to "street, housenumber"
         $get_SenderStreet1 = strtoupper(ReadUrl("SenderStreet1","Y"));
         
         If ( is_numeric(substr($get_SenderStreet1,0,1)) AND strpos($get_SenderStreet1,",") ) {
         
                $get_SenderStreet = explode(",",ReadUrl("SenderStreet1","Y"));
                $get_SenderStreet1 = $get_SenderStreet[2]." ".$get_SenderStreet[1]." ".$get_SenderStreet[0];
         }
         
         // splitting field of senders town & postcode into two fields 
         list($get_SenderTown,$get_SenderPostcode) = explode(",",ReadUrl("SenderTown","Y"));
         
         // splitting field of receiers street into receiver name & street fields
         $get_ReceiverStreet = explode(",",ReadUrl("ReceiverStreet1","Y"),2) ;
         If (ReadUrl("ReceiverStreet1","Y") <> "") {
           $get_ReceiverName = $get_ReceiverStreet[0];
           $get_ReceiverStreet1 = $get_ReceiverStreet[1];
         } else {
           $get_ReceiverName = "";
           $get_ReceiverStreet1 = "";         
         }
         
         // define shipment description for documents
         $get_ShipmentDescription = (ReadUrl("ShipmentType","Y")=="D" ? "Documents" : ReadUrl("ShipmentDescription","Y")); 
         
         // based on payment terms do logic with sender and receiver account
         If (ReadUrl("PaymentTerms","Y")== "S") {
             $get_SenderAccount = floatval(ReadUrl("AccountNumber","Y"));
             $get_ReceiverAccount = "";             
         } ElseIf (ReadUrl("PaymentTerms","Y")== "R") { 
             $get_SenderAccount = floatval(ReadUrl("SenderAccount","Y"));
             //$get_SenderAccount = "0";
             $get_ReceiverAccount = floatval(ReadUrl("AccountNumber","Y"));           
         }
           
         // Sum total items either with multiple lines pieces or total
         If (ReadUrl("Items[0]","Y")<> "") {
             $get_TotalItems = ReadUrl("Items[0]","Y") + ReadUrl("Items[1]","Y") + ReadUrl("Items[2]","Y") + ReadUrl("Items[3]","Y") + ReadUrl("Items[4]","Y");
         } Else {
             $get_TotalItems = ReadUrl("TotalItems","Y");           
         }  

         // Sum total weight either with multiple lines pieces or total
         If (ReadUrl("TotalSubWeight","Y")<> "") { 
             (ReadUrl("TotalWeight","Y")== "" ? $get_TotalWeight = "0" : $get_TotalWeight = ReadUrl("TotalWeight","Y"));
             $get_TotalWeight = $get_TotalWeight.".".ReadUrl("TotalSubWeight","Y");
         } else {
             $get_TotalWeight = number_format(round(ReadUrl("TotalWeight","Y"),2),2,".","");           
         }

         // Process non docs shipment based on total dims & weight or multiple line
         If (ReadUrl("ShipmentType","Y") == "N" ) { 
             (ReadUrl("TotalItems","Y")<> "" ? $get_TotalPackageType = "BOX" : $get_TotalPackageType = "");
             (ReadUrl("Items_0","Y")<> "" ? $get_PackageType_0 = "BOX" : $get_PackageType_0 = "");
             (ReadUrl("Items_0","Y")<> "" ? $get_Weight_0 = number_format(round((ReadUrl("TotalWeight","Y") / $get_TotalItems),2),2,".","")  : $get_Weight_0 = "");
             (ReadUrl("Items_1","Y")<> "" ? $get_PackageType_1 = "BOX" : $get_PackageType_1 = "");
             (ReadUrl("Items_1","Y")<> "" ? $get_Weight_1 = number_format(round((ReadUrl("TotalWeight","Y") / $get_TotalItems),2),2,".","")  : $get_Weight_1 = "");
             (ReadUrl("Items_2","Y")<> "" ? $get_PackageType_2 = "BOX" : $get_PackageType_2 = "");
             (ReadUrl("Items_2","Y")<> "" ? $get_Weight_2 = number_format(round((ReadUrl("TotalWeight","Y") / $get_TotalItems),2),2,".","")  : $get_Weight_2 = "");
             (ReadUrl("Items_3","Y")<> "" ? $get_PackageType_3 = "BOX" : $get_PackageType_3 = "");
             (ReadUrl("Items_3","Y")<> "" ? $get_Weight_3 = number_format(round((ReadUrl("TotalWeight","Y") / $get_TotalItems),2),2,".","")  : $get_Weight_3 = "");
             (ReadUrl("Items_4","Y")<> "" ? $get_PackageType_4 = "BOX" : $get_PackageType_4 = "");
             (ReadUrl("Items_4","Y")<> "" ? $get_Weight_4 = number_format(round((ReadUrl("TotalWeight","Y") / $get_TotalItems),2),2,".","")  : $get_Weight_4 = "");
          }            
                
         // Set customs processing field based on country
         If (in_array(ReadUrl("ReceiverCountry","Y"), $cfg_csfl_eu) OR ReadUrl("ShipmentType","Y") == "D") {
             $get_CustomsControl = "0";
         } else {
             $get_CustomsControl = "1";         
         }  

        If (ReadUrl("InsuranceValue","Y") <> "") {
             $get_InsuranceValue = ReadUrl("InsuranceValue","Y");
             $get_InsuranceValue = str_replace(",",".",ReadUrl("InsuranceValue","Y"));
             $get_ShipmentValue = $get_InsuranceValue;
        } else {
             $get_ShipmentValue = "";
             $get_InsuranceValue = "";
        }

        If (ReadUrl("InsuranceCurrency","Y") <> "") {
             $get_ShipmentCurrency = ReadUrl("InsuranceCurrency","Y");
        } else {
             $get_ShipmentCurrency = "";
        }


         // Set date format with . if used / for DD/MM/YY
         $get_CollectionDate = ReadUrl("CollectionDate","Y");

         If (strpos($get_CollectionDate,"/")) {
            $get_CollectionDate = str_replace("/",".",$get_CollectionDate);
            
              If (substr($get_CollectionDate,-4,2) <> "20") {
                $get_CollectionDate = substr($get_CollectionDate,0,-2)."20".substr($get_CollectionDate,strlen($get_CollectionDate)-2);
              }
              
         }

         $get_ExpectedDeliveryDate = ReadUrl("ExpectedDeliveryDate","Y");         

         If (strpos($get_ExpectedDeliveryDate,"/")) {
            $get_ExpectedDeliveryDate = str_replace("/",".",$get_ExpectedDeliveryDate);
            
            If (substr($get_ExpectedDeliveryDate,-4,2) <> "20") {
              $get_ExpectedDeliveryDate = substr($get_ExpectedDeliveryDate,0,-2)."20".substr($get_ExpectedDeliveryDate,strlen($get_ExpectedDeliveryDate)-2);         
            }
         }

        If (ReadUrl("CashOnDeliveryValue","Y") <> "") {
             $get_CashOnDeliveryValue = ReadUrl("CashOnDeliveryValue","Y");
             $get_CashOnDeliveryValue = str_replace(",",".",$get_CashOnDeliveryValue);
             $get_DeliveryInstruction = "COD ".$get_CashOnDeliveryValue." ".ReadUrl("CashOnDeliveryCurrency","") ;
        } else {
             $get_DeliveryInstruction = "";
             $get_CashOnDeliveryValue = "";
        }
        
        
        If (ReadUrl("CashCollectionValue","Y") <> "") {
             $get_CashCollectionValue = ReadUrl("CashCollectionValue","Y");
             $get_CashCollectionValue = str_replace(",",".",$get_CashCollectionValue);
        } else {
             $get_CashCollectionValue = "";
        }

         $sql  =   "

                     UserName                  = '".strtoupper(ReadUrl("UserName","Y"))."',
                     
                     BookingNumber             = '".strtoupper(ReadUrl("CC_CRN","Y"))."',
                     
                     ConsignmentNumber         = '',

                     PaymentTerms              = '".ReadUrl("PaymentTerms","Y")."',

                     SenderAccount             = '".trim($get_SenderAccount)."',

                     SenderName                = '".strtoupper(ReadUrl("SenderName","Y"))."',

                     SenderStreet1             = '".trim($get_SenderStreet1)."',

                     SenderPostcode            = '".trim($get_SenderPostcode)."',

                     SenderTown                = '".strtoupper(trim($get_SenderTown))."',

                     SenderCountry             = '".ReadUrl("SenderCountry","Y")."',

                     SenderContact             = '".strtoupper(trim(ReadUrl("SenderContact","Y")))."',

                     SenderPhone               = '".ReadUrl("SenderPhone1","Y")." ".ReadUrl("SenderPhone2","Y")." ".ReadUrl("SenderExtension","Y")."',

                     SenderEmail               = '".trim(ReadUrl("CC_email","Y"))."',

                     ReceiverAccount           = '".trim($get_ReceiverAccount)."',

                     ReceiverName              = '".trim($get_ReceiverName)."', 	 

                     ReceiverStreet1           = '".trim($get_ReceiverStreet1)."', 	 

                     ReceiverStreet2           = '',

                     ReceiverStreet3           = '',

                     ReceiverPostcode          = '".ReadUrl("ReceiverPostcode","Y")."',

                     ReceiverTown              = '".strtoupper(ReadUrl("ReceiverTown","Y"))."',

                     ReceiverCountry           = '".ReadUrl("ReceiverCountry","Y")."',

                     ReceiverContact           = '',

                     ReceiverPhone             = '',

                     CustomsControl            = '".trim($get_CustomsControl)."',

                     ShipmentType              = '".ReadUrl("ShipmentType","Y")."',
                     
                     ShipmentValue             = '".trim($get_ShipmentValue)."',

                     ShipmentCurrency          = '".trim($get_ShipmentCurrency)."',                     

                     ShipmentDescription       = '".trim($get_ShipmentDescription)."',

                     PackageType_0             = '".trim($get_PackageType_0)."',

                     Items_0                   = '".ReadUrl("Items_0","Y")."',

                     Weight_0                  = '".trim($get_Weight_0)."',

                     Length_0                  = '".ReadUrl("Length_0","Y")."',

                     Width_0                   = '".ReadUrl("Width_0","Y")."',

                     Height_0                  = '".ReadUrl("Height_0","Y")."',

                     PackageType_1             = '".trim($get_PackageType_1)."',

                     Items_1                   = '".ReadUrl("Items_1","Y")."',

                     Weight_1                  = '".trim($get_Weight_1)."',

                     Length_1                  = '".ReadUrl("Length_1","Y")."',

                     Width_1                   = '".ReadUrl("Width_1","Y")."',

                     Height_1                  = '".ReadUrl("Height_1","Y")."',

                     PackageType_2             = '".trim($get_PackageType_2)."',

                     Items_2                   = '".ReadUrl("Items_2","Y")."',

                     Weight_2                  = '".trim($get_Weight_2)."',

                     Length_2                  = '".ReadUrl("Length_2","Y")."',

                     Width_2                   = '".ReadUrl("Width_2","Y")."',

                     Height_2                  = '".ReadUrl("Height_2","Y")."',

                     PackageType_3             = '".trim($get_PackageType_3)."',

                     Items_3                   = '".ReadUrl("Items_3","Y")."',

                     Weight_3                  = '".trim($get_Weight_3)."',

                     Length_3                  = '".ReadUrl("Length_3","Y")."',

                     Width_3                   = '".ReadUrl("Width_3","Y")."',

                     Height_3                  = '".ReadUrl("Height_3","Y")."',

                     PackageType_4             = '".trim($get_PackageType_4)."',

                     Items_4                   = '".ReadUrl("Items_4","Y")."',

                     Weight_4                  = '".trim($get_Weight_4)."',

                     Length_4                  = '".ReadUrl("Length_4","Y")."',

                     Width_4                   = '".ReadUrl("Width_4","Y")."',

                     Height_4                  = '".ReadUrl("Height_4","Y")."',

                     TotalPackageType          = '".trim($get_TotalPackageType)."',
                                                                                                    
                     TotalItems                = '".trim($get_TotalItems)."',

                     TotalWeight               = '".trim($get_TotalWeight)."',

                     TotalLength               = '".ReadUrl("TotalLength","Y")."',

                     TotalWidth                = '".ReadUrl("TotalWidth","Y")."',

                     TotalHeight               = '".ReadUrl("TotalHeight","Y")."',

                     DGIndicator               = '".ReadUrl("DGIndicator","Y")."',

                     DGOption                  = '".ReadUrl("DGOption","Y")."',

                     DGUNNumber                = '".ReadUrl("DGUNNumber","Y")."',

                     Service                   = '".ReadUrl("Service","Y")."',

                     ServiceOption_0           = '".ReadUrl("ServiceOption_0","Y")."',

                     ServiceOption_1           = '".ReadUrl("ServiceOption_1","Y")."',

                     ServiceOption_2           = '".ReadUrl("ServiceOption_2","Y")."',

                     ServiceOption_3           = '".ReadUrl("ServiceOption_3","Y")."',

                     ServiceOption_4           = '".ReadUrl("ServiceOption_4","Y")."',

                     ServiceOption_5           = '".ReadUrl("ServiceOption_5","Y")."',

                     InsuranceValue            = '".trim($get_InsuranceValue)."',

                     InsuranceCurrency         = '".ReadUrl("InsuranceCurrency","Y")."',

                     CashCollectionValue       = '".trim($get_CashCollectionValue)."',

                     CashCollectionCurrency    = '".ReadUrl("CashCollectionCurrency","Y")."',

                     CashOnDeliveryValue       = '".trim($get_CashOnDeliveryValue)."',

                     CashOnDeliveryCurrency    = '".ReadUrl("CashOnDeliveryCurrency","Y")."',

                     ExpectedDeliveryDate      = '".trim($get_ExpectedDeliveryDate)."',

                     CollectionDate            = '".trim($get_CollectionDate)."',

                     CollectionTimeFrom        = '".ReadUrl("CollectionTimeFrom","Y")."',

                     CollectionTimeTo          = '".ReadUrl("CollectionTimeTo","Y")."',

                     UnavailableFrom           = '".ReadUrl("UnavailableFrom","Y")."',

                     UnavailableTo             = '".ReadUrl("UnavailableTo","Y")."',

                     CollectionInstructions    = '".ReadUrl("CollectionInstructions","Y")."', 

                     DeliveryInstruction       = '".trim($get_DeliveryInstruction)."',

                     CustomerReference         = '',

                     TandC                     = '0',

                     FlagPrinted               = '0',
                     
                     FlagDataSent              = '0'
                                          
                   ";

        

        

        $sql  =   "INSERT INTO cc_".$cfg_Sender_Country_Code."_dat_shipments SET ".

                  $sql;

        

       //echo $sql; 
       //die();
        

        mysqli_query($DB_Connection,$sql);


        If ($cfg_csfl_email_personal == "Y") {
        
              $sql = "SELECT a.Email
    															FROM cc_".$cfg_Sender_Country_Code."_cfg_cscontact AS a
                                  WHERE UCASE(a.UserName) = '".strtoupper(ReadUrl("UserName","Y"))."'
                                  ";          

              $sql_select = mysqli_query($DB_Connection,$sql);  

              if (mysqli_num_rows($sql_select) > 0) {
                $row = mysqli_fetch_array($sql_select);
                $cfg_csfl_email = "TNT <".$row[0].">";
                $cfg_csfl_email_bounce = $row[0];
              }        
        
        }
      

              

        

		// **************************************************
		//  Logout if database exists
		// **************************************************

    

      mysqli_close($DB_Connection);
              
		// **************************************************
 		//  Redirect to clients frontpage
 		// **************************************************


            If (ReadUrl("CC_email","Y") <> "") {
            
            function send_email($to='', $from='', $subject='', $html_content='', $text_content='', $headers='', $bounce='') { 
            	# Setup mime boundary
            	$mime_boundary = "Multipart_Boundary_x".md5(time())."x";
            
            	$headers  = "MIME-Version: 1.0 \n";
            	$headers .= "Content-Type: multipart/alternative; boundary=".$mime_boundary." \n";
            	$headers .= "Content-Transfer-Encoding: 7bit \n";
            
            	$body	 = "This is a multi-part message in mime format.\n\n";
            
            	# Add in plain text version
            	$body	.= "--".$mime_boundary."\n";
            	$body	.= "Content-Type: text/plain; charset=\"UTF-8\"\n";
            	$body	.= "Content-Transfer-Encoding: 7bit\n\n";
            	$body	.= $text_content;
            	$body	.= "\n\n";
            
            	# Add in HTML version
            	$body	.= "--".$mime_boundary."\n";
            	$body	.= "Content-Type: text/html; charset=\"UTF-8\"\n";
            	$body	.= "Content-Transfer-Encoding: 7bit\n\n";
            	$body	.= $html_content;
            	$body	.= "\n\n";
            
            	# Attachments would go here
            	# But this whole email thing should be turned into a class to more logically handle attachments, 
            	# this function is fine for just dealing with html and text content.
            
            	# End email
            	$body	.= "--".$mime_boundary."--\n"; # <-- Notice trailing --, required to close email body for mime's
            
            	# Finish off headers
            	$headers .= "From: ".$from."  \n";
            	$headers .= "Date: ".date('D, j M Y H:i:s O')." \n";
              $headers .= "Reply-To: " . $from . " \n";
              $headers .= "Message-ID: <".sha1(microtime())."@tnt.com"."> \n";
            
            	# Mail it out
            	return mail($to, $subject, $body, $headers,"-f".$bounce);
              //return mail($to, $subject, $body, $headers);
            }

                    $messagehtml = $cfg_csfl_message[0];
                    $messagehtml .= "<br>";
                    $messagehtml .= $cfg_csfl_message[1];               
                    $messagehtml .= "<br>";
                    $messagehtml .= "<br>";
                    $messagehtml .= "<a href='".$cfg_csfl_message[2]."/?lang=1&crn=".ReadUrl("CC_CRN","")."&senderaccount=".$get_SenderAccount."'>".$cfg_csfl_message[2]."/?lang=1&crn=".ReadUrl("CC_CRN","")."&senderaccount=".$get_SenderAccount."</a>";
                    $messagehtml .= "<br>";
                    $messagehtml .= "<br>";
                    $messagehtml .= $cfg_csfl_message[3];
                    $messagehtml .= "<br>";
                    $messagehtml .= $cfg_csfl_message[4].": ".ReadUrl("CC_CRN","");
                    $messagehtml .= "<br>";
                    $messagehtml .= $cfg_csfl_message[5].": ".$get_SenderAccount;
                    $messagehtml .= "<br>";
                    $messagehtml .= "<br>";
                    $messagehtml .= $cfg_csfl_message[6];
                    $messagehtml .= "<br>";
                    $messagehtml .= "<br>";
                    $messagehtml .= $cfg_csfl_message[7];
                    $messagehtml .= "<br>";
                    $messagehtml .= $cfg_csfl_message[8].$cfg_csfl_email_bounce;
                    $messagehtml .= "<br>";
                    $messagehtml .= $cfg_csfl_message[9];
                    $messagehtml .= "<br>";
                    $messagehtml .= $cfg_csfl_message[10];
                    $messagehtml .= "<br>";
                    $messagehtml .= $cfg_csfl_message[11];
                    $messagehtml .= "<br>";
                    $messagehtml .= "<a href='".$cfg_csfl_message[12]."'>".$cfg_csfl_message[12]."</a>";
                    $messagehtml .= "<br>";
                    $messagehtml .= $cfg_csfl_message[13];
                    
                   
                    $messagetext = $cfg_csfl_message[0];
                    $messagetext .= "\r\n";
                    $messagetext .= $cfg_csfl_message[1];               
                    $messagetext .= "\r\n";
                    $messagetext .= "\r\n";
                    $messagetext .= $cfg_csfl_message[2]."/?lang=1&crn=".ReadUrl("CC_CRN","")."&senderaccount=".$get_SenderAccount;
                    $messagetext .= "\r\n";
                    $messagetext .= "\r\n";
                    $messagetext .= $cfg_csfl_message[3];
                    $messagetext .= "\r\n";
                    $messagetext .= $cfg_csfl_message[4].": ".ReadUrl("CC_CRN","");
                    $messagetext .= "\r\n";
                    $messagetext .= $cfg_csfl_message[5].": ".$get_SenderAccount;
                    $messagetext .= "\r\n";
                    $messagetext .= "\r\n";
                    $messagetext .= $cfg_csfl_message[6];
                    $messagetext .= "\r\n";
                    $messagetext .= "\r\n";
                    $messagetext .= $cfg_csfl_message[7];
                    $messagetext .= "\r\n";
                    $messagetext .= $cfg_csfl_message[8].$cfg_csfl_email_bounce;
                    $messagetext .= "\r\n";
                    $messagetext .= $cfg_csfl_message[9];
                    $messagetext .= "\r\n";
                    $messagetext .= $cfg_csfl_message[10];
                    $messagetext .= "\r\n";
                    $messagetext .= $cfg_csfl_message[11];
                    $messagetext .= "\r\n";
                    $messagetext .= $cfg_csfl_message[12];
                    $messagetext .= "\r\n";
                    $messagetext .= $cfg_csfl_message[13];
                                  

                send_email(ReadUrl("CC_email","Y"),$cfg_csfl_email,$cfg_csfl_subject.ReadUrl("CC_CRN",""),$messagehtml,$messagetext,"",$cfg_csfl_email_bounce);                
             }

      header("Location: ".$cfg_cc_SubDomain_Name."/?lang=1&crn=".ReadUrl("CC_CRN","")."&senderaccount=".$get_SenderAccount);

      die();



?>