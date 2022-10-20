<?
// This file is for DB pages, in case they have same layout
              
                         $content = "<h1>Kniha návštev</h1>";

                         
If (@$_POST['odoslatKN']) {


 foreach ($_POST as $key => $value) {
    $_POST[$key] = mysql_real_escape_string($value);
  }


  If ( str_replace("tx44", "", $_POST['spolu']) == (@$_POST['antispam'] + 13) AND strpos(@$_POST['text'], '<a href') === false AND strpos(@$_POST['text'], '<img') === false AND $_POST['kontrola'] == '' AND strlen($_POST['meno']) > 1 AND strlen($_POST['email']) > 8 AND strlen($_POST['text']) > 2) {
                            
                       $result = mysql_query("INSERT INTO cms_content_guestbook (id_menu,name,email,content) VALUES ('6','".@$_POST['meno']."','".@$_POST['email']."','".@$_POST['text']."')") 
                                  or die(mysql_error()); 
          
          $content .= "<p class='attention'><strong>Ďakujeme za Váš podnet. Váš komentár bol zaznamenaný.</strong></p>";
        } else {
          $content .= "<p class='attention'><strong>Boli nesprávne vyplnené Vaše údaje!</strong></p>";
        }  

} 








//ANTISPAM MATH

$A = rand(1, 9);
$B = rand(1, 9);
$C = ($A + $B)+13;

$content .= "


<div class='form'><form method='post' action='?go=6' >

  <p>
    <div class='polozka'>Meno a priezvisko*: <input name='meno' size='40' maxlength='40'></div>
    <div class='polozka'>E-mail *: <input name='email' size='40' maxlength='40'></div>
    <div class='polozka'>Text *: <textarea name='text' rows='5' cols='30' ></textarea></div>
    <div class='polozka2'>Anti spam: ".$A." + ".$B."= <input name='antispam' size='5' maxlength='10'></div>
    <div><input name='spolu' type='hidden' value='tx44".$C."'></div>
    <div><input name='kontrola' class='kontrola' value=''></div>
    <div class='submit'><input type='submit' value='Odoslať' name='odoslatKN'></div>
  
  </p>

</form>
</div>";



                          $sql = mysql_query("SELECT a.id, a.name, a.content, a.stamp
                  															FROM cms_content_guestbook AS a 
                                                ORDER BY a.id DESC");
                              
                      		while ($row = mysql_fetch_row($sql)) 
				                    {
                              $content .= "<div class='comment'><strong>".$row[3]." / ".$row[1]." napísal(a):</strong><br>
                                            ".$row[2]."
                                          </div><br>";
                            } 






                         
 ?>

