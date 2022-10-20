<?
// **************************************************
// Get Variables From URL
// **************************************************

// VARIABLES
// -----------
    global $HTTP_POST_VARS;
    global $HTTP_GET_VARS;
    global $_SESSION;

    $go 			  = ReadUrl("go",2);
  	$lang 			= ReadUrl("lang",1);
    $action     = ReadUrl("action",0);
    $id         = ReadUrl("id",0);
    $result     = ReadUrl("result",0);

    if (isset($_POST['myusername'])) { $myusername = $_POST['myusername'];}
    if (isset($_POST['mypassword'])) { $mypassword = $_POST['mypassword'];}

	  // *******************************************************
		// Read/Analyze URL parameters
		// *******************************************************
	

		function ReadUrl($UrlParam,$DefVal)
			{

				if ( isset($_GET[$UrlParam]) ) {
        
                if ( $_GET[$UrlParam]=="" | !is_numeric($_GET[$UrlParam]) ){
        					$ReadUrl = $DefVal;}
        				else {
         					$ReadUrl = $_GET[$UrlParam];}

	         } else {
                  $ReadUrl = $DefVal;}
					
          return $ReadUrl;
			}


// **************************************************
//  Session Variable
// **************************************************
//	session_start();

//if (!isset($HTTP_SESSION_VARS['sid'])) {
  if (isset($_POST['Submit'])) {

      $myusername = stripslashes($myusername);
      $mypassword = stripslashes($mypassword);
      $myusername = mysql_real_escape_string($myusername);
      $mypassword = mysql_real_escape_string($mypassword);

    $result=mysql_query("SELECT * FROM cms_admin WHERE username='$myusername' and password='$mypassword'");

    // Mysql_num_row is counting table row
    $login_count=mysql_num_rows($result);
    // If result matched $myusername and $mypassword, table row must be 1 row
    
    if($login_count==1){
    // Register $myusername, $mypassword and redirect
      if (session_id() == "") session_start(); 
      
      $_SESSION['sid']       = session_id();
      $_SESSION['username']  = $myusername; 

    }
    
}
//********************************	
// MENU DB
//********************************

function menu() {

		global $go, $lang, $_SESSION;

							$sql = mysql_query("SELECT a.id, b.word, a.admin
															FROM cms_menu AS a, cms_menu_words AS b
															WHERE a.id_word = b.id AND b.lang = ".$lang);

 				$menu = "<div class='header'>
                  <a href='?go=".$go."&action=1&PHPSESSID=".@$_SESSION['sid']."'><img title='Pridať záznam' align='left' height='40' border='0' src='images/load.png'></a> 
                  <a href='?go=".$go."&action=6&PHPSESSID=".@$_SESSION['sid']."'><img title='Odhlásiť' align='right' height='40' border='0' src='images/exit.png'></a> 
                  a.sk
                  </div>";
                  
                  
				$menu .= "<div class='items'><ul>";  
		while ($row = mysql_fetch_row($sql)) 
				{
        
            if (isset($_SESSION['sid']['username']) AND $_SESSION['sid']['username'] == "admin") {
                if ($go==$row[0]) {
                  $menu .= "<li><a class='open' href='?go=".$row[0]."&action=0&PHPSESSID=".@$_SESSION['sid']."'>".$row[1]."</a></li>";
                } else {
                  $menu .= "<li><a href='?go=".$row[0]."&action=0&PHPSESSID=".@$HTTP_SESSION_VARS['sid']."'>".$row[1]."</a></li>";
                }
            } else {
              if ($row[2]==1) {
                if ($go==$row[0] && !$go==0) {
                  $menu .= "<li><a class='open' href='?go=".$row[0]."&action=0&PHPSESSID=".@$_SESSION['sid']."'>".$row[1]."</a></li>";
                } else {
                  $menu .= "<li><a href='?go=".$row[0]."&action=0&PHPSESSID=".@$_SESSION['sid']."'>".$row[1]."</a></li>";
                }
              }
            }
            
        
				}
				$menu .= "</ul></div>";  
        				

        				
        				
		return $menu;
		}


//********************************	
// CONTENT
//********************************

function content() 	{

// ------------
// EXAMPLE
// ------------

		global $go, $action, $_SESSION;

//									 if ($setup_default_go AND $go=="") {
//									       include("includes/php/go_".$setup_default_go.".php");
//                         }
//                    else {
									       include("includes/php/go_default.php");
//                         }

									       //include("includes/php/go_".$go.".php");
		return $content;								
		}

	

//*******************
// Including Classes
//*******************

	include("includes/php/class_PhpLib.php");
	

//**************************************************************
// Generate Template/Page ->  Main Menu + Main & Local Template
//**************************************************************
	function ShowPage($TplFile)
	{
		global $go, $action;
		global $HTTP_POST_VARS;
    global $HTTP_GET_VARS;
    global $_SESSION;
    
		// ---- PHPLib	
		$template = new Template("includes/html/");

		// + Main Template
		$template->set_file("Tpl",$TplFile);

//         if ($TplFile <> "tpl_homepage.html") {
              
          			// Content + Menu Template
       					$template->set_var("Menu",menu()); 
       					$template->set_var("Content",content()); 
              
//             }
		
		// + Finalize Whole Template To Page
    $template->parse("FINALPAGE","Tpl"); 
    $template->p("FINALPAGE"); 
	}


?>
