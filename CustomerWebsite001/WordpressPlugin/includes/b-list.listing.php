<?php

    $numrows = 3;
    if (!isset($_GET['strana'])){$strana = "0";} else {$strana = test_input($_GET['strana']);};
    
    $wheresql = "";
    $get_okresy = ""; $get_obec = ""; $get_typlokality = ""; $get_povodnevyuzitie = ""; $get_rozlohaod = ""; $get_rozlohado = ""; $get_druhvlastnictva = "";
	  $checkbox = ""; $checkbox1 = ""; $checkbox2 = ""; $checkbox3 = ""; $checkbox4 = ""; $checkbox5 = ""; $checkbox6 = ""; $checkbox7 = ""; $checkbox8 = ""; 
    
    if ( isset($_GET['submit']) ) 
     {   

        $get_okresy             = test_input($_GET['vokresy']);
        $get_obec               = test_input($_GET['vobec']);
        $get_typlokality        = test_input($_GET['vtyplokality']);
        $get_povodnevyuzitie    = test_input($_GET['vpovodnevyuzitie']);
        $get_rozlohaod          = test_input($_GET['vrozlohaod']);
        $get_rozlohado          = test_input($_GET['vrozlohado']);
        $get_druhvlastnictva    = test_input($_GET['vdruhvlastnictva']);
        
        if ($get_okresy=="")          {$wheresql .= "";} else {$wheresql .= " AND a.05_okres = '".$get_okresy."'";};
        if ($get_obec=="")            {$wheresql .= "";} else {$wheresql .= " AND a.06_obec LIKE '%".$get_obec."%'";};
        if ($get_typlokality=="")     {$wheresql .= "";} else {$wheresql .= " AND a.08_typ_lokality_id = '".$get_typlokality."'";};
        if ($get_povodnevyuzitie=="") {$wheresql .= "";} else {$wheresql .= " AND a.12_povodne_vyuzitie_id LIKE '%".$get_povodnevyuzitie."|%'";};
        if ($get_rozlohaod=="")       {$wheresql .= "";} else {$wheresql .= " AND 10_rozloha_arealu > ".$get_rozlohaod."";};
        if ($get_rozlohado=="")       {$wheresql .= "";} else {$wheresql .= " AND 10_rozloha_arealu < ".$get_rozlohado."";};
        if ($get_druhvlastnictva=="") {$wheresql .= "";} else {$wheresql .= " AND a.11_druh_vlastnictva_id = '".$get_druhvlastnictva."'";};
        
        if (empty($_GET['vkraj']))            
                {
                  $wheresql .= "";
                } else {
                  $wheresql .= " AND (";
                  foreach($_GET['vkraj'] as $checkbox) {
                        if ($checkbox == "1")     { $checkbox1 = "checked";$wheresql .= " a.04_kraj = 'Banskobystrický kraj' OR";};
                        if ($checkbox == "2")     { $checkbox2 = "checked";$wheresql .= " a.04_kraj = 'Bratislavský kraj' OR";};
                        if ($checkbox == "3")     { $checkbox3 = "checked";$wheresql .= " a.04_kraj = 'Košický kraj' OR";};
                        if ($checkbox == "4")     { $checkbox4 = "checked";$wheresql .= " a.04_kraj = 'Nitriansky kraj' OR";};
                        if ($checkbox == "5")     { $checkbox5 = "checked";$wheresql .= " a.04_kraj = 'Prešovský kraj' OR";};
                        if ($checkbox == "6")     { $checkbox6 = "checked";$wheresql .= " a.04_kraj = 'Trenčiansky kraj' OR";};
                        if ($checkbox == "7")     { $checkbox7 = "checked";$wheresql .= " a.04_kraj = 'Trnavský kraj' OR";};
                        if ($checkbox == "8")     { $checkbox8 = "checked";$wheresql .= " a.04_kraj = 'Žilinský kraj' OR";};                                                                                                    
                        }
                        $wheresql .= " 1=0)";
              };
     }
             
    $result = $wpdb->get_results ( "SELECT 
                                      a.00_id AS ID, a.03_nazov_lokality AS NAZOV_LOKALITY, 
                                      a.04_kraj AS KRAJ, a.05_okres AS OKRES, a.06_obec AS OBEC, a.30_ilu_foto_1 AS OBRAZOK, b.name AS TYP_LOKALITY 
                                    FROM  dm_br_uzemia AS a 
                                    LEFT JOIN dm_br_form_items AS b
                                    ON a.08_typ_lokality_id = b.id
                                    WHERE 00_schvalene = '1' AND 00_vyradene <> '1' ".$wheresql."
                                    ORDER BY a.00_id DESC
                                    LIMIT ".$strana.",".$numrows."
                                    " );

    $rowcount = $wpdb->get_var( "SELECT COUNT(*) FROM dm_br_uzemia AS a WHERE a.00_schvalene = '1' AND a.00_vyradene <> '1' ".$wheresql );
    $numpages = ceil($rowcount / $numrows);
    
    function SelectOptions($CategoryForm,$CategorySelected) {            
                  
                          global $wpdb; 
                          $selected1 = ""; $selected2 = "";              
                          
                          if (is_numeric($CategoryForm)) {
                          
                              $result_options = $wpdb->get_results( "
                                    SELECT * 
                                    FROM dm_br_form_items 
                                    WHERE item_id = '".$CategoryForm."'
                                    ORDER BY id ASC
                                    " );
 
                          } else {
                          
                              $result_options = $wpdb->get_results( "
                                    SELECT * 
                                    FROM dm_br_form_".$CategoryForm." 
                                    ORDER BY id ASC
                                    " );

                          }
                          
                          $SelectOptions ="<option value='' ".$selected1.">Prosím vyberte --></option>";
                          
                          
                         foreach ( $result_options as $page )
                          { 
                            
                                                      if (is_numeric($CategoryForm)) {
                                                          if ($page->id === $CategorySelected) {$selected2 = "selected='selected'";} else {$selected2 = "";}
                                                          $SelectOptions .= "<option ".$selected2." value='".$page->id."'>".$page->name."</option>";
                                                      } else {
                                                          if ($page->name === $CategorySelected) {$selected2 = "selected='selected'";} else {$selected2 = "";}                                                         
                                                          $SelectOptions .= "<option ".$selected2." value='".$page->name."'>".$page->name."</option>";                                
                                                      }
                          }                           
                          
                          return $SelectOptions;
                        };


                   function listoptions($param,$filter) {
                         global $wpdb;
                          $listoptions = "";
                              switch ($param) {
                                case "vokresy":
                                case "vobec":
                                case "vrozlohaod":                                
                                case "vrozlohado":
                                  $listoptions = $filter;
                                  break;
                                case "vtyplokality":
                                case "vpovodnevyuzitie": 
                                case "vdruhvlastnictva": 
                                  $result_items = $wpdb->get_row( "SELECT id, name FROM dm_br_form_items WHERE id = '".$filter."'" );
                                  $listoptions = $result_items->name;                                  
                               }
                          
                          return $listoptions;
                         
                     }

                   function listvkraj($filter) {
                              $listoptions = "";
                              switch ($filter) {
                                case "1":
                                  $listoptions = "Banskobystrický kraj";
                                  break;
                                case "2":
                                  $listoptions = "Bratislavský kraj";
                                  break;
                                case "3":
                                  $listoptions = "Košický kraj";
                                  break;
                                case "4":
                                  $listoptions = "Nitriansky kraj";
                                  break;
                                case "5":
                                  $listoptions = "Prešovský kraj";
                                  break;
                                case "6":
                                  $listoptions = "Trenčiansky kraj";
                                  break;
                                case "7":
                                  $listoptions = "Trnavský kraj";
                                  break;
                                case "8":
                                  $listoptions = "Žilinský kraj";
                                  break;

                              }                          
                          return $listoptions;
                         
                     }
                                      



    echo "    <style type='text/css'>
              div.col40 {font-weight:700;width:40%;float:left;margin-top:6px;}
              div.col60 {width:60%;float:left;margin-top:6px;}
              div.col100 {width:100%;display:table;clear:both;padding-left:8px;}              
              div.rowdesc {width:100%;display:table;clear:both;padding-left:8px;}
              div.tablerow {width:100%;display:table;clear:both;padding-left:8px;}
              div.tablerowtopic {width:100%;display:table;clear:both;background-color:#deeeff;padding:10px;margin-top:20px;font-weight:700;color:#1e4e9d;}
              </style>
              <script>
                  function openclose() {
                                    
                                          if (document.getElementById('vyhladavanie').style.display == 'none') {
                                              document.getElementById('vyhladavanie').style.display = 'block';
                                          } else {
                                              document.getElementById('vyhladavanie').style.display = 'none';                  
                                          }      
                                          return;
                                    }

              </script>
              <div>  <a href='#' onclick='openclose();return false;' ><b>Vyhľadávanie</b></a> </div>
              ";

              foreach ($_GET as $key => $value) 
              {
              
                  if (is_array($value)) {
                  
                  foreach ($value as $keykraj => $valuekraj) 
                    {

                      if ($valuekraj<>"") {
                        echo  "<div style='display:inline-block;vertical-align:top;border:1px;border-style: solid;padding:5px;border-color: #1e73be;'><a title='Zrušiť' href='". str_replace("vkraj%5B".$keykraj."%5D=".$valuekraj."&","",$_SERVER['REQUEST_URI']) ."'>X " . listvkraj($valuekraj) . " </a></div>";                    
                      }

                    }

                  } else {
                  
                    if ($key <> "submit" AND $key <> "strana" AND $value <> "") {
                    
                      echo  "<div style='display:inline-block;vertical-align:top;border:1px;border-style: solid;padding:5px;border-color: #1e73be;'><a title='Zrušiť' href='". str_replace($key."=".urlencode($value)."&",$key."=&",$_SERVER['REQUEST_URI']) ."'>X " . listoptions($key,$value) . " </a></div>";
                    
                    }
                  }
              }

                                                                                                                                                                                   
    echo "    <div>&nbsp;</div>
              <div id='vyhladavanie' class='row' style='width:100%;display:none;clear:both;'>  
              <form method='get' enctype='application/x-www-form-urlencoded'>   
                      <div class='row col100'>
                        <div class='col40'><label>Kraje: </label></div>                                           
                        <div class='col60'>
                          <fieldset>
                          <input name='vkraj[0]' value='1' type='checkbox' ".$checkbox1."> <label>Banskobystrický kraj</label>                   <input name='vkraj[4]' value='5' type='checkbox' ".$checkbox5.">   <label>Prešovský kraj</label><br>
                          <input name='vkraj[1]' value='2' type='checkbox' ".$checkbox2.">    <label>Bratislavský kraj</label>                   <input name='vkraj[5]' value='6' type='checkbox' ".$checkbox6.">   <label>Trenčiansky kraj</label><br>
                          <input name='vkraj[2]' value='3' type='checkbox' ".$checkbox3.">         <label>Košický kraj</label>                   <input name='vkraj[6]' value='7' type='checkbox' ".$checkbox7.">   <label>Trnavský kraj</label><br>
                          <input name='vkraj[3]' value='4' type='checkbox' ".$checkbox4.">      <label>Nitriansky kraj</label>                   <input name='vkraj[7]' value='8' type='checkbox' ".$checkbox8.">   <label>Žilinský kraj</label><br>
                          </fieldset>
                        </div> 
                      </div>
                      <div class='row col100'>
                        <div class='col40'><label>Okres: </label></div>                                           
                        <div class='col60'>
                          <select name='vokresy'>
                          ". SelectOptions("okresy",$get_okresy). "
                          </select> 
                        </div> 
                       </div>                 
                      <div class='row col100'>
                        <div class='col40'><label>Obec: </label></div>                                           
                        <div class='col60'><input name='vobec' type='text' value='".$get_obec."'></div> 
                      </div>
                      <div class='row col100'>
                        <div class='col40'><label>Typ lokality: </label></div>                                           
                        <div class='col60'>
                          <select name='vtyplokality'>
                          ". SelectOptions("8",$get_typlokality). "
                          </select> 
                        </div> 
                       </div> 
                      <div class='row col100'>
                        <div class='col40'><label>Pôvodné využitie: </label></div>                                           
                        <div class='col60'>
                          <select name='vpovodnevyuzitie'>
                          ". SelectOptions("12",$get_povodnevyuzitie). "
                          </select> 
                        </div> 
                       </div>  
                      <div class='row col100'>
                        <div class='col40'><label> Rozloha areálu v m²: </label></div>
                        <div class='col60'>Od <input name='vrozlohaod' size='5' style='width:100px;' type='number' value='".$get_rozlohaod."'> do <input name='vrozlohado' size='5' style='width:100px;' type='number' value='".$get_rozlohado."'></div> 
                      </div>
                      <div class='row col100'><div class='col40' style='width:40%;float:left;margin-top:6px;'><label>Druh vlastníctva areálu: </label></div>                                           
                        <div class='col60'>
                        <select name='vdruhvlastnictva'>
                        ". SelectOptions("11",$get_druhvlastnictva). "
                        </select> 
                        </div> 
                      </div>
                      <div>&nbsp;</div> 
                       <div class='row col100'> <div class='col40'><label>&nbsp;</label>                      </div>                        <div class='col60'> <input type='submit' name='submit' value='Hľadať'/></div></div>                
                      <div>&nbsp;</div>
              </form>
              </div>";

          If ($rowcount <> 0) {  
          
                    echo "<div class='tableFootStyle' style='text-align: center;'>
                        <div class='links'> 
                          <a  href='".$url_string."strana=0'>&laquo;</a> ";
                            for ($x = 0; $x < $numpages; $x++)
                            {
                              $limit = ($x*$numrows);
                              echo " <a ";
                              echo ( $strana == $limit ) ? " style='font-weight:700;' " : "";
                              echo " href='".$url_string."strana=".$limit."'>".($x+1)."</a>";
                            }
                    echo " <a class='active' href='".$url_string."strana=".$limit."'>&raquo;</a> 
                        </div>
                      </div>
                      <div>&nbsp;</div>";
             
  
                    echo "<div>";
          
                              foreach ( $result as $page )
                                {          
                              echo "<div style='border-width:1px;border-style:solid;border-color:#efefef;margin-bottom:30px;clear:both;'>
                                     <div class='row tablerowtopic' style='margin-top:6px;'><a style='font-weight:700;text-decoration: underline;' href='".$url_string."strana=".$strana."&id=".$page->ID."'>".$page->NAZOV_LOKALITY."</a></div>
                                      <div class='row' style='width:90%;display:table;clear:both;padding:10px;margin-top:6px;'>
                                         <div style='width:70%;float:left;'>
                                            <div class='row tablerow'><div class='col40'><label>Kraj: </label></div>                                           <div class='col60'>".$page->KRAJ."</div> </div>            
                                            <div class='row tablerow'><div class='col40'><label>Okres: </label></div>                                          <div class='col60'>".$page->OKRES."</div> </div>
                                            <div class='row tablerow'><div class='col40'><label>Obec: </label></div>                                           <div class='col60'>".$page->OBEC."</div> </div>
                                            <div class='row tablerow'><div class='col40'><label>Typ lokality: </label></div>                                   <div class='col60'>".$page->TYP_LOKALITY."</div> </div>
                                         </div>
                                         <div style='width:30%;height:100%;float:left;'>
                                          <img style='display:block;margin: 0 auto;border-width:2px;border-style:solid;border-color:#deeeff;max-width:200px;max-height:150px;' src='/uploads/".$page->OBRAZOK."'>
                                         </div>
                                      </div>
                                    </div>
                                    <div>&nbsp;</div>";
                                }
                    
                    echo "</div>
                      <div class='tableFootStyle' style='text-align: center;'>
                        <div class='links'> 
                          <a  href='".$url_string."strana=0'>&laquo;</a> ";
                            for ($x = 0; $x < $numpages; $x++)
                            {
                              $limit = ($x*$numrows);
                              echo " <a ";
                              echo ( $strana == $limit ) ? " style='font-weight:700;' " : "";
                              echo " href='".$url_string."strana=".$limit."'>".($x+1)."</a>";
                            }
                    echo " <a class='active' href='".$url_string."strana=".$limit."'>&raquo;</a> 
                        </div>
              
              
                      </div>";
            } else {
            
            echo "
                      <div class='row col100'>
                        <h2>Nenašli sa žiadne záznamy</h2> 
                      </div>
            
            
            ";
            
            }
  
?>