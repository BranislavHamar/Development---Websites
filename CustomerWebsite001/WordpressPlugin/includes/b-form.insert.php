<?php

////////////////////////////////////////////
// After success - Insert succesful data
////////////////////////////////////////////

                             echo "<pre>";   
                      		   echo "<h2 style='color:green;'>Ďakujeme, formulár bol úspešne odoslaný.</h2>";
                             echo "<button  onclick=\"window.location.href='https://xxxxxx/'\">Pridať ďalší brownfield</button>";  
                             echo "</pre>";  
              
                              /////// Upload do databazy
                                     
                             $post12 = implode('|',$_POST['12']).'|';
                             $post14 = implode('|',$_POST['14']).'|';
                             $post41 = implode('|',$_POST['41']).'|';
                                           
                            
                              global $wpdb;
                             
                              $wpdb->insert('dm_br_uzemia', array(
                                                                      '00_schvalene'                 =>   '0',
                                                                      '00_datum_pridania'            =>   date("d.m.Y H:i:s",time()+ 60*60*2),           
                                                                      '00_datum_aktualizacie'        =>   date("d.m.Y H:i:s",time()+ 60*60*2),
                                                                      '01_meno_priezvisko'           =>   $post01,
                                                                      '02_email'                     =>   $post02,
                                                                      '03_nazov_lokality'            =>   $post03,
                                                                      '04_kraj'                      =>   $post04,
                                                                      '05_okres'                     =>   $post05,
                                                                      '06_obec'                      =>   $post06,
                                                                      '07_adresa'                    =>   $post07,
                                                                      '08_typ_lokality_id'           =>   $post08,
                                                                      '09_poloha_zast_uzemia_id'     =>   $post09,
                                                                      '10_rozloha_arealu'            =>   $post10,
                                                                      '11_druh_vlastnictva_id'       =>   $post11,
                                                                      '12_povodne_vyuzitie_id'       =>   $post12,
                                                                      '13_povodne_vyuzitie_ine'      =>   $post13,
                                                                      '14_sucasne_vyuzitie_id'       =>   $post14,
                                                                      '15_sucasne_vyuzitie_ine'      =>   $post15,
                                                                      '16_vyuzitie_arealu_id'        =>   $post16,                          
                                                                      '17_pecatenie_pody_id'         =>   $post17,
                                                                      '18_char_jest_veg'             =>   $post18,
                                                                      '19_kontam_lok_id'             =>   $post19,                          
                                                                      '20_kontam_lok_kon'            =>   $post20,
                                                                      '22_ochr_prir_hod_prv'         =>   $post22,
                                                                      '23_ochr_prir_hod_popis'       =>   $post23,
                                                                      '24_pocet_objektov'            =>   $post24,
                                                                      '25_funk_vyuz_upn'             =>   $post25,
                                                                      '26_kategoria_roz_pot_id'      =>   $post26,
                                                                      '27_zname_zamery'              =>   $post27,
                                                                      '28_struc_char_pozn'           =>   $post28,
                                                                      '40_telefonne_cislo'           =>   $post40,
                                                                      '41_dost_tech_inf_id'          =>   $post41,
                                                                      '42_druh_vlastnictva_ine'      =>   $post42
                                                                 )                                              
                                          );
                            
                              $lastid = $wpdb->insert_id;
                              
                              
                              if (isset($_POST['32'])) {
                              
                                  $pocetobjektov = count($_POST['32']);
                                  
                              } else {
                                  $pocetobjektov = 0;
                              }
                              
                              
                              //Pocet objektov
                              for ($i = 0; $i < $pocetobjektov; $i++) {

                                          $post32[$i] = test_input($_POST['32'][$i]);
                                          $post33[$i] = test_input($_POST['33'][$i]);
                                          $post34[$i] = test_input($_POST['34'][$i]);
                                          $post35[$i] = test_input($_POST['35'][$i]);
                                          $post36[$i] = test_input($_POST['36'][$i]);
                                          $post38[$i] = test_input($_POST['38'][$i]);                                          
                                          $post39[$i] = test_input($_POST['39'][$i]);                                          
                                                                                                  
                                          $wpdb->insert('dm_br_uzemia_obj', array(
                                                                      '00_id'                        =>   $lastid,
                                                                      '32_klasif_stavby_id'          =>   $post32[$i],
                                                                      '33_rozl_objektu'              =>   $post33[$i],
                                                                      '34_stav_tech_stav_id'         =>   $post34[$i],
                                                                      '35_druh_vlastnictva_id'       =>   $post35[$i],
                                                                      '36_pocet_podlazi_id'          =>   $post36[$i],
                                                                      '38_ochr_kult_hod_id'          =>   $post38[$i],
                                                                      '39_ochr_kult_hod_evi'         =>   $post39[$i]
                                                                 )                                              
                                          );
              
                              }
              
                                  $uploaddir = '/var/www/html/uploads/';
                                  $upload_id = $lastid. "_";
                                                              
                                  //Situacny planik
                                  if (basename($_FILES['29']['name']) <> "") {
                                  
                                      $uploadedName29 = $_FILES['29']['name'];
                                      $ext29 = strtolower(substr($uploadedName29, strripos($uploadedName29, '.')+1));
                                      $filename29 = round(microtime(true)).mt_rand().'.'.$ext29;
                                      
                                      $uploadfile_29_situacny_planik = $uploaddir . $upload_id . "_0_" . $filename29;
                                      move_uploaded_file($_FILES['29']['tmp_name'], $uploadfile_29_situacny_planik);
                                      $wpdb->update("dm_br_uzemia", array("29_situacny_planik" =>  $upload_id . "_0_" .$filename29), array("00_id" => $lastid));
                                    
                                  }
              
                                  //ilustracne foto 1                    
                                  if (basename($_FILES['30']['name']) <> "") {
              
                                      $uploadedName30 = $_FILES['30']['name'];
                                      $ext30 = strtolower(substr($uploadedName30, strripos($uploadedName30, '.')+1));
                                      $filename30 = round(microtime(true)).mt_rand().'.'.$ext30;
                                      
                                      $uploadfile_30_fotodok_lokality = $uploaddir . $upload_id . "_1_" .$filename30;
                                      move_uploaded_file($_FILES['30']['tmp_name'], $uploadfile_30_fotodok_lokality);                  
                                      $wpdb->update("dm_br_uzemia", array("30_ilu_foto_1" =>   $upload_id . "_1_" .$filename30), array("00_id" => $lastid));
                  
                                  }
                                  
              
                                  //ilustracne foto 2                    
                                  if (basename($_FILES['31']['name']) <> "") {
              
                                      $uploadedName31 = $_FILES['31']['name'];
                                      $ext31 = strtolower(substr($uploadedName31, strripos($uploadedName31, '.')+1));
                                      $filename31 = round(microtime(true)).mt_rand().'.'.$ext31;
                                      
                                      $uploadfile_31_fotodok_lokality = $uploaddir . $upload_id . "_2_" .$filename31;
                                      move_uploaded_file($_FILES['31']['tmp_name'], $uploadfile_31_fotodok_lokality);
                                      $wpdb->update("dm_br_uzemia", array("31_ilu_foto_2" =>   $upload_id . "_2_" .$filename31), array("00_id" => $lastid));
                                  
                                  }
                                  


                                
?>