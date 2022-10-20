<?php                                                                          
//////////////////////////////
// Zoznam brownfieldov
//////////////////////////////

    $numrows = 20; $wheresql=""; $search="";
    if (!isset($_GET['export'])) {$export = "";} else {$export = $_GET['export'];};
    if (!isset($_GET['strana'])) {$strana = "0";} else {$strana = $_GET['strana'];};
    if (!isset($_GET['search'])) {$search = "";} else {$search = $_GET['search']; $wheresql=" WHERE a.00_invent_cislo LIKE '%".$search."%' OR a.03_nazov_lokality LIKE '%".$search."%' OR a.04_kraj LIKE '%".$search."%' OR a.05_okres LIKE '%".$search."%' OR a.06_obec LIKE '%".$search."%' OR a.07_adresa LIKE '%".$search."%' OR c.name LIKE '%".$search."%' OR d.name LIKE '%".$search."%' OR f.name LIKE '%".$search."%'";};
    if (!isset($_GET['deleteid'])) {$deleteid = "";} else {$deleteid = $_GET['deleteid'];};

    function remove_url_query($url, $param) {
          $url = preg_replace('/(&|\?)'.preg_quote($param).'=[^&]*$/', '', $url);
          $url = preg_replace('/(&|\?)'.preg_quote($param).'=[^&]*&/', '$1', $url);
         return $url;
    }
       
    $url_string = "https://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];              
    $url_string = remove_url_query($url_string, 'deleteid');
    $url_string = remove_url_query($url_string, 'strana');
    $url_string = remove_url_query($url_string, 'export');    
          
    //Vymazanie
    if ($deleteid <> "") {
                $wpdb->query($wpdb->prepare("DELETE FROM dm_br_uzemia WHERE 00_id = '%d'",$deleteid));
                $wpdb->query($wpdb->prepare("DELETE FROM dm_br_uzemia_obj WHERE 00_id = '%d'",$deleteid));
                
                $uploaddir = '/var/www/html/uploads/';
                $mask = $uploaddir.$deleteid."_*.*";
                
                foreach (glob($mask) as $filename) {
                   unlink($filename);
                }
                                   
    }


    if ($export <> "") {

           echo "
           <script>
      
          window.onload = function(){
               window.open('/wp-content/plugins/xxxx.xls.php?". $_SERVER['QUERY_STRING'] ."', '_blank'); // will open new tab on window.onload
              }
          </script>
      
           ";

    }
           
    $result = $wpdb->get_results ( "SELECT DISTINCT 
        a.00_id AS ID, 00_datum_pridania AS DATUM_PRIDANIA, a.00_schvalene AS SCHVALENE, a.00_vyradene AS VYRADENE, a.00_invent_cislo AS INVENT_CISLO, a.03_nazov_lokality AS NAZOV_LOKALITY, 
        a.04_kraj AS KRAJ, a.05_okres AS OKRES, a.06_obec AS OBEC, a.26_kategoria_roz_pot_id, b.name AS TYP_LOKALITY, c.name AS KAT_ROZV  
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
        LIMIT ".$strana.",".$numrows."
        " );

    $rowcount = $wpdb->get_var( "SELECT COUNT(*) FROM dm_br_uzemia AS a 
        LEFT JOIN dm_br_form_items AS c
        ON a.26_kategoria_roz_pot_id = c.id
        LEFT JOIN dm_br_form_items AS d
        ON 11_druh_vlastnictva_id = d.id
        LEFT JOIN dm_br_uzemia_obj AS e
        ON a.00_id = e.00_id
        LEFT JOIN dm_br_form_items AS f
        ON 35_druh_vlastnictva_id = f.id        
        ".$wheresql );
    $numpages = ceil($rowcount / $numrows);
                  
    echo "<h1>Brownfields | zoznam (".$rowcount.") </h1>";

    echo "<div style='margin-bottom:10px;'><form enctype='multipart/form-data' action='https://xxxxx/admin.php' method='get'>
          <input type='hidden' name='page' value='b-plugin'> <input type='text' style='width:500px;' name='search' value='".$search."'> <input id='submit' class='button button-primary' type='submit' name='submit' value='Hľadať'/>  <a href='".$url_string."&export=xls'>[Export do Excelu]</a>
          </form></div>";

    if ($deleteid <> "") {
      echo "<h2 style='padding-top:5px;color:green;' > <img style='width:12px;height:12px;' src='data:image/gif;base64, R0lGODlhFQAXAKIGAN/y35/Zn+/571+/Xy+sLwCZAP///wAAACH5BAEAAAYALAAAAAAVABcAAANSaLrcLMTJBsu81V6X9V6d94UFIYxEoa7lOZGsKcFsS6W1OsSuQRcDQ032CwqHAFzOeMw5gYynk6nYSVfUhVWaZWyXny/2U611L9vzZqf+BMiGBAA7' /> Záznam číslo ".$deleteid." bol úspešne vymazaný. </h2>";
    }                   
    
    echo "<div class='divTable blueTable'>
            <div class='divTableHeading'>
              <div class='divTableRow'>
              <div class='divTableHead'>Riadok číslo</div>
              <div class='divTableHead'>Poradové číslo</div>
              <div class='divTableHead'>Inventarizačné číslo</div>
              <div class='divTableHead'>Názov lokality</div>
              <div class='divTableHead'>Kraj</div>            
              <div class='divTableHead'>Okres</div>
              <div class='divTableHead'>Obec</div>
              <div class='divTableHead'>Typ lokality</div>
              <div class='divTableHead'>Kategória podľa rozv. potenciálu</div>
              <div class='divTableHead'>Dátum pridania</div>
              <div class='divTableHead' align='center'>Vymazať</div>              
              <div class='divTableHead' align='center'>Vyradené</div>
              <div class='divTableHead' align='center'>Schválené</div>
              <div class='divTableHead' align='center'>Detail</div>
            </div>
          </div>
          <div class='divTableBody'>";

          $rowid = intval($strana);
                   
    foreach ( $result as $page )
      {          
       $rowid = $rowid+1;
    echo "<div class='divTableRow'>
            <div class='divTableCell'>".$rowid."</div>
            <div class='divTableCell'>".$page->ID."</div>
            <div class='divTableCell'>".$page->INVENT_CISLO."</div>
            <div class='divTableCell'>".$page->NAZOV_LOKALITY."</div>
            <div class='divTableCell'>".$page->KRAJ."</div>            
            <div class='divTableCell'>".$page->OKRES."</div>
            <div class='divTableCell'>".$page->OBEC."</div>
            <div class='divTableCell'>".$page->TYP_LOKALITY."</div>
            <div class='divTableCell'>".$page->KAT_ROZV."</div>
            <div class='divTableCell'>".$page->DATUM_PRIDANIA."</div>
            <div class='divTableCell' align='center'><a onclick='return confirm(\"Chcete naozaj vymazať záznam číslo ".$page->ID." - ".$page->NAZOV_LOKALITY." ?\");' href='".$url_string."&deleteid=".$page->ID."'><img style='display:block;width:12px;height:12px;' src=' data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACfUlEQVR4nO2bvWsUQRjGfx4i4QyHSLBIYSFBxEKCtVikEomYRtNYWFgoWFhI/gcL/wArwU8sLCWFrWIK0cZCiKDEIEIstNBYxI9iL3hOZmZnb2f3Oc37g4Hb995575ln73bn4F0wtjc7MtU5AswDk5nqxVgGbgGrLXxWEgvAD+BXi+MrMNfG4sqYod2Fuybsr7uATs35l+oKqEEXOF+3SOgaMAucAiZK5s8Ae+qKqMEK8Dwh7yNwH3hSlrgTeIDua930uF5mwNURENn0OBszYHkEBDY9Hg8u2L0IHoi585/w1xpdA+reFf4FOsEDRmh31SAfBg9cA+61KETF7dibXeAp+gtVU+Mhzkn3bYR2AReB08DefmwMOBRzrs8GxcZkDJhOyH9HsZmZBnolud+AF8A+4GBC7e/A6/7rzY3QHeBnwtwtTFHu7ltH2HHgSyT/Cn/ORg9YjOQ+o1j4Juco/wP2cpiFhkgxYNYzbyGQu+jJnQDWA/lTnvybJXqSDMh521tKjEFxRl0+AW8qxH01KpPTgA1PLPR7C8V9NXyxWI1KbIeNTxQzQC1AjRmgFqDGDFALUGMGqAWoMQPUAtSYAWoBaswAtQA1ZoBagBozQC1AjRmgFqDGDFALUGMGqAWoMQPUAtSYAWoBaswAtQA1ZoBagBozIGOtbmIMYHeGGqF4JXIa4GtDnw/kzlH0Iw5yFH//Xw844cQ6wJlK6mqS0ia3DlymaK6cBK6V5D8CDgPjwEngfSR3jcLgXl/L3QQ9rfcJjtrI2ieYpSWtZZI0pxqwCnweXouEV7kLXqD9BySHHWv422u3UPXR2WMUV/bxivPaZAW4gfNghGH4+Q1irwcGw1ZAVQAAAABJRU5ErkJggg==' /></a></div>
            <div class='divTableCell' align='center'>"; echo ($page->VYRADENE=="1")?("<img style='display:block;width:12px;height:12px;' src='data:image/gif;base64, R0lGODlhFQAXAKIGAN/y35/Zn+/571+/Xy+sLwCZAP///wAAACH5BAEAAAYALAAAAAAVABcAAANSaLrcLMTJBsu81V6X9V6d94UFIYxEoa7lOZGsKcFsS6W1OsSuQRcDQ032CwqHAFzOeMw5gYynk6nYSVfUhVWaZWyXny/2U611L9vzZqf+BMiGBAA7' />"):("<img style='display:block;width:12px;height:12px;' src='data:image/gif;base64, R0lGODlhFQAXALMIAP8/P/+Pj/+fn/9PT/9/f/8vL/9fX/8AAP///wAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAAgALAAAAAAVABcAAARZEMlJqyVY2B3y+YW2TcZ3AOYRjkhpoulqueZAgyKZqtrN67GcbzXMSYbFjW8nU+5MzdEyKn1SZ08caxl0xpKUJLjFFJbJ3XD5jE0N0t4P7MdCnzAEI6uTjwAAOw==' />"); echo "</div>
            <div class='divTableCell' align='center'>"; echo ($page->SCHVALENE=="1")?("<img style='display:block;width:12px;height:12px;' src='data:image/gif;base64, R0lGODlhFQAXAKIGAN/y35/Zn+/571+/Xy+sLwCZAP///wAAACH5BAEAAAYALAAAAAAVABcAAANSaLrcLMTJBsu81V6X9V6d94UFIYxEoa7lOZGsKcFsS6W1OsSuQRcDQ032CwqHAFzOeMw5gYynk6nYSVfUhVWaZWyXny/2U611L9vzZqf+BMiGBAA7' />"):("<img style='display:block;width:12px;height:12px;' src='data:image/gif;base64, R0lGODlhFQAXALMIAP8/P/+Pj/+fn/9PT/9/f/8vL/9fX/8AAP///wAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAAgALAAAAAAVABcAAARZEMlJqyVY2B3y+YW2TcZ3AOYRjkhpoulqueZAgyKZqtrN67GcbzXMSYbFjW8nU+5MzdEyKn1SZ08caxl0xpKUJLjFFJbJ3XD5jE0N0t4P7MdCnzAEI6uTjwAAOw==' />"); echo "</div>
            <div class='divTableCell' align='center'><a href='?page=".$_GET['page']."&id=".$page->ID."'>[>>]</a></div>
          </div>";
      }
          
    echo "</div>
      </div>
      <div class='blueTable outerTableFooter'>
      <div class='tableFootStyle'>
      <div class='links'>
      <a  href='".$url_string."&strana=0'>&laquo;</a>";
      
      $limit = "";
      for ($x = 0; $x < $numpages; $x++)
      {
        $limit = ($x*$numrows);
        echo "<a ";
        echo ( $strana == $limit ) ? " class='active' " : "";
        echo " href='".$url_string."&strana=".$limit."'>".($x+1)."</a>";
      }
      
      echo "<a class='active' href='".$url_string."&strana=".$limit."'>&raquo;</a>
      </div>
      </div>
    </div>";

 
?>