<?
// **************************************************
//  Security setup
// **************************************************
    // Adds X-Frame-Options to HTTP header, so that page can only be shown in an iframe of the same site.
    header('X-Frame-Options: SAMEORIGIN'); // FF 3.6.9+ Chrome 4.1+ IE 8+ Safari 4+ Opera 10.5+
    
// **************************************************
//  Session Variable
// **************************************************
//	session_start();

// **************************************************
// Get Variables From URL
// **************************************************

// VARIABLES
// -----------

    $senderaccount      = ReadParamValue("senderaccount","","1");
    $crn                = ReadParamValue("crn","","0");
  	$lang 			        = ReadParamValue("lang","1","1");
  	$flagprinted        = ReadParamValue("flagprinted","","1");
    $rowid              = ReadParamValue("rowid","","1");
    
	  // *******************************************************
		// Read/Analyze URL OR POST parameters
		// *******************************************************
		
		
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


//********************************	
// CODE FOR PRINT
//********************************

function print_code($x) {

      If ($x=="js") {
        $print_code = " onload='window.print();' ";      
      } ElseIf ($x=="css") {
        $print_code = " <link rel='stylesheet' href='includes/css/print.css' type='text/css' media='print' > ";
      } 
      
      return $print_code;
}



//********************************	
// WORDS
//********************************

function word($filter) {

    global $lang, $DB_connection;
    global $cfg_Sender_Country_Code;
        
          If ($filter <> "all") {
        	   
             $sql = mysqli_query($DB_connection,"SELECT a.id, a.lang_".$lang."
															FROM cc_".$cfg_Sender_Country_Code."_cfg_words AS a
                              WHERE a.id IN (".$filter.")
                              ORDER BY a.id ASC" );          
          
          } elseif ($filter == "all") {

             $sql = mysqli_query($DB_connection,"SELECT a.id, a.lang_".$lang."
															FROM cc_".$cfg_Sender_Country_Code."_cfg_words AS a
                              ORDER BY a.id ASC" );

          }
  
  
          if (mysqli_num_rows($sql) > 0) {
    		      while ($row = mysqli_fetch_row($sql)) 
    				  {
                 $id[$row[0]] =  $row[1];
    				  } 
          } else {
            header("Location: index.php");
            exit();
          }
  
      return $id;

}

//********************************	
// HEADER MENU
//********************************

function menu() {

    global $word, $lang;
    global $cfg_Sender_Country_Code, $cfg_links_Top;	
		
        $menu="<ul>
                <li><a href='".$cfg_links_Top[0]."' tabindex='-1'>".$word['1000']."</a></li>
                <li><a href='".$cfg_links_Top[1]."' tabindex='-1'>".$word['2000']."</a></li>
                <li><a href='".$cfg_links_Top[2]."' tabindex='-1'>".$word['3000']."</a></li>
                <li><a href='".$cfg_links_Top[3]."' tabindex='-1'>".$word['4000']."</a></li>
                <li><a href='".$cfg_links_Top[4]."' tabindex='-1'>".$word['5000']."</a></li>
              </ul>";
    
    return $menu;
		}

//********************************	
// FOOTER
//********************************

function footer() {

    global $word, $lang;
    global $cfg_links_Bottom;	
		
        $footer="<ul>
                 <li><a href='".$cfg_links_Bottom[0]."' tabindex='-1'>".$word['10009']."</a></li>
                 <li> | </li>
                 <li><a href='".$cfg_links_Bottom[1]."' tabindex='-1'>".$word['10010']."</a></li>
                 <li> | </li>
                 <li><a href='".$cfg_links_Bottom[2]."' tabindex='-1'>".$word['10011']."</a></li>
                 </ul>
                 <br><br>".$word['10012']."
              ";
    
    return $footer;
		}

//*******************
// Including Classes
//*******************

	include("includes/php/class_PhpLib.php");


//******************************************************************
// Generate Template/Page ->  Header Menu + Main Template + Content 
//******************************************************************
	function ShowPage($TplFile)
	{
		global $crn, $senderaccount, $lang, $flagprinted, $checkvalidate, $rowid;
    global $cfg_Sender_Country_Code, $cfg_links_Top, $DB_connection, $cfg_con_source_PDF, $cfg_links_myTNT, $cfg_csfl_dateseparator, $cfg_csfl_dateformat, $cfg_con_email_personal, $cfg_con_email, $cfg_con_email_bounce, $cfg_header_code, $cfg_con_mkt_detailedmanifest_media, $cfg_con_mkt_detailedmanifest_start, $cfg_con_mkt_detailedmanifest_end;
    
		// ---- PHPLib	
		$template = new Template("includes/html/");

		// + Main Template
		$template->set_file("Tpl",$TplFile);
              
          			// Content + Menu Template
                    $template->set_var("External_Code",$cfg_header_code); 
                    $template->set_var("Menu",menu()); 
                    $template->set_var("Link_myTNT",$cfg_links_myTNT); 
          					$template->set_var("Content_Web",content_web());                
                    $template->set_var("Footer",footer()); 
                    
                If (isset($_POST["finish"]) AND $checkvalidate=="") {
                    $template->set_var("Print_CSS",print_code("css"));
                    $template->set_var("Print_JS",print_code("js"));
          					$template->set_var("Content_Docs",content_docs());
                } 
                
                		
		// + Finalize Whole Template To Page
    $template->parse("FINALPAGE","Tpl"); 
    $template->p("FINALPAGE"); 
	}
	
?>
