<?php                                                                          

    echo "<h1>Brownfields | detail</h1>";

///////////////////////////
/////// A. Update formularu
///////////////////////////

		 if ( isset($_POST['submit']) ) {

    		///////////////////
    		/////// Potvrdenie
    		///////////////////
    
        		   echo "
        
        				<h2 style='padding-top:25px;color:green;' > <img style='width:12px;height:12px;' src='data:image/gif;base64, R0lGODlhFQAXAKIGAN/y35/Zn+/571+/Xy+sLwCZAP///wAAACH5BAEAAAYALAAAAAAVABcAAANSaLrcLMTJBsu81V6X9V6d94UFIYxEoa7lOZGsKcFsS6W1OsSuQRcDQ032CwqHAFzOeMw5gYynk6nYSVfUhVWaZWyXny/2U611L9vzZqf+BMiGBAA7' /> Záznam bol aktualizovaný</h2>
        
        		   ";
               

               
        /////////////
        ///// Upload File
        /////////////
               
                    $uploaddir = '/var/www/html/uploads/';
                    $upload_id = $_GET["id"]. "_";
                                        
                    //Situacny planik
                    if (basename($_FILES['29']['name']) <> "") {

                    $uploadedName29 = $_FILES['29']['name'];
                    $ext29 = strtolower(substr($uploadedName29, strripos($uploadedName29, '.')+1));
                    $filename29 = round(microtime(true)).mt_rand().'.'.$ext29;
                    
                    $uploadfile_29_situacny_planik = $uploaddir . $upload_id . "_0_" .$filename29;
                    
                      echo '<pre>';
                      
                        if (move_uploaded_file($_FILES['29']['tmp_name'], $uploadfile_29_situacny_planik)) {
                            echo "Súbor <b>".$_FILES['29']['name']."</b> sa nahral na server.\n";
                        } else {
                            echo "Súbor <b>".$_FILES['29']['name']."</b> sa nenahral!\n";
                        }
                        
                      
                      echo "</pre>";                   
                    $wpdb->update("dm_br_uzemia", array("29_situacny_planik"           =>   $upload_id . "_0_" .$filename29), array("00_id" => $_GET["id"]));
                      
                    }

                    //ilustracne foto 1                    
                    if (basename($_FILES['30']['name']) <> "") {

                    $uploadedName30 = $_FILES['30']['name'];
                    $ext30 = strtolower(substr($uploadedName30, strripos($uploadedName30, '.')+1));
                    $filename30 = round(microtime(true)).mt_rand().'.'.$ext30;
                    
                    $uploadfile_30_fotodok_lokality = $uploaddir . $upload_id . "_1_" .$filename30;
                                        
                      echo '<pre>';
                      
                        if (move_uploaded_file($_FILES['30']['tmp_name'], $uploadfile_30_fotodok_lokality)) {
                            echo "Súbor <b>".$_FILES['30']['name']."</b> sa nahral na server.\n";
                        } else {
                            echo "Súbor <b>".$_FILES['30']['name']."</b> sa nenahral!\n";
                        }
                        
                      echo "</pre>";                    
                    $wpdb->update("dm_br_uzemia", array("30_ilu_foto_1"           =>   $upload_id . "_1_" .$filename30), array("00_id" => $_GET["id"]));
                    }
                    

                    //ilustracne foto 2                    
                    if (basename($_FILES['31']['name']) <> "") {

                    $uploadedName31 = $_FILES['31']['name'];
                    $ext31 = strtolower(substr($uploadedName31, strripos($uploadedName31, '.')+1));
                    $filename31 = round(microtime(true)).mt_rand().'.'.$ext31;
                    
                    $uploadfile_31_fotodok_lokality = $uploaddir . $upload_id . "_2_" .$filename31;
                                        
                      echo '<pre>';
                      
                        if (move_uploaded_file($_FILES['31']['tmp_name'], $uploadfile_31_fotodok_lokality)) {
                            echo "Súbor <b>".$_FILES['31']['name']."</b> sa nahral na server.\n";
                        } else {
                            echo "Súbor <b>".$_FILES['31']['name']."</b> sa nenahral!\n";
                        }
                        
                      echo "</pre>";                    
                    $wpdb->update("dm_br_uzemia", array("31_ilu_foto_2"           =>   $upload_id. "_2_" .$filename31), array("00_id" => $_GET["id"]));
                    }

                    //zamena ilustracnych foto                    
                    if ( isset($_POST['zamena_ilu']) ) { 
                      $wpdb->update("dm_br_uzemia", array("30_ilu_foto_1"           =>  $_POST["ilu31"] ), array("00_id" => $_GET["id"]));
                      $wpdb->update("dm_br_uzemia", array("31_ilu_foto_2"           =>  $_POST["ilu30"] ), array("00_id" => $_GET["id"]));                                        
                    }

               /////////////
               //// Data update
               /////////////

               $post12 = ""; $post14 = ""; $post41 = "";
               $post12 = implode('|',$_POST['12']).'|';
               $post14 = implode('|',$_POST['14']).'|';
               $post41 = implode('|',$_POST['41']).'|';
               
               $wpdb->update("dm_br_uzemia", array(
                                                        '00_invent_cislo'              =>   $_POST["A001"],
                                                        '00_schvalene'                 =>   $_POST["A002"],
                                                        '00_vyradene'                  =>   $_POST["A003"],
                                                        '00_datum_aktualizacie'        =>   date("d.m.Y H:i:s",time()+ 60*60*2),                                                                   
                                                        '00_datum_zaradenia'           =>   $_POST["A006"],
                                                        '00_datum_vyradenia'           =>   $_POST["A007"],
                                                        '00_gps_lon'                   =>   $_POST["A008"],
                                                        '00_gps_lat'                   =>   $_POST["A009"],
                                                        '01_meno_priezvisko'           =>   $_POST['01'],
                                                        '02_email'                     =>   $_POST['02'],
                                                        '03_nazov_lokality'            =>   $_POST['03'],
                                                        '04_kraj'                      =>   $_POST['04'],
                                                        '05_okres'                     =>   $_POST['05'],
                                                        '06_obec'                      =>   $_POST['06'],
                                                        '07_adresa'                    =>   $_POST['07'],
                                                        '08_typ_lokality_id'           =>   $_POST['8'],
                                                        '09_poloha_zast_uzemia_id'     =>   $_POST['9'],
                                                        '10_rozloha_arealu'            =>   $_POST['10'],
                                                        '11_druh_vlastnictva_id'       =>   $_POST['11'],
                                                        '12_povodne_vyuzitie_id'       =>   $post12,
                                                        '13_povodne_vyuzitie_ine'      =>   $_POST['13'],
                                                        '14_sucasne_vyuzitie_id'       =>   $post14,
                                                        '15_sucasne_vyuzitie_ine'      =>   $_POST['15'],
                                                        '16_vyuzitie_arealu_id'        =>   $_POST['16'],                          
                                                        '17_pecatenie_pody_id'         =>   $_POST['17'],
                                                        '18_char_jest_veg'             =>   $_POST['18'],
                                                        '19_kontam_lok_id'             =>   $_POST['19'],                          
                                                        '20_kontam_lok_kon'            =>   $_POST['20'],
                                                        '22_ochr_prir_hod_prv'         =>   $_POST['22'],
                                                        '23_ochr_prir_hod_popis'       =>   $_POST['23'],
                                                        '24_pocet_objektov'            =>   $_POST['24'],
                                                        '25_funk_vyuz_upn'             =>   $_POST['25'],
                                                        '26_kategoria_roz_pot_id'      =>   $_POST['26'],
                                                        '27_zname_zamery'              =>   $_POST['27'],
                                                        '28_struc_char_pozn'           =>   $_POST['28'],
                                                        '40_telefonne_cislo'           =>   $_POST['40'],
                                                        '41_dost_tech_inf_id'          =>   $post41,
                                                        '42_druh_vlastnictva_ine'      =>   $_POST['42']                                                        
                                                   ), array("00_id" => $_GET["id"])                                              
                            );
                            
                //Pocet objektov
                $getid = $_GET["id"];
                $wpdb->query($wpdb->prepare("DELETE FROM dm_br_uzemia_obj WHERE 00_id = '%d'",$getid));
                                    
                for ($i = 0; $i < count($_POST['32']); $i++) {
    

                            $wpdb->insert('dm_br_uzemia_obj', array(
                                                        '00_id'                        =>   $_GET["id"],
                                                        '32_klasif_stavby_id'          =>   $_POST['32'][$i],
                                                        '33_rozl_objektu'              =>   $_POST['33'][$i],
                                                        '34_stav_tech_stav_id'         =>   $_POST['34'][$i],
                                                        '35_druh_vlastnictva_id'       =>   $_POST['35'][$i],
                                                        '36_pocet_podlazi_id'          =>   $_POST['36'][$i],
                                                        '38_ochr_kult_hod_id'          =>   $_POST['38'][$i],
                                                        '39_ochr_kult_hod_evi'         =>   $_POST['39'][$i]
                                                   )                                              
                            );

                }            


		} 

