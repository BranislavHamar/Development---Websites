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
        mysqli_query($DB_Connection,"SET NAMES 'utf8' " );


          $where = "";
          $url = "";
                    
          foreach ($_GET as $key => $value) {
          
            If ($where == "" ) {
              $where .= " WHERE 1=1 ";
            }          
            
            If ($key <> "submit" AND $key <> "page" ) {
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


                                         








            echo "<html><head><meta http-equiv='content-type' content='text/html; charset=utf-8'><meta http-equiv='refresh' content='60'><title>TNT - Cooperative connote</title>";
            echo "<style type='text/css' >
                  #form
                  {
                  font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;
                  font-size: 12px;
                  width:100%;
                  border-collapse:collapse;
                  }
                  #form td, #form th 
                  {
                  font-size:1.2em;
                  border:1px solid #FF954F;
                  padding:3px 4px 2px 7px;
                  }
                  #form th 
                  {
                  font-size:1.1em;
                  text-align:left;
                  padding-top:5px;
                  padding-bottom:4px;
                  background-color:#FF954F;
                  color:#fff;
                  }
                  #form tr.alt td 
                  {
                  color:#000;
                  background-color:#FFC096;
                  }
                  </style>
                  
                  <script>
                  var interval;
                  var minutes = 0;
                  var seconds = 59;
                  window.onload = function() {
                      countdown('countdown');
                  }
              
                  function countdown(element) {
                      interval = setInterval(function() {
                          var el = document.getElementById(element);
                          if(seconds == 0) {
                              if(minutes == 0) {
                                  el.innerHTML = 'Refreshing page. Please wait...!';                    
                                  clearInterval(interval);
                                  return;
                              } else {
                                  minutes--;
                                  seconds = 60;
                              }
                          }
                          if(minutes > 0) {
                              var minute_text = minutes + (minutes > 1 ? ' minutes' : ' minute');
                          } else {
                              var minute_text = '';
                          }
                          var second_text = seconds > 1 ? 'seconds' : 'second';
                          el.innerHTML = 'Next page refresh in ' + minute_text + ' ' + seconds + ' ' + second_text + '.';
                          seconds--;
                      }, 1000);
                  }
                  </script>
                  ";
            echo "</head><body>";
            echo "<h1>Monitor</h1>";
            echo "<table id='form' border=1>";
            echo "<tr><th style='width:40px;'>ID</th><th style='width:50px;'>User<br>ID</th><th style='width:50px;'>Booking<br>Code</th><th style='width:60px;'>Consignment<br>Number</th><th style='width:50px;'>Collection<br>Date</th><th>Sender<br>Email</th><th>Sender<br>Contact</th><th style='width:100px;'>Sender<br>Telephone</th><th style='width:50px;'>Sender<br>Account</th><th>Sender<br>Name</th><th>Connote<br>Printed</th><th>Data<br>Sent</th><th>Show<br>Link</th><th>Send<br>Link</th></tr>";
                 
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

            echo "<tr><form action='' method='get'><td><input type='text' name='id' value='".@$_GET['id']."' style='width:100%;'></td><td><input type='text' name='Username' value='".trim(@$_GET['Username'])."' style='width:100%;'></td><td><input type='text' name='BookingNumber' value='".@$_GET['BookingNumber']."' style='width:100%;'></td><td><input type='text' name='ConsignmentNumber' value='".@$_GET['ConsignmentNumber']."' style='width:100%;'></td><td><input type='text' name='CollectionDate' value='".@$_GET['CollectionDate']."' style='width:100%;'></td><td><input type='text' name='SenderEmail' value='".@$_GET['SenderEmail']."' style='width:100%;'></td><td><input type='text' name='SenderContact' value='".trim(@$_GET['SenderContact'])."' style='width:100%;'></td><td><input type='text' name='SenderPhone' value='".trim(@$_GET['SenderPhone'])."' style='width:100%;'></td><td><input type='text' name='SenderAccount' value='".trim(@$_GET['SenderAccount'])."' style='width:100%;'></td><td><input type='text' name='Sendername' value='".trim(@$_GET['Sendername'])."' style='width:100%;'></td><td align=center><select name='FlagPrinted' style='width:50px;'> <option value='' ".$FlagPrintedSelected[0].">&nbsp;</option><option value='0' ".$FlagPrintedSelected[1].">No</option><option value='1' ".$FlagPrintedSelected[2].">Yes</option></select></td><td align=center><select style='width:50px;' name='FlagDataSent'> <option value='' ".$FlagDataSentSelected[0].">&nbsp;</option><option value='0' ".$FlagDataSentSelected[1].">No</option><option value='1' ".$FlagDataSentSelected[2].">Yes</option></select></td><td align=center colspan=2><input type='hidden' name='page' value='".$pagenum."' size='3'><input style='width:100%;' type='submit' name='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Filter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ></td></form></tr>";

            
            function encodeURI($string) {
                $entities = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
                $replacements = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
                return str_replace($entities, $replacements, urlencode($string));
            }
            
            while (($row = mysqli_fetch_array($sql))) {
            
                  $ConNumber = $row['ConsignmentNumber'];

                  If ($ConNumber <> "") {
                      $ConNumber = "<a title='Track shipment...' target='_blank' href='".$cfg_con_message[3].$ConNumber."'>".$ConNumber."</a>";
                  }
                  
                  
                      
                  
                  echo "<tr><td>".$row['id']."</td><td title='".$row['UserName']."'>".$row['UserName']."</td><td title='".$row['LastUpdated']."'>".$row['BookingNumber']."</td><td>".$ConNumber."&nbsp;</td><td>".$row['CollectionDate']."</td><td>".$row['SenderEmail']."&nbsp;</td><td>".$row['SenderContact']."&nbsp;</td><td>".$row['SenderPhone']."</td><td>".$row['SenderAccount']."</td><td>".$row['SenderName']."</td><td align=center><img src='/images/".$row['FlagPrinted'].".png'></td><td align=center><img src='/images/".$row['FlagDataSent'].".png'></td><td align=center><a target='_blank' href='/?lang=1&crn=".$row['BookingNumber']."&senderaccount=".$row['SenderAccount']."&rowid=".$row['id']."'>+&nbsp;>>>&nbsp;+</a></td><td align=center><a href='mailto:".$row['SenderEmail']."?subject=".urlencode($cfg_csfl_subject).$row['BookingNumber']."&body=".urlencode($cfg_csfl_message[2]).urlencode("/?lang=1&crn=").$row['BookingNumber'].urlencode("&senderaccount=").$row['SenderAccount'].urlencode("&rowid=").$row['id']."'>+&nbsp;@@@&nbsp;+</a></td></tr>";
            
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
                      $paginationCtrls .= "<a href='?page=".$previous.$url."'>Previous</a> &nbsp; &nbsp; ";
                      // Render clickable number links that should appear on the left of the target page number
                      for($i = $pagenum-4; $i < $pagenum; $i++){
                          if($i > 0){
                              $paginationCtrls .= "<a href='?page=".$i.$url."'>".$i."</a> &nbsp; ";
                          }
                      }
                  }
                  // Render the target page number, but without it being a link
                  $paginationCtrls .= "".$pagenum." &nbsp; ";
                  // Render clickable number links that should appear on the right of the target page number
                  for($i = $pagenum+1; $i <= $last; $i++){
                      $paginationCtrls .= "<a href='?page=".$i.$url."'>".$i."</a> &nbsp; ";
                      if($i >= $pagenum+4){
                          break;
                      }
                  }
                  // This does the same as above, only checking if we are on the last page, and then generating the "Next"
                  if ($pagenum != $last) {
                      $next = $pagenum + 1;
                      $paginationCtrls .= " &nbsp; &nbsp; <a href='?page=".$next.$url."'>Next</a> ";
                  }
              }


 echo "<div style='margin-top:30px;width:90%;text-align:center;'><br>";
 echo $paginationCtrls; 
 echo "<p>".$pagetext." (".$rows." records)</p>";
 echo "<div style='font-size:9px;' id='countdown'></div>";
 echo "<p><div style='font-size:9px;' >Your IP: ".$_SERVER['REMOTE_ADDR']."</div></p>";
 echo "</div>";  
 echo "</body></html>"; 
?>