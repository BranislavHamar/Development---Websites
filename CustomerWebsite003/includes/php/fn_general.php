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

    $go 			  = ReadUrl("go",1);
    $subgo 			= ReadUrl("subgo",0);    
//  $action		  = ReadUrl("action",0);
//	$page 			= ReadUrl("page",0);
//	$lang 			= ReadUrl("lang",1);
  	$doc        = ReadUrl("doc",0);
//	$search 		= trim($_GET["search"]);

// URL
// -----------	

//	  $url			= "?go=".$go;
//  $url			= "?go=".$go."&lang=".$lang."&PHPSESSID=".session_id();
//	if ($search) { $url = $url."&search=".$search;}


    // *******************************************************
		//  Default layout of content 'go' pages or different
		// *******************************************************

        switch ($go) {
    //   SELECT SPECIAL PAGE TO CODE
           case 1:  
            $setup_default_go = $go;
                break;
           case 3:  
            $setup_default_go = $go;
                break;
           case 4:  
            $setup_default_go = $go;
                break;
           case 5:  
            $setup_default_go = $go;
                break;
           case 6:  
            $setup_default_go = $go;
                break;
          case 7:  
            $setup_default_go = $go;
                break;

    //   ALL/OTHER DEFAULT
           default: 
             $setup_default_go    = "yes";
    //       $setup_default_go    = "no";
            }



If (@$_POST['odoslat']) {


      $email = stripslashes($_POST['email']);
      $email = mysql_real_escape_string($email);

  If (  strlen($email) > 8 AND strpos($email, '@') !== false AND strpos($email, '.') !== false) {

                                           
          
                              $sql = mysql_query("SELECT a.content
															                    FROM cms_content AS a
															                    WHERE a.content = '".$email."' " );
                                           
                          If (mysql_num_rows($sql)==0) {	                               
                                           
                                           
                                        $result = mysql_query("INSERT INTO cms_content
                                                  (id_menu, id_lang, content, typ) VALUES
                                                  ('9','1','".$email."','1')") or die(mysql_error());                            
                              
                              }

        $form_result = "yes";

  } else {

        $form_result = "no";
        
  }
 
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


//********************************	
// MENU DB
//********************************
mysql_query( "SET NAMES 'utf8' " );

function menu() {

		global $go;

							$sql = mysql_query("SELECT a.id, b.word
															FROM cms_menu AS a, cms_menu_words AS b
															WHERE a.id_word = b.id AND b.lang = 1 AND a.id_parent = 0" );

				$menu = "<ul>";  
		while ($row = mysql_fetch_row($sql)) 
				{
        
            if ($go==$row[0] && !$go==0) {
              $menu .= "<li class='active' ><a href='?go=".$row[0]."#menu".$row[0]."'>".$row[1]."</a></li>";
            } else if ($row[0]==6) {
              $menu .= "<li><a class='kniha-navstev'  href='?go=".$row[0]."#menu".$row[0]."'>".$row[1]."</a></li>"; 
            } else if ($go==$row[0] && !$go==6) {              
              $menu .= "<li ><a class='active2'  href='?go=".$row[0]."#menu".$row[0]."'>".$row[1]."</a></li>";                          
            } else if ($row[0]==5) {
              $menu .= "<li><a  href='?go=".$row[0]."&subgo=16#menu".$row[0]."'>".$row[1]."</a></li>";
            } else {
              $menu .= "<li><a  href='?go=".$row[0]."#menu".$row[0]."'>".$row[1]."</a></li>";
            }

				}
				$menu .= "</ul>";  
	
		return $menu;
		}

$meniny ="";
function meniny() {

                  $mena=array('Nov?? rok', 'Alexandra', 'Daniela', 'Drahoslav', 'Andera', 'Ant??nia', 'Bohuslav(a)', 'Sever??n', 'Alexej', 'D????a', 'Malv??na', 'Ernest', 'Rastislav', 'Radovan', 'Dobroslav', 'Krist??na', 'Nata??a', 'Bohdana', 'Drahom??ra', 'Dalibor', 'Vincent', 'Zora', 'Milo??', 'Timotej', 'Gejza', 'Tamara', 'Bohu??', 'Alfonz', 'Ga??par', 'Ema', 'Emil', 'Tatiana', 'Erik(a)', 'Bla??ej', 'Veronika', 'Ag??ta', 'Dorota', 'Vanda', 'Zoja', 'Zdenko', 'Gabriela', 'Dezider', 'Perla', 'Arp??d', 'Valent??n', 'Pravoslav', 'Ida', 'Miloslava', 'Jarom??r', 'Vlasta', 'L??via', 'Eleon??ra', 'Etela', 'Roman(a)', 'Metej', 'Frederik(a)', 'Viktor', 'Alexander', 'Zlatica', 'Radom??r', 'Alb??n', 'Ane??ka', 'Bohumil(a)', 'Kazim??r', 'Fridrich', 'Radoslav', 'Tom????', 'Alan(a)', 'Franti??ka', 'Branislav, Bruno', 'Angela, Angelika', 'Gregor', 'Vlastimil', 'Matilda', 'Svetlana', 'Boleslav', '??ubica', 'Eduard', 'Jozef', 'V????azoslav', 'Blahoslav', 'Be??adik', 'Adri??n', 'Gabriel', 'Mari??n', 'Emanuel', 'Alena', 'So??a', 'Miroslav', 'Vieroslava', 'Benjam??n', 'Hugo', 'Zita', 'Richard', 'Izidor', 'Miroslava', 'Irena', 'Zolt??n', 'Albert', 'Milena', 'Igor', 'J??lius', 'Estera', 'Ale??', 'Just??na', 'Fedor', 'Dana, Danica', 'Rudolf', 'Val??r', 'Jela', 'Marcel', 'Erv??n', 'Slavom??r', 'Vojtech', 'Juraj', 'Marek', 'Jaroslava', 'Jaroslav', 'Jarmila', 'Lea', 'Anast??zia', 'Sviatok pr??ce', '??igmunt', 'Galina', 'Flori??n', 'Lesana, Lesia', 'Herm??na', 'Monika', 'Ingrida', 'Roland', 'Vikt??ria', 'Bla??ena', 'Pankr??c', 'Serv??c', 'Bonif??c', '??ofia', 'Svetoz??r', 'Gizela', 'Viola', 'Gertr??da', 'Bernard', 'Zina', 'J??lia, Juliana', '??elm??ra', 'Ela', 'Urban', 'Du??an', 'Iveta', 'Viliam', 'Vilma', 'Ferdinand', 'Petronela, Petrana', '??aneta', 'X??nia', 'Karol??na', 'Lenka', 'Laura', 'Norbert', 'R??bert', 'Medard', 'Stanislava', 'Margar??ta', 'Dobroslava', 'Zlatko', 'Anton', 'Vasil', 'V??t', 'Blanka', 'Adolf', 'Vratislav(a)', 'Alfr??d', 'Val??ria', 'Alojz', 'Paul??na', 'Sid??nia', 'J??n', 'Tade????', 'Adri??na', 'Ladislav(a)', 'Be??ta', 'Peter a Pavol, Petra', 'Mel??nia', 'Diana', 'Berta', 'Miloslav', 'Prokop', 'Sviatok sv. Cyrila a Metoda', 'Patr??cia, Patrik', 'Oliver', 'Ivan', 'Lujza', 'Am??lia', 'Milota', 'Nina', 'Margita', 'Kamil', 'Henrich', 'Drahom??r', 'Bohuslav', 'Kamila', 'Du??ana', 'I??ja, Eli????', 'Daniel', 'Magdal??na', 'O??ga', 'Vladim??r', 'Jakub', 'Anna, Hana', 'Bo??ena', 'Kri??tof', 'Marta', 'Libu??a', 'Ign??c', 'Bo??idara', 'Gust??v', 'Jergu??', 'Dominik(a)', 'Hortenzia', 'Jozef??na', '??tef??nia', 'Osk??r', '??ubom??ra', 'Vavrinec', 'Zuzana', 'Darina', '??ubom??r', 'Mojm??r', 'Marcela', 'Leonard', 'Milica', 'Elena, Helena', 'L??dia', 'Anabela', 'Jana', 'Tichom??r', 'Filip', 'Bartolomej', '??udov??t', 'Samuel', 'Silvia', 'August??n', 'Nikola', 'Ru??ena', 'Nora', 'Drahoslava', 'Linda', 'Belo', 'Roz??lia', 'Reg??na', 'Alica', 'Marianna', 'Miriama', 'Martina', 'Oleg', 'Bystr??k', 'M??ria', 'Ctibor', '??ubomil, ??udomil', 'Jolana', '??udmila', 'Olympia', 'Eug??nia', 'Kon??tant??n', '??uboslav(a)', 'Mat????', 'M??ric', 'Zdenka', '??ubo??, ??ubor', 'Vladislav', 'Edita', 'Cypri??n', 'V??clav', 'Michal, Michaela', 'Jarol??m', 'Arnold', 'Levoslav', 'Stela', 'Franti??ek', 'Viera', 'Nat??lia', 'Eli??ka', 'Brigita', 'Dion??z', 'Slavom??ra', 'Valent??na', 'Maximili??n', 'Koloman', 'Boris', 'Ter??zia', 'Vladim??ra', 'Hedviga', 'Luk????', 'Kristi??n', 'Vendel??n', 'Ur??u??a', 'Sergej', 'Alojzia', 'Kvetoslava', 'Aurel', 'Demeter', 'Sab??na', 'Dobromila, Kevin', 'Kl??ra', '??imon(a)', 'Aur??lia', 'Denis(a)', 'Pamiatka zosnul??ch', 'Hubert', 'Karol', 'Imrich', 'Ren??ta', 'Ren??', 'Bohum??r', 'Teodor', 'Tibor', 'Martin, Maro??', 'Sv??topluk', 'Stanislav', 'Irma', 'Leopold', 'Agnesa', 'Klaudia', 'Eugen', 'Al??beta', 'F??lix', 'Elv??ra', 'Cec??lia', 'Klement', 'Em??lia', 'Katar??na', 'Kornel', 'Milan', 'Henrieta', 'Vratko', 'Ondrej, Andrej', 'Edmund', 'Bibi??na', 'Oldrich', 'Barbora', 'Oto', 'Mikul????', 'Ambr??z', 'Mar??na', 'Izabela', 'Rad??z', 'Hilda', 'Ot??lia', 'Lucia', 'Branislava, Bronislava', 'Ivica', 'Alb??na', 'Korn??lia', 'Sl??va, Sl??vka', 'Judita', 'Dagmara', 'Bohdan', 'Adela', 'Nade??da', 'Adam a Eva', '1. Sviatok viano??n??', '??tefan', 'Filom??na', 'Ivana, Ivona', 'Milada', 'D??vid', 'Silvester');
                  
                  
                  
                  $den=date("z", time());
                  
                  if ((date("Y", time())%4>0)&&($den>59)) {
                  
                     $den++;
                  
                  }
                  
                  
                  
                  if ($den==1||$den==121||$den==186||$den==306||$den==359) {
                  
                     $meniny="dnes je ".$mena[$den];
                  
                  }else{
                  
                     $meniny="meniny m?? ".$mena[$den];
                  
                  }

                         
		return $meniny;								
		}
		
		

    

function code() {

      $code = "";

    global $go,$form_result;

          If ($go==1) {
          
                If ($form_result=="yes") {
                    
                    $code = 'onload="alertTheUser(\'1\')"';
                
                } else if ($form_result=="no") {
                    
                    $code = 'onload="alertTheUser(\'0\')"';                
                
                }
          
          
          } Else If ($go==3) {
            
            $code = 'onload="open_close(\'28\');"';
          
          }   
  

    return $code;

}


function scroll() {

    global $go;

      $scroll = "<a name='menu".$go."'></a> "; 

    return $scroll;

}


function ram() {	

	$ram ="";

			global $go, $doc, $subgo;
			      if ($go == 3) {
                $ram .= "
  
  <h2><a id='28_menu' href='javascript:open_close(28);' >DENN?? MENU</a></h2>
  <h2><a id='100_menu2' href='javascript:open_close2(100);'>JED??LNY L??STOK</a></h2>                
  <div class='hide' id='100'>
    <ul>
      <li><a id='0_menu' href='javascript:open_close(0);'>Ra??ajky</a></li>
      <li><a id='1_menu' href='javascript:open_close(1);'>Predjedl??</a></li>
      <li><a id='2_menu' href='javascript:open_close(2);'>Cestoviny</a></li>
      <li><a id='3_menu' href='javascript:open_close(3);'>Rizot??</a></li>
      <li><a id='4_menu' href='javascript:open_close(4);'>Steaky</a></li>
      <li><a id='5_menu' href='javascript:open_close(5);'>Na objedn??vku z brav??ov??ho m??sa</a></li>
      <li><a id='6_menu' href='javascript:open_close(6);'>Na objedn??vku z hydiny</a></li>
      <li><a id='7_menu' href='javascript:open_close(7);'>Ryby a in?? potvory z vody</a></li>
      <li><a id='8_menu' href='javascript:open_close(8);'>Ba??ta pre dve a viac fig??r</a></li>
      <li><a id='9_menu' href='javascript:open_close(9);'>Na objedn??vku - 3 dni vopred</a></li>
      <li><a id='10_menu' href='javascript:open_close(10);'>Dom??ca kuchy??a</a></li>
      <li><a id='11_menu' href='javascript:open_close(11);'>Syry</a></li>
      <li><a id='12_menu' href='javascript:open_close(12);'>Jedl?? k pivu</a></li>
      <li><a id='14_menu' href='javascript:open_close(14);'>Nie??o pre bylino??ravcov</a></li>
      <li><a id='15_menu' href='javascript:open_close(15);'>Pre bylino??ravcov, ktor?? jedia m??so</a></li>
      <li><a id='16_menu' href='javascript:open_close(16);'>Pre mlsn?? jaz????ky</a></li>
      <li><a id='17_menu' href='javascript:open_close(17);'>Pr??lohy</a></li>
      <li><a id='18_menu' href='javascript:open_close(18);'>??peci??lne om????ky</a></li>
                               
    </ul>
  </div>
  <h2><a id='29_menu' href='javascript:open_close(29);' >PONUKA</a></h2>
  <h2><a id='200_menu2' href='javascript:open_close2(200);' href=''>N??POJOV?? L??STOK</a></h2>
  <div class='hide' id='200'>
    <ul>
      <li><a id='20_menu' href='javascript:open_close(20);'>Pivo ??apovan??</a></li>
      <li><a id='21_menu' href='javascript:open_close(21);'>Pivo f??a??kov??</a></li>
      <li><a id='22_menu' href='javascript:open_close(22);'>V??na</a></li>
      <li><a id='23_menu' href='javascript:open_close(23);'>Nealko</a></li>
      <li><a id='24_menu' href='javascript:open_close(24);'>Tepl?? n??poje</a></li>
      <li><a id='25_menu' href='javascript:open_close(25);'>Destil??ty</a></li>
      <li><a id='26_menu' href='javascript:open_close(26);'>Lik??ry</a></li>    
      <li><a id='27_menu' href='javascript:open_close(27);'>Chu??ovky, energy drinky, cigarety</a></li>
    </ul>
  </div>                
                
                
                
                
                
                ";
		        } else If ($go == 4) {
                $ram .= "<h2>AKCIE</h2>";
                
                          $sql = mysql_query("SELECT a.id, a.nadpis
                  															FROM cms_content_akcie AS a
                  															WHERE a.id_menu = 4 AND a.id_lang = 1 
                                                ORDER BY a.id DESC");
                              
                      		while ($row = mysql_fetch_row($sql)) 
				                    {
                                            $ram .= "<img src='images/hr.gif'>";
                                            If ($row[0]==$doc) {
                                              $ram .= "<p ><a style='color:#CA7058;font-weight:bold;' href='?go=4&doc=".$row[0]."' >".$row[1]."</a></p>";
                                            } else {
                                              $ram .= "<p><a href='?go=4&doc=".$row[0]."' >".$row[1]."</a></p>";
                                            }
                            
                            
                            
                            
                            }                     
               
                

            } else if ($go == 5 ) {
                $ram .= "<h2>GAL??RIA</h2>";
                
                
                 $sql = mysql_query("SELECT a.id, b.word
                                                FROM cms_menu AS a, cms_menu_words b
                                                WHERE a.id_parent = 5
                                                AND a.id_word = b.id
                                                ORDER BY a.id DESC
                                                ");
                              
                      		while ($row = mysql_fetch_row($sql)) 
				                    {
                                            $ram .= "<img src='images/hr.gif'>";
                                            If ($row[0]==$subgo) {
                                              $ram .= "<p ><a style='color:#CA7058;font-weight:bold;' href='?go=5&subgo=".$row[0]."#menu5' >".$row[1]."</a></p>";
                                              $doc = $row[1];
                                            } else {
                                              $ram .= "<p><a href='?go=5&subgo=".$row[0]."#menu5' >".$row[1]."</a></p>";
                                            }
                            
                            
                            
                            
                            }  
                            

            }	else {
                $ram .= "<h2>NOVINKY</h2>";
                
                          $sql = mysql_query("SELECT a.content
                  															FROM cms_content AS a
                  															WHERE a.id_menu = 8 AND a.id_lang = 1 
                                                ORDER BY a.id DESC");
                              
                      		while ($row = mysql_fetch_row($sql)) 
				                    {
                                            $ram .= "<img src='images/hr.gif'>";
                                            $ram .= "<p>".$row[0]."</p>";
                            }                
                

            }
		
    		return $ram;	
}    
    
//********************************	
// CONTENT
//********************************

function content() 	{

		global $go, $lang, $setup_default_go, $doc, $subgo;

									 if ($setup_default_go=="yes") {
									       include("includes/php/go_default.php");
                         }
                    else {
									       include("includes/php/go_".$setup_default_go.".php");
                         }
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
		global $go, $subgo, $subcat;
	  global $setup_default_go;

		// ---- PHPLib	
		$template = new Template("includes/html/");

		// + Main Template
		$template->set_file("Tpl",$TplFile);

         if ($TplFile <> "tpl_homepage.html") {
              
          			// Content + Menu Template
       					$template->set_var("Code",code());
       					$template->set_var("Meniny",meniny());           			
       					$template->set_var("Scroll",scroll());
                $template->set_var("Menu",menu()); 
      					$template->set_var("Content",content()); 
      					$template->set_var("Ram",ram()); 
                
                If ($go==1) {
                  $template->set_var("Intro",intro());
                }
             }
		
		// + Finalize Whole Template To Page
    $template->parse("FINALPAGE","Tpl"); 
    $template->p("FINALPAGE"); 
	}
	
?>
