<?php

    $url_string = removeqsvar($url_string, "id");

                      // Read database
                      $result = $wpdb->get_row("SELECT 
                                                a.00_id AS A000, a.00_invent_cislo AS A001, a.00_schvalene AS A002, a.00_vyradene AS A003, a.00_datum_pridania AS A004, a.00_datum_aktualizacie AS A005, 
                                                a.00_datum_zaradenia AS A006, a.00_datum_vyradenia AS A007, a.00_gps_lon AS A008, a.00_gps_lat AS A009, 
                                                a.01_meno_priezvisko AS A01, a.02_email AS A02, a.03_nazov_lokality AS A03, a.04_kraj AS A04,
                                                a.05_okres AS A05, a.06_obec AS A06, a.07_adresa AS A07, a.08_typ_lokality_id AS A08,
                                                a.09_poloha_zast_uzemia_id AS A09, a.10_rozloha_arealu AS A10, a.11_druh_vlastnictva_id AS A11,
                                                a.12_povodne_vyuzitie_id AS A12, a.13_povodne_vyuzitie_ine AS A13, a.14_sucasne_vyuzitie_id AS A14, a.15_sucasne_vyuzitie_ine AS A15, 
                                                a.16_vyuzitie_arealu_id AS A16, a.17_pecatenie_pody_id AS A17, a.18_char_jest_veg AS A18, 
                                                a.19_kontam_lok_id AS A19, a.20_kontam_lok_kon AS A20, a.21_ochr_prir_hod_radio AS A21,
                                                a.22_ochr_prir_hod_prv AS A22, a.23_ochr_prir_hod_popis AS A23, a.24_pocet_objektov AS A24, a.25_funk_vyuz_upn AS A25,
                                                a.26_kategoria_roz_pot_id AS A26, a.27_zname_zamery AS A27, a.28_struc_char_pozn AS A28, a.29_situacny_planik AS A29,     
                                                a.30_ilu_foto_1 AS A30, a.31_ilu_foto_2 AS A31
                                                FROM dm_br_uzemia AS a WHERE a.00_id = ".intval(test_input($_GET['id']))." AND a.00_schvalene = '1' AND a.00_vyradene <> '1' " );    
                      // Read database                  
                      $result2 = $wpdb->get_results ("SELECT 
                                                      a.32_klasif_stavby_id AS A32, a.33_rozl_objektu AS A33, a.34_stav_tech_stav_id AS A34, 
                                                      a.35_druh_vlastnictva_id AS A35, a.36_pocet_podlazi_id AS A36, a.37_ochr_kult_hod_radio AS A37, 
                                                      a.38_ochr_kult_hod_id AS A38, a.39_ochr_kult_hod_evi AS A39 
                                                      FROM dm_br_uzemia_obj AS a WHERE a.00_id = ".intval(test_input($_GET['id']))."  " );

                     //List function
                     function listoptions($filter) {
                         global $wpdb;
                         
                         $listoptions ="";
                         $result_items = $wpdb->get_row( "SELECT id, name FROM dm_br_form_items WHERE id = '".$filter."'" );
                         
                                                 
                                   
                                    $listoptions .= $result_items->name;
                                    

                          
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

                    //Show detail if exist
                    If (!empty($result)) {
                                     
                                  echo "
                                  <style type='text/css'>
                                    div.col40 {font-weight:700;width:40%;float:left;margin-top:6px;}
                                    div.col60 {width:60%;float:left;margin-top:6px;}
                                    div.tablerow {width:100%;display:table;clear:both;padding-left:8px;}
                                    div.tablerowtopic {width:100%;display:table;clear:both;background-color:#deeeff;padding:10px;margin-top:20px;font-weight:700;color:#1e4e9d;}
                                  </style>
                                  ";
                  
                                 echo "
                                  <div style='border-width:1px;border-style:solid;border-color:#efefef;margin-bottom:30px;'>
                                         
                                     <div class='row tablerowtopic' style='margin-top:6px;'>".$result->A03."</div>
                                     <div class='row tablerow'> <div class='col40'><label>Kraj:</label>                                        </div>                        <div class='col60'>".$result->A04."</div></div>
                                     <div class='row tablerow'> <div class='col40'><label>Okres:</label>                                       </div>                        <div class='col60'>".$result->A05."</div></div>
                                     <div class='row tablerow'> <div class='col40'><label>Obec:</label>                                        </div>                        <div class='col60'>".$result->A06."</div></div>
                                     <div class='row tablerow'> <div class='col40'><label>Typ lokality:</label>                                </div>                        <div class='col60'>". listoptions($result->A08). "</div></div>
                                     <div class='row tablerow'> <div class='col40'><label>Poloha v rámci zastavaného územia:</label>           </div>                        <div class='col60'>". listoptions($result->A09). "</div></div>
                                     <div class='row tablerow'> <div class='col40'><label>Lokalizácia na mape: </label>                        </div>                        <div class='col60' ><a target='_blank' href='http://maps.google.com/maps/place/".$result->A07."+".$result->A06."/@".$result->A009.",".$result->A008.",15z'>[Otvoriť]</a></div></div>
                                                        
                                     <div class='row tablerowtopic'><span>Informácie o areáli</span></div>
                                     <div class='row tablerow'> <div class='col40'><label>Rozloha areálu v m&#178;:</label>                    </div>                        <div class='col60'>".$result->A10."</div></div>
                                     <div class='row tablerow'> <div class='col40'><label>Druh vlastníctva areálu:</label>                     </div>                        <div class='col60'>". listoptions($result->A11). "</div></div>
                                     <div class='row tablerow'> <div class='col40'><label>Pôvodné využitie:</label>                            </div>                        <div class='col60'>". listoptionsmultiple($result->A12). "</div></div>
                                     <div class='row tablerow'> <div class='col40'><label>&nbsp;</label>                                       </div>                        <div class='col60'>".$result->A13."</div></div>
                                     <div class='row tablerow'> <div class='col40'><label>Súčasné využitie:</label>                            </div>                        <div class='col60'>". listoptionsmultiple($result->A14). "</div></div>                                  
                                     <div class='row tablerow'> <div class='col40'><label>&nbsp;</label>                                       </div>                        <div class='col60'>".$result->A15."</div></div>
                                     <div class='row tablerow'> <div class='col40'><label>Využitie areálu v %:</label>                         </div>                        <div class='col60'>". listoptions($result->A16). "</div></div>
                                     <div class='row tablerow'> <div class='col40'><label>Kontaminácia lokality:</label>                       </div>                        <div class='col60'>". listoptions($result->A19). "</div></div>
                                     <div class='row tablerow'> <div class='col40'><label>&nbsp;</label>                                       </div>                        <div class='col60'>".$result->A20."</div></div>
                                     <div class='row tablerow'> <div class='col40'><label>Počet objektov:</label>                              </div>                        <div class='col60'> ". listoptions($result->A24). "</div></div>";
                  
                  
                                     if ( listoptions($result->A24) <> "0") {    
                              		   echo "<div id='container-objekty-header' class='row tablerowtopic'><span>Informácie o objektoch</span></div>
                                                         <div id='container-objekty'>
                                      ";
                                     $i = 1;
                                       foreach ( $result2 as $page ) {
                                        echo "
                                               <div id='objekty'>
                                                 <div class='row tablerow'> <div class='col40'>Objekt ".$i.":                                              </div>                        <div class='col60'>&nbsp;</div></div>
                                                 <div class='row tablerow'> <div class='col40'><label>Klasifikácia stavby/typ:</label>                     </div>                        <div class='col60'> ". listoptions($page->A32). "</div></div>
                                                 <div class='row tablerow'> <div class='col40'><label>Rozloha/veľkosť objektu v m&#178;/m:</label>         </div>                        <div class='col60'> ".$page->A33."</div></div>
                                                 <div class='row tablerow'> <div class='col40'><label>Stavebno-technický stav:</label>                     </div>                        <div class='col60'> ". listoptions($page->A34). "</div></div>
                                                 <div class='row tablerow'> <div class='col40'><label>Druh vlastníctva objektu:</label>                    </div>                        <div class='col60'> ". listoptions($page->A35). "</select></div></div>
                                                 <div class='row tablerow'> <div class='col40'><label>&nbsp;</label>                                       </div>                        <div class='col60'> &nbsp; </div></div>
                                               </div>
                                      
                                      ";
                                      $i = $i + 1;
                                      } ;
                                      
                                      echo "</div>";
                                      
                                      }                   
                                      echo "
                                     <div class='row tablerowtopic'><span>Obrazové prílohy</span></div>
                                     <div class='row tablerow'> <div class='col40'><label>Situačný plánik lokality/mapka:</label>              </div>                      <div class='col60'> <a target='_blank' href='../uploads/".$result->A29."'>".$result->A29."</a></div></div>
                                     <div style='width:500px;padding:10px;display:block;margin: 0 auto;'> <a target='_blank' href='../uploads/".$result->A30."' ><img style='max-width:200px;max-height:150px;' src='../uploads/".$result->A30."'></a> <a target='_blank' href='../uploads/".$result->A31."' ><img style='max-width:200px;max-height:150px;' src='../uploads/".$result->A31."'></a></div>
                                   </div>
                  
                                     <div class='row tablerow'> <div class='col40'><input class='button' type='button' onclick='window.location.replace(\"/b/".$url_string."strana=".$_GET['strana']."\")' value='Späť' /></div></div>        
                          		   ";
                    }
     
  
?>