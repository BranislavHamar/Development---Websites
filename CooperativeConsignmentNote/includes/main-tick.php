<?
// SUMMARY
// A. LIST WHAT WORDS TO SHOW ON PAGE
// B. Definition of function to lock input fields
// C. CONTENT
          // 1. CHECK MANDATORY FIELDS IF NOT EMPTY
          // 2. IF CRN DATA ARE OPEN TO EDIT UPDATE CERTAIN FIELDS OF CRN
          // 3. FLAG "PRINTED" SPECIFIC CRN DATA BEFORE PRINTING
          // 4. FORWARD TO EMAIL FUNCTIONALITY
          // 5. LOAD SPECIFIC CRN DATA
          // 6. HTML CONTENT OF CRN DATA
            // a. HTML CONTENT OF ERROR MESSAGE
// D. DOCUMENTS
          // 1. LOAD SPECIFIC CRN DATA
          // 2. HTML CONTENT OF CRN DATA
            // a. ADDRESS LABEL
            // b. CONNOTE (for NON EU shipments)
            // c. MANIFEST


//************************************	
// A. LIST WHAT WORDS TO SHOW ON PAGE
//************************************

$word = word("all");


//************************************************	
// B. Definition of function to lock input fields
//************************************************

function lock($i) {

    If ($i=="1" ) {
    
      $lock = " readonly class='readonly' ";
    
    } else {
    
      $lock = " ";
    
    }

    return $lock;
}
    
//********************************	
// C. CONTENT
//********************************

