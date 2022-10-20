<?php                                                                          

$pos = strpos($_SERVER['HTTP_REFERER'], "https://xxxxxxxxxxxxxxx");   

if($pos === false) { 
echo "no hack sorry";
die();
}


//////
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $path = $_SERVER['DOCUMENT_ROOT'];
        include $path . '/wp-load.php';
        $wheresql = "";
        if (!isset($_GET['search'])) {$search = "";} else {$search = $_GET['search']; $wheresql=" WHERE a.00_invent_cislo LIKE '%".$search."%' OR a.03_nazov_lokality LIKE '%".$search."%' OR a.04_kraj LIKE '%".$search."%' OR a.05_okres LIKE '%".$search."%' OR a.06_obec LIKE '%".$search."%' OR a.07_adresa LIKE '%".$search."%' OR c.name LIKE '%".$search."%' OR d.name LIKE '%".$search."%' OR f.name LIKE '%".$search."%'";};
        
        $export_result = $wpdb->get_results ( "SELECT DISTINCT
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
                                              FROM  dm_br_uzemia AS a 
                                              LEFT JOIN dm_br_form_items AS b
                                              ON a.08_typ_lokality_id = b.id
                                              LEFT JOIN dm_br_form_items AS c
                                              ON a.26_kategoria_roz_pot_id = c.id
                                              LEFT JOIN dm_br_form_items AS d
                                              ON 11_druh_vlastnictva_id = d.id
                                              LEFT JOIN dm_br_uzemia_obj AS e
                                              ON a.00_id = e.00_id
                                              LEFT JOIN dm_br_form_items AS f
                                              ON 35_druh_vlastnictva_id = f.id
                                              ".$wheresql." 
                                              ORDER BY a.00_id DESC
                                              " );
          
                    function showoption($selected) {
                         global $wpdb;
                         $showoption = ""; 
                         $pos = strpos($selected, "|");
                         
                           if ($pos === false) {
                           
                             $result_items = $wpdb->get_row("SELECT name FROM dm_br_form_items WHERE id = '".$selected."'");
                             $showoption = (is_object($result_items) ? $result_items->name : $selected);
                           
                           } else {
  
                                $result_items_array = explode('|', $selected); //split string into array seperated by ', '
                                  foreach($result_items_array as $value) //loop over values
                                  {
                                      $result_items = $wpdb->get_row("SELECT name FROM dm_br_form_items WHERE id = '".$value."'");
                                      $showoption .= (is_object($result_items) ? $result_items->name. " / " : "") ;
                                  }
                    
  
                           }
                         $showoption = rtrim($showoption," / ");
                         return $showoption;
                         
                     }
                     
                     
                  function listoptionsradio($selected) {

                        $radio1 = "";$radio2 = "";
                        ($selected =="1" ? $radio1 = "Áno" : $radio2 = "Nie");                     
                     
                        $listoptionsradio = $radio1.$radio2; 
                        return $listoptionsradio;
                        
                     } 
                     
                     
/////////////////////////////////////////
//file XLS
////////////////////////////////////////                                                                   
                                   
          header('Content-Encoding: UTF-8');
          header("Content-Type: application/octet-stream"); 
          header("Content-Disposition: attachment; filename=xxxx_".date("YmdHis",time()).".csv"); 
          header("Pragma: no-cache");
          header("Expires: 0");
          echo "\xEF\xBB\xBF"; // UTF-8 BOM

          //$s = "\t";
          $s = ';';          
          //$s = '","';  
                    
          echo "NO.".$s.                                            
               "ID".$s.                                             //A000
               "INVENTARIZACNE CISLO".$s.                           //A001
               "SCHVALENE".$s.                                      //A002
               "VYRADENE".$s.                                       //A003
               "DATUM PRIDANIA".$s.                                 //A004
               "DATUM AKTUALIZACIE".$s.                             //A005
               "DATUM ZARADENIA".$s.                                //A006
               "DATUM VYRADENIA".$s.                                //A007
               "GPS LONGITUDE".$s.                                  //A008
               "GPS LATITUDE".$s.                                   //A009
               "MENO A PRIEZVISKO".$s.                              //A01
               "TELEFONNE CISLO".$s.                                //A40
               "EMAIL".$s.                                          //A02
               "NAZOV LOKALITY".$s.                                 //A03
               "KRAJ".$s.                                           //A04
               "OKRES".$s.                                          //A05
               "OBEC".$s.                                           //A06
               "ADRESA".$s.                                         //A07
               "TYP LOKALITY".$s.                                   //A08
               "POLOHA ZASTAVANEHO UZEMIA".$s.                      //A09                       
               "ROZLOHA AREALU".$s.                                 //A10
               "DRUH VLASTNICTVA".$s.                               //A11
               "DRUH VLASTNICTVA INE".$s.                           //A42
               "POVODNE VYUZITIE".$s.                               //A12
               "POVODNE VYUZITIE INE".$s.                           //A13
               "SUCASNE VYUZITIE".$s.                               //A14
               "SUCASNE VYUZITIE INE".$s.                           //A15
               "VYUZITIE AREALU".$s.                                //A16
               "PECATENIE PODY".$s.                                 //A17
               "DOST TECH INF".$s.                                  //A41
               "CHARAKTERISTIKA JEST. VEGETACIE".$s.                //A18
               "KONTAMINOVANA LOKALITA".$s.                         //A19
               "KONTAMINOVANA LOKALITA KON.".$s.                    //A20
               "OCHRANA PRIRODNY HODNOT".$s.                        //A22
               "OCHRANA PRIRODNY HODNOT POPIS".$s.                  //A23
               "POCET OBJEKTOV".$s.                                 //A24
               "FUNKCNE VYUZITIE UPN".$s.                           //A25
               "KATEGORIA ROZ POT".$s.                              //A26
               "ZNAME ZAMERY".$s.                                   //A27
               "STRUCNA CHARAKTERISTIKA".$s.                        //A28
               "SITUACNY PLANIK".$s.                                //A29
               "ILUSTRACNE FOTO 1".$s.                              //A30
               "ILUSTRACNE FOTO 2".$s.                              //A31
               "|".$s.
              
               $s;
               
          echo "\n";
          
              $rowid = 0;
              foreach ( $export_result as $page )
                {          
                  $rowid = $rowid+1;
                  echo $rowid.$s.
                       $page->A000.$s.
                       $page->A001.$s.
                       listoptionsradio($page->A002).$s.
                       listoptionsradio($page->A003).$s.
                       $page->A004.$s.
                       $page->A005.$s.
                       $page->A006.$s.
                       $page->A007.$s.
                       $page->A008.$s.
                       $page->A009.$s.
                       $page->A01.$s.
                       $page->A40.$s.                   
                       $page->A02.$s.
                       $page->A03.$s.
                       $page->A04.$s.
                       $page->A05.$s.
                       $page->A06.$s.
                       $page->A07.$s.
                       showoption($page->A08).$s.
                       showoption($page->A09).$s.
                       $page->A10.$s.
                       showoption($page->A11).$s.
                       $page->A42.$s.                   
                       showoption($page->A12).$s.
                       $page->A13.$s.
                       showoption($page->A14).$s.
                       $page->A15.$s.
                       showoption($page->A16).$s.
                       showoption($page->A17).$s.
                       showoption($page->A41).$s.
                       $page->A18.$s.
                       showoption($page->A19).$s.
                       $page->A20.$s.
                       showoption($page->A22).$s.
                       $page->A23.$s.
                       showoption($page->A24).$s.
                       showoption($page->A25).$s.
                       showoption($page->A26).$s.
                       preg_replace("/\r|\n|;/", "", $page->A27).$s.
                       preg_replace("/\r|\n|;/", "", $page->A28).$s.
                       $page->A29.$s.
                       $page->A30.$s.
                       $page->A31.$s;
                       
                       /// objekty
                       $export_result2 = $wpdb->get_results ("SELECT 
                                    a.32_klasif_stavby_id AS A32, a.33_rozl_objektu AS A33, a.34_stav_tech_stav_id AS A34, 
                                    a.35_druh_vlastnictva_id AS A35, a.36_pocet_podlazi_id AS A36, 
                                    a.38_ochr_kult_hod_id AS A38, a.39_ochr_kult_hod_evi AS A39 
                                    FROM dm_br_uzemia_obj AS a WHERE a.00_id = ".$page->A000." " );
                       
                                                  if (!is_null($export_result2)) {
                                                  
                                                    $i = 1;
                                                    foreach ( $export_result2 as $page2 )
                                                    {
                                                       
                                                      echo "OBJEKT ".$i."-> ".$s.
                                                           "KLASIFIKACIA STAVBY -> "              .showoption($page2->A32).$s.
                                                           "ROZLOHA OBJEKTU -> "                  .$page2->A33.$s.
                                                           "STAVEBNO TECHNICKY STAV -> "          .showoption($page2->A34).$s.
                                                           "DRUH VLASTNICTVA -> "                 .showoption($page2->A35).$s.
                                                           "POCET PODLAZI -> "                    .showoption($page2->A36).$s.
                                                           "OCHRANNA KULTURNYCH HODNOT -> "       .showoption($page2->A38).$s.
                                                           "OCHRANNA KULTURNYCH HODNOT EVID. -> " .$page2->A39.$s;
                                                           $i = $i + 1;
                                                    } 
                                                  
                                                  
                                                  }
                                                  
                       
                       
                       
                       
                       
                  echo "\n";
          
              }
          echo "";
?>