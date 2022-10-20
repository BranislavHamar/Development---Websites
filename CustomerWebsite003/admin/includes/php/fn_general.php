<?


// **************************************************
// Get Variables From URL
// **************************************************

mysql_query( "SET NAMES 'utf8' " );


// VARIABLES
// -----------
    global $HTTP_POST_VARS;
    global $HTTP_GET_VARS;
    global $HTTP_SESSION_VARS;

    $go 			  = ReadUrl("go",3);
    $subgo 			= ReadUrl("subgo",0);
  	$lang 			= ReadUrl("lang",1);
    $action     = ReadUrl("action",0);
    $id         = ReadUrl("id",0);
    $result     = ReadUrl("result",0);
    $typ        = ReadUrl("typ",1);

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

    
    $sql=mysql_query("SELECT * FROM cms_admin WHERE username='$myusername' and password='$mypassword'");

    // Mysql_num_row is counting table row
    $login_count=mysql_num_rows($sql);
    // If result matched $myusername and $mypassword, table row must be 1 row
    
    if($login_count==1){
    // Register $myusername, $mypassword and redirect
      if (session_id() == "") session_start(); 
      
//session_register("sid");
//session_register("username");
      $_SESSION['sid']       = session_id();
      $_SESSION['username']  = $myusername;
//      $HTTP_SESSION_VARS['sid']       = $_SESSION['sid'];
//      $HTTP_SESSION_VARS['username']  = $_SESSION['username'];
      $HTTP_SESSION_VARS['sid']       = session_id();
      $HTTP_SESSION_VARS['username']  = $myusername; 
//      $_SESSION['sid']       = session_id();
//      $_SESSION['username']  = $myusername;

    }
   
}
 if (session_id() != ""){
      $HTTP_SESSION_VARS['sid']       = $_SESSION['sid'];
      $HTTP_SESSION_VARS['username']  = $_SESSION['username'];
}

//********************************	
// MENU DB
//********************************

function submenu($cat_go) {

		global $HTTP_SESSION_VARS, $lang, $go, $subgo;
		$sql = "";
		 $submenu ="";
                      $sql = mysql_query("SELECT a.id, b.word
															FROM cms_menu AS a, cms_menu_words AS b
															WHERE a.id_word = b.id 
                                    AND (a.id_parent = ".$cat_go." AND a.id_parent <> 0)
                                    AND b.lang = ".$lang." 
                              ORDER BY a.id DESC");

															//if (!$HTTP_SESSION_VARS['username'] == "admin") {
                              //          $sql .= " AND a.admin = 1 ";
                                //          }; 	

											                       
                                                        
                        $submenu .= "<ol>";
                        	while ($row = mysql_fetch_row($sql)) 
                      				{
                          $submenu .= "<li><a ";
                          
                          If ($row[0]==$subgo) {
                                $submenu .=" class='open' "; 
                                
                                };
                           $submenu .= "href='?go=5&subgo=".$row[0]."&lang=".$lang."&action=0&PHPSESSID=".@$HTTP_SESSION_VARS['sid']."'>".$row[1]."</a></li>";
                              }
                        $submenu .= "</ol>";
                        			

		return $submenu;
		}


function menu() {

		global $go, $HTTP_SESSION_VARS, $lang, $result;

//if (isset($HTTP_SESSION_VARS['username']) AND $HTTP_SESSION_VARS['username'] == "admin") {

//                      $sql = "SELECT a.id, b.word
//															FROM cms_menu AS a, cms_menu_words AS b
//															WHERE a.id_word = b.id AND (a.id_parent = 0 OR a.id_parent IS NULL) AND b.lang = ".$lang."
//                              ORDER BY a.id_parent ASC, a.priority ASC 
//                              ";
//} else {
                      $sql = "SELECT a.id, b.word
															FROM cms_menu AS a, cms_menu_words AS b
															WHERE a.id_word = b.id AND (a.id_parent = 0 OR a.id_parent IS NULL) AND b.lang = ".$lang." AND a.admin = 1
                              ORDER BY a.id_parent ASC, a.priority ASC 
                              ";


//}

                      $sql = mysql_query($sql);


        $menu  = "";
           
 				$menu .= "<div class='menu-header'>
         
                   <br><br>
                   <form action='' method='get'>
                      <select name='lang'>";
                         $menu .= "<option "; if ($lang==1) {$menu .=" selected='yes' ";} $menu .= "value='1'>(SK) slovensky</option>";
                         $menu .= "</select>
                   <input type='submit' value='OK'>  
                   </form>
                   </div>";                  
                  
				$menu .= "<div class='menu-items'><ul>";
        
        
          
                      		while ($row = mysql_fetch_row($sql)) 
                      				{

                                        $menu .= "<li><a ";
                                        
                                      If ($row[0]==$go) {
                                            $menu .=" class='open' "; 
                                
                                        };
                                        
                                        
                                       $menu .= " href='?go=".$row[0]."&lang=".$lang."&action=0&PHPSESSID=".@$HTTP_SESSION_VARS['sid']."'>".$row[1]."</a>";
                                        
                                          $menu .= submenu($row[0]);
                                         
                                          };
                                        $menu .= "</li>";
  
                      				
         $menu .= "</ul></div>";  
        				

        				$menu .= "<div class='menu-bottom'>";
                
                              

                
               $menu .= "</div>";
        				
        				
        				
       				
		return $menu;
		}

//********************************	
// CONTENT
//********************************

function content() 	{

		global $go, $action, $lang, $HTTP_SESSION_VARS, $result, $subgo;

/// MENU buttons

                  @$content .= "<div id='content-header'>";

                              @$content .= "<span class='website'>www.h.sk</span><br>";  

                              
                                    //// 1 -> default content text
                                    //// 2 -> galeria
            
            
                                           $sql = mysql_query("SELECT a.typ
                      															FROM cms_menu AS a 
                                                    WHERE a.id=".$go);
                                        
                                        while ($row = mysql_fetch_row($sql)) 
                                      		      	{
                                			
                                          			       If ($row[0]==1) {
                                                       
                                                          @$content .= "<a href='?go=".$go."&subgo=".$subgo."&lang=".$lang."&action=1&PHPSESSID=".@$HTTP_SESSION_VARS['sid']."&typ=1&id=0'><img title='Pridať text' height='40' border='0' src='images/load-txt.gif'></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                                       
                                                       } else if ($row[0]==2) {
                                                       
                                                          If ($go==5 AND !$subgo==0 AND ($subgo<17 OR $subgo>19)) {
                                                          @$content .= "<a href='?go=".$go."&subgo=".$subgo."&lang=".$lang."&action=1&PHPSESSID=".@$HTTP_SESSION_VARS['sid']."&typ=2&id=0'><img title='Pridať obrázok' height='40' border='0' src='images/load-img.gif'></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                                          }
                                                       };
                                			
                                                  };


                            @$content .= "<a href='?go=".$go."&subgo=".$subgo."&lang=".$lang."&action=6&PHPSESSID=".@$HTTP_SESSION_VARS['sid']."'><img title='Odhlásiť' height='40' border='0' src='images/exit.gif'></a>";
                                
                  @$content .= "</div>";
                  
                  @$content .= "<div id='list'>"; 
                  
                              If ($result == 1) {
                    $content .= "<p class='alert'>Váš záznam bol aktualizovaný - ".date("d.m.y / H:i:s", time())."</p>";
            } Elseif ($result == 2) {
                    @$content .= "<p class='alert'>Váš záznam bol pridaný - ".date("d.m.y / H:i:s", time())."</p>";
            } Elseif ($result == 3) {
                    @$content .= "<p class='alert'>Váš záznam bol vymazaný - ".date("d.m.y / H:i:s", time())."</p>";
            };
                  
                  
                  
                  If ($go==0) {

                        //// MENU ITEMS
                        
                          include("includes/php/go_0.php");

                    } else If ($go==4) {

                        //// CATEGORY IMAGES
                        
                          include("includes/php/go_4.php");
                  
                    } else If ($go==5) {

                        //// CATEGORY IMAGES
                        
                          include("includes/php/go_5.php");
                          
                    } else If ($go==6) {

                        //// CATEGORY IMAGES
                        
                          include("includes/php/go_6.php");
                  
                    } else {
                  
                        //// 1 -> default content text
                        //// 2 -> galeria


                               $sql = mysql_query("SELECT a.typ
          															FROM cms_menu AS a 
                                        WHERE a.id=".$go);
                            
                            while ($row = mysql_fetch_row($sql)) 
                          		      	{
                    			include("includes/php/go_default_".$row[0].".php");
                                      };
                    
                    };



                @$content .= "</div>";



                @$content .= "<div id='content-bottom'></div>";


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
    global $HTTP_SESSION_VARS;

		// ---- PHPLib	
		$template = new Template("includes/html/");

		// + Main Template
		$template->set_file("Tpl",$TplFile);


if (isset($HTTP_SESSION_VARS['username'])) {
              
          			// Content + Menu Template
       					$template->set_var("Menu",menu()); 
       					$template->set_var("Content",content()); 
              
};
		
		// + Finalize Whole Template To Page
    $template->parse("FINALPAGE","Tpl"); 
    $template->p("FINALPAGE"); 
	}


?>