///////////////////////////
/////// B. Zakladny formular
///////////////////////////
    
    $result = $wpdb->get_row("SELECT 
                              a.00_id AS A000, a.00_invent_cislo AS A001, a.00_schvalene AS A002, a.00_vyradene AS A003, a.00_datum_pridania AS A004, a.00_datum_aktualizacie AS A005, 
                              a.00_datum_zaradenia AS A006, a.00_datum_vyradenia AS A007, a.00_gps_lon AS A008, a.00_gps_lat AS A009, 
                              a.01_meno_priezvisko AS A01, a.02_email AS A02, a.03_nazov_lokality AS A03, a.04_kraj AS A04,
                              a.05_okres AS A05, a.06_obec AS A06, a.07_adresa AS A07, a.08_typ_lokality_id AS A08,
                              a.09_poloha_zast_uzemia_id AS A09, a.10_rozloha_arealu AS A10, a.11_druh_vlastnictva_id AS A11,
                              a.12_povodne_vyuzitie_id AS A12, a.13_povodne_vyuzitie_ine AS A13, a.14_sucasne_vyuzitie_id AS A14, a.15_sucasne_vyuzitie_ine AS A15, 
                              a.16_vyuzitie_arealu_id AS A16, a.17_pecatenie_pody_id AS A17, a.18_char_jest_veg AS A18, 
                              a.19_kontam_lok_id AS A19, a.20_kontam_lok_kon AS A20, 
                              a.22_ochr_prir_hod_prv AS A22, a.23_ochr_prir_hod_popis AS A23, a.24_pocet_objektov AS A24, a.25_funk_vyuz_upn AS A25,
                              a.26_kategoria_roz_pot_id AS A26, a.27_zname_zamery AS A27, a.28_struc_char_pozn AS A28, a.29_situacny_planik AS A29,     
                              a.30_ilu_foto_1 AS A30, a.31_ilu_foto_2 AS A31, a.40_telefonne_cislo AS A40, a.41_dost_tech_inf_id AS A41, a.42_druh_vlastnictva_ine AS A42
                              FROM dm_br_uzemia AS a WHERE a.00_id = ".$_GET['id']." " );

    $result2 = $wpdb->get_results ("SELECT 
                                    a.32_klasif_stavby_id AS A32, a.33_rozl_objektu AS A33, a.34_stav_tech_stav_id AS A34, 
                                    a.35_druh_vlastnictva_id AS A35, a.36_pocet_podlazi_id AS A36, 
                                    a.38_ochr_kult_hod_id AS A38, a.39_ochr_kult_hod_evi AS A39 
                                    FROM dm_br_uzemia_obj AS a WHERE a.00_id = ".$_GET['id']." " );

                     function listoptions($filter,$selected) {
                         global $wpdb;
                         
                         $filternumber = str_replace("[]", "", $filter);
                         $result_items = $wpdb->get_results ( "SELECT id, name FROM dm_br_form_items WHERE item_id = '".$filternumber."'" );
                         
                         $listoptions = "<select name='".$filter."'><option value='0'>Prosím vyberte </option>";
                                                  
                             foreach ( $result_items as $row )
                              {
                                    
                                    if ($row->id === $selected ) {
                                      $x = "selected='selected'";
                                    } else {
                                      $x = "";                                
                                    }
                                    $listoptions .= "<option ".$x." value='".$row->id."'>".$row->name."</option>";
                                    
                              }
                          
                          $listoptions .= "</select>";
                          return $listoptions;
                         
                     }
                     
                     function listoptionsmultiple($filtermultiple,$selectedmultiple) {
                         global $wpdb;
                         $result_items = $wpdb->get_results ( "SELECT id, name FROM dm_br_form_items WHERE item_id = '".$filtermultiple."'" );

                         $listoptionsmultiple = "<select name='".$filtermultiple."[]' multiple><option value='0'>Prosím vyberte --> </option>";
                                                  
                             foreach ( $result_items as $row )
                              {
                                    $pos = strpos(strval($selectedmultiple), strval($row->id)."|");
                                    
                                    if ($pos !== false) {
                                      $x = "selected='selected'";
                                    } else {
                                      $x = "";                                
                                    }
                                    $listoptionsmultiple .= "<option ".$x." value='".$row->id."'>".$row->name."</option>";
                                    
                              }
                          
                          $listoptionsmultiple .= "</select>";
                          return $listoptionsmultiple;
                     }
                     
                     function listoptionsradio($filter,$selected) {

                        $radio1 = "";$radio2 = "";
                        ($selected =="1" ? $radio1 = " checked " : $radio2 = " checked ");                     
                     
                        $listoptionsradio = "<fieldset> "; 
                        $listoptionsradio .= "Áno: <input type='radio' ".$radio1." value='1' name='".$filter."'>";
                        $listoptionsradio .= "Nie: <input type='radio' ".$radio2." value='2' name='".$filter."'>";
                        $listoptionsradio .= "</fieldset>";                     
                        return $listoptionsradio;
                        
                     }
                    
               
               echo "

                  <link rel='stylesheet' href='//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>
                  <link rel='stylesheet' href='/wp-content/plugins/b/css/b-form.css'>
                  
                  <script src='https://code.jquery.com/jquery-1.12.4.js'></script>
                  <script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>
                  <script src='/wp-content/plugins/b/js/b-admin.js'></script>
        
        				<form enctype='multipart/form-data' action='' method='post'>
            		   <div class='row brown-row' style='margin-top:20px;'> <h2>Administrátorské údaje</h2>                                   </div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Poradové číslo :</label>                             </div>                        <div class='col60 brown-col60'><b>".$result->A000."</b></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Inventarizačné číslo :</label>                       </div>                        <div class='col60 brown-col60'><input type='text' name='A001' value='".$result->A001."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Schválené :</label>                                  </div>                        <div class='col60 brown-col60'>". listoptionsradio("A002",$result->A002). "</div></div>
            		   <div class='row brown-row'> <div class='col40 brown-col40'><label>Vyradené :</label>                                   </div>                        <div class='col60 brown-col60'>". listoptionsradio("A003",$result->A003). "</div></div>
            		   <div class='row brown-row'> <div class='col40 brown-col40'><label>Dátum/čas pridania :</label>                         </div>                        <div class='col60 brown-col60'><b>".$result->A004."</b></div></div>
            		   <div class='row brown-row'> <div class='col40 brown-col40'><label>Dátum/čas aktualizácie :</label>                     </div>                        <div class='col60 brown-col60'><b>".$result->A005."</b></div></div>
            		   <div class='row brown-row'> <div class='col40 brown-col40'><label>Dátum/čas zaradenia :</label>                        </div>                        <div class='col60 brown-col60'><input type='text' id='A006' name='A006' value='".$result->A006."'></div></div>
            		   <div class='row brown-row'> <div class='col40 brown-col40'><label>Dátum/čas vyradenia :</label>                        </div>                        <div class='col60 brown-col60'><input type='text' id='A007' name='A007' value='".$result->A007."'></div></div>                                      
            		   <div class='row brown-row'> <div class='col40 brown-col40'>&nbsp;                                                      </div>                        <div class='col60 brown-col60'>&nbsp; </div></div>



            		   <div class='row brown-row' style='margin-top:20px;'> <h2>Kontaktná osoba</h2>                                          </div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Meno a priezvisko:</label>                           </div>                        <div class='col60 brown-col60'><input type='text' name='01' value='".$result->A01."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Telefónne číslo:</label>                             </div>                        <div class='col60 brown-col60'><input type='text' name='40' value='".$result->A40."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Email:</label>                                       </div>                        <div class='col60 brown-col60'><input type='text' name='02' value='".$result->A02."'></div></div>
                   
            		   <div class='row brown-row' style='margin-top:20px;'> <h2>Základné informácie o lokalite</h2>                           </div>                        
            		   <div class='row brown-row'> <div class='col40 brown-col40'><label>Názov lokality:</label>                              </div>                        <div class='col60 brown-col60'><input type='text' name='03' value='".$result->A03."' maxlength='50'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Kraj:</label>                                        </div>                        <div class='col60 brown-col60'><input type='text' id='04' name='04' value='".$result->A04."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Okres:</label>                                       </div>                        <div class='col60 brown-col60'><input type='text' id='05' name='05' value='".$result->A05."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Obec:</label>                                        </div>                        <div class='col60 brown-col60'><input type='text' id='06' name='06' value='".$result->A06."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Adresa (ulica, číslo, PSČ):</label>                  </div>                        <div class='col60 brown-col60'><input type='text' id='07' name='07' value='".$result->A07."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Typ lokality:</label>                                </div>                        <div class='col60 brown-col60'>". listoptions("8",$result->A08). "</div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Poloha v rámci zastavaného územia:</label>           </div>                        <div class='col60 brown-col60'>". listoptions("9",$result->A09). "</div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>GPS - Longitude: </label>                            </div>                        <div class='col60 brown-col60'><input  type='text' id='A008' name='A008' value='".$result->A008."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>GPS - Latitude:</label>                              </div>                        <div class='col60 brown-col60'><input type='text' id='A009' name='A009' value='".$result->A009."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>&nbsp;</label>                                       </div>                        <div class='col60 brown-col60'> <button id='gpsbutton' onclick='return false;' > Získať GPS </button> &nbsp;&nbsp;<a target='_blank' href='http://maps.google.com/maps/place/".$result->A07."+".$result->A06."/@".$result->A009.",".$result->A008.",15z'>[Otvoriť]</a></div></div>
                   
            		   <div class='row brown-row' style='margin-top:20px;'> <h2>Informácie o areáli</h2>                                      </div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Rozloha areálu v m&#178;:</label>                    </div>                        <div class='col60 brown-col60'><input type='text' name='10' value='".$result->A10."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Druh vlastníctva areálu:</label>                     </div>                        <div class='col60 brown-col60'>". listoptions("11",$result->A11). "</div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>&nbsp;</label>                                       </div>                        <div class='col60 brown-col60'><input type='text' name='42' value='".$result->A42."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Pôvodné využitie:</label>                            </div>                        <div class='col60 brown-col60'>". listoptionsmultiple("12",$result->A12). "</div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>&nbsp;</label>                                       </div>                        <div class='col60 brown-col60'><input type='text' name='13' value='".$result->A13."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Súčasné využitie:</label>                            </div>                        <div class='col60 brown-col60'>". listoptionsmultiple("14",$result->A14). "</div></div>                                  
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>&nbsp;</label>                                       </div>                        <div class='col60 brown-col60'><input type='text' name='15' value='".$result->A15."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Využitie areálu v %:</label>                         </div>                        <div class='col60 brown-col60'>". listoptions("16",$result->A16). "</div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Pečatenie pôdy v % :</label>                         </div>                        <div class='col60 brown-col60'>". listoptions("17",$result->A17). "</div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Dostupnosť technickej infraštruktúry:</label>        </div>                        <div class='col60 brown-col60'>". listoptionsmultiple("41",$result->A41). "</div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Charakteristika jestvujúcej vegetácie :</label>      </div>                        <div class='col60 brown-col60'><input type='text' name='18' value='".$result->A18."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Kontaminácia lokality:</label>                       </div>                        <div class='col60 brown-col60'>". listoptions("19",$result->A19). "</div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>&nbsp;</label>                                       </div>                        <div class='col60 brown-col60'><input type='text' name='20' value='".$result->A20."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Ochrana prírodných hodnôt:</label>                   </div>                        <div class='col60 brown-col60'>". listoptions("22",$result->A22). "</div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>&nbsp;</label>                                       </div>                        <div class='col60 brown-col60'> <input type='text' name='23' value='".$result->A23."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Počet objektov:</label>                              </div>                        <div class='col60 brown-col60'> ". listoptions("24",$result->A24). "</div></div>
                       
            		   <div id='container-objekty-header' class='row' style='width:100%;display:table;clear:both;margin-top:20px;'> <h2>Informácie o objektoch</h2>                                               </div>
                                       <div id='container-objekty'>
                    ";
                     foreach ( $result2 as $page ) {
                    echo "

                             <div id='objekty'>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label>Klasifikácia stavby/typ:</label>                     </div>                        <div class='col60 brown-col60'> ". listoptions("32[]",$page->A32). "</div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label>Rozloha/veľkosť objektu v m&#178;/m:</label>         </div>                        <div class='col60 brown-col60'> <input type='text' name='33[]' value='".$page->A33."'></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label>Stavebno-technický stav:</label>                     </div>                        <div class='col60 brown-col60'> ". listoptions("34[]",$page->A34). "</div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label>Druh vlastníctva objektu:</label>                    </div>                        <div class='col60 brown-col60'> ". listoptions("35[]",$page->A35). "</select></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label>Počet podlaží:</label>                               </div>                        <div class='col60 brown-col60'> ". listoptions("36[]",$page->A36). "</select></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label>Ochrana kultúrnych hodnôt:</label>                   </div>                        <div class='col60 brown-col60'> ". listoptions("38[]",$page->A38). "</div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label>Názov pamätihodnosti a čislo: </label>               </div>                        <div class='col60 brown-col60'> <input type='text' name='39[]' value='".$page->A39."'></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label>&nbsp;</label>                                       </div>                        <div class='col60 brown-col60'> &nbsp; </div></div>
                             </div>
                    
                    ";
                    } ;
                    
                    echo "                  
                                       </div>                   
                   <div id='container-objekty-button' class='row' style='width:100%;display:table;clear:both;'> <div class='col40' style='width:40%;float:left;margin-top:6px;'><label>&nbsp;</label> </div>                        <div class='col60 brown-col60'> <button onclick='cloning();return false;' >+ Pridať ďalšie objekty </button> </div></div>                   
                   
                   <div class='row brown-row' style='margin-top:20px;'> <h2>Možnosti využitia</h2>                                                                                  </div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Funkčné využitie a regulácia v zmysle platného ÚPN obce:</label></div>           <div class='col60 brown-col60'>". listoptions("25",$result->A25). "</div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Kategória podľa rozvojového potenciálu:</label>      </div>                      <div class='col60 brown-col60'> ". listoptions("26",$result->A26). "</div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Známe zámery:</label>                                </div>                      <div class='col60 brown-col60'> <textarea type='text' name='27' rows='4' cols='50'>".$result->A27."</textarea></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Stručná charakteristika/poznámka:</label>            </div>                      <div class='col60 brown-col60'> <textarea type='text' name='28' rows='4' cols='50'>".$result->A28."</textarea></div></div>

            		   <div class='row brown-row' style='margin-top:20px;'> <h2>Obrazové prílohy</h2>                                         </div>                        
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Situačný plánik lokality/mapka:</label>              </div>                      <div class='col60 brown-col60'> <input accept='.jpg,.jpeg,.png,.pdf,.docx,.doc' type='file' name='29' > <a target='_blank' href='../uploads/".$result->A29."'>".$result->A29."</a></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Ilustračné foto 1:</label>                           </div>                      <div class='col60 brown-col60'> <input accept='.jpg,.jpeg,.png,.pdf,.docx,.doc' type='file' name='30' > <a target='_blank' href='../uploads/".$result->A30."'>".$result->A30."</a><input type='hidden' name='ilu30' value='".$result->A30."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Ilustračné foto 2:</label>                           </div>                      <div class='col60 brown-col60'> <input accept='.jpg,.jpeg,.png,.pdf,.docx,.doc' type='file' name='31' > <a target='_blank' href='../uploads/".$result->A31."'>".$result->A31."</a><input type='hidden' name='ilu31' value='".$result->A31."'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Zameniť úvodné ilustračné foto: </label>             </div>                      <div class='col60 brown-col60'> <input type='checkbox' name='zamena_ilu'></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label>&nbsp;</label>                                       </div>                      <div class='col60 brown-col60'> &nbsp;</div></div>
                                                                                                                  
                   <div class='row brown-row'> <div class='col40 brown-col40'><input id='submit' class='button button-primary' style='width:150px;' type='submit' name='submit' value='Aktualizovať'/> <input style='width:150px;' class='button' type='button' onclick='window.location.replace(\"/wp-admin/admin.php?page=b-plugin\")' value='Späť' /></div></div>
        			</form>
        
        
        
  
        
        		   ";


?>