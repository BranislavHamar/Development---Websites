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

                  $mena=array('Nový rok', 'Alexandra', 'Daniela', 'Drahoslav', 'Andera', 'Antónia', 'Bohuslav(a)', 'Severín', 'Alexej', 'Dáša', 'Malvína', 'Ernest', 'Rastislav', 'Radovan', 'Dobroslav', 'Kristína', 'Nataša', 'Bohdana', 'Drahomíra', 'Dalibor', 'Vincent', 'Zora', 'Miloš', 'Timotej', 'Gejza', 'Tamara', 'Bohuš', 'Alfonz', 'Gašpar', 'Ema', 'Emil', 'Tatiana', 'Erik(a)', 'Blažej', 'Veronika', 'Agáta', 'Dorota', 'Vanda', 'Zoja', 'Zdenko', 'Gabriela', 'Dezider', 'Perla', 'Arpád', 'Valentín', 'Pravoslav', 'Ida', 'Miloslava', 'Jaromír', 'Vlasta', 'Lívia', 'Eleonóra', 'Etela', 'Roman(a)', 'Metej', 'Frederik(a)', 'Viktor', 'Alexander', 'Zlatica', 'Radomír', 'Albín', 'Anežka', 'Bohumil(a)', 'Kazimír', 'Fridrich', 'Radoslav', 'Tomáš', 'Alan(a)', 'Františka', 'Branislav, Bruno', 'Angela, Angelika', 'Gregor', 'Vlastimil', 'Matilda', 'Svetlana', 'Boleslav', 'Ľubica', 'Eduard', 'Jozef', 'Víťazoslav', 'Blahoslav', 'Beňadik', 'Adrián', 'Gabriel', 'Marián', 'Emanuel', 'Alena', 'Soňa', 'Miroslav', 'Vieroslava', 'Benjamín', 'Hugo', 'Zita', 'Richard', 'Izidor', 'Miroslava', 'Irena', 'Zoltán', 'Albert', 'Milena', 'Igor', 'Július', 'Estera', 'Aleš', 'Justína', 'Fedor', 'Dana, Danica', 'Rudolf', 'Valér', 'Jela', 'Marcel', 'Ervín', 'Slavomír', 'Vojtech', 'Juraj', 'Marek', 'Jaroslava', 'Jaroslav', 'Jarmila', 'Lea', 'Anastázia', 'Sviatok práce', 'Žigmunt', 'Galina', 'Florián', 'Lesana, Lesia', 'Hermína', 'Monika', 'Ingrida', 'Roland', 'Viktória', 'Blažena', 'Pankrác', 'Servác', 'Bonifác', 'Žofia', 'Svetozár', 'Gizela', 'Viola', 'Gertrúda', 'Bernard', 'Zina', 'Júlia, Juliana', 'Želmíra', 'Ela', 'Urban', 'Dušan', 'Iveta', 'Viliam', 'Vilma', 'Ferdinand', 'Petronela, Petrana', 'Žaneta', 'Xénia', 'Karolína', 'Lenka', 'Laura', 'Norbert', 'Róbert', 'Medard', 'Stanislava', 'Margaréta', 'Dobroslava', 'Zlatko', 'Anton', 'Vasil', 'Vít', 'Blanka', 'Adolf', 'Vratislav(a)', 'Alfréd', 'Valéria', 'Alojz', 'Paulína', 'Sidónia', 'Ján', 'Tadeáš', 'Adriána', 'Ladislav(a)', 'Beáta', 'Peter a Pavol, Petra', 'Melánia', 'Diana', 'Berta', 'Miloslav', 'Prokop', 'Sviatok sv. Cyrila a Metoda', 'Patrícia, Patrik', 'Oliver', 'Ivan', 'Lujza', 'Amália', 'Milota', 'Nina', 'Margita', 'Kamil', 'Henrich', 'Drahomír', 'Bohuslav', 'Kamila', 'Dušana', 'Iľja, Eliáš', 'Daniel', 'Magdaléna', 'Oľga', 'Vladimír', 'Jakub', 'Anna, Hana', 'Božena', 'Krištof', 'Marta', 'Libuša', 'Ignác', 'Božidara', 'Gustáv', 'Jerguš', 'Dominik(a)', 'Hortenzia', 'Jozefína', 'Štefánia', 'Oskár', 'Ľubomíra', 'Vavrinec', 'Zuzana', 'Darina', 'Ľubomír', 'Mojmír', 'Marcela', 'Leonard', 'Milica', 'Elena, Helena', 'Lýdia', 'Anabela', 'Jana', 'Tichomír', 'Filip', 'Bartolomej', 'Ľudovít', 'Samuel', 'Silvia', 'Augustín', 'Nikola', 'Ružena', 'Nora', 'Drahoslava', 'Linda', 'Belo', 'Rozália', 'Regína', 'Alica', 'Marianna', 'Miriama', 'Martina', 'Oleg', 'Bystrík', 'Mária', 'Ctibor', 'Ľubomil, Ľudomil', 'Jolana', 'Ľudmila', 'Olympia', 'Eugénia', 'Konštantín', 'Ľuboslav(a)', 'Matúš', 'Móric', 'Zdenka', 'Ľuboš, Ľubor', 'Vladislav', 'Edita', 'Cyprián', 'Václav', 'Michal, Michaela', 'Jarolím', 'Arnold', 'Levoslav', 'Stela', 'František', 'Viera', 'Natália', 'Eliška', 'Brigita', 'Dionýz', 'Slavomíra', 'Valentína', 'Maximilián', 'Koloman', 'Boris', 'Terézia', 'Vladimíra', 'Hedviga', 'Lukáš', 'Kristián', 'Vendelín', 'Uršuľa', 'Sergej', 'Alojzia', 'Kvetoslava', 'Aurel', 'Demeter', 'Sabína', 'Dobromila, Kevin', 'Klára', 'Šimon(a)', 'Aurélia', 'Denis(a)', 'Pamiatka zosnulých', 'Hubert', 'Karol', 'Imrich', 'Renáta', 'René', 'Bohumír', 'Teodor', 'Tibor', 'Martin, Maroš', 'Svätopluk', 'Stanislav', 'Irma', 'Leopold', 'Agnesa', 'Klaudia', 'Eugen', 'Alžbeta', 'Félix', 'Elvíra', 'Cecília', 'Klement', 'Emília', 'Katarína', 'Kornel', 'Milan', 'Henrieta', 'Vratko', 'Ondrej, Andrej', 'Edmund', 'Bibiána', 'Oldrich', 'Barbora', 'Oto', 'Mikuláš', 'Ambróz', 'Marína', 'Izabela', 'Radúz', 'Hilda', 'Otília', 'Lucia', 'Branislava, Bronislava', 'Ivica', 'Albína', 'Kornélia', 'Sláva, Slávka', 'Judita', 'Dagmara', 'Bohdan', 'Adela', 'Nadežda', 'Adam a Eva', '1. Sviatok vianočný', 'Štefan', 'Filoména', 'Ivana, Ivona', 'Milada', 'Dávid', 'Silvester');
                  
                  
                  
                  $den=date("z", time());
                  
                  if ((date("Y", time())%4>0)&&($den>59)) {
                  
                     $den++;
                  
                  }
                  
                  
                  
                  if ($den==1||$den==121||$den==186||$den==306||$den==359) {
                  
                     $meniny="dnes je ".$mena[$den];
                  
                  }else{
                  
                     $meniny="meniny má ".$mena[$den];
                  
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
  
  <h2><a id='28_menu' href='javascript:open_close(28);' >DENNÉ MENU</a></h2>
  <h2><a id='100_menu2' href='javascript:open_close2(100);'>JEDÁLNY LÍSTOK</a></h2>                
  <div class='hide' id='100'>
    <ul>
      <li><a id='0_menu' href='javascript:open_close(0);'>Raňajky</a></li>
      <li><a id='1_menu' href='javascript:open_close(1);'>Predjedlá</a></li>
      <li><a id='2_menu' href='javascript:open_close(2);'>Cestoviny</a></li>
      <li><a id='3_menu' href='javascript:open_close(3);'>Rizotá</a></li>
      <li><a id='4_menu' href='javascript:open_close(4);'>Steaky</a></li>
      <li><a id='5_menu' href='javascript:open_close(5);'>Na objednávku z bravčového mäsa</a></li>
      <li><a id='6_menu' href='javascript:open_close(6);'>Na objednávku z hydiny</a></li>
      <li><a id='7_menu' href='javascript:open_close(7);'>Ryby a iné potvory z vody</a></li>
      <li><a id='8_menu' href='javascript:open_close(8);'>Bašta pre dve a viac figúr</a></li>
      <li><a id='9_menu' href='javascript:open_close(9);'>Na objednávku - 3 dni vopred</a></li>
      <li><a id='10_menu' href='javascript:open_close(10);'>Domáca kuchyňa</a></li>
      <li><a id='11_menu' href='javascript:open_close(11);'>Syry</a></li>
      <li><a id='12_menu' href='javascript:open_close(12);'>Jedlá k pivu</a></li>
      <li><a id='14_menu' href='javascript:open_close(14);'>Niečo pre bylinožravcov</a></li>
      <li><a id='15_menu' href='javascript:open_close(15);'>Pre bylinožravcov, ktorí jedia mäso</a></li>
      <li><a id='16_menu' href='javascript:open_close(16);'>Pre mlsné jazýčky</a></li>
      <li><a id='17_menu' href='javascript:open_close(17);'>Prílohy</a></li>
      <li><a id='18_menu' href='javascript:open_close(18);'>Špeciálne omáčky</a></li>
                               
    </ul>
  </div>
  <h2><a id='29_menu' href='javascript:open_close(29);' >PONUKA</a></h2>
  <h2><a id='200_menu2' href='javascript:open_close2(200);' href=''>NÁPOJOVÝ LÍSTOK</a></h2>
  <div class='hide' id='200'>
    <ul>
      <li><a id='20_menu' href='javascript:open_close(20);'>Pivo čapované</a></li>
      <li><a id='21_menu' href='javascript:open_close(21);'>Pivo fľaškové</a></li>
      <li><a id='22_menu' href='javascript:open_close(22);'>Vína</a></li>
      <li><a id='23_menu' href='javascript:open_close(23);'>Nealko</a></li>
      <li><a id='24_menu' href='javascript:open_close(24);'>Teplé nápoje</a></li>
      <li><a id='25_menu' href='javascript:open_close(25);'>Destiláty</a></li>
      <li><a id='26_menu' href='javascript:open_close(26);'>Likéry</a></li>    
      <li><a id='27_menu' href='javascript:open_close(27);'>Chuťovky, energy drinky, cigarety</a></li>
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
                $ram .= "<h2>GALÉRIA</h2>";
                
                
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
