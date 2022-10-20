<?
//********************************	
// MENU DB
//********************************

function menu() {

		global $go, $lang, $go_menu_hl;

							$sql = mysql_query("SELECT a.id, b.word
															FROM cms_menu AS a, cms_menu_words AS b
															WHERE a.id_word = b.id AND b.lang = ".$lang );

				$menu = "<ul>";  
		while ($row = mysql_fetch_row($sql)) 
				{
        
      If ($go_menu_hl=="yes") {
            if ($go==$row[0] && !$go==0) {
              $menu .= "<li><a class='open' href='?go=".$row[0]."'>".$row[1]."</a></li>";
            } else {
              $menu .= "<li><a href='?go=".$row[0]."'>".$row[1]."</a></li>";
            }
        } elseif ($go_menu_hl=="no") {
              $menu .= "<li><a href='?go=".$row[0]."'>".$row[1]."</a></li>";        
        }
				}
				$menu .= "</ul>";  
        				
		return $menu;
		}


//********************************	
// CATEGORY IMAGE - go images
//********************************

function cat_image() {

		global $go,$go_images,$go_images_name,$go_images_ext;

									 if ($go_images=="yes") {
									       $cat_image = "<IMG ALT='' SRC='images/".$go_images_name."_".$go.".".$go_images_ext."'>";
                         }
                    elseif ($go_images=="no") {
									       $cat_image = "<IMG ALT='' SRC='images/".$go_images_name.".".$go_images_ext."'>";
                         }
                         
      

        				
		return $cat_image;
		}


//********************************	
// CONTENT
//********************************

function content() 	{

// ------------
// EXAMPLE
// ------------

		global $go, $lang, $setup_default_go;

									 if ($setup_default_go=="yes") {
									       include("includes/php/go_default.php");
                         }
                    else {
									       include("includes/php/go_".$setup_default_go.".php");
                         }
		return $content;								
		}

	
?>
