<?
// **************************************************
//  Session Variable
// **************************************************
//	session_start();

// **************************************************
// Get Variables From URL
// **************************************************

// VARIABLES
// -----------

    $go 			  = ReadUrl("go",0);
  	$lang 			= ReadUrl("lang",1);
//	$page 			= ReadUrl("page",0);
//	$doc        = ReadUrl("doc",0);
//	$search 		= trim($_GET["search"]);

// URL
// -----------	

//  $url			= "?go=".$go;
//  $url			= "?go=".$go."&lang=".$lang."&PHPSESSID=".session_id();
//	if ($search) { $url = $url."&search=".$search;}


    // *******************************************************
		//  Default layout of content 'go' pages or different
		// *******************************************************

      switch ($go) {
    //   SELECT SPECIAL PAGE TO CODE
    //     case 0:  //EXAMPLE 
    //     case 1:  //EXAMPLE 
         case 1:  //EXAMPLE 
            $setup_default_go = $go;
            break;
    //   ALL/OTHER DEFAULT
        default: 
             $setup_default_go    = "yes";
    //       $setup_default_go    = "no";
          }
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


//*******************
// Including Classes
//*******************

	include("includes/php/class_PhpLib.php");


//**************************************************************
// Generate Template/Page ->  Main Menu + Main & Local Template
//**************************************************************
	function ShowPage($TplFile)
	{
		global $go;
	  global $setup_default_go;

		// ---- PHPLib	
		$template = new Template("includes/html/");

		// + Main Template
		$template->set_file("Tpl",$TplFile);

//         if ($TplFile <> "tpl_homepage.html") {
              
          			// Content + Menu Template
       					$template->set_var("HeaderImage",cat_image()); 
       					$template->set_var("Menu",menu()); 
       					$template->set_var("Content",content()); 
              
//             }
		
		// + Finalize Whole Template To Page
    $template->parse("FINALPAGE","Tpl"); 
    $template->p("FINALPAGE"); 
	}
	
?>