function content_web() 	{

		global $crn, $senderaccount, $word, $lock, $flagprinted, $checkvalidate, $lang, $emailnotification, $rowid, $flagmarketing;
		global $TotalItems, $TotalWeight, $TotalVolume;
		global $cfg_Sender_Country_Code, $cfg_links_Top, $cfg_links_Bottom, $DB_connection, $cfg_con_source_PDF, $cfg_Sender_Country_Code_big;
    global $cfg_con_option_names, $cfg_con_subject, $cfg_con_email, $cfg_con_email_bounce, $cfg_con_email_personal, $cfg_con_message, $cfg_con_mkt_detailedmanifest_media, $cfg_con_mkt_detailedmanifest_start, $cfg_con_mkt_detailedmanifest_end;
    
          //*****************************************	
          // CHECK MANDATORY FIELDS IF NOT EMPTY
          //*****************************************

              $checkvalidate = "";

          If ($flagprinted=="0") {

              If (ReadParamValue("RECEIVER_COMPANY_NAME","","0")=="") {
                    $checkvalidate .= "<li>".$word['9102'].": ".$word['9103']."</li>";
              } 
    
              If (ReadParamValue("RECEIVER_ADDRESS_1","","0")=="") {
                    $checkvalidate .= "<li>".$word['9102'].": ".$word['9104']."</li>";
              } 

              If (ReadParamValue("RECEIVER_CONTACT_NAME","","0")=="") {
                    $checkvalidate .= "<li>".$word['9102'].": ".$word['9108']."</li>";
              } 

              If (ReadParamValue("RECEIVER_CONTACT_PHONE","","0")=="") {
                    $checkvalidate .= "<li>".$word['9102'].": ".$word['9109']."</li>";
              } 

    
              If (ReadParamValue("CustomsControl","","0")=="1" AND ReadParamValue("SHIPMENTTYPE","","0")=="N" AND ReadParamValue("SHIPMENT_VALUE","","0")=="" ) {
                    $checkvalidate .= "<li>".$word['9206']."</li>";
              } 
           
              If (ReadParamValue("CustomsControl","","0")=="1" AND ReadParamValue("SHIPMENTTYPE","","0")=="N" AND ReadParamValue("SHIPMENT_CURRENCY","","0")=="" ) {
                    $checkvalidate .= "<li>".$word['9206']."</li>";
              } 

              If (ReadParamValue("ShipmentDescription","","0")=="" AND ReadParamValue("SHIPMENTTYPE","","0")=="N") {
                    $checkvalidate .= "<li>".$word['9207']."</li>";
              }           

              If (ReadParamValue("termsAndConditions","","0")=="") {
                    $checkvalidate .= "<li>".$word['10003']."</li>";
              } 
         
          
          }
          
            

          //***********************************************************	
          // IF CRN DATA ARE OPEN TO EDIT UPDATE CERTAIN FIELDS OF CRN
          //***********************************************************


              If ($flagprinted=="0") {
                        
                        
                        $flagmarketing = ReadParamValue("Marketing","","0");
                        If ($flagmarketing == "") {$flagmarketing = "2";}
                        
                        $sql = mysqli_query($DB_connection,"UPDATE cc_".$cfg_Sender_Country_Code."_dat_shipments AS a
                                            SET a.SenderStreet2           = '".ReadParamValue("SENDER_ADDRESS_2","","0")."',
                                                a.SenderStreet3           = '".ReadParamValue("SENDER_ADDRESS_3","","0")."',
                                                a.ReceiverName            = '".ReadParamValue("RECEIVER_COMPANY_NAME","","0")."',
                                                a.ReceiverStreet1         = '".ReadParamValue("RECEIVER_ADDRESS_1","","0")."',
                                                a.ReceiverStreet2         = '".ReadParamValue("RECEIVER_ADDRESS_2","","0")."',
                                                a.ReceiverStreet3         = '".ReadParamValue("RECEIVER_ADDRESS_3","","0")."',
                                                a.ReceiverContact         = '".ReadParamValue("RECEIVER_CONTACT_NAME","","0")."',
                                                a.ReceiverPhone           = '".ReadParamValue("RECEIVER_CONTACT_PHONE","","0")."', 
                                                a.ShipmentDescription     = '".ReadParamValue("ShipmentDescription","","0")."',
                                                a.ShipmentValue           = '".ReadParamValue("SHIPMENT_VALUE","","1")."',
                                                a.ShipmentCurrency        = '".ReadParamValue("SHIPMENT_CURRENCY","","0")."',
                                                a.CustomerReference       = '".ReadParamValue("CUSTOMER_REFERENCE","","0")."',
                                                a.TandC                   = '".ReadParamValue("termsAndConditions","","0")."',
                                                a.FlagMarketing           = '".$flagmarketing."',
                                                a.DeliveryInstruction     = '".ReadParamValue("DELIVERY_INSTRUCTION","","0")."',
                                                a.PackageType_0           = '".ReadParamValue("PackageType_0","","0")."',
                                                a.PackageType_1           = '".ReadParamValue("PackageType_1","","0")."',
                                                a.PackageType_2           = '".ReadParamValue("PackageType_2","","0")."',
                                                a.PackageType_3           = '".ReadParamValue("PackageType_3","","0")."',
                                                a.PackageType_4           = '".ReadParamValue("PackageType_4","","0")."',
                                                a.TotalPackageType        = '".ReadParamValue("TotalPackageType","","0")."'                                                                                                                  
                                            WHERE a.BookingNumber  = '".$crn."' AND a.SenderAccount = '".$senderaccount."' AND a.id = '".ReadParamValue("rowid","","0")."'" );
              }

                                               
          //****************************************************************************	
          // FLAG "PRINTED" & GENERATE CON NUMBER FOR SPECIFIC CRN DATA BEFORE PRINTING
          //****************************************************************************

              If ($flagprinted=="0" AND $checkvalidate=="") {
                        

                   $sql = mysqli_multi_query($DB_connection,"
                                SET @Con=(SELECT LEFT(lastused,8) FROM cc_".$cfg_Sender_Country_Code."_cfg_conrange ORDER BY id DESC LIMIT 1)+1;
                                SET @ConArray= Mid(@Con,1,1)*8 + Mid(@Con,2,1)*6 + Mid(@Con,3,1)*4 + Mid(@Con,4,1)*2 + Mid(@Con,5,1)*3 + Mid(@Con,6,1)*5 + Mid(@Con,7,1)*9 + Mid(@Con,8,1)*7;
                                SET @Modulus=@ConArray Mod 11;
                                SET @CheckDigit=123;
                                
                                SELECT CASE 
                                WHEN @Modulus=0 THEN 5
                                WHEN @Modulus=1 THEN 0
                                WHEN @Modulus>1 THEN 11-@Modulus
                                END
                                INTO @CheckDigit;
                                
                                SET @FinalCon = CONCAT(@Con,@CheckDigit);
                                SET @Id = (SELECT id FROM cc_".$cfg_Sender_Country_Code."_cfg_conrange ORDER BY id DESC LIMIT 1);
                                
                                UPDATE cc_".$cfg_Sender_Country_Code."_cfg_conrange SET lastused=@FinalCon WHERE id= @Id;
                                
                                UPDATE cc_".$cfg_Sender_Country_Code."_dat_shipments SET FlagPrinted = '1', ConsignmentNumber=@FinalCon WHERE BookingNumber= '".$crn."' AND SenderAccount = '".$senderaccount."' AND id = '".ReadParamValue("rowid","","0")."';
                                

                              ") or die ("Error: ".mysqli_error($DB_connection));

                              //mysqli_store_result($DB_connection) or die ("Error: ".mysqli_error($DB_connection));
                              //mysqli_free_result($sql) or die ("Error: ".mysqli_error($DB_connection));
                              //mysqli_next_result($DB_connection) or die ("Error: ".mysqli_error($DB_connection));
                              
                              while (mysqli_next_result($DB_connection)) {
                                  if (!mysqli_more_results($DB_connection)) break;
                              }
                        
                        //mysqli_query($sql);
              
              $emailnotification = 1;
              
              }


          //********************************	
          // FORWARD TO EMAIL FUNCTIONALITY
          //********************************

            //If (isset($_POST["email"]) AND $checkvalidate=="") {
            
            // header("Location: email.php?lang=".$lang."&crn=".$crn."&senderaccount=".$senderaccount);
            
            //}

          //********************************	
          // LOAD SPECIFIC CRN DATA
          //********************************
          
          ($rowid <> "" ? $sql = "AND a.id='".$rowid."'" : $sql="" ); 
          
          $sql = "SELECT a.*, c.Name, c.Telephone, c.Email
															FROM cc_".$cfg_Sender_Country_Code."_dat_shipments AS a
                              LEFT JOIN cc_".$cfg_Sender_Country_Code."_cfg_cscontact AS c
                              ON a.UserName = c.UserName  
                              WHERE a.BookingNumber = '".$crn."' AND a.SenderAccount = '".$senderaccount."' ".$sql."
                              ORDER BY a.id DESC";          

          $sql_select = mysqli_query($DB_connection,$sql);  
                                
          //echo mysqli_num_rows($sql_select) or die("SQL: ".$sql."<br>".mysqli_error($DB_connection));
          
          if (mysqli_num_rows($sql_select) > 0) {
            $row = mysqli_fetch_array($sql_select);
          } else {
            header("Location: index.php");
            exit();
          }

          //********************************	
          // HTML CONTENT OF CRN DATA
          //********************************
					
          $content_web = "
          <div id='topic'> 
            <h1>".$word['7000']."</h1>
          </div>
            <div id='collection'>
              <h2>".$word['7100']."</h2>
              <table>
                <tr><td class='label'><strong>".$word['7101'].":</strong></td><td>".$row['BookingNumber']." <input name='crn' type='hidden' value='".$row['BookingNumber']."'><input name='rowid' type='hidden' value='".$row['id']."'></td><td class='label'>".$word['7103'].":</td><td>".$row['Name']."</td></tr>
                <tr><td class='label'>".$word['7102'].":</td><td>".$row['ConsignmentNumber']."</td><td class='label'>".$word['7104'].":</td><td>".$row['Telephone']."</td></tr>
                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                <tr><td class='label'>".$word['7105'].":</td><td><input size='40' style='width:270px;' type='text' name='COLLECTION_DATE' value='".$row['CollectionDate']."' readonly class='readonly'></td><td class='label'>".$word['7107'].":</td><td><input size='16' style='width:130px;'  type='text' name='TIME_FROM' value='".$row['CollectionTimeFrom']."' readonly class='readonly'> - <input  size='16' style='width:130px;'  type='text' name='TIME_TO' value='".$row['CollectionTimeTo']."' readonly class='readonly'></td></tr>
                <tr><td class='label'>".$word['7106'].":</td><td><input size='40' style='width:270px;' type='text' name='COLLECTION_INSTRUCTION' value='".$row['CollectionInstructions']."' readonly class='readonly'></td><td class='label'>".$word['7108'].":</td><td><input size='16' style='width:130px;' type='text' name='UNAVAILABLE_FROM' value='".$row['UnavailableFrom']."' readonly class='readonly'> - <input size='16' style='width:130px;' type='text' name='UNAVAILABLE_TO' value='".$row['UnavailableTo']."' readonly class='readonly'></td></tr>
              </table>          
           </div>";

          //********************************	
          // HTML CONTENT OF ERROR MESSAGE
          //********************************
          
          If ( (isset($_POST["finish"]) OR isset($_POST["email"])) AND $checkvalidate<>"") {

                    $content_web .= "<div id='error'>&nbsp;&nbsp;&nbsp;".$word['10008']."";
                    $content_web .= "<ul>".$checkvalidate."</ul></div>";

          }
           
          $content_web .= "
        <div id='topic'> 
          <h1>".$word['9000']."</h1>
        </div>
          <div id='address'>
            <h2>".$word['9100']."</h2>
            <table>
              <tr><th style='text-align: left;' colspan='2'>".mb_strtoupper($word['9101'], 'UTF-8')." / ".mb_strtoupper($word['9110'], 'UTF-8')."</th>                                                                                                                                                                                            <th  style='text-align: left;' colspan='2'>".mb_strtoupper($word['9102'], 'UTF-8')." / ".mb_strtoupper($word['9111'], 'UTF-8')."</th></tr>
              <tr><td class='label'>".$word['9103'].":</td><td><input  style='width:270px;' size='40' type='text' name='SENDER_COMPANY_NAME' value='".htmlspecialchars($row['SenderName'],ENT_QUOTES)."' readonly class='readonly'></td>                                                                                       <td class='label-mandatory'>".$word['9103']." *:</td><td><input  size='40' maxlength='50'  style='width:270px;'  type='text' name='RECEIVER_COMPANY_NAME' value='".$row['ReceiverName']."' ".lock($row['FlagPrinted'])."></td></tr>
              <tr><td class='label'>".$word['9104'].":</td><td><input  style='width:270px;' size='40' type='text' name='SENDER_ADDRESS_1' value='".htmlspecialchars($row['SenderStreet1'],ENT_QUOTES)."' readonly class='readonly'></td>                                                                                                   <td class='label-mandatory'>".$word['9104']." *:</td><td><input  size='40' maxlength='30'  style='width:270px;'  type='text' name='RECEIVER_ADDRESS_1' value='".$row['ReceiverStreet1']."' ".lock($row['FlagPrinted'])."></td></tr>
              <tr><td class='label'>&nbsp;</td><td><input ".lock($row['FlagPrinted'])."  size='40' maxlength='30' style='width:270px;'   type='text' name='SENDER_ADDRESS_2' value='".$row['SenderStreet2']."'></td>                                                                                                                <td class='label'>&nbsp;</td><td><input  size='40' maxlength='30' style='width:270px;' type='text' name='RECEIVER_ADDRESS_2' value='".$row['ReceiverStreet2']."' ".lock($row['FlagPrinted'])."></td></tr>
              <tr><td class='label'>&nbsp;</td><td><input ".lock($row['FlagPrinted'])."  size='40' maxlength='30' style='width:270px;'   type='text' name='SENDER_ADDRESS_3' value='".$row['SenderStreet3']."'></td>                                                                                                                <td class='label'>&nbsp;</td><td><input  size='40' maxlength='30' style='width:270px;' type='text' name='RECEIVER_ADDRESS_3' value='".$row['ReceiverStreet3']."' ".lock($row['FlagPrinted'])."></tr>
              <tr><td class='label'>".$word['9105']." / ".$word['9106'].":</td><td><input style='width:80px;'  type='text' name='SENDER_POSTCODE' value='".$row['SenderPostcode']."' readonly class='readonly'> / <input  style='width:167px;'  type='text' name='SENDER_TOWN' value='".htmlspecialchars($row['SenderTown'],ENT_QUOTES)."' readonly class='readonly'></td>                     <td class='label'>".$word['9105']." / ".$word['9106'].":</td><td><input style='width:80px;'  type='text' name='RECEIVER_POSTCODE' value='".$row['ReceiverPostcode']."' readonly class='readonly'> / <input style='width:167px;' type='text' name='RECEIVER_TOWN' value='".htmlspecialchars($row['ReceiverTown'],ENT_QUOTES)."' readonly class='readonly'></td>
              <tr><td class='label'>".$word['9107'].":</td><td><input  size='40' style='width:270px;'  type='text' name='SENDER_COUNTRY' value='".$row['SenderCountry']."' readonly class='readonly'></td>                                                                                                                  <td class='label'>".$word['9107'].":</td><td><input  size='40' style='width:270px;' type='text' name='RECEIVER_COUNTRY' value='".$row['ReceiverCountry']."' readonly class='readonly'>  </input></td></tr>
              <tr><td class='label'>".$word['9108'].":</td><td><input  size='40' style='width:270px;'   type='text' name='SENDER_CONTACT_NAME' value='".htmlspecialchars($row['SenderContact'],ENT_QUOTES)."' readonly class='readonly'></td>                                                                                                    <td class='label-mandatory'>".$word['9108']." *:</td><td><input  size='40' maxlength='22'  style='width:270px;' type='text' name='RECEIVER_CONTACT_NAME' value='".$row['ReceiverContact']."' ".lock($row['FlagPrinted'])."></td></tr>
              <tr><td class='label'>".$word['9109'].":</td><td><input  size='40' style='width:270px;'   type='text' name='SENDER_CONTACT_PHONE' value='".$row['SenderPhone']."' readonly class='readonly'></td>                                                                                                     <td class='label-mandatory'>".$word['9109']." *:</td><td><input  size='40' maxlength='16'  style='width:270px;' type='text' name='RECEIVER_CONTACT_PHONE' value='".$row['ReceiverPhone']."' ".lock($row['FlagPrinted'])."></td></tr>
            </table>
         </div>
         <div id='shipment'>
          <h2>".$word['9200']."</h2>
          <table>
            <tr ><td rowspan=4 class='label'>".$word['9201'].":</td><td rowspan=4  class='shipmenttype-".$row['ShipmentType']."'><div style='position:relative;top:-30px;left:10px;'><h3>".($row['ShipmentType']=='N' ? $word['9220'] : $word['9221'])."</h3></div></td><td class='label'>".$word['9202'].":</td><td><input  size='40' style='width:270px;' type='text' name='PAYMENT_TERMS' value='".( $row['PaymentTerms'] == "S" ? $word['9222'] : $word['9223'])."' readonly class='readonly'></td></tr>
            <tr><td class='label'>".$word['9203'].":</td><td><input  size='40' style='width:270px;'  type='text' name='ACCOUNT' value='".($row['PaymentTerms']=='S' ? $row['SenderAccount'] : $row['ReceiverAccount'])."' readonly class='readonly'> <input type='hidden' name='senderaccount' value='".$row['SenderAccount']."'> </td></tr>
            <tr><td class='label'>".$word['9204'].":</td><td><input  size='40' maxlength='24'  style='width:270px;'  type='text' name='CUSTOMER_REFERENCE' value='".$row['CustomerReference']."' ".lock($row['FlagPrinted'])."></td></tr>
            <tr><td class='label'>".$word['9205'].":</td><td><input  size='40' maxlength='60' style='width:270px;'  type='text' name='DELIVERY_INSTRUCTION' value='".$row['DeliveryInstruction']."' ".lock($row['FlagPrinted'])."></td></tr>
          </table>";
          switch ($row['ShipmentType'])
          {
            // DOCUMENTS VISUAL
            case "D":
              $content_web .= "
                <table  class='calc'>
                    <tr style='background-color:#F2F2F2;'><th >".$word['9211'].": </th><th >".$word['9212'].":</th><th>".$word['9213'].":</th><th>".$word['9218'].":</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th></tr>
                    <tr><td><select style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;height:25px;vertical-align:top;' ".lock($row['FlagPrinted'])."><option value='D'>".mb_strtoupper($word['9221'], 'UTF-8')."</option></select> </td><td><input type='text' name='ITEMS' value='".$row['TotalItems']."' size='5' readonly class='readonly'></td><td><input type='text' name='WEIGHT' value='".number_format(round($row['TotalWeight'],2),2,".","")."' size='5' readonly class='readonly'> kg</td><td>".number_format(round($row['TotalWeight']*$row['TotalItems'],3),3,".","")." kg</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                </table>";
              
              $TotalItems   =$row['TotalItems'];
              $TotalWeight  =number_format(round($row['TotalWeight'],2),2,".","");
              
              break;
            // NON DOCUMENTS VISUAL
            case "N":        
              $content_web .= "
                <table>
                  <tr><td ".($row['CustomsControl']=="1" ? "class='label-mandatory'" : "class='label'")." >".$word['9206']." : <input type='hidden' value='".$row['CustomsControl']."' name='CustomsControl'></td><td><input  size='20' style='width:202px;' type='text' name='SHIPMENT_VALUE' value='".$row['ShipmentValue']."' ".lock($row['FlagPrinted'])."> <select style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;height:25px;vertical-align:top;' name='SHIPMENT_CURRENCY' ".lock($row["FlagPrinted"]).">".(lock($row['ShipmentCurrency'])<>"" ? "<option value='".$row['ShipmentCurrency']."' selected>".$row['ShipmentCurrency']."</option>" : "")."<option value='EUR'>EUR</option><option value='USD'>USD</option><option value='CZK'>CZK</option><option value='HUF'>HUF</option><option value='PLN'>PLN</option><option value='RON'>RON</option><option value='LVL'>LVL</option><option value='LTL'>LTL</option><option value='RUB'>RUB</option><option value='UAH'>UAH</option></select> </td>          <td class='label-mandatory'>".$word['9207'].":</td><td><input type='text'  size='40'  maxlength='20'  style='width:270px;'  name='ShipmentDescription' value='".$row['ShipmentDescription']."' ".lock($row['FlagPrinted'])."></td></tr>".
                  ($row['DGIndicator'] == 'Y' ? "<tr><td class='label'>".$word['9208'].":</td><td><input  size='40' style='width:270px;'  type='text' name='DANGEROUS_GOODS' value='".$word['10006']."' readonly class='readonly'></td>                   <td>".$word['9209']." / ".$word['9210']." *:</td><td><input type='text'  size='27' style='width:199px;'  name='DG_TYPE' value='".$cfg_con_option_names[$row['DGOption']]."' readonly class='readonly'> / <input  size='5' style='width:60px;' type='text' name='UN_NUMBER' value='".$row['DGUNNumber']."' readonly class='readonly'></td></tr>" : "")     
                ."</table>
                <table  class='calc'>
                    <tr style='background-color:#F2F2F2;'><th >".$word['9211'].": </th><th >".$word['9212'].":</th><th>".$word['9213'].":</th><th>".$word['9214'].":</th><th>".$word['9215'].":</th><th>".$word['9216'].":</th><th>".$word['9217'].":</th><th>".$word['9218'].":</th></tr>";

                      $i            =0;
                      $TotalItems   =0;
                      $TotalVolume  =0;
                      $TotalWeight  =0;
                      
                 If ($row['Items_0']<>"") {   
                   
                 // Multiple lines per multiple items 
                   
                   while (isset($row['Items_'.$i]) AND $row['Items_'.$i]<>"" ) {
                     
                      $content_web  .= "<tr><td><select style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;height:25px;vertical-align:top;' name='PackageType_".$i."' ".lock($row["FlagPrinted"]).">".(lock($row["PackageType_".$i])<>"" ? "<option value='".$row["PackageType_".$i]."' selected>".$row["PackageType_".$i]."</option>" : "")."<option value='BOX'>BOX</option><option value='BAG'>BAG</option><option value='CARTON'>CARTON</option><option value='CRATE'>CRATE</option><option value='DRUM'>DRUM</option><option value='ENVELOPE'>ENVELOPE</option><option value='EUROPALLET'>EUROPALLET</option><option value='PALLET'>PALLET</option><option value='PIECES'>PIECES</option><option value='ROLL'>ROLL</option><option value='SATCHELS'>SATCHELS</option></select> </td><td><input type='text' name='ITEMS' value='".$row['Items_'.$i]."' size='4'  style='width:50px;' readonly class='readonly'></td><td><input type='text' name='WEIGHT' value='".number_format(round($row['Weight_'.$i],2),2,".","")."' size='4'  style='width:50px;' readonly class='readonly'> kg</td><td><input type='text' name='WIDTH' value='".$row['Length_'.$i]."' size='4'  style='width:50px;' readonly class='readonly'> cm</td><td><input type='text' name='LENGTH' value='".$row['Width_'.$i]."' size='4'  style='width:50px;' readonly class='readonly'> cm</td><td><input type='text' name='HEIGHT' value='".$row['Height_'.$i]."' size='4'  style='width:50px;' readonly class='readonly'> cm</td><td>".number_format(round($row['Width_'.$i]*$row['Length_'.$i]*$row['Height_'.$i]/1000000*$row['Items_'.$i],3),3,".","")." m3</td><td>".number_format($row['Weight_'.$i]*$row['Items_'.$i],3,".","")." kg</td></tr>";
                      $TotalItems   += $row['Items_'.$i];
                      $TotalVolume  += round($row['Width_'.$i]*$row['Length_'.$i]*$row['Height_'.$i]/1000000*$row['Items_'.$i],3);
                      $TotalWeight  += number_format($row['Weight_'.$i]*$row['Items_'.$i],3,".","");
                      $i++;
                    
                    } 
                 
                 } else {

                 // Single line with number of items
                 
                      $content_web  .= "<tr><td><select style='-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;height:25px;vertical-align:top;border : 1px #ccc solid;' name='TotalPackageType' ".lock($row['FlagPrinted']).">".(lock($row["TotalPackageType"])<>"" ? "<option value='".$row["TotalPackageType"]."' selected>".$row["TotalPackageType"]."</option>" : "")."<option value='BOX'>BOX</option><option value='BAG'>BAG</option><option value='CARTON'>CARTON</option><option value='CRATE'>CRATE</option><option value='DRUM'>DRUM</option><option value='ENVELOPE'>ENVELOPE</option><option value='EUROPALLET'>EUROPALLET</option><option value='PALLET'>PALLET</option><option value='PIECES'>PIECES</option><option value='ROLL'>ROLL</option><option value='SATCHELS'>SATCHELS</option></select> </td><td><input type='text' name='ITEMS' value='".$row['TotalItems']."' size='4'  style='width:50px;' readonly class='readonly'></td><td><input  style='width:50px;' type='text' name='WEIGHT' value='".number_format(round($row['TotalWeight']/$row['TotalItems'],2),2,".","")."' size='4'  style='width:50px;' readonly class='readonly'> kg</td><td><input type='text' name='WIDTH' value='".$row['TotalLength']."' size='4'  style='width:50px;' readonly class='readonly'> cm</td><td><input type='text' name='LENGTH' value='".$row['TotalWidth']."' size='4'  style='width:50px;' readonly class='readonly'> cm</td><td><input type='text' name='HEIGHT' value='".$row['TotalHeight']."' size='4'  style='width:50px;' readonly class='readonly'> cm</td><td>".number_format(round($row['TotalWidth']*$row['TotalLength']*$row['TotalHeight']/1000000*$row['TotalItems'],3),3,".","")." m3</td><td>".number_format($row['TotalWeight'],3,".","")." kg</td></tr>";                 
                      $TotalItems   = $row['TotalItems'];
                      $TotalVolume  = round($row['TotalWidth']*$row['TotalLength']*$row['TotalHeight']/1000000*$row['TotalItems'],3);
                      $TotalWeight  = number_format($row['TotalWeight'],3,".","");
       
                 }
                 
                    
                    $content_web .= "<tr><td>".$word['9219']."</td><td>".$TotalItems."</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>".$TotalVolume." m3</td><td>".$TotalWeight." kg</td></tr>
                </table>";
              break;
          }
                        
        $content_web .= "
        <input type='hidden' value='".$row['ShipmentType']."' name='SHIPMENTTYPE'>
        </div>
        <div id='service'>
          <h2>".$word['9300']."</h2>
         <table>
            <tr><td class='label'>".$word['9301'].":</td><td><input  size='40' style='width:270px;' type='text' name='SERVICE' value='".$row['Service']."' readonly class='readonly'></td>".( $row['ExpectedDeliveryDate'] <> "" ? "<td class='label'>".$word['9302'].":</td><td><input  size='40' style='width:270px;' type='text' name='DELIVERY_DATE' value='".$row['ExpectedDeliveryDate']."' readonly class='readonly'></td>" : "<td>&nbsp;</td><td>&nbsp;</td>" )."</tr>
            <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
            
            $ServiceOptions = array($row['ServiceOption_0'],$row['ServiceOption_1'],$row['ServiceOption_2'],$row['ServiceOption_3'],$row['ServiceOption_4'],$row['ServiceOption_5']);

                  foreach ($ServiceOptions as $key => $value) {


                            If ($value== "IN") {
                              $content_web .= "<tr><td class='label'>".$word['9303'].":</td><td><input  size='40' style='width:270px;'  type='text' name='OPTION[0]' value='".$word['10006']."' readonly class='readonly'></td><td class='label'>".$word['9304'].":</td><td><input size='30' type='text' name='INSURANCE_VALUE' value='".$row['InsuranceValue']."' readonly class='readonly'> <input size='5' type='text' name='CURRENCY' value='".$row['InsuranceCurrency']."' readonly class='readonly'></td></tr>";}
                            ElseIf ($value== "CS") {
                              $content_web .= "<tr><td class='label'>".$word['9306'].":</td><td><input  size='40' style='width:270px;'  type='text' name='OPTION[1]' value='".$word['10006']."' readonly class='readonly'></td><td class='label'>".$word['9307'].":</td><td><input size='30' type='text' name='CASH_VALUE' value='".$row['CashCollectionValue']."' readonly class='readonly'> <input size='5' type='text' name='CURRENCY' value='".$row['CashCollectionCurrency']."'  readonly class='readonly'></td></tr>";}
                            ElseIf ($value== "CO") {
                              $content_web .= "<tr><td class='label'>".$word['9308'].":</td><td><input  size='40' style='width:270px;'  type='text' name='OPTION[2]' value='".$word['10006']."' readonly class='readonly'></td><td class='label'>".$word['9309'].":</td><td><input size='30' type='text' name='CASH_ON_DELIVERY_VALUE' value='".$row['CashOnDeliveryValue']."' readonly class='readonly'> <input size='5' type='text' name='CURRENCY' value='".$row['CashOnDeliveryCurrency']."' readonly class='readonly'></td></tr>";}
                            ElseIf ($value== "SYS") {
                              $content_web .= "<tr><td class='label'>".$word['9310'].":</td><td><input  size='40' style='width:270px;'  type='text' name='OPTION[3]' value='".$word['10006']."' readonly class='readonly'></td>&nbsp;</td><td>&nbsp;</td></tr>";}                            
                            ElseIf ($value== "PR") {
                              $content_web .= "<tr><td class='label'>".$word['9311'].":</td><td><input  size='40' style='width:270px;'  type='text' name='OPTION[4]' value='".$word['10006']."' readonly class='readonly'></td>&nbsp;</td><td>&nbsp;</td></tr>";}                            
                            ElseIf ($value== "AU") {
                              $content_web .= "<tr><td class='label'>".$word['9312'].":</td><td><input  size='40' style='width:270px;'  type='text' name='OPTION[5]' value='".$word['10006']."' readonly class='readonly'></td>&nbsp;</td><td>&nbsp;</td></tr>";}                            
                            ElseIf ($value== "SA") {
                              $content_web .= "<tr><td class='label'>".$word['9313'].":</td><td><input  size='40' style='width:270px;'  type='text' name='OPTION[5]' value='".$word['10006']."' readonly class='readonly'></td>&nbsp;</td><td>&nbsp;</td></tr>";}                            
                            ElseIf ($value== "RT") {
                              $content_web .= "<tr><td class='label'>".$word['9314'].":</td><td><input  size='40' style='width:270px;'  type='text' name='OPTION[5]' value='".$word['10006']."' readonly class='readonly'></td>&nbsp;</td><td>&nbsp;</td></tr>";}                            
                            ElseIf ($value== "AH") {
                              $content_web .= "<tr><td class='label'>".$word['9315'].":</td><td><input  size='40' style='width:270px;'  type='text' name='OPTION[5]' value='".$word['10006']."' readonly class='readonly'></td>&nbsp;</td><td>&nbsp;</td></tr>";}                            
                            ElseIf ($value== "HE") {
                              $content_web .= "<tr><td class='label'>".$word['9316'].":</td><td><input  size='40' style='width:270px;'  type='text' name='OPTION[5]' value='".$word['10006']."' readonly class='readonly'></td>&nbsp;</td><td>&nbsp;</td></tr>";}                            
                            ElseIf ($value<> "") {
                              $content_web .= "<tr><td class='label'>".$value.":</td><td><input  size='40' style='width:270px;'  type='text' name='OPTION[4]' value='".$word['10006']."' readonly class='readonly'></td>&nbsp;</td><td>&nbsp;</td></tr>";}                            
                          

                  
                  }
        // marketing statuses : 0 from CS, 1 checked (by default), 2 unchecked, 3 never informed about
        
        $content_web .= "</table>          
        </div>
        <div id='submit'>
            <input ".($row['FlagPrinted']=='1' ? " disabled" : "")." id='termsAndConditions' type='checkbox' name='Marketing' value='1' "; if ($row['FlagMarketing']=='0' OR $row['FlagMarketing']=='1') {$content_web .= " checked";} $content_web .= "> <a style='color:black;margin-right:50px;' target='_blank' href='".$cfg_links_Bottom[1]."'>".$word['10013']."</a>
            <input ".($row['FlagPrinted']=='1' ? " disabled" : "")." id='termsAndConditions' type='checkbox' name='termsAndConditions' value='1' ".($row['TandC']=='1' ? " checked" : "")."> <a style='color:black;margin-right:20px;' target='_blank' href='".$cfg_links_Bottom[2]."'>".$word['10003']."</a>
            <input id='flagprinted' type='hidden' value='".$row['FlagPrinted']."' name='flagprinted'>
            <input type='hidden' name='lang' value='".$lang."' >
          &nbsp;&nbsp;&nbsp;
        <input class='submit' type='submit' name='finish' value='".$word['10005']."' >
      </div>
          
          
          ";


    // **************************************************
 		//  Forward consignment notification to sender email
 		// **************************************************

        If ($row['SenderEmail'] <> "" AND $emailnotification == 1) {

            function send_email($to='', $from='', $subject='', $html_content='', $text_content='', $headers='') { 
            	# Setup mime boundary
            	$mime_boundary = "Multipart_Boundary_x".md5(time())."x";
            
            	$headers  = "MIME-Version: 1.0\r\n";
            	$headers .= "Content-Type: multipart/alternative; boundary=".$mime_boundary."\r\n";
            	$headers .= "Content-Transfer-Encoding: 7bit\r\n";
            
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
            	return mail($to, $subject, $body, $headers);
            }
            
            

            
              If ($cfg_con_email_personal == "Y") {
              
              $cfg_con_email_bounce = $row['Email'];
              
                  If ($cfg_con_email_bounce <> "") {
                    $cfg_con_email = "TNT <".$row['Email'].">";
                    $cfg_con_email_bounce = $row['Email'];
                  }      

              }
            
                $messagehtml  = $cfg_con_message[0];
                $messagehtml .= "<br>";
                $messagehtml .= "<br>";
                $messagehtml .= $cfg_con_message[1].$row['ConsignmentNumber'];               
                $messagehtml .= "<br>";
                $messagehtml .= $cfg_con_message[2];
                $messagehtml .= "<br>";
                $messagehtml .= "<br>";
                $messagehtml .= "<a href='".$cfg_con_message[3].$row['ConsignmentNumber']."'>".$cfg_con_message[3].$row['ConsignmentNumber']."</a>";
                $messagehtml .= "<br>";
                $messagehtml .= "<br>";
                $messagehtml .= $cfg_con_message[4].": ".$row['SenderName'].", ".$row['SenderStreet1'].", ".$row['SenderStreet2'].", ".$row['SenderStreet3'].", ".$row['SenderTown'].", ".$row['SenderPostcode'].", ".$row['SenderCountry'];                                                                                                
                $messagehtml .= "<br>";
                $messagehtml .= $cfg_con_message[5].": ".$row['ReceiverName'].", ".$row['ReceiverStreet1'].", ".$row['ReceiverStreet2'].", ".$row['ReceiverStreet3'].", ".$row['ReceiverTown'].", ".$row['ReceiverPostcode'].", ".$row['ReceiverCountry'];
                $messagehtml .= "<br>";
                $messagehtml .= $cfg_con_message[6].": ".$row['ShipmentDescription'];
                $messagehtml .= "<br>";
                $messagehtml .= $cfg_con_message[7].": ".$TotalItems;                                                
                $messagehtml .= "<br>";
                $messagehtml .= $cfg_con_message[8].": ".$TotalWeight." kg";                                                
                $messagehtml .= "<br>";
                $messagehtml .= $cfg_con_message[9].": ".$row['CustomerReference'];
                $messagehtml .= "<br>";
                $messagehtml .= "<br>";                
                $messagehtml .= $cfg_con_message[10];
                $messagehtml .= "<br>";
                $messagehtml .= $cfg_con_message[11].$cfg_con_email_bounce;
                $messagehtml .= "<br>";
                $messagehtml .= $cfg_con_message[12];
                $messagehtml .= "<br>";
                $messagehtml .= $cfg_con_message[13];
                $messagehtml .= "<br>";
                $messagehtml .= $cfg_con_message[14];
                $messagehtml .= "<br>";
                $messagehtml .= "<a href='".$cfg_con_message[15]."'>".$cfg_con_message[15]."</a>";
                $messagehtml .= "<br>";
                $messagehtml .= $cfg_con_message[16];                
            
 
                $messagetext  = $cfg_con_message[0];
                $messagetext .= "\r\n";
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[1].$row['ConsignmentNumber'];               
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[2];                
                $messagetext .= "\r\n";
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[3].$row['ConsignmentNumber'];
                $messagetext .= "\r\n";
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[4].": ".$row['SenderName'].", ".$row['SenderStreet1'].", ".$row['SenderStreet2'].", ".$row['SenderStreet3'].", ".$row['SenderTown'].", ".$row['SenderPostcode'].", ".$row['SenderCountry'];                                                                                                
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[5].": ".$row['ReceiverName'].", ".$row['ReceiverStreet1'].", ".$row['ReceiverStreet2'].", ".$row['ReceiverStreet3'].", ".$row['ReceiverTown'].", ".$row['ReceiverPostcode'].", ".$row['ReceiverCountry'];
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[6].": ".$row['ShipmentDescription'];
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[7].": ".$TotalItems;                                                
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[8].": ".$TotalWeight." kg";                                                
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[9].": ".$row['CustomerReference'];
                $messagetext .= "\r\n";
                $messagetext .= "\r\n";                
                $messagetext .= $cfg_con_message[10];
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[11].$cfg_con_email_bounce;
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[12];
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[13];
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[14];
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[15];
                $messagetext .= "\r\n";
                $messagetext .= $cfg_con_message[16];                

                    if (mb_detect_encoding($cfg_con_subject,"UTF-8")) {
                      $cfg_con_subject = "=?UTF-8?B?".base64_encode($cfg_con_subject)."?=";              
                    }
                
                send_email($row['SenderEmail'],$cfg_con_email,$cfg_con_subject.$row['ConsignmentNumber'],$messagehtml,$messagetext,"");
              
       
        
        } 


		return $content_web;								
		}










//********************************	
// DOCUMENTS
//********************************
          
function content_docs() 	{

		global $crn, $senderaccount, $rowid;
		global $TotalItems, $TotalWeight, $TotalVolume;
		global $cfg_Sender_Country_Code, $DB_connection, $cfg_con_source_PDF, $cfg_Sender_Country_Code_big, $cfg_con_option_names, $cfg_con_national_chars, $cfg_csfl_dateseparator, $cfg_csfl_dateformat, $cfg_con_mkt_detailedmanifest_media, $cfg_con_mkt_detailedmanifest_start, $cfg_con_mkt_detailedmanifest_end;


          //********************************	
          // LOAD SPECIFIC CRN DATA
          //********************************
        
          ($rowid <> "" ? $sql = "AND a.id='".$rowid."'" : $sql="" ); 
        
          $sql = mysqli_query($DB_connection,"SELECT a.*, b.*
															FROM cc_".$cfg_Sender_Country_Code."_dat_shipments AS a, cc_".$cfg_Sender_Country_Code."_cfg_services AS b 
                              WHERE a.Service = b.Name 
                                AND a.ShipmentType = b.Type
                                AND IF('".$cfg_Sender_Country_Code_big."' = a.ReceiverCountry, 'D', 'I') = b.DomInt
                                AND a.BookingNumber = '".$crn."' AND a.SenderAccount = '".$senderaccount."' ".$sql);
                                
                                //AND a.id = '".ReadParamValue("rowid","","0")."'"          
  
          //if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_array($sql,MYSQLI_ASSOC) or die(mysqli_error($DB_connection));
          //} 
          
          //********************************	
          // HTML CONTENT OF CRN DATA
          //********************************

      

          $content_docs = "

         
          
                        <script type='text/javascript'>		
                          var firstPagePrinted = false;
                      
                          function includePageBreak() {
                      	if (firstPagePrinted) {
                      	    document.writeln(\"<div class='pagebreak'>\");
                      	    document.writeln(\"<font color='#FFFFFF' size='1'>.</font>\");
                      	    document.writeln(\"</div>\");
                      	} else {
                      	    firstPagePrinted = true;
                      	}
                          }      
                      </script>
              
                      <script type='text/javascript'>includePageBreak();</script>
                      
                      <div id='documents'>
                      ";


                      // Show text with service options on below documents 
                      
                      $con_options = "";
                      
                      for ($line = 0; $line < 6; $line++) {
                        ( $row['ServiceOption_'.$line] <> "" ? $con_options .= " (".$row['ServiceOption_'.$line].") ".$cfg_con_option_names[$row['ServiceOption_'.$line]]." ": ""); 
                      }
                      
                      ( $row['DGOption'] <> "" ? $con_options .= " (".$row['DGOption'].") ".$cfg_con_option_names[$row['DGOption']]: "");


//***************
// ADDRESS LABEL
//***************

                $i=0;

                    while ($i<$TotalItems) {
                     
                      
                      $content_docs .= "<table class='mainTable1' border='0' cellspacing='0' cellpadding='0'>
                                        <tbody>
                                          <tr align='right' valign='top'><td><font class='carrierLicence'></font></td></tr>
                                          <tr valign='top'><td>
                                              <table class='outLine' border='1' cellspacing='0' cellpadding='0'>
                                                <tbody>
                                                  <tr><td>
                                                      <table  cellpadding='3' cellspacing='0' border='0' class='table1'>
                                                        <tbody>
                                                          <tr>
                                                            <td valign='top' class='table1td1' rowspan='2'>
                                                                    <table class='table1td1table' border='0' cellspacing='0' cellpadding='0'>
                                                                      <tbody>
                                                                        <tr>
                                                                          <td><font class='addressHeader'>Sender :</font></td>
                                                                          <td><font class='addressHeader'>TNT Account :</font></td>
                                                                          <td><font class='addressData'>".$row['SenderAccount']."</font></td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td colspan='3'>
                                                                            <p class='senderAddress'>
                                                                              <font class='addressData'>".$row['SenderName']."
                                                                                <br>".$row['SenderStreet1']."
                                                                                <br>".$row['SenderStreet2']."
                                                                                <br>".$row['SenderStreet3']."
                                                                                <br>".$row['SenderTown']."
                                                                                <br>".$row['SenderPostcode']."
                                                                                <br>".$row['SenderCountry']."
                                                                                <br>
                                                                              </font>
                                                                            </p></td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td><font class='addressHeaderRec'>Contact:</font></td>
                                                                          <td colspan='2'><font class='addressDataRec'><p class='senderAddress'>".$row['SenderContact']."</p></font></td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td><font class='addressHeaderRec'>Tel:</font></td>
                                                                          <td colspan='2'><font class='addressDataRec'>".$row['SenderPhone']."</font></td>
                                                                        </tr>
                                                                      </tbody>
                                                                    </table>
                                                              
                                                            </td>
                                                            <td colspan='2' class='table1td2' align='center'><img width='40' src='images/lg_tnt_bw.gif'>
                                                              <font class='addressData'>
                                                                <br>
                                                              </font>
                                                              <img width='190px' height='30px' src='includes/php/tcpdf/tnt_1d.php?BARCODE=".$row['ConsignmentNumber']."'>
                                                              <font class='addressData'>
                                                                <br>
                                                              </font>
                                                              <font class='addressHeaderCode'>*".$row['ConsignmentNumber']."*
                                                              </font></td>
                                                          </tr>
                                                          <tr>
                                                            <td valign='top' class='table1td3' colspan='2' id='sender_ref_non_au_dom'>
                                                              <font class='addressHeader'>Sender Ref:
                                                              </font>
                                                              <font class='addressData'>
                                                                <br>".$row['CustomerReference']."
                                                              </font></td>
                                                          </tr>
                                                        </tbody>
                                                      </table></td>
                                                  </tr>
                                                  <tr>
                                                    <td class='td2height'>
                                                      <table class='t21' cellpadding='3' cellspacing='0' border='0'>
                                                        <tbody>
                                                          <tr>
                                                            <td valign='top' class='table2td1'>
                                                              <table class='table2td1table' border='0' cellspacing='0' cellpadding='0'>
                                                                <tbody>
                                                                  <tr class='deliveryAddress'>
                                                                    <td colspan='3'>
                                                                      <font class='addressHeader'>Delivery Address
                                                                        <br>
                                                                      </font>
                                                                      <font class='addressDataRec'>".$row['ReceiverName']."
                                                                        <br>".$row['ReceiverStreet1']."
                                                                        <br>".$row['ReceiverStreet2']."
                                                                        <br>".$row['ReceiverStreet3']."
                                                                        <br>".$row['ReceiverTown']."
                                                                        <br>".$row['ReceiverPostcode']."
                                                                        <br>".$row['ReceiverCountry']."
                                                                        <br>
                                                                      </font></td>
                                                                  </tr>
                                                                  <tr class='deliveryAddress'>
                                                                          <td><font class='addressHeaderRec'>Contact:</font></td>
                                                                          <td colspan='2'><font class='addressDataRec'><p class='senderAddress'>".$row['ReceiverContact']."</p></font></td>
                                                                        </tr>
                                                                        <tr class='deliveryAddress'>
                                                                          <td><font class='addressHeaderRec'>Tel:</font></td>
                                                                          <td colspan='2'><font class='addressDataRec'>".$row['ReceiverPhone']."</font></td>
                                                                        </tr>
                                                                </tbody>
                                                              </table></td>
                                                            <td width='100%' class='t24' valign='top'>
                                                              <font class='addressHeader'>Shipping Date :
                                                              </font>
                                                              <font class='addressData'>".$row['CollectionDate']."
                                                                <br>
                                                              </font>
                                                              <font class='addressHeader'>Description of Goods &nbsp;&nbsp;
                                                              </font>
                                                              <font class='addressData'>".$row['ShipmentDescription']."
                                                                <br>
                                                              </font>
                                                              </td>
                                                          </tr>
                                                        </tbody>
                                                      </table></td>
                                                  </tr>
                                                  <tr><td>
                                                      <table cellpadding='3' cellspacing='0' border='0' class='table3'>
                                                        <tbody>
                                                          <tr>
                                                            <td colspan='2' class='table3td1'>
                                                              <font class='addressHeader'>Special Delivery Instructions
                                                              </font>
                                                              <font class='addressData'>
                                                              <br>".$row['DeliveryInstruction']."
                                                              </font></td>
                                                            <td class='table3td2'>
                                                              <font class='addressDataRec'>".($row['DGIndicator']=='Y' ? "DANGEROUS GOODS" : "NON DANGEROUS GOODS") ."    
                                                              </font></td>
                                                          </tr>
                                                        </tbody>
                                                      </table></td>
                                                  </tr>
                                                  <tr>
                                                    <td class='td4height'>
                                                      <table class='t41' cellpadding='3' cellspacing='0' border='0'>
                                                        <tbody>
                                                          <tr>
                                                            <td valign='top' class='table4td1'>
                                                              <font class='addressHeader'>Service&amp;  Options
                                                                <br>
                                                              </font>
                                                              <font class='addressData'>														  (".$row['Code'].")  ".$row['Service']."
                                                                <br>".$con_options."
                                                              </font></td>
                                                            <td valign='top' align='left' class='table4td2'>
                                                              <font class='addressHeader'>No. of Pieces
                                                                <br>
                                                                <br>
                                                              </font>
                                                              <font class='addressDataWeight'>".($i+1)."&nbsp;of&nbsp;".$TotalItems."
                                                                <br>
                                                              </font>
                                                              <font class='addressHeader'>Consignment Weight
                                                                <br>
                                                                <br>
                                                              </font>
                                                              <font class='addressDataWeight'>".$TotalWeight."&nbsp;kg
                                                              </font></td>
                                                            <td style='line-height: 0' id='addressLabel_terms'>
                                                              <br>
                                                              <font style='line-height: 1' class='addressSmallPrint'>TNT'S LIABILITY FOR LOSS, DAMAGE AND DELAY IS LIMITED BY THE CMR CONVENTION OR THE WARSAW CONVENTION WHICHEVER IS APPLICABLE. THE SENDER AGREES THAT THE GENERAL CONDITIONS, WHICH CAN BE VIEWED AT 
                                                                <font class='addressSmallPrintLink'>http://my.tnt.com/myTNT/footer/terms.do
                                                                </font>, ARE ACCEPTABLE AND GOVERN THIS CONTRACT. IF NO SERVICES OR BILLING OPTIONS ARE SELECTED THE FASTEST AVAILABLE SERVICE WILL BE CHARGED TO THE SENDER.
                                                              </font></td>
                                                          </tr>
                                                        </tbody>
                                                      </table></td>
                                                  </tr>
                                                </tbody>
                                              </table></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                      <script type='text/javascript'>includePageBreak();</script>";
                      

                      $i++;

                    } 
                 
                 
// EXCEPTION to myTNT labels no dimensions per label
//                                                              <font class='addressHeader'>Package Type :
//                                                              </font>
//                                                              <font class='addressData'>".$row['PackageType_'.$i]."
//                                                                <br>
//                                                              </font>
//                                                              <font class='addressHeader'>Dimensions:
//                                                              </font>
//                                                              <font class='addressData'>".$row['Length_'.$i]."cm&nbsp;x&nbsp;".$row['Width_'.$i]."cm&nbsp;x&nbsp;".$row['Height_'.$i]."cm&nbsp;
//                                                              </font>
//
//


//***************
// CONNOTE
//***************

            $y=0;

            while ($y<2 AND $row['CustomsControl']=='1') {

                    $content_docs .= "
                    <table class='printTable' cellspacing='0' cellpadding='0'>
                      <tbody>
                        <tr>
                          <td align='center'>
                            <font class='center' size='20'><b>Consignment Note</b>
                            </font>
                            <br>
                            <br></td>
                        </tr>
                        <tr><td>
                            <table border='1' cellspacing='0' cellpadding='0' width='600' class='outLine connote'>
                              <tbody>
                                <tr>
                                  <td width='300' valign='top'>
                                    <table border='0' cellspacing='1' cellpadding='0' width='300'>
                                      <tbody>
                                        <tr>
                                          <td colspan='4'>
                                            <font class='header'>1.From (Collection Address)
                                            </font>
                                            <hr width='100%' noshade size='1'>
                                            <font class='data'>Sender's Account No : ".$row['SenderAccount']."
                                              <br>Name : ".$row['SenderName']."
                                              <br>Address : ".$row['SenderStreet1']."
                                              <br>".$row['SenderStreet2']."
                                              <br>".$row['SenderStreet3']."
                                            </font></td>
                                        </tr>
                                        <tr>
                                          <td colspan='2'>
                                            <font class='data'>City : ".$row['SenderTown']."
                                              <br>Province : 
                                              <br>Contact Name : ".$row['SenderContact']."
                                            </font></td>
                                          <td colspan='2'>
                                            <font class='data'>Postal/Zip Code : ".$row['SenderPostcode']."
                                              <br>Country : ".$row['SenderCountry']."
                                              <br>Tel No : ".$row['SenderPhone']."
                                            </font></td>
                                        </tr>
                                        <tr>
                                          <td colspan='4'>
                                            <font class='header'>
                                              <br>2.To (Receiver Address)
                                            </font>
                                            <hr width='100%' noshade size='1'>
                                            <font class='data'>Name : ".$row['ReceiverName']."
                                              <br>Address : ".$row['ReceiverStreet1']."
                                              <br>".$row['ReceiverStreet2']."
                                              <br>".$row['ReceiverStreet3']."
                                            </font></td>
                                        </tr>
                                        <tr>
                                          <td colspan='2'>
                                            <font class='data'>City : ".$row['ReceiverTown']."
                                              <br>Province : 
                                              <br>Contact Name : ".$row['ReceiverContact']."
                                            </font></td>
                                          <td colspan='2'>
                                            <font class='data'>Postal/Zip Code : ".$row['ReceiverPostcode']."
                                              <br>Country : ".$row['ReceiverCountry']."
                                              <br>Tel No : ".$row['ReceiverPhone']."
                                            </font></td>
                                        </tr>
                                        <tr>
                                          <td colspan='4'>
                                            <font class='header'>
                                              <br>3.Goods
                                            </font>
                                            <hr width='100%' noshade size='1'>
                                            <font class='data'>General Description :
                                              <br>".$row['ShipmentDescription']."
                                              <br>
                                            </font>
                                            <br></td>
                                        </tr>
                                        <tr>
                                          <td colspan='1'>
                                            <font class='data'>HS Tariff Code: 
                                            </font></td><td>
                                            <font class='data'>
                                            </font></td>
                                        </tr>
                                        <tr>
                                          <td colspan='1'>
                                            <font class='data'>Total Packages :  
                                            </font></td>
                                          <td colspan='1'>
                                            <font class='data'>Total Weight :    
                                            </font></td>
                                          <td colspan='1'>
                                            <font class='data'>Total Volume :    
                                            </font></td>
                                          <td colspan='1'></td>
                                        </tr>
                                        <tr>
                                          <td colspan='1'>
                                            <font class='data'>".$TotalItems."
                                            </font></td>
                                          <td colspan='1'>
                                            <font class='data'>".$TotalWeight."&nbsp;kg
                                            </font></td>
                                          <td colspan='1'>
                                            <font class='data'>".$TotalVolume."&nbsp;m<sup>3</sup>
                                            </font></td>
                                          <td colspan='1'></td>
                                        </tr>
                                        <tr>
                                          <td colspan='4'>
                                            <font class='header'>
                                              <br>4. Services
                                            </font>
                                            <hr width='100%' noshade size='1'>
                                            <font class='data'>                                                    Service : (".$row['Code'].")".$row['Service']."
                                              <br>                                                    Options :  ".$con_options."
                                            </font></td>
                                        </tr>
                                        <tr>
                                          <td colspan='3'>
                                            <font class='data'>
                                            </font></td>
                                        </tr>
                                        <tr>
                                          <td align='left' colspan='1'>
                                            <font class='header'>".($row['PaymentTerms']=="S" ? "Sender Pays":"Receiver Pays")."
                                            </font>
                                            </td>
                                          <td align='right' colspan='3'>
                                            <font class='header'>
                                              <nobr>".($row['DGIndicator']=='Y' ? "DANGEROUS GOODS" : "NON DANGEROUS GOODS")."
                                              </nobr>
                                            </font></td>
                                        </tr>
                                        ".($y==0 ? "":"<tr><td colspan='2'><font class='data'>Insurance Currency : ".$row['InsuranceCurrency']."</font></td><td colspan='2'><font nowrap='nowrap' class='data'>Value : ".$row['InsuranceValue']."</font></td></tr>")
                                        ."<tr>
                                          <td colspan='4'>
                                            <hr width='100%' noshade size='1'></td>
                                        </tr>
                                        <tr>
                                          <td colspan='4'>
                                            <font class='header'>
                                              <br>Sender's Signature : ______________________________
                                            </font></td>
                                        </tr>
                                        <tr>
                                          <td colspan='4'>
                                            <font class='header'>
                                              <br>Date : ______/______/______
                                            </font>
                                            <br></td>
                                        </tr>
                                        <tr>
                                          <td id='connote_terms' colspan='4'>
                                            <br>
                                            <font class='smallprint'>TNT'S LIABILITY FOR LOSS, DAMAGE AND DELAY IS LIMITED BY THE CMR CONVENTION OR THE WARSAW CONVENTION WHICHEVER IS APPLICABLE. THE SENDER AGREES THAT THE GENERAL CONDITIONS, WHICH CAN BE VIEWED AT 
                                              <font class='smallprintlink'>http://my.tnt.com/myTNT/footer/terms.do
                                              </font>, ARE ACCEPTABLE AND GOVERN THIS CONTRACT. IF NO SERVICES OR BILLING OPTIONS ARE SELECTED THE FASTEST AVAILABLE SERVICE WILL BE CHARGED TO THE SENDER.
                                            </font></td>
                                        </tr>
                                      </tbody>
                                    </table></td>
                                  <td width='300' valign='top'>
                                    <table border='0' cellspacing='0' cellpadding='1' width='300'>
                                      <tbody>
                                        <tr>
                                          <td align='center' colspan='2'>
                                            <img src='images/lg_tnt.gif'></td>
                                        </tr>
                                        <tr align='center'>
                                          <td colspan='2'>
                                            <br>
                                            <img width='275px' height='80px' src='includes/php/tcpdf/tnt_1d.php?BARCODE=".$row['ConsignmentNumber']."'></td>
                                        </tr>
                                        <tr>
                                          <td colspan='2' align='center'>
                                            <font class='data'>*".$row['ConsignmentNumber']."*
                                              <br>Please quote this number if you have an enquiry.
                                            </font></td>
                                        </tr>
                                        <tr>
                                          <td colspan='2'>
                                            <font class='header'>
                                              <br>A. Delivery Address
                                            </font>
                                            <br>
                                            <hr noshade width='100%' size='1'>
                                            <font class='data'>Name :  ".$row['ReceiverName']."
                                              <br>Address : ".$row['ReceiverStreet1']."
                                                                        <br>".$row['ReceiverStreet2']."
                                                                        <br>".$row['ReceiverStreet3']."
                                            </font></td>
                                        </tr>
                                        <tr>
                                          <td colspan='1'>
                                            <font class='data'>City :   ".$row['ReceiverTown']."
                                              <br>Province : 
                                              <br>Contact Name : ".$row['ReceiverContact']."
                                            </font></td>
                                          <td colspan='1'>
                                            <font class='data'>Postal/Zip Code : ".$row['ReceiverPostcode']."
                                              <br>Country : ".$row['ReceiverCountry']."
                                              <br>Tel No :  ".$row['ReceiverPhone']."
                                            </font></td>
                                        </tr>
                                        <tr>
                                          <td colspan='4'>
                                            <font class='header'>
                                              <br>B. Dutiable Shipment Details
                                            </font>
                                            <hr width='100%' noshade size='1'>
                                            <font class='data'>Receivers VAT/TVA/BTW/MWST No. : 
                                              <br>Invoice Value of Dutiables
                                            </font></td>
                                        </tr>".($y==0 ? "":"<tr><td colspan='1'><font class='data'>Currency: ".$row['ShipmentCurrency']."</font></td><td colspan='1'><font class='data'>Value: ".$row['ShipmentValue']."</font></td></tr>")
                                        ."<tr>
                                          <td colspan='2'>
                                            <font class='header'>
                                              <br>C. Special Delivery Instructions
                                            </font>
                                            <hr width='100%' noshade size='1'>
                                            <font class='data'> ".$row['DeliveryInstruction']."
                                            </font>
                                            <font class='header'>
                                              <br>D. Customer Reference
                                            </font>
                                            <hr width='100%' noshade size='1'>
                                            <font class='data'>".$row['CustomerReference']."
                                            </font>
                                            <font class='header'>
                                              <br>E. Invoice Receiver (Receiver's Account Number)
                                            </font>
                                            <br>
                                            <hr width='100%' noshade size='1'>
                                            <font class='data'>".($row['PaymentTerms']=='R' ? $row['ReceiverAccount'] : "NK")."
                                            </font>
                                            <hr width='100%' noshade size='1'>
                                            <font class='header'>
                                              <br>Received by TNT 
                                              <br>by (Name) : _____________________________________
                                            </font>
                                            <br>
                                            <br>
                                            <font class='header'>Date : ______/______/______ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Time : ______:______
                                            </font>
                                            <br>
                                            <font class='data'>
                                              <br>".($y==0 ? "Receiver's Copy":"Customs Copy")."
                                            </font>
                                            </td>
                                        </tr>
                                      </tbody>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td colspan='2'>
                                    <font class='carrierLicence'>
                                    </font></td>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                      </tbody>
                    </table>
                    
                    
                    <script type='text/javascript'>includePageBreak();</script>";
                    
                    $y++;
  }  

//***************
// MANIFEST
//***************
              
              $y=0; 
                              
              $pdf_dg             = ""; if ( $row['DGIndicator']=="Y" ) { $pdf_dg = "Y"; } else { $pdf_dg = "N"; };
                                  
                  if ($pdf_dg == "Y") {
                            $pdf_serviceoption  = array($row['DGOption'],$row['ServiceOption_0'],$row['ServiceOption_1'],$row['ServiceOption_2']);                                              
                  } else {
                            $pdf_serviceoption  = array($row['ServiceOption_0'],$row['ServiceOption_1'],$row['ServiceOption_2'],$row['ServiceOption_3']);
                  }
              
              $collectiondate     = explode($cfg_csfl_dateseparator,$row['CollectionDate']);

              if ($cfg_csfl_dateformat == "1") {
                  $collectiondate[2]  = (strlen($collectiondate[2]) == 2 ? "20".$collectiondate[2] : $collectiondate[2] );
                  $pdf_collectiondate = str_pad($collectiondate[0],2,"0",STR_PAD_LEFT)."/".str_pad($collectiondate[1],2,"0",STR_PAD_LEFT)."/".$collectiondate[2];
              } else if ($cfg_csfl_dateformat == "2"){
                  $collectiondate[0]  = (strlen($collectiondate[0]) == 2 ? "20".$collectiondate[0] : $collectiondate[0] );
                  $pdf_collectiondate = $collectiondate[2]."/".str_pad($collectiondate[1],2,"0",STR_PAD_LEFT)."/".str_pad($collectiondate[0],2,"0",STR_PAD_LEFT);
              }

          Function RemoveNationalChars($content){
            
            global $cfg_con_national_chars;
            
              $cfg_con_national_chars["&"] = " "; //TCPDF bug. Following & char must be removed to create correct 2D barcode 
            
              $RemoveNationalChars = str_replace(array_keys($cfg_con_national_chars),array_values($cfg_con_national_chars),$content);
            
            return $RemoveNationalChars;
          
          }
                                              
              $pdfdata = "PL05~~~~~~0700~~~|".$row['ConsignmentNumber']."|".$cfg_con_source_PDF."|".str_pad($row['SenderAccount'], 9,"0",STR_PAD_LEFT)."|".RemoveNationalChars($row['SenderName'])."|".RemoveNationalChars($row['SenderStreet1'])."|".RemoveNationalChars($row['SenderStreet2'])."|".$row['SenderTown']."|".$row['SenderPostcode']."||".$cfg_Sender_Country_Code_big."|".$row['SenderContact']."|".$row['SenderPhone']."|".RemoveNationalChars($row['ReceiverName'])."|".RemoveNationalChars($row['ReceiverStreet1'])."|".RemoveNationalChars($row['ReceiverStreet2'])."|".$row['ReceiverTown']."|".$row['ReceiverPostcode']."||".$row['ReceiverCountry']."|".RemoveNationalChars($row['ReceiverContact'])."|".$row['ReceiverPhone']."|".RemoveNationalChars($row['ShipmentDescription'])."||".$TotalItems."|".$TotalWeight."|".$TotalVolume."|".$row['Code']."|".$pdf_serviceoption[0]."|".$pdf_serviceoption[1]."|".$pdf_serviceoption[2]."|".$pdf_serviceoption[3]."|".$row['InsuranceValue']."|".$row['InsuranceCurrency']."|".$pdf_dg."|".$row['SenderName']."|".RemoveNationalChars($row['SenderStreet1'])."|".RemoveNationalChars($row['SenderStreet2'])."|".$row['SenderTown']."|".$row['SenderPostcode']."||".$cfg_Sender_Country_Code_big."|".$row['SenderContact']."|".$row['SenderPhone']."|".RemoveNationalChars($row['ReceiverName'])."|".RemoveNationalChars($row['ReceiverStreet1'])."|".RemoveNationalChars($row['ReceiverStreet2'])."|".$row['ReceiverTown']."|".$row['ReceiverPostcode']."||".$row['ReceiverCountry']."|".RemoveNationalChars($row['ReceiverContact'])."|".$row['ReceiverPhone']."||".$row['ShipmentValue']."|".RemoveNationalChars($row['DeliveryInstruction'])."|".RemoveNationalChars($row['CustomerReference'])."|".$row['PaymentTerms']."|".str_pad($row['ReceiverAccount'], 9,"0",STR_PAD_LEFT)."|".$pdf_collectiondate."|08:00|".$row['div']."|||N|N|||".$row['DGUNNumber']."||".$row['CashOnDeliveryValue']."|".$row['CashOnDeliveryCurrency']."| | | | | | | | | | | | | | | |0.00| | | | | | | |0.00| | | | | | | |0.00| | | | | | | | | | | | | | | | | | | | | | | | | | | | | |";

              while ($y<2) {
              
                  $content_docs .= "
                  <table class='manifest' cellpadding='0' cellspacing='1' border='0' width='600'>
                    <tbody>
                      <tr>
                        <td width='80'></td>
                        <td width='120'></td>
                        <td width='150'></td>
                        <td width='120'></td>
                        <td width='130'></td>
                      </tr>
                      <tr align='left' valign='top'>
                        <td style='line-height: 13px' colspan='4'>
                          <font class='carrierLicence'>
                          </font></td>
                      </tr>
                      <tr class='force-line-height'>
                        <td colspan='1'>
                          <img src='images/lg_tnt.gif'></td>
                        <td colspan='3' align='center'>
                          <font style='line-height: 18px' class='title'>COLLECTION MANIFEST (DETAIL) - OTHERS (".($row['PaymentTerms']=="S" ? "SENDER PAYS":"RECEIVER PAYS").") 
                          </font>
                          <br>
                          <font class='data'>TNT Express
                          </font>
                          <br>
                          <font class='header'>Shipment Date 
                          </font>
                          <font class='data'>: ".$row['CollectionDate']."
                          </font>
                          <br>
                          <font class='header'>Pickup id 
                          </font>
                          <font class='data'>: CC
                          </font></td>
                        <td align='right'>
                          <font class='data'>&nbsp;
                          </font></td>
                      </tr>
                      <tr class='force-line-height'>
                        <td colspan='1'>
                          <font class='header'>Sender Account
                          </font></td>
                        <td colspan='3'>
                          <font class='data'>: ".$row['SenderAccount']."
                          </font></td>
                        <td nowrap align='right' colspan='1'>
                          <font class='header'>Printed on 
                          </font>
                          <font class='data'>: ".( $cfg_csfl_dateformat == "1" ? date("d".$cfg_csfl_dateseparator."m".$cfg_csfl_dateseparator."Y") : date("Y".$cfg_csfl_dateseparator."m".$cfg_csfl_dateseparator."d") )."
                          </font></td>
                      </tr>
                      <tr class='force-line-height'>
                        <td colspan='1'>
                          <font class='header'>Sender Name
                          </font></td>
                        <td colspan='4'>
                          <font class='data'>: ".$row['SenderName']."
                          </font></td>
                      </tr>
                      <tr class='force-line-height'>
                        <td colspan='1'>
                          <font class='header'>&amp; Address
                          </font></td>
                        <td colspan='4'>
                          <font class='data'>: ".$row['SenderStreet1'].", ".$row['SenderStreet2'].", ".$row['SenderStreet3']."
                          </font></td>
                      </tr>
                      <tr class='force-line-height'>
                        <td colspan='1'></td>
                        <td colspan='4'>
                          <font class='data'>: ".$row['SenderTown'].", ".$row['SenderPostcode'].", ".$row['SenderCountry']."
                          </font></td>
                      </tr>
                      <tr class='force-line-height'>
                        <td colspan='5'>
                          <hr noshade='true' size='1' width='100%'></td>
                      </tr>
                      <tr class='force-line-height'>
                        <td align='center' colspan='2'>
                          <img width='275px' height='50px' src='includes/php/tcpdf/tnt_1d.php?BARCODE=".$row['ConsignmentNumber']."'>
                          <br>
                          <font class='data'>*".$row['ConsignmentNumber']."*
                          </font></td>
                        <td colspan='2' valign='top'>
                          <font class='header'><u>Special Instructions</u>
                          </font>
                          <font class='data'>
                          <br>".$row['DeliveryInstruction']."
                            <br>".($row['PaymentTerms']=="S" ? "SENDER PAYS":"RECEIVER PAYS")."
                          </font></td>
                        <td align='right' colspan='2'>
                          <font class='header'>".($row['DGIndicator']=='Y' ? "DANGEROUS GOODS" : "NON DANGEROUS GOODS")."
                          </font></td>
                      </tr>
                    </tbody>
                  </table>
                  <table class='manifest' cellpadding='0' cellspacing='1' border='0' width='600'>
                    <tbody>
                      <tr class='force-line-height'>
                        <td width='18%'><font class='header'>Sender Contact</font></td>
                        <td><font class='data'>: </font></td>
                        <td colspan='3'><font class='data'>".$row['SenderContact']."</font></td>
                      </tr>
                      <tr class='force-line-height'>
                        <td><font class='header'>Tel</font></td>
                        <td valign='top'><font class='data'>:</font></td>
                        <td><font class='data'>".$row['SenderPhone']."</font></td>
                        <td align='right' width='23%'><font class='header'>Sender Ref&nbsp; :</font></td>
                        <td><font class='data'>".$row['CustomerReference']."</font></td>
                      </tr>
                      <tr class='force-line-height'>
                        <td valign='top'><font class='header'>Receiver Name<br>&amp; Address</font></td>
                        <td valign='top'><font class='data'>:</font></td>
                        <td colspan='3' valign='top'><font class='data'>".$row['ReceiverName'].",<br>".$row['ReceiverStreet1'].", ".$row['ReceiverStreet2'].", ".$row['ReceiverStreet3'].", ".$row['ReceiverTown'].", ".$row['ReceiverPostcode'].", ".$row['ReceiverCountry']."</font></td>
                      </tr>
                      <tr class='force-line-height'>
                        <td><font class='header'>Receiver Contact</font></td>
                        <td><font class='data'>: </font></td>
                        <td><font class='data'>".$row['ReceiverContact']."</font></td>
                        <td align='right'><font class='header'>Receiver Tel&nbsp;</font></td>
                        <td><font class='data'>: ".$row['ReceiverPhone']."</font></td>
                      </tr>
                      <tr class='force-line-height'>
                        <td><font class='header'>Receiver Vat Nr</font></td>
                        <td><font class='data'>:&nbsp;</font></td>
                        <td><font class='data'></font></td>
                        <td align='right'><font class='header'>Receiver Acc Number&nbsp;</font></td>
                        <td><font class='data'>: ".($row['PaymentTerms']=='R' ? $row['ReceiverAccount'] : "NK")."</font></td>
                      </tr>
                      <tr class='force-line-height'>
                        <td valign='top'><font class='header'>Collection Name
                          <br>&amp; Address</font></td>
                        <td valign='top'><font class='data'>: </font></td>
                        <td colspan='3' valign='top'><font class='data'>".$row['SenderName']."<br> 
                        ".$row['SenderStreet1'].", ".$row['SenderStreet2'].", ".$row['SenderStreet3'].", ".$row['SenderTown'].", ".$row['SenderPostcode'].", ".$row['SenderCountry']."</font></td>
                      </tr>
                      <tr>
                        <td valign='top'><font class='header'>Delivery Name<br>&amp; Address</font></td>
                        <td valign='top'><font class='data'>: </font></td>
                        <td colspan='3' valign='top'><font style='force-line-height-more' class='data'>".$row['ReceiverName'].",
                        <br>".$row['ReceiverStreet1'].", ".$row['ReceiverStreet2'].", ".$row['ReceiverStreet3'].", ".$row['ReceiverTown'].", ".$row['ReceiverPostcode'].", ".$row['ReceiverCountry']."</font>.</td>
                      </tr>
                      <tr class='force-line-height'>
                        <td colspan='5'><font class='header'>Serv</font><font class='data'>: (".$row['Code'].") ".$row['Service']."</font><br><font class='header'>Opts</font><font class='data'>:  ".$con_options."</font></td>
                      </tr>
                    </tbody>
                  </table>
                  <table class='manifest' cellpadding='0' cellspacing='1' border='0' width='600'>
                    <tbody>
                      <tr class='force-line-height'><td>
                          <font class='header'>No Pieces 
                          </font>
                          <font class='data'>: ".$TotalItems."
                          </font></td><td>
                          <font class='header'>Weight 
                          </font>
                          <font class='data'>: ".$TotalWeight."&nbsp;kg
                          </font></td><td>
                          <font class='header'>Insurance Value 
                          </font>
                          <font class='data'>: ".$row['InsuranceValue']." ".$row['InsuranceCurrency']."
                          </font></td><td>
                          <font class='header'>Invoice Value 
                          </font>
                          <font class='data'>: ".$row['ShipmentValue']."&nbsp;".$row['ShipmentCurrency']."
                          </font></td><td></td>
                      </tr>
                      <tr>
                        <td colspan='5'>
                          <font class='header'>Goods Description 
                          </font>
                          <font class='data'>: ".$row['ShipmentDescription']."
                          </font></td>
                      </tr>
                      <tr class='force-line-height-with-padding'>
                        <td valign='bottom' colspan='2'>
                          <font class='header'>Description (including packing and marks)
                          </font></td>
                        <td valign='bottom' align='center'>
                          <font class='header'>Dimensions (L x W x H)
                          </font></td>
                        <td class='with-additional-padding' valign='top' align='center'>
                          <font class='header'>Total Consignment Volume
                          </font>&nbsp;
                          <font class='data'>".$TotalVolume."&nbsp;m
                            <sup class='sup'>3</sup>
                          </font></td>
                      </tr>
                      ";
                          
                          
                          
                  $i=0;
                           
                 If ($row['Items_0']<>"") {   
                   
                 // Multiple lines per multiple items 
                   
                    while (isset($row['Items_'.$i]) AND $row['Items_'.$i]<>"" ) {
                     
                      $content_docs  .= "<tr class='force-line-height'><td colspan='2'><font class='data'>".$row['PackageType_'.$i]."</font></td><td valign='top' align='center'><font class='data'>".$row['Length_'.$i]."&nbsp;cm&nbsp;x&nbsp;".$row['Width_'.$i]."&nbsp;cm&nbsp;x&nbsp;".$row['Height_'.$i]."&nbsp;cm</font></td><td valign='top' align='center' colspan='1'><font class='data'>&nbsp;</font></td></tr>";
                      $i++;

                    } 
                 
                 } else {

                 // Single line with number of items
                 
                      $content_docs  .= "<tr class='force-line-height'><td colspan='2'><font class='data'>".$row['TotalPackageType']."</font></td><td valign='top' align='center'><font class='data'>".$row['TotalLength']."&nbsp;cm&nbsp;x&nbsp;".$row['TotalWidth']."&nbsp;cm&nbsp;x&nbsp;".$row['TotalHeight']."&nbsp;cm</font></td><td valign='top' align='center' colspan='1'><font class='data'>&nbsp;</font></td></tr>";                 
       
                 }
                     
                     
                      $content_docs .="
                      <tr class='force-line-height'>
                        <td colspan='5'>
                          <hr noshade='true' size='1' width='100%'></td>
                      </tr>
                    </tbody>
                  </table>
                  <table class='manifest' cellpadding='0' cellspacing='1' border='0' width='600'>
                    <tbody>
                      <tr>
                        <td colspan='2'>&nbsp;</td>
                      </tr>
                      <tr class='force-line-height'>
                        <td width='65%'>
                          <font class='header'>Sender's Signature ____________________________________________
                          </font></td>
                        <td width='35%'>
                          <font class='header'>Date ____/____/____
                          </font></td>
                      </tr>
                      <tr>
                        <td colspan='2'>&nbsp;</td>
                      </tr>
                      <tr class='force-line-height'><td>
                          <font class='header'>Received by TNT &nbsp;&nbsp;&nbsp;&nbsp; ____________________________________________
                          </font></td><td>
                          <font class='header'>Date ____/____/____  Time ___:___ hrs
                          </font></td>
                      </tr>
                      <tr style='line-height: 8px'>
                        <td id='manifest_terms' colspan='2'>
                          <font class='smallprint'>TNT'S LIABILITY FOR LOSS, DAMAGE AND DELAY IS LIMITED BY THE CMR CONVENTION OR THE WARSAW CONVENTION WHICHEVER IS APPLICABLE. THE SENDER AGREES THAT THE GENERAL CONDITIONS, WHICH CAN BE VIEWED AT 
                            <font class='smallprintlink'>http://my.tnt.com/myTNT/footer/terms.do
                            </font>, ARE ACCEPTABLE AND GOVERN THIS CONTRACT. IF NO SERVICES OR BILLING OPTIONS ARE SELECTED THE FASTEST AVAILABLE SERVICE WILL BE CHARGED TO THE SENDER.
                          </font></td>
                      </tr>
                    </tbody>
                  </table>
                  <p><img height='100px' width='450px' src='/includes/php/tcpdf/tnt_pdf.php?crndata=".$pdfdata."'></p>
                  <p>";
                  if ($cfg_con_mkt_detailedmanifest_media <> "") {
                     ( $cfg_con_mkt_detailedmanifest_start -1 < date("Ymd") && $cfg_con_mkt_detailedmanifest_end +1 > date("Ymd") ? $content_docs .= $cfg_con_mkt_detailedmanifest_media : $content_docs .= "");
                  };
                           
                  $content_docs .= "</p>".($y==0 ? "<script type='text/javascript'>includePageBreak();</script>" : "");
                 $y++;
                 
                 }
                    
		return $content_docs;

}
	
?>
