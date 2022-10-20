  <?php

   		///////////////////////////
   		/////// form options
  		///////////////////////////

       function SelectOptions($CategoryForm,$CategorySelected) {            
              

                          global $wpdb; 
                          $selected1 = ""; $selected2 = ""; $pos = "";              
                          $result_options = $wpdb->get_results( "
                                SELECT * 
                                FROM dm_br_form_items 
                                WHERE item_id = '".$CategoryForm."'
                                ORDER BY id ASC
                                " );

                          $SelectOptions ="<option value='0' ".$selected1." disabled selected value>Prosím vyberte --></option>";

                if (!is_array($CategorySelected)) {                          

                          if( strpos( $CategorySelected, '|' ) !== false) {
                              $x = "|"; //if multiselect
                          } else {
                              $x = ""; //if single select                          
                          }

                };
                                          
                         foreach ( $result_options as $page )
                          { 

                            if (!is_array($CategorySelected)) {
                              $pos = strpos(strval($CategorySelected), strval($page->id).$x); //"|"
                            };
                                    if ($pos !== false) {
                                      $selected2 = "selected='selected'";
                                    } else {
                                      $selected2 = "";                                
                                    }
     
                            $SelectOptions .= "<option ".$selected2." value='".$page->id."'>".$page->name."</option>";
                          }


                          
                          return $SelectOptions;

                    
          }
                    
                    
    
	   echo "
                  <link rel='stylesheet' href='//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>
                  <link rel='stylesheet' href='/wp-content/plugins/xxxx.css'>
                                               
                                               
                  <script src='https://code.jquery.com/jquery-1.12.4.js'></script>
                  <script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>
                  <script src='/wp-content/plugins/xxxx.js'></script>                  

                  <div id='myModal0' class='modal'>
                      <div class='modal-content'>
                        <span onclick='myModal(0,0);' class='close' >&times;</span>
                        <h2>Súhlas dotknutej (kontaktnej) osoby</h2> 
                      <p>Ja, <b><span id='x01'>Meno, Priezvisko</span></b>, súhlasím so spracovaním mojich osobných údajov v rozsahu titul, meno, priezvisko, email a telefónne číslo pre 
                      prevádzkovateľa: za účelom: verifikácie získaných informácií z formulára pre tvorbu databázy zanedbaných a nevyužívaných území v intravilánoch sídiel.
                      Uvedený súhlas dotknutej (kontaktnej) osoby sa dáva na celé obdobie tvorby databázy zanedbaných a nevyužívaných území v intravilánoch sídiel.
                      </p>
                      </div>
                  </div>
                  
                  <div id='myModal1' class='modal'>
                      <div class='modal-content'>
                        <span onclick='myModal(1,0);' class='close' >&times;</span>
                        <h2>Pôvodné využitie</h2>
                        <p>Môžete si vybrať viacero možností (stlačte Ctrl + klik).</p>
                      </div>
                  </div>

                  <div id='myModal2' class='modal'>
                      <div class='modal-content'>
                        <span onclick='myModal(2,0);' class='close' >&times;</span>
                        <h2>Súčasné využitie</h2>
                        <p>Môžete si vybrať viacero možností (stlačte Ctrl + klik).</p>
                      </div>
                  </div>
                  
                  <div id='myModal3' class='modal'>
                      <div class='modal-content'>
                        <span onclick='myModal(3,0);' class='close' >&times;</span>
                        <h2>Počet objektov</h2>
                        <p>Objekty zahŕňajú:<br>
                          - bytové budovy,<br> 
                          - nebytové budovy,<br> 
                          - dopravnú infraštruktúru,<br> 
                          - potrubné rozvody, elektronické komunikačné siete, elektrické rozvody a vedenia,<br> 
                          - komplexné priemyselné stavby,<br> 
                          - ostatné inžinierske stavby</p>
                      </div>
                  </div>

                  <div id='myModal4' class='modal'>
                      <div class='modal-content'>
                        <span onclick='myModal(4,0);' class='close' >&times;</span>
                        <h2>Kategória podľa rozvojového potenciálu:</h2>
                          <p>
                          Rozvojový potenciál brownfieldu (BF) vyjadruje jeho šance na nové využitie, mieru intervencie potrebnú pre revitalizáciu územia a výšku verejných financií potrebnú pre naštartovanie zmeny v území.
                          </p>
                          
                          <p>
                          <b>KATEGÓRIA A</b><br>
                          Zahŕňa územia s vhodnou lokalizáciou v rámci štruktúry mesta s jednoznačným vlastníctvom a minimálnymi problémami, bez kontaminácie, bez limitov ÚPN, t.j. brownfieldy, ktoré realitný trh absorbuje sám. V týchto prípadoch nie je možné obhájiť použitie verejných financií. Verejná iniciatíva má v týchto prípadoch iba koordinačnú a propagačnú úlohu.
                          </p>
                          <p>
                          <b>KATEGÓRIA B</b><br>
                          Zahŕňa BF, ktoré majú určité množstvo problémov a určitú atraktivitu. Súkromná investícia do takýchto BF však nemá dostatočnú návratnosť a je potrebná určitá verejná podpora (najlepšie neinvestičná a pokiaľ to nejde inak, tak aj investičná  napríklad pokrytím kapitálových medzier), ktorá by aktivovala súkromný kapitál k investícii. V podstate ide o to, čo najvhodnejšie a najlacnejšie premeniť BF kategórie typu B na BF typu A, o ktoré sa potom postará realitný trh sám. Na túto kategóriu BF by sa mala sústrediť ako miestna, tak regionálna samospráva. Najmä neinvestičná verejná podpora tu prináša veľmi efektívne výsledky, vytvára „investovateľné„ projekty a vedie k rôznym formám rozvojových partnerstiev.
                          </p>
                          <p>
                          <b>KATEGÓRIA C</b><br>
                          Zahŕňa BF, so zlou dostupnosťou, umiestnené mimo komerčne atraktívnych lokalít, s minimálnou návratnosťou investície. Jedná so o územia, pre ktoré je potrebné nájsť nové využitie a užívateľov.<br> 
                          - rozvoj týchto území nie je v súčasnosti ani možný, ani zmysluplný;<br> 
                          - ich prítomnosť môže blokovať rozvoj kontaktného územia;<br>
                          - s verejnou podporou je možné ich premeniť na BF typu B (za predpokladu silného spoločenského tlaku);<br>
                          - majú malú finančnú návratnosť a súčasne veľké spoločenské prínosy.
                          </p>
                          <p>
                          <b>KATEGÓRIA D</b><br>
                          Zahŕňa BF, ktoré môžu byť rôzneho pôvodu a ohrozujú predovšetkým ľudské zdravie a životné prostredie.<br>
                          - budovy, ktoré ohrozujú svojim technickým stavom verejný priestor;<br>
                          - majú ekologické záťaže ohrozujúce spodné vody, pôdy, ovzdušie a kontaktné životné prostredie;<br> 
                          - územia, ktoré svojim charakterom znehodnocujú rozvojový potenciál obce.
                          </p>

                      </div>
                  </div>

                  <div id='myModal5' class='modal'>
                      <div class='modal-content'>
                        <span onclick='myModal(5,0);' class='close' >&times;</span>
                        <h2>Pečatenie pôdy v %:</h2> 
                        <p>
                        Pečatenie pôdy je prekrývanie pôdy nepriepustným materiálom, ktoré môže byť spôsobené novou výstavbou, rozvojom cestnej infraštruktúry, budovaním asfaltových parkovísk alebo vo všeobecnosti zvyšovaním podielu nepriepustných plôch v mestách a ich verejnom priestore. 
                        </p>
                      </div>
                  </div>

                  <div id='myModal6' class='modal'>
                      <div class='modal-content'>
                        <span onclick='myModal(6,0);' class='close' >&times;</span>
                        <h2>Charakteristika jestvujúcej vegetácie:</h2> 
                          <p>
                          - stromová, krovinová vegetácia, zatrávnená plocha...<br>
                          - solitérne postavenie, stromoradie, skupina listnatých/ihličnatých stromov, les...<br>
                          - druhy a početnosť vegetácie, výskyt významných drevín, súčasný zdravotný stav vegetácie, funkcia vegetácie (klimatická, ochranná, krajinotvorná/estetická funkcia...)
                          </p>
                      </div>
                  </div>

                  <div id='myModal7' class='modal'>
                      <div class='modal-content'>
                        <span onclick='myModal(7,0);' class='close' >&times;</span>
                        <h2>Situačný plánik lokality/mapka</h2>
                        <p>Maximálna veľkosť súboru: 2 MB<br>
                        Podporované súbory: jpg, jpeg, png, pdf, doc, docx.</p>
                      </div>
                  </div>
                  
                  <div id='myModal8' class='modal'>
                      <div class='modal-content'>
                        <span onclick='myModal(8,0);' class='close' >&times;</span>
                        <h2>Ilustračné foto 1</h2>
                        <p>Maximálna veľkosť súboru: 2 MB<br>
                        Podporované súbory: jpg, jpeg, png.</p>
                      </div>
                  </div>
                  
                  <div id='myModal9' class='modal'>
                      <div class='modal-content'>
                        <span onclick='myModal(9,0);' class='close' >&times;</span>
                        <h2>Ilustračné foto 2</h2>
                        <p>Maximálna veľkosť súboru: 2 MB<br>
                        Podporované súbory: jpg, jpeg, png.</p>
                      </div>
                  </div>

                  <div id='myModal10' class='modal'>
                      <div class='modal-content'>
                        <span onclick='myModal(10,0);' class='close' >&times;</span>
                        <h2>Dostupnosť technickej infraštruktúry</h2>
                        <p>Môžete si vybrať viacero možností (stlačte Ctrl + klik).</p>
                      </div>
                  </div>
                  
                <h2 style='font-weight: bold;color: rgb(30,78,157);' >Databáza zanedbaných a nevyužívaných území</h2> 
                <p>Tento formulár slúži na tvorbu databázy zanedbaných a nevyužívaných území v intravilánoch sídiel. Účelom tvorby databázy je získanie prehľadu o počte, charaktere a vývoji takýchto lokalít na území Slovenskej republiky. Cieľom inventarizácie je plánovanie verejných intervencií, aktivizácia samospráv a príprava pre transparentnejší proces výberu lokalít podporovaných z verejných zdrojov. 
                </p>
                <p class='red'>* je povinný údaj</p>
                
        				<form id='brownfieldsform' enctype='multipart/form-data' action='https://xxxxx/' method='post'>
            		   <div class='row brown-row' style='margin-top:20px;'> <h2>Kontaktná osoba</h2>                                                                                                                                                              </div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Meno a priezvisko:</label>                                                                                               </div>                        <div class='col60 brown-col60'> <input type='text' oninput='meno()' id='01' name='01' value='".$post01."' required></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Telefónne číslo:</label>                                                                                                 </div>                        <div class='col60 brown-col60'> <input type='tel' name='40' value='".$post40."' required></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Email:</label>                                                                                                           </div>                        <div class='col60 brown-col60'> <input type='email' name='02' value='".$post02."' required></div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'>&nbsp;                                                                                                                                                                          </div>                        <div class='col60 brown-col60'> &nbsp;</div></div>
                   
                  <p><b>Ja, <span id='x02'>Meno a priezvisko</span>, súhlasím so spracovaním mojich osobných údajov.</b> <a href='#' onclick='myModal(0,1);return false;'>(?)</a> 
                  </p>

                   <div class='row brown-row'> <div class='col40 brown-col40'><label>&nbsp;</label>                                                                                                                                                           </div>                        <div class='col60 brown-col60'> <button onclick='suhlas();return false;' >+ Súhlasím a pokračujem s vypĺňaním +</button> </div></div>
                   <div class='row brown-row'> <div class='col40 brown-col40'>&nbsp;                                                                                                                                                                          </div>                        <div class='col60 brown-col60'> &nbsp;</div></div>                               

                                   
                   <div style='display:none;' id='suhlas'>

                        		   <div class='row brown-row' style='margin-top:20px;'> <h2>Základné informácie o lokalite</h2>                                                                                                                                   </div>                        
                        		   <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Názov lokality:</label>                                                                                      </div>                        <div class='col60 brown-col60'> <input type='text' name='03' value='".$post03."' maxlength='50' required></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Kraj:</label>                                                                                                </div>                        <div class='col60 brown-col60'> <input type='text' id='autocomplete_kraje' name='04' value='".$post04."' required></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Okres:</label>                                                                                               </div>                        <div class='col60 brown-col60'> <input type='text' id='autocomplete_okresy' name='05' value='".$post05."' required></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Obec:</label>                                                                                                </div>                        <div class='col60 brown-col60'> <input type='text' id='autocomplete_obce' name='06' value='".$post06."' required></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Adresa (ulica, číslo, PSČ):</label>                                                                          </div>                        <div class='col60 brown-col60'> <input type='text' name='07' value='".$post07."' required></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Typ lokality:</label>                                                                                        </div>                        <div class='col60 brown-col60'> <select name='08' required>". SelectOptions("8",$post08). "</select></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Poloha v rámci zastavaného územia:</label>                                                                   </div>                        <div class='col60 brown-col60'> <select name='09' required>". SelectOptions("9",$post09). "</select></div></div>
            
                        		   <div class='row brown-row' style='margin-top:20px;'> <h2>Informácie o areáli</h2>                                                                                                                                              </div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Rozloha areálu v m&#178;:</label>                                                                            </div>                        <div class='col60 brown-col60'> <input type='number' name='10' value='".$post10."' required></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Druh vlastníctva areálu:</label>                                                                             </div>                        <div class='col60 brown-col60'> <select id='select11' name='11' onchange='admSelectCheck(11,44);' required>". SelectOptions("11",$post11). "</select></div></div>
                               <div id='Option44' class='row brown-row' style='display:none;'> <div class='col40 brown-col40'><label>&nbsp;</label>                                                                                                           </div>                        <div class='col60 brown-col60'> <input type='text' name='42' value='".$post42."' ></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Pôvodné využitie <a href='#' onclick='myModal(1,1);return false;'>(?)</a>:</label>                           </div>                        <div class='col60 brown-col60'> <select id='select12' name='12[]' onchange='admSelectCheck(12,19);' required multiple>". SelectOptions("12",$post12). "</select></div></div>
                               <div id='Option19' class='row brown-row' style='display:none;'> <div class='col40 brown-col40'><label>&nbsp;</label>                                                                                                           </div>                        <div class='col60 brown-col60'> <input type='text' name='13' value='".$post13."' ></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Súčasné využitie <a href='#' onclick='myModal(2,1);return false;'>(?)</a>:</label>                           </div>                        <div class='col60 brown-col60'> <select id='select14' name='14[]'  onchange='admSelectCheck(14,28);' required multiple>". SelectOptions("14",$post14). "</select></div></div>                                  
                               <div id='Option28' class='row brown-row' style='display:none;'> <div class='col40 brown-col40'><label>&nbsp;</label>                                                                                                           </div>                        <div class='col60 brown-col60'> <input type='text' name='15' value='".$post15."' ></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Využitie areálu v %:</label>                                                                                 </div>                        <div class='col60 brown-col60'> <select name='16' required>". SelectOptions("16",$post16). "</select></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Pečatenie pôdy v % <a href='#' onclick='myModal(5,1);return false;'>(?)</a>:</label>                         </div>                        <div class='col60 brown-col60'> <select name='17' required>". SelectOptions("17",$post17). "</select></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Dostupnosť technickej infraštruktúry <a href='#' onclick='myModal(10,1);return false;'>(?)</a>:</label>      </div>                        <div class='col60 brown-col60'> <select id='select41' name='41[]' required multiple>". SelectOptions("41",$post41). "</select></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Charakteristika jestvujúcej vegetácie <a href='#' onclick='myModal(6,1);return false;'>(?)</a>:</label>      </div>                        <div class='col60 brown-col60'> <input type='text' name='18' value='".$post18."' required></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Kontaminácia lokality:</label>                                                                               </div>                        <div class='col60 brown-col60'> <select id='select19' name='19' onchange='admSelectCheck(19,57);' required>". SelectOptions("19",$post19). "</select></div></div>
                               <div id='Option57' class='row brown-row' style='display:none;'> <div class='col40 brown-col40'><label>&nbsp;</label>                                                                                                           </div>                        <div class='col60 brown-col60'> <input type='text' name='20' value='".$post20."' ></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Ochrana prírodných hodnôt</label>                                                                            </div>                        <div class='col60 brown-col60'> <select name='22' id='select22'  onchange='admSelectCheck(22,51);' required>". SelectOptions("22",$post22). "</select></div></div>
                               <div id='Option51' class='row brown-row' style='display:none;'> <div class='col40 brown-col40'><label>&nbsp;</label>                                                                                                           </div>                        <div class='col60 brown-col60'> <input type='text' name='23' value='".$post23."' ></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Počet objektov <a href='#' onclick='myModal(3,1);return false;'>(?)</a>:</label>                             </div>                        <div class='col60 brown-col60'> <select onchange='admSelectCheck2(24);' name='24' id='select24' required>". SelectOptions("24",$post24). "</select></div></div>
                                   
                        		   <div id='container-objekty-header' class='row' style='width:100%;display:table;clear:both;margin-top:20px;display:none;'> <h2>Informácie o objektoch</h2>                             </div>
                               <div id='container-objekty' style='display:none;'>
                               <div id='objekty'>
                                   <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Klasifikácia stavby/typ:</label>                                                                         </div>                        <div class='col60 brown-col60'> <select id='32[]' name='32[]' required> ". SelectOptions("32",$post32). "</select></div></div>
                                   <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Rozloha/veľkosť objektu v m&#178;/m:</label>                                                             </div>                        <div class='col60 brown-col60'> <input id='33[]' type='number' name='33[]' value='".$post33."' required></div></div>
                                   <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Stavebno-technický stav:</label>                                                                         </div>                        <div class='col60 brown-col60'> <select id='34[]' name='34[]' required>". SelectOptions("34",$post34). "</select></div></div>
                                   <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Druh vlastníctva objektu:</label>                                                                        </div>                        <div class='col60 brown-col60'> <select id='35[]' name='35[]' required>". SelectOptions("35",$post35). "</select></div></div>
                                   <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Počet podlaží:</label>                                                                                   </div>                        <div class='col60 brown-col60'> <select id='36[]' name='36[]' required>". SelectOptions("36",$post36). "</select></div></div>
                                   <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span>  Ochrana kultúrnych hodnôt:</label>                                                                      </div>                        <div class='col60 brown-col60'> <select id='38[]' name='38[]' required>". SelectOptions("38",$post38). "</select></div></div>
                                   <div class='row brown-row'> <div class='col40 brown-col40'><label>Názov pamätihodnosti a číslo: </label>                                                                                                                   </div>                        <div class='col60 brown-col60'> <input id='39[]' type='text' name='39[]' value='".$post39."' ></div></div>
                                   <div class='row brown-row'> <div class='col40 brown-col40'><label>&nbsp;</label>                                                                                                                                           </div>                        <div class='col60 brown-col60'> <a style='color:#CD5C5C;' href='#' onclick='del(this.parentElement.parentElement.parentElement.id);return false;' > - Vymazať tento objekt - </a> </div></div>
                                   <div class='row brown-row'> <div class='col40 brown-col40'><label>&nbsp;</label>                                                                                                                                           </div>                        <div class='col60 brown-col60'> &nbsp;</div></div>
                               </div>
                               </div>
                               
                               <div id='container-objekty-button' class='row' style='width:100%;display:table;clear:both;display:none;'> <div class='col40 brown-col40'><label>&nbsp;</label>                                                                 </div>                        <div class='col60 brown-col60'> <button onclick='cloning();return false;' >+ Pridať ďalšie objekty </button> </div></div>                   
                               
                               <div class='row brown-row' style='margin-top:20px;'> <h2>Možnosti využitia</h2>                             </div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Funkčné využitie a regulácia v zmysle platného ÚPN obce:</label>                                             </div>                        <div class='col60 brown-col60'> <select name='25' required>". SelectOptions("25",$post25). "</select></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Kategória podľa rozvojového potenciálu <a href='#' onclick='myModal(4,1);return false;'>(?)</a>:</label>     </div>                        <div class='col60 brown-col60'> <select name='26' required>". SelectOptions("26",$post26). "</select></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Známe zámery:</label>                                                                                        </div>                        <div class='col60 brown-col60'> <textarea type='text' name='27' rows='4' cols='50' required>".$post27."</textarea></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Stručná charakteristika/poznámka:</label>                                                                    </div>                        <div class='col60 brown-col60'> <textarea type='text' name='28' rows='4' cols='50' required>".$post28."</textarea></div></div>
            
                        		   <div class='row brown-row' style='margin-top:20px;'> <h2>Obrazové prílohy</h2>                             </div>                        
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Situačný plánik lokality/mapka <a href='#' onclick='myModal(7,1);return false;'>(?)</a>:</label>             </div>                         <div class='col60 brown-col60'> <input onchange='ValidateSize(this)' accept='.jpg,.jpeg,.png,.pdf,.docx,.doc' type='file' name='29' required></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Ilustračné foto 1 <a href='#' onclick='myModal(8,1);return false;'>(?)</a>:</label>                          </div>                         <div class='col60 brown-col60'> <input onchange='ValidateSize(this)' accept='.jpg,.jpeg,.png' type='file' name='30' required></div></div>
                               <div class='row brown-row'> <div class='col40 brown-col40'><label><span title='povinný údaj' class='red'>*</span> Ilustračné foto 2 <a href='#' onclick='myModal(9,1);return false;'>(?)</a>:</label>                          </div>                         <div class='col60 brown-col60'> <input onchange='ValidateSize(this)' accept='.jpg,.jpeg,.png' type='file' name='31' required></div></div>
                                                                                        
                               <div class='row brown-row'> <div class='col40 brown-col40' ><input style='width:150px;' type='submit' name='submit' value='Odoslať'/></div></div>
                               <input style='display:none;' type='text' id='abc' name='abc'/>

                   </div>


              </form>
        
        		   ";

?>