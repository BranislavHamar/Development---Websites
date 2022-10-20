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

        function ReadParamValue($Param,$DefVal,$y)
			{
        global $DB_connection;
        
				if ( isset($_REQUEST[$Param]) ) {
        
         					$ReadParamValue = $_REQUEST[$Param];

                  if ($y=="0") { // textual value in variable
                  
                      $ReadParamValue = stripslashes($ReadParamValue);
                      $ReadParamValue = mysqli_real_escape_string($DB_connection,$ReadParamValue);
                  
                  } elseif ($y=="1") { // numerical value in variable

                      $ReadParamValue = str_replace(',', '.', $ReadParamValue);
                      If (!is_numeric($ReadParamValue)) {
                         $ReadParamValue = $DefVal;
                      }
                  
                  }

	      } else {
        
                  $ReadParamValue = $DefVal;
        }
				
        $ReadParamValue = str_replace("'","",$ReadParamValue);
        $ReadParamValue = trim($ReadParamValue);
        	
        return $ReadParamValue;
			}
      
      
        $go = ReadParamValue("go","0","1");
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      	$DB_Connection = mysqli_connect($cfg_DB_hostname, $cfg_DB_username, $cfg_DB_password, $cfg_DB_name) or die("Could Not Connect To Database");
        mysqli_query($DB_Connection,"SET NAMES 'utf8' " );

        if ($go=="0") {
        //VIEW
                            $where = "";
                            $url = "";
                                      
                            foreach ($_GET as $key => $value) {
                            
                              If ($where == "" ) {
                                $where .= " WHERE 1=1 ";
                              }          
                              
                              If ($key <> "submit" AND $key <> "page" AND $key <> "go") {
                                If ($value <> "" ) {
                                  $where .= " AND ".$key." LIKE UCASE('%".strtoupper(trim($value))."%') ";
                                  $url .= "&".$key."=".trim($value);
                                }          
                              }
                          
                            }
                         
                            $sql = "SELECT COUNT(id) FROM cc_".$cfg_Sender_Country_Code."_dat_shipments ".$where;
                            $query = mysqli_query($DB_Connection, $sql);
                            $row = mysqli_fetch_row($query);
                            $rows = $row[0];
                            $page_rows = 30;
                            $last = ceil($rows/$page_rows);
                            if($last < 1){
                                $last = 1;
                            }
                            $pagenum = 1;
                            if(isset($_GET["page"])){
                                $pagenum = preg_replace("#[^0-9]#", "", $_GET["page"]);
                            }
                            if ($pagenum < 1) { 
                                $pagenum = 1; 
                            } else if ($pagenum > $last) { 
                                $pagenum = $last; 
                            }
                  
                            $limit = " LIMIT " .($pagenum - 1) * $page_rows ."," .$page_rows;
                  
                                        $sql = mysqli_query($DB_Connection,"SELECT a.*
                  															FROM cc_".$cfg_Sender_Country_Code."_dat_shipments AS a
                                                ".$where."     
                                                ORDER BY a.id DESC ".$limit ); 
                  
                  
          } elseif ($go=="1"){
          //STATISTICS

                                        if ($cfg_csfl_dateformat == "1") {  // DD.MM.YYYY
                                                  $date = "%d.%m.%Y";
                                              } else if ($cfg_csfl_dateformat == "2"){  // YYYY.MM.DD
                                                  $date = "%Y.%m.%d";
                                              }
                          
  
          


                   $sql10 = mysqli_query($DB_Connection,"SELECT DISTINCT a.UserName, a.Total_CRN, b.Total_CONS, Round(b.Total_cons/a.Total_CRN*100,2) AS Ratio
                          FROM 
                          (SELECT UserName, Count(DISTINCT(BookingNumber)) AS Total_CRN FROM `cc_".$cfg_Sender_Country_Code."_dat_shipments` GROUP BY UserName ORDER BY Total_CRN DESC, UserName ASC) AS a
                          LEFT JOIN
                          (SELECT UserName, Count(DISTINCT(ConsignmentNumber)) AS Total_CONS FROM `cc_".$cfg_Sender_Country_Code."_dat_shipments` WHERE ConsignmentNumber <> '' GROUP BY UserName ORDER BY Total_CONS DESC, UserName ASC) AS b
                          ON a.UserName = b.UserName  
                          ORDER BY b.Total_CONS DESC, Total_CRN DESC, a.UserName ASC");            
 
                   $sql11 = mysqli_query($DB_Connection,"SELECT DISTINCT a.CollectionDate, a.UserName, a.Total_CRN, b.Total_CONS,  Round(b.Total_cons/a.Total_CRN*100,2) AS Ratio
                          FROM 
                          (SELECT DISTINCT STR_TO_DATE(CollectionDate, '".$date."') AS CollectionDate, UserName, Count(DISTINCT(BookingNumber)) AS Total_CRN FROM `cc_".$cfg_Sender_Country_Code."_dat_shipments` GROUP BY CollectionDate, UserName ORDER BY CollectionDate DESC, Total_CRN DESC, UserName ASC) AS a
                          LEFT JOIN
                          (SELECT DISTINCT STR_TO_DATE(CollectionDate, '".$date."') AS CollectionDate, UserName, Count(DISTINCT(ConsignmentNumber)) AS Total_CONS FROM `cc_".$cfg_Sender_Country_Code."_dat_shipments` WHERE ConsignmentNumber <> '' GROUP BY CollectionDate , UserName ORDER BY CollectionDate DESC, Total_Cons DESC, UserName ASC) AS b
                          ON a.UserName = b.UserName AND a.CollectionDate = b.CollectionDate WHERE (YEARWEEK(a.CollectionDate) = YEARWEEK(CURDATE())-1 OR YEARWEEK(a.CollectionDate) = YEARWEEK(CURDATE())) 
                          ORDER BY a.CollectionDate DESC, b.Total_Cons DESC");  
         
                   $sql12 = mysqli_query($DB_Connection,"SELECT DISTINCT CONCAT(a.Year, LPAD(a.Week,2,'0')) AS CollectionWeek, a.UserName, a.Total_CRN, b.Total_CONS,  Round(b.Total_cons/a.Total_CRN*100,2) AS Ratio
                          FROM 
                          (SELECT DISTINCT YEAR(STR_TO_DATE(CollectionDate, '".$date."')) AS Year, WEEK(STR_TO_DATE(CollectionDate, '".$date."')) AS Week, STR_TO_DATE(CollectionDate, '".$date."') AS CollectionDate, UserName, Count(DISTINCT(BookingNumber)) AS Total_CRN FROM `cc_".$cfg_Sender_Country_Code."_dat_shipments` GROUP BY Year, Week, UserName ORDER BY Year DESC, Week DESC, Total_CRN DESC, UserName ASC) AS a
                          LEFT JOIN
                          (SELECT DISTINCT YEAR(STR_TO_DATE(CollectionDate, '".$date."')) AS Year, WEEK(STR_TO_DATE(CollectionDate, '".$date."')) AS Week, STR_TO_DATE(CollectionDate, '".$date."') AS CollectionDate, UserName, Count(DISTINCT(ConsignmentNumber)) AS Total_Cons FROM `cc_".$cfg_Sender_Country_Code."_dat_shipments` WHERE ConsignmentNumber <> '' GROUP BY Year, Week, UserName ORDER BY Year DESC, Week DESC, Total_Cons DESC, UserName ASC) AS b
                          ON a.UserName = b.UserName AND a.Week = b.Week AND a.Year = b.Year WHERE (CONCAT(a.Year, LPAD(a.Week,2,'0')) = YEARWEEK(CURDATE()) OR CONCAT(a.Year, LPAD(a.Week,2,'0')) = YEARWEEK(CURDATE())-1 )
                          ORDER BY a.Year DESC, a.Week DESC, b.Total_Cons DESC"); 
                      
          }                                                
                  







echo "
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 1.0 Transitional//EN'>
<html>
<head>
<meta http-equiv='content-type' content='text/html; charset=utf-8'>
<meta name='generator' content='PSPad editor, www.pspad.com'>";

                  


                    if ($go=="0") {
                        echo "<meta http-equiv='refresh' content='60'><link rel='stylesheet' href='/includes/css/view-monitor.css' type='text/css' media='screen'><script src='/includes/js/view.js'></script>"; 
                    }else if ($go=="1") {
                        echo "<link rel='stylesheet' href='/includes/css/view-statistics.css' type='text/css' media='screen'>";
                    }

echo "<link rel='stylesheet' href='/includes/css/view-main.css' type='text/css' media='screen'>
<title>TNT - Cooperative Consignment Note Overview - ".$cfg_Sender_Country_Code_big."</title>                                        
</head>
<body>
<div style='min-width:1200px;'>
  <div id='logo'></div>
  <div id='page'>      
    <div id='header' >
      <div id='menu'>
        <ul>
          <li><a href='?go=0' title='HOME' id='menu-home'>&nbsp;</a></li>
          <li><a href='?go=0' title='MONITOR' id='menu-monitor'>&nbsp;</a></li>
          <li><a href='?go=1' title='STATISTICS' id='menu-statistics'>&nbsp;</a></li>                
        </ul>
      </div>
    </div>
    <div id='content'>";
                            
if ($go=="0") {
//MONITOR 
                                                              
                                                             echo "<table id='form' >
                                                                   <tr>
                                                                     <th style='width:40px;'>ID</th><th style='width:60px;'>User<br>ID</th><th style='width:45px;'>Booking<br>Code</th><th style='width:60px;'>Consignment<br>Number</th><th style='width:50px;'>Collection<br>Date</th><th>Sender<br>Email</th><th>Sender<br>Contact</th><th style='width:100px;'>Sender<br>Telephone</th><th style='width:50px;'>Sender<br>Account</th><th style='min-width:150px;'>Sender<br>Name</th><th style='width:50px;'>Connote<br>Printed</th><th style='width:50px;'>Data<br>Sent</th><th style='width:70px;'>Show<br>Link</th><th style='width:70px;'>Send<br>Link</th>
                                                                   </tr>";
                                                                                      
                                                             $FlagPrintedSelected = array("", "", "");
                                                             
                                                             If (@$_GET['FlagPrinted'] == "") {
                                                              $FlagPrintedSelected[0] = "Selected";}                 
                                                             If (@$_GET['FlagPrinted'] == "0") {
                                                              $FlagPrintedSelected[1] = "Selected";}
                                                             If (@$_GET['FlagPrinted'] == "1") {
                                                              $FlagPrintedSelected[2] = "Selected";
                                                             }
                                                             
                                                             $FlagDataSentSelected = array("", "", "");
                                                             
                                                             If (@$_GET['FlagDataSent'] == "") {
                                                              $FlagDataSentSelected[0] = "Selected";}                 
                                                             If (@$_GET['FlagDataSent'] == "0") {
                                                              $FlagDataSentSelected[1] = "Selected";}
                                                             If (@$_GET['FlagDataSent'] == "1") {
                                                              $FlagDataSentSelected[2] = "Selected";
                                                             }
                                            
                                                        echo "<tr class='line2'><form action='' method='get'><td class='highlight2'><input type='text' name='id' value='".@$_GET['id']."' style='width:100%;'></td><td class='highlight2'><input type='text' name='Username' value='".trim(@$_GET['Username'])."' style='width:100%;'></td><td class='highlight2'><input type='text' name='BookingNumber' value='".@$_GET['BookingNumber']."' style='width:50px;'></td><td><input type='text' name='ConsignmentNumber' value='".@$_GET['ConsignmentNumber']."' style='width:100%;'></td><td><input type='text' name='CollectionDate' value='".@$_GET['CollectionDate']."' style='width:100%;'></td><td><input type='text' name='SenderEmail' value='".@$_GET['SenderEmail']."' style='width:100%;'></td><td><input type='text' name='SenderContact' value='".trim(@$_GET['SenderContact'])."' style='width:100%;'></td><td><input type='text' name='SenderPhone' value='".trim(@$_GET['SenderPhone'])."' style='width:100%;'></td><td><input type='text' name='SenderAccount' value='".trim(@$_GET['SenderAccount'])."' style='width:100%;'></td><td><input type='text' name='Sendername' value='".trim(@$_GET['Sendername'])."' style='width:100%;'></td><td align=center><select name='FlagPrinted' style='width:50px;'> <option value='' ".$FlagPrintedSelected[0].">&nbsp;</option><option value='0'".$FlagPrintedSelected[1]." >No</option><option value='1' ".$FlagPrintedSelected[2].">Yes</option></select></td><td align=center><select style='width:50px;' name='FlagDataSent'> <option value='' ".$FlagDataSentSelected[0].">&nbsp;</option><option value='0' ".$FlagDataSentSelected[1]." >No</option><option value='1' ".$FlagDataSentSelected[2].">Yes</option></select></td><td align=center colspan=2><input type='hidden' name='page' value='".$pagenum."' size='3'><input style='width:100%;height:25px;' type='submit' name='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Filter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ></td></form></tr>";
                                                        
                                                        function encodeURI($string) {
                                                            $entities = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
                                                            $replacements = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
                                                            return str_replace($entities, $replacements, urlencode($string));
                                                        }
                                                              
                                                              $sem=1;
                                                                          
                                                        while (($row = mysqli_fetch_array($sql))) {
                                                        
                                                              $ConNumber = $row['ConsignmentNumber'];
                                            
                                                              If ($ConNumber <> "") {
                                                                  $ConNumber = "<a title='Track shipment...' target='_blank' href='".$cfg_con_message[3].$ConNumber."'>".$ConNumber."</a>";
                                                              }
                                                              
                                                              If ($sem == 3) {$sem = 1;}
                                                       
                                                              echo "<tr class='line".$sem."'><td class='highlight".$sem."'>".$row['id']."</td><td class='highlight".$sem."' title='".$row['UserName']."'>".$row['UserName']."</td><td class='highlight".$sem."' title='".$row['LastUpdated']."'>".$row['BookingNumber']."</td><td>".$ConNumber."&nbsp;</td><td>".$row['CollectionDate']."</td><td>".$row['SenderEmail']."&nbsp;</td><td>".$row['SenderContact']."&nbsp;</td><td>".$row['SenderPhone']."</td><td>".$row['SenderAccount']."</td><td>".$row['SenderName']."</td><td style='text-align:center;'><img src='/images/".$row['FlagPrinted'].".png'></td><td style='text-align:center;'><img src='/images/".$row['FlagDataSent'].".png'></td><td style='text-align:center;'><a target='_blank' href='/?lang=1&crn=".$row['BookingNumber']."&senderaccount=".$row['SenderAccount']."&rowid=".$row['id']."'>+&nbsp;>>>&nbsp;+</a></td><td style='text-align:center;'><a href='mailto:".$row['SenderEmail']."?subject=".urlencode($cfg_csfl_subject).$row['BookingNumber']."&body=".urlencode($cfg_csfl_message[2]).urlencode("/?lang=1&crn=").$row['BookingNumber'].urlencode("&senderaccount=").$row['SenderAccount'].urlencode("&rowid=").$row['id']."'>+&nbsp;@@@&nbsp;+</a></td></tr> ";
                                                        
                                                              $sem++;            
                                                        }       
                                            
                                                        echo "</table>";
                                            
                                                                   //($_GET[0]=="" ? $z = "?" : $z = "&") ;
                                            
                                                        $pagetext = "Page <b>".$pagenum."</b> of <b>".$last."</b>";
                                                          // Establish the $paginationCtrls variable
                                                          $paginationCtrls = "";
                                                          // If there is more than 1 page worth of results
                                                          if($last != 1){
                                                              /* First we check if we are on page one. If we are then we don't need a link to 
                                                                 the previous page or the first page so we do nothing. If we aren't then we
                                                                 generate links to the first page, and to the previous page. */
                                                              if ($pagenum > 1) {
                                                                  $previous = $pagenum - 1;
                                                                  $paginationCtrls .= "<a href='?go=0&page=".$previous.$url."'>Previous</a> &nbsp; &nbsp; ";
                                                                  // Render clickable number links that should appear on the left of the target page number
                                                                  for($i = $pagenum-4; $i < $pagenum; $i++){
                                                                      if($i > 0){
                                                                          $paginationCtrls .= "<a href='?go=0&page=".$i.$url."'>".$i."</a> &nbsp; ";
                                                                      }
                                                                  }
                                                              }
                                                              // Render the target page number, but without it being a link
                                                              $paginationCtrls .= "".$pagenum." &nbsp; ";
                                                              // Render clickable number links that should appear on the right of the target page number
                                                              for($i = $pagenum+1; $i <= $last; $i++){
                                                                  $paginationCtrls .= "<a href='?go=0&page=".$i.$url."'>".$i."</a> &nbsp; ";
                                                                  if($i >= $pagenum+4){
                                                                      break;
                                                                  }
                                                              }
                                                              // This does the same as above, only checking if we are on the last page, and then generating the "Next"
                                                              if ($pagenum != $last) {
                                                                  $next = $pagenum + 1;
                                                                  $paginationCtrls .= " &nbsp; &nbsp; <a href='?go=0&page=".$next.$url."'>Next</a> ";
                                                              }
                                                          }
                                            
                                            
                                                       echo "<div style='font-size:13px;margin-top:30px;width:90%;text-align:center;'><br>";
                                                       echo $paginationCtrls; 
                                                       echo "<p>".$pagetext." (".$rows." records)</p>";
                                                       echo "<p><div style='font-size:9px;' >Your IP: ".$_SERVER['REMOTE_ADDR']."</div></p>";
                                                       echo "<div style='font-size:9px;' id='countdown'>&nbsp;</div>";
                                                      echo "</div>";
                                             
 } elseif ($go=="1"){
//STATISTICS TOTAL
                                                       
                                                        echo"<table id='statistics' style='width:60%;' border='1'>
                                                             <tr>
                                                                <th colspan=6 style='font-size:12px;width:100px;text-align:center;background-color:white;color:black;'><strong>TOTAL (".$cfg_con_history." days history)</strong></th>
                                                             </tr>
                                                             <tr>
                                                                <th style='width:60px;'>User<br>ID</th><th >Total<br>Bookings</th><th >Total<br>Consignments</th><th>Conversion</th><th width='200px'>&nbsp;</th>
                                                             </tr>";
                                                             $sem = 1;
                                                             $TotalCRN = 0;
                                                             $TotalCONS = 0;
                                                              
                                                        while (($row = mysqli_fetch_array($sql10))) {
                                                              
                                                              
                                                              If ($sem == 3) {$sem = 1;}
                                                               
                                                                $TotalCRN = $TotalCRN + $row['Total_CRN'];
                                                                $TotalCONS = $TotalCONS + $row['Total_CONS'];
                                                                echo "<tr class='line".$sem."'><td class='highlight".$sem."'>".$row['UserName']."</td><td>".$row['Total_CRN']."</td><td>".( $row['Total_CONS']=="" ? "0":$row['Total_CONS'])."</td><td>".( $row['Ratio']=="" ? "0":$row['Ratio'])."%</td><td><img src='/images/view-graph.png' width='".( $row['Ratio'] > 100 ? "102%" : $row['Ratio'])."%' height='5px'></td></tr>";
                                                                
                                                              $sem++;



                                                        }    
                                                         echo "<tr>
                                                                <td style='width:60px;background-color:#999999;color:white;'><b>TOTAL</b></td><td style='background-color:#999999;color:white;'>".$TotalCRN."</td><td style='background-color:#999999;color:white;'>".$TotalCONS."</td><td style='background-color:#999999;color:white;'>".(Round($TotalCONS/$TotalCRN,4)*100)."%</td><td style='width:200px;background-color:#999999;color:white;' ><img src='/images/view-graph.png' width='".( (Round($TotalCONS/$TotalCRN,4)*100) > 100 ? "102%" : (Round($TotalCONS/$TotalCRN,4)*100)."%")."' height='5px'></td>   
                                                               </tr>";
                                                         echo "<tr ><td colspan='6'>&nbsp;</td></tr>";
                                                         echo "</table>";                                                         
//STATISTICS DAILY                                                        
                                                        echo"<table id='statistics' style='margin-left:20px;float:left;width:48%;' border='1'>
                                                             <tr>
                                                                <th colspan=6 style='font-size:12px;width:100px;text-align:center;background-color:white;color:black;'><strong>DAILY (Current week & Previous week)</strong></th>
                                                             </tr>
                                                              
                                                             <tr>
                                                                <th style='width:80px;'>Collection<br>Date</th><th style='width:60px;'>User<br>ID</th><th >Total<br>Bookings</th><th >Total<br>Consignments</th><th>Conversion</th><th width='200px'>&nbsp;</th>
                                                             </tr>";
                                                              
                                                              $sem = 1;
                                                              $previous = '';
                                                              $firstrow = true;
                                                              $TotalCRN = 0;
                                                              $TotalCONS = 0;
                                                              $Day = "";
                                                              
                                                        while (($row = mysqli_fetch_array($sql11))) {

                                                              
                                                              if ($firstrow==false) {
                                                                If ($previous <> $row['CollectionDate']) {
  
                                                                 echo "<tr><td style=background-color:#999999;color:white;'><b>".$Day."</b></td><td style=background-color:#999999;color:white;'<b>TOTAL</b></td><td style=background-color:#999999;color:white;'>".$TotalCRN."</td><td style=background-color:#999999;color:white;'>".$TotalCONS."</td><td style='background-color:#999999;color:white;'>".(Round($TotalCONS/$TotalCRN,4)*100)."%</td><td style='width:200px;background-color:#999999;color:white;' ><img src='/images/view-graph.png' width='".( (Round($TotalCONS/$TotalCRN,4)*100) > 100 ? "102%" : (Round($TotalCONS/$TotalCRN,4)*100)."%")."' height='5px'></td></tr>";   
                                                                 $TotalCRN = 0;
                                                                 $TotalCONS = 0;
                                                                }                                                            
                                                              }
                                                              
                                                              $previous = $row['CollectionDate'];                                                               
                                                              $firstrow=false;
                                                              
                                                              
                                                              If ($sem == 3) {$sem = 1;}

                                                                echo "<tr class='line".$sem."'><td class='highlight".$sem."'>".$row['CollectionDate']."</td><td class='highlight".$sem."'>".$row['UserName']."</td><td>".$row['Total_CRN']."</td><td>".( $row['Total_CONS']=="" ? "0":$row['Total_CONS'])."</td><td>".( $row['Ratio']=="" ? "0":$row['Ratio'])."%</td><td><img src='/images/view-graph.png' width='".( $row['Ratio'] > 100 ? "102%" : $row['Ratio'])."%' height='5px'></td></tr>";
                                                       
                                                              $sem++;

                                                              $TotalCRN = $TotalCRN + $row['Total_CRN'];
                                                              $TotalCONS = $TotalCONS + $row['Total_CONS'];
                                                              
                                                              $Day = $row['CollectionDate'];                                                             


                                                        }    
                                                        
                                                         echo "<tr><td style=background-color:#999999;color:white;'><b>".$Day."</b></td><td style=background-color:#999999;color:white;'><b>TOTAL</b></td><td style=background-color:#999999;color:white;'>".$TotalCRN."</td><td style=background-color:#999999;color:white;'>".$TotalCONS."</td><td style='background-color:#999999;color:white;'>".(Round($TotalCONS/$TotalCRN,4)*100)."%</td><td style='width:200px;background-color:#999999;color:white;' ><img src='/images/view-graph.png' width='".( (Round($TotalCONS/$TotalCRN,4)*100) > 100 ? "102%" : (Round($TotalCONS/$TotalCRN,4)*100)."%")."' height='5px'></td></tr>";                                                        
                                                         echo "</table>";

//STATISTICS WEEKLY

                                                         echo "<table id='statistics' style='margin-left:20px;float:left;width:48%;' border='1'>
                                                             <tr>
                                                                <th colspan=6 style='font-size:12px;width:100px;text-align:center;background-color:white;color:black;'><strong>WEEKLY (Current week & Previous week)</strong></th>
                                                             </tr>
                                                               <tr>
                                                                  <th style='width:40px;'>Collection<br>YearWeek</th><th style='width:60px;'>User<br>ID</th><th >Total<br>Bookings</th><th >Total<br>Consignments</th><th>Conversion</th><th width='200px'>&nbsp;</th>
                                                               </tr>";
                                                              $sem = 1;
                                                              $previous = '';
                                                              $firstrow = true;
                                                              $TotalCRN = 0;
                                                              $TotalCONS = 0; 
                                                              $YearWeek = "";
                                                                                                                                                                                         
                                                        while (($row = mysqli_fetch_array($sql12))) {
                                                              
                                                              if ($firstrow==false) {
                                                                If ($previous <> $row['CollectionWeek']) {
  
                                                                 echo "<tr><td style=background-color:#999999;color:white;'><b>".$YearWeek."</b></td><td style=background-color:#999999;color:white;'><b>TOTAL</b></td><td style=background-color:#999999;color:white;'>".$TotalCRN."</td><td style=background-color:#999999;color:white;'>".$TotalCONS."</td><td style='background-color:#999999;color:white;'>".(Round($TotalCONS/$TotalCRN,4)*100)."%</td><td style='width:200px;background-color:#999999;color:white;' ><img src='/images/view-graph.png' width='".( (Round($TotalCONS/$TotalCRN,4)*100) > 100 ? "102%" : (Round($TotalCONS/$TotalCRN,4)*100)."%")."' height='5px'></td></tr>";   
                                                                 $TotalCRN = 0;
                                                                 $TotalCONS = 0; 
                                                                
                                                                                                                             
                                                                }                                                            
                                                              }

                                                              $previous = $row['CollectionWeek'];                                                               
                                                              $firstrow=false;
                                                                                                                            
                                                              If ($sem == 3) {$sem = 1;}

                                                                echo "<tr class='line".$sem."'><td class='highlight".$sem."'>".$row['CollectionWeek']."</td><td class='highlight".$sem."'>".$row['UserName']."</td><td>".$row['Total_CRN']."</td><td>".( $row['Total_CONS']=="" ? "0":$row['Total_CONS'])."</td><td>".( $row['Ratio']=="" ? "0":$row['Ratio'])."%</td><td><img src='/images/view-graph.png' width='".( $row['Ratio'] > 100 ? "102%" : $row['Ratio'])."%' height='5px'></td></tr>";
                                                       
                                                              $sem++;
                                                              
                                                              $TotalCRN = $TotalCRN + $row['Total_CRN'];
                                                              $TotalCONS = $TotalCONS + $row['Total_CONS'];
                                                              $YearWeek = $row['CollectionWeek'];                                                                          
                                                        }   
                                                         echo "<tr><td style=background-color:#999999;color:white;'><b>".$YearWeek."</b></td><td style=background-color:#999999;color:white;'><b>TOTAL</b></td><td style=background-color:#999999;color:white;'>".$TotalCRN."</td><td style=background-color:#999999;color:white;'>".$TotalCONS."</td><td style='background-color:#999999;color:white;'>".(Round($TotalCONS/$TotalCRN,4)*100)."%</td><td style='width:200px;background-color:#999999;color:white;' ><img src='/images/view-graph.png' width='".( (Round($TotalCONS/$TotalCRN,4)*100) > 100 ? "102%" : (Round($TotalCONS/$TotalCRN,4)*100)."%")."' height='5px'></td></tr>";
                                                         echo "   </table>
                                                            
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        ";
 
 
 
 
 }
  
 echo "</div></div>";
 echo "</body></html>"; 
?>