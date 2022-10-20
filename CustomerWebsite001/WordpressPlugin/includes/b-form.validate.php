<?php

////////////////////////////////////////////
// Validate values
////////////////////////////////////////////

                      //transform to array
                      $post32 = array(); $post33 = array(); $post34 = array(); $post35 = array(); $post36 = array(); $post37 = array(); $post38 = array(); $post39 = array(); 
     
                      //SPAM checker
                      if(!empty($_POST['abc'])) die();
                      
                      function test_input($data) {
                              $test_input = trim($data);
                              $test_input = stripslashes($data);
                              $test_input = htmlspecialchars($data);
                              return $test_input;
                              }
                      
                      $result = '';
                      $post01 = test_input($_POST['01']); if ( $post01 <> '')                               {$result .='';} else {$result .='< Meno a Priezvisko > <br>';};
                      $post02 = test_input($_POST['02']); if ( $post02 <> '')                               {$result .='';} else {$result .='< Email > <br>';};
                      $post03 = test_input($_POST['03']); if ( $post03 <> '')                               {$result .='';} else {$result .='< Názov lokality > <br>';};
                      $post04 = test_input($_POST['04']); if ( $post04 <> '')                               {$result .='';} else {$result .='< Kraj > <br>';};
                      $post05 = test_input($_POST['05']); if ( $post05 <> '')                               {$result .='';} else {$result .='< Okres > <br>';};
                      $post06 = test_input($_POST['06']); if ( $post06 <> '')                               {$result .='';} else {$result .='< Obec > <br>';};
                      $post07 = test_input($_POST['07']); if ( $post07 <> '')                               {$result .='';} else {$result .='< Adresa > <br>';};
                      $post08 = test_input($_POST['08']); if ( $post08 <> '')                               {$result .='';} else {$result .='< Typ lokality > <br>';};
                      $post09 = test_input($_POST['09']); if ( $post09 <> '')                               {$result .='';} else {$result .='< Poloha v rámci zastavaného územia > <br>';};
                      $post10 = test_input($_POST['10']); if ( $post10 <> '')                               {$result .='';} else {$result .='< Rozloha areálu v m² > <br>';};
                      $post11 = test_input($_POST['11']); if ( $post11 <> '')                               {$result .='';} else {$result .='< Druh vlastníctva areálu > <br>';};
                      $post12 =            $_POST['12'] ; if ( $post12 <> '|')                              {$result .='';} else {$result .='< Pôvodné využitie > <br>';};
                      $post13 = test_input($_POST['13']); if ( $post12 == '19|')                            {if ( $post13 <> '') {$result .='';} else {$result .='< Pôvodné využitie Iné > <br>';};}                      
                      $post14 =            $_POST['14'] ; if ( $post14 <> '|')                              {$result .='';} else {$result .='< Súčasné využitie > <br>';};
                      $post15 = test_input($_POST['15']); if ( $post14 == '28|')                            {if ( $post15 <> '') {$result .='';} else {$result .='< Súčasné využitie Iné > <br>';};}  
                      $post16 = test_input($_POST['16']); if ( $post16 <> '')                               {$result .='';} else {$result .='< Využitie areálu v % > <br>';};
                      $post17 = test_input($_POST['17']); if ( $post17 <> '')                               {$result .='';} else {$result .='< Pečatenie pôdy v % > <br>';};
                      $post18 = test_input($_POST['18']); if ( $post18 <> '')                               {$result .='';} else {$result .='< Charakteristika jestvujúcej vegetácie > <br>';};
                      $post19 = test_input($_POST['19']); if ( $post19 <> '')                               {$result .='';} else {$result .='< Kontaminácia lokality > <br>';};
                      $post20 = test_input($_POST['20']);
                      $post22 = test_input($_POST['22']);
                      $post23 = test_input($_POST['23']);
                      $post24 = test_input($_POST['24']); if ( $post24 <> '')                               {$result .='';} else {$result .='< Počet objektov > <br>';};
                      $post25 = test_input($_POST['25']); if ( $post25 <> '')                               {$result .='';} else {$result .='< Funkčné využitie a regulácia v zmysle platného ÚPN obce > <br>';};
                      $post26 = test_input($_POST['26']); if ( $post26 <> '')                               {$result .='';} else {$result .='< Kategória podľa rozvojového potenciálu > <br>';};
                      $post27 = test_input($_POST['27']); if ( $post27 <> '')                               {$result .='';} else {$result .='< Známe zámery > <br>';};
                      $post28 = test_input($_POST['28']); if ( $post28 <> '')                               {$result .='';} else {$result .='< Stručná charakteristika/poznámka > <br>';};
                      $post29 =    $_FILES['29']['size']; if ( $post29 < 2000001)                           {$result .='';} else {$result .='< Súbor 1 je príliž veľký > <br>';};
                      $post30 =    $_FILES['30']['size']; if ( $post30 < 2000001)                           {$result .='';} else {$result .='< Súbor 2 je príliž veľký > <br>';};
                      $post31 =    $_FILES['31']['size']; if ( $post31 < 2000001)                           {$result .='';} else {$result .='< Súbor 3 je príliž veľký > <br>';};
                      $post40 = test_input($_POST['40']); if ( $post40 <> '')                               {$result .='';} else {$result .='< Telefónne číslo > <br>';};
                      $post41 =            $_POST['41'] ; if ( $post41 <> '|')                              {$result .='';} else {$result .='< Dostupnosť technickej infraštruktúry > <br>';};
                      $post42 = test_input($_POST['42']);
                                
?>