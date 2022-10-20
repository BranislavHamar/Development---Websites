<?php

////////////////////////////////////////////
// After success - Send email
////////////////////////////////////////////
                                  
/**
 * Send email
 * @param string|array $email
 * @param object $from
 * @param string $subject
 * @param string $message
 * @param string $headers optional
 */
function send_email($email, $from_name, $from_email, $subject, $message, $headers = null)
{
	// Unique boundary
	$boundary = md5( uniqid() . microtime() );

	// If no $headers sent
	if (empty($headers))
	{
		// Add From: header
		$headers = "From: " . $from_name . " <" . $from_email . ">\r\n";

		// Specify MIME version 1.0
		$headers .= "MIME-Version: 1.0\r\n";

		// Tell e-mail client this e-mail contains alternate versions
		$headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\r\n\r\n";
	}

	// Plain text version of message
	$body = "--".$boundary."\r\n" .
	   "Content-Type: text/plain; charset=UTF-8\r\n" .
	   "Content-Transfer-Encoding: base64\r\n\r\n";
	$body .= chunk_split( base64_encode( strip_tags($message) ) );

	// HTML version of message
	$body .= "--$boundary\r\n" .
	   "Content-Type: text/html; charset=UTF-8\r\n" .
	   "Content-Transfer-Encoding: base64\r\n\r\n";
	$body .= chunk_split( base64_encode( $message ) );

	$body .= "--".$boundary."--";

  $subject = '=?UTF-8?B?'.base64_encode($subject).'?=';
  
	// Send Email
	if (is_array($email))
	{
		foreach ($email as $e)
		{
			mail($e, $subject, $body, $headers);
		}
	}
	else
	{
		mail($email, $subject, $body, $headers);
	}
}

///////////////////
// Parameters
///////////////////

$email[0] = "xxxx@yyyy.sk";
$email[1] = "xxxx@zzz.sk";
$email[2] = $post02;

$from_name = "Dobre Mesto";
$from_email = "rrrrrr@ddddd.sk";

$subject = "Registracia brownfield - ".$post03;


///////////////////
// Message
///////////////////

                     function listoptions($filter) {
                         global $wpdb;
                         
                         $listoptions ="";
                         $result_items = $wpdb->get_row( "SELECT id, name FROM dm_br_form_items WHERE id = '".$filter."'" );
                         
                                                 
                                   
                                    $listoptions = $result_items->name;
                                    

                          
                          return $listoptions;
                         
                     }
                     
                     
                     //List function with multiple options                     
                     function listoptionsmultiple($filtermultiple) {
                        global $wpdb;
                        $listoptionsmultiple = "";
                        $filtermultiplearray = explode("|", $filtermultiple);
                        $filtermultiplearraylength = count($filtermultiplearray)-1;
                        $i = 0;

                        while ($i < $filtermultiplearraylength)
                            {
                                $result_items = $wpdb->get_row ( "SELECT id, name FROM dm_br_form_items WHERE id = '".$filtermultiplearray[$i]."'" );                         
                                $listoptionsmultiple .= $result_items->name ." / ";
                                    $i++;
                            }                              

                       $listoptionsmultiple = substr($listoptionsmultiple,0,-2);
                       return $listoptionsmultiple;
                     }


$message = "  
Dobrý deň,<br>
ďakujeme Vám, že ste vyplnili formulár pre tvorbu databázy zanedbaných a nevyužívaných území v intravilánoch sídiel. V prípade potreby aktualizácie uvedených údajov, pošlite konkrétnu požiadavku na mailovú adresu <a target='_blank' href='mailto:rrrrr@ttttt.sk'>hhhhh@jjjjj.sk</a>. Detaily formulára si môžete pozrieť nižšie:<br> 
<br>
<b>[ - Kontaktná osoba - ]</b><br>
<b>Meno a priezvisko:</b>                                               ". $post01. "<br>
<b>Telefónne číslo:</b>                                                 ". $post40. "<br>
<b>Email:</b>                                                           ". $post02. "<br>
<br>
<b>[ - Základné informácie o lokalite - ]</b><br>
<b>Názov lokality:</b>                                                  ". $post03. "<br>
<b>Kraj:</b>                                                            ". $post04. "<br>
<b>Okres:</b>                                                           ". $post05. "<br>
<b>Obec:</b>                                                            ". $post06. "<br>
<b>Adresa:</b>                                                          ". $post07. "<br>
<b>Typ lokality:</b>                                                    ". listoptions($post08). "<br>
<b>Poloha zastavaného územia:</b>                                       ". listoptions($post09). "<br>
<br>
<b>[ - Informácie o areáli - ]</b><br>
<b>Rozloha areálu:</b>                                                  ". $post10. "<br>
<b>Druh vlastníctva:</b>                                                ". listoptions($post11). "<br>
";
If ($post42 <> "") {$message .=  "<b>Druh vlastníctva iné:</b>                        ". $post42. "<br>
";}
$message .=  "<b>Pôvodné využitie:</b>                                                ". listoptionsmultiple($post12). "<br>
";
If ($post13 <> "") {$message .=  "<b>Pôvodné využitie iné:</b>                        ". $post13. "<br>
";}
$message .=  "<b>Súčasné využitie:</b>                                                ". listoptionsmultiple($post14). "<br>
";
If ($post15 <> "") {$message .=  "<b>Súčasné využitie iné:</b>                        ". $post15. "<br>
";}
$message .=  "<b>Využitie areálu:</b>                                                 ". listoptions($post16). "<br>
<b>Pečatenie pôdy:</b>                                                  ". listoptions($post17). "<br>
<b>Dostupnosť technickej infraštruktúry:</b>                            ". listoptionsmultiple($post41). "<br>
<b>Charakteristika jestvujúcej vegetácie:</b>                           ". $post18. "<br>
<b>Kontaminácia lokality:</b>                                           ". listoptions($post19). "<br>
";
If ($post20 <> "") {$message .=  "<b>Kontaminácia lokality popis:</b>". $post20. "<br>
";}
$message .=  "<b>Ochrana prírodných hodnôt:</b>                         ". ($post22 <> "" ?  listoptions($post22) : "") . "<br>
<b>Ochrana prírodných hodnôt popis:</b>                                 ". $post23. "<br>
<b>Počet objektov:</b>                                                  ". listoptions($post24). "<br>
";

if ( $post24 <> "131") {    
$message .=  "<br>
<b>[ - Informácie o objektoch - ]</b><br>";

  $y = 1;                  
  for ($i = 0; $i < $pocetobjektov; $i++) 
  {
$message .= "
<b>Objekt ".$y.":</b>                                                   ". $post33[$i] ."<br>
<b>Klasifikácia stavby/typ:</b>                                         ". ($post32[$i] <> "" ?  listoptions($post32[$i]) : ""). "<br>
<b>Rozloha/veľkosť objektu v m&#178;/m:</b>                             ". $post33[$i] ."<br>
<b>Stavebno-technický stav:</b>                                         ". ($post34[$i] <> "" ?  listoptions($post34[$i]) : ""). "<br>
<b>Druh vlastníctva objektu:</b>                                        ". ($post35[$i] <> "" ?  listoptions($post35[$i]) : ""). "<br>
<b>Počet podlaží:</b>                                                   ". ($post36[$i] <> "" ?  listoptions($post36[$i]) : ""). "<br>
<b>Ochrana kultúrnych hodnôt:</b>                                       ". ($post38[$i] <> "" ?  listoptions($post38[$i]) : ""). "<br>
<b>Názov pamätihodnosti a číslo:</b>                                    ". $post39[$i] ."<br>
<br>";
$y = $y + 1;
  };

} 


$message .= "
<b>[ - Možnosti využitia - ]</b><br>
<b>Funkčné využitie a regulácia v zmysle platného UPN obce:</b>         ". listoptions($post25). "<br>
<b>Kategória podľa rozvojového potenciálu:</b>                          ". listoptions($post26). "<br>
<b>Známe zámery:</b>                                                    ". $post27. "<br>
<b>Stručná charakteristika/poznámka:</b>                                ". $post28. "<br>
<br>
S pozdravom,<br>
MDV SR<br>
<br><img style='display:block;width:218px;height:55px;' src='data:image/png;base64,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' /><br>
xxxxx<br>
yyyyy<br> 
<a  target='_blank' href='mailto:eeeee@rrrrrr.sk'>wwwww@eeeee.sk</a> | <a target='_blank' href='http://www.xxxxx.sk'>www.xxxxx.sk</a><br> 
<br>
Tento email ste dostali, pretože ste vyplnili formulár pre tvorbu databázy zanedbaných a nevyužívaných území v intravilánoch sídiel na webovej platforme Dobré mesto. Email je vygenerovaný automaticky, prosíme, neodpovedajte naň. Ak sa Vám email nezobrazuje správne, vyskúšajte iný prehliadač.
";


$headers = "";

send_email($email, $from_name, $from_email, $subject, $message, $headers);

                                
?>