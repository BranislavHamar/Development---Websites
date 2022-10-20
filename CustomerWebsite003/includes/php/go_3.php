<?
// This file is for DB pages, in case they have same layout
              
             
                
                $sql = mysql_query("SELECT a.content, a.id_menu, c.word, b.id_parent
															FROM cms_content AS a, cms_menu AS b, cms_menu_words AS c
															WHERE a.id_menu = ".$go." AND a.id_lang = 1 AND a.id_menu = b.id AND b.id_word = c.id
                              ");
				
        //ORDER BY a.id DESC
        						
        						
        						
 						
                      

// Category functions
function row($food,$desc,$gram,$price ) {

$row = "

		<tr>
		    <td width=400><strong>".$food."</strong><br />
			   ".$desc."</td>
		    <td class='gram'>".$gram."&nbsp;</td>
		    <td><b>".$price."</b></td>
		</tr>
		<tr>
				    <td>&nbsp;</td>
    </tr>
";

return $row;

}
// Category go subpage


$content = "

<div class='hide' id='0'>
                      <h1>Menu > Jedálny lístok</h1>  
  <table cellpadding='0' cellspacing='0'>
  ". row("Slanina s vajcom","3 vajcia","180 g","2,40 €") ."
  ". row("Šunka s vajcom","3 vajcia","180 g","2,40 €") ."
  ". row("Praženica s cibuľkou","4 vajcia","180 g	","2,60 €") ."
  </table>
</div>  

<div class='hide' id='1'>
                      <h1>Menu > Jedálny lístok</h1>  
  <table cellpadding='0' cellspacing='0'>
  ". row("Hydinová pečeň na domáci spôsob","cibuľa, slanina, majoránka, rasca, čierne korenie	","150 g	","3,10 €") ."
  ". row("Plnené šampiňóny","plnené nivou a slaninkou","150 g","3,65 €") ."
  </table>
</div>  
  
				
   

<div class='hide' id='2'>
                      <h1>Menu > Jedálny lístok</h1>  
  <table cellpadding='0' cellspacing='0'>
     ". row("Špagety ' BOLOŇSKÉ '","+200g / mleté mäso, rajčina, syr","300 g","4,70 €") ."  
    ". row("Špagety ' SEDLIACKE '","+200g / slanina, syr, smotana, šampiňóny","300 g","4,95 €") ."
    ". row("Špagety ' PESTO '","+100g / pesto, parmezán","300 g","3,90 €") ."  
    ". row("Špagety ' AGLIO OLIO '","+100g / olivový olej, cesnak, chilli, parmezán	","300 g","3,90 €") ."  
    ". row("Penne s rukolou a sušenými paradajkami","+100g / olivový olej, cesnak, parmezán, rukola, sušené paradajky, paradajka","300 g","4,60 €") ."
    ". row("Penne ' KURACIE '","+200g / kuracie prsia, smotana, šampiňóny, syr, cibuľa","300 g","5,30 €") ."                                              
    ". row("Zapekané cestoviny s kuracím mäsom a slaninou","(šampiňóny, cibuľa, slanina, smotana, vajce)","400 g","5,20 €") ."  
  </table>  
</div>  


<div class='hide' id='3'>
                      <h1>Menu > Jedálny lístok</h1>  
  <table cellpadding='0' cellspacing='0'>
     ". row("Rizoto 'KURACIE'","kuracie prsia, miešaná zelenina, mletá paprika","300 g","4,95 €") ."  
    ". row("Rizoto 'ZELENINOVÉ'","miešaná zelenina","300 g","4,95 €") ."
    ". row("Rizoto 'TALIANSKE'","sušené paradajky, špenát, olivový olej, maslo, parmezán","300 g","4,95 €") ."                                                
  </table>  
</div>  
				

<div class='hide' id='4'>
                      <h1>Menu > Jedálny lístok</h1>  
  <table cellpadding='0' cellspacing='0'>
    ". row("Mexický bombarďák nášho Pepa","hovädzí steak-sviečkovica (grilovaná slanina, kovbojská fazuľa, grilovaná zelenina)","200 g","15,85 €") ."
    ". row("Hovädzí steak, listový špenát, špargľa","hovädzia sviečkovica","200 g","15,75 €") ."
    ". row("Hovädzí ' RENGOŠ ' steak","hovädzia sviečkovica, topinka, slaninka, volské oko","200 g	","15,75 €") ."
    ". row("Steak z bravčovej panenky","s pfeffer omáčkou, s bylinkovou omáčkou, s dubákovou omáčkou","200 g","7,75 €") ."
    ". row("Steak z bravčovej panenky","s listovým špenátom a volským okom","200 g","7,95 €") ."
    ". row("Viedenská roštenka","viedenská cibuľka	","200 g	","7,80 €") ."
    ". row("Rump steak ' BLUE-CHEESE '","marinovaná roštenka s omáčkou z modrého syra, grilovaná zelenina","200 g","7,80 €") ."
    ". row("Behalo to po dvore, ale steak je z toho lepší","kurací steak na bylinkách","200 g","6,10 €") ."                                      
    ". row("Bravčový steak zapečený s oštiepkom a grilovanou paprikou na cesnaku","bravčová panenka, ovčí syr","200 g","7,75 €") ."
    ". row("Rump-steak Napoleonovej šenkárky","hovädzia roštenka, grilované fazuľové lúsky, slaninka, cesnak","200 g","7,80 €") ."  
  </table> 
</div>  
				
			



<div class='hide' id='5'>
                      <h1>Menu > Jedálny lístok</h1>  
  <table cellpadding='0' cellspacing='0'>
    ". row("Maso ze strúhankú","vyprážaný bravčový rezeň","200 g	","4,90 €") ."  
    ". row("Medvedia tlapa","bravčové karé v černohorskom cestíčku","200 g","5,50 €") ."  
    ". row("Svinsky štipľavé maso z prasaťa","bravčové mäso, šampiňóny, chili, cibuľa, cesnak, syr v zemiakovej placke","150 g","4,90 €") ."  
    ". row("Bravčové medajlónky z panenky Dr. Labudu","sójová a cesnaková omáčka, horčica","150 g","5,75 €") ." 
    ". row("Bravčové medajlónky tetky z Viedne","bravčová panenka, Viedenská cibuľa","150 g","5,75 €") ."            
    ". row("Kus fajnového maska","200g br.panenka, 200g chrumkavý šalát (mrkva, ľad. šalát), mor. soľ, balsamico","200 g","6,10 €") ."
    ". row("1 kg Amputovane koleno z plemennej mangalice","(vaha cca 1,7kg, priprava 45min)","1,7 kg","7,90 €") ."
  </table> 
</div>  


<div class='hide' id='6'>
                      <h1>Menu > Jedálny lístok</h1>  
  <table cellpadding='0' cellspacing='0'>
    ". row("Prsia pod perinkou","kuracie prsia na prírodno so syrovou omáčkou","200 g","5,05 €") ."  
    ". row("Kačacie prsia na jablkách","kačacie prsia s kožou, sendvič, karamelizované jablká","250 g","7,10 €") ."  
    ". row("Žhavé kozenky v župane","kuracie prsia, šampiňóny, chili, cesnak, syr v zemiakovej placke","150 g","5,90 €") ."  
    ". row("Cecíky jemne líznuté smotanou","kuracie prsia, slanina, šampiňóny, cibuľa, horčica, kečup, smotana","150 g","5,40 €") ."  
    ". row("Kurací šnicel","vyprážané kuracie prsia","200 g","4,90 €") ."  
    ". row("Zrolovaná pipka","kuracia roláda na kari omáčke, špargľa, syr, šunka","150 g","6,10 €") ."  
    ". row("Kurací ' GORDON '","kuracie prsia, šunka, syr v trojobale","150g","5,90 €") ."  
    ". row("Kurací ' GORDON ' na prírodno","kuracie prsia, šunka, syr	","150 g","5,80 €") ."  
    ". row("Thajské rezance","kuracie mäso, pór, hríby, mrkva, sójova omáčka, cibuľa, kapusta","400 g","4,30 €") ." 
  </table> 

</div>     
      


<div class='hide' id='7'>
                      <h1>Menu > Jedálny lístok</h1>  
  <table cellpadding='0' cellspacing='0'>
    ". row("Losos na grile s pestom","","200 g	","8,10 €") ."  
    ". row("Losos na grile so sušenými paradajkami a mozzarelou","","200 g","9,20 €") ."  
  </table> 

</div>    



<div class='hide' id='8'>
                      <h1>Menu > Jedálny lístok</h1>  
  <table cellpadding='0' cellspacing='0'>
    ". row("čakacia doba 35 minút","","","") ."
    ". row("DEDOV MIX GRIL","200g/kuracie prsia, 200g/bravčová panenka, 200g/hovädzia roštenka, grilovaná zelenina, buffalo salsa, bluechese omáčka","600 g","23,10 €") ."  
    ". row("SEDLIACKA misa","500g/pečené rebierka, 400g/ kuracie krídelka, 300g/kuracie stehienka, pikantná omáčka, mix kyslé","1200 g","15,30 €") ."                                          
  </table> 
  
</div>    



<div class='hide' id='9'>
                      <h1>Menu > Jedálny lístok</h1>  
   <table cellpadding='0' cellspacing='0'>
    ". row("Grilované prasiatko","(v celku - váha cca 20 kg)"," 1 kg","11,10 €") ."
    ". row("Grilované kurence","(v celku - váha cca 1,3 kg)","1 kg","7,90 €") ."  
    ". row("Pečené kačice","(v celku - váha cca 2,5 kg)","1 kg","12,30 €") ."
    ". row("Pečené husi","(v celku - váha cca 5 kg )","1 kg","16,10 €") ."  
    ". row("Grilovaná sedliacka krkovička ","(v celku - váha cca 4 kg)","1 kg","9,90 €") ."

  </table> 

  
</div>  
 
<div class='hide' id='10'>
                      <h1>Menu > Jedálny lístok</h1>  
  <table cellpadding='0' cellspacing='0'>
    ". row("Bryndzové halušky so slaninou","","400 g","4,10 €") ."  
    ". row("Bryndzové halušky so slaninou a klobásou","","400 g","4,15 €") ." 
    ". row("Kapustové strapačky so slaninou	","","400 g","3,95 €") ."  
    ". row("Kapustové strapačky so slaninou a klobásou","","400 g	","4,10 €") ." 
    ". row("Zapekané zemiaky so syrom, klobásou a slaninkou","(smotana, vajce)","400 g","4,90 €") ."  
    ". row("Zapekané cestoviny z kuracím mäsom a slaninou","(šampiňóny, smotana, vajce)","400 g","5,20 €") ." 
    ". row("Plnená zemiaková placka","(kyslá kapusta, slaninka) po 15.00 hod.","100 g	","3,95 €") ."  
  </table> 

</div>    

<div class='hide' id='11'>
                      <h1>Menu > Jedálny lístok</h1>  
  <table cellpadding='0' cellspacing='0'>
    ". row("Vyprážaný syr","","150 g","4,15 €") ." 
    ". row("Vyprážaný syr so šunkou","","150 g","4,90 €") ."  
    ". row("Vyprážaný oštiepok v cestíčku","ovčí syr","150 g	","4,10 €") ." 
    ". row("Vyprážaný encián","","120 g","4,10 €") ." 
    ". row("Vyprážaný romadúr","pivný syr","100 g","4,10 €") ." 
    ". row("Grilovaný encián na šaláte, toast","nakladaný v korení, ľad. šalát, kukurica, mrkva, uhorka, medovo horčicový dressing","120 g","4,95 €") ."
  </table> 

</div>  

<div class='hide' id='12'>
                      <h1>Menu > Jedálny lístok</h1>  
  <table cellpadding='0' cellspacing='0'>
    ". row("Babičkin kurací hamburger","kuracie mäso, hranolky, konfitovaná cibuľa, horčica, kečup, uhorka, paradajka","200 g","5,95 €") ."
    ". row("Dedov hovädzí hamburger, hranolky, buffalo omáčka","","200 g","6,50 €") ."
    ". row("Kuracie krídelká zo susedovho kurníka","pečené kuracie krídelká s pikantnou omáčkou","400 g","4,10 €") ." 
    ". row("Zahalené stehienka kabátikom","pečené kuracie stehienka, corn flaces","300 g","4,50 €") ." 
    ". row("Keď ste si ma upiekli, tak si ma aj zjedzte","pečené bravčové rebierka s pikantnou omáčkou","500 g","5,15 €") ."                                     
    ". row("Pivná syrová pomazánka pre 3 osoby po 15.00 hod.","eidam, niva, encián, horčica, pivo, cibuľa, feferónky, paprika, chilli","300 g","8,20 €") ." 
    ". row("Nakladaný syr s feferónkami, chlieb 1ks","","120 g","3,90 €") ." 
    ". row("Vnučkine copánky","vyprážané korbáčiky, cenakový dresing","100 g","3,90 €") ."  
    ". row("Pivný syr","(romadúr, horčica, maslo, cibuľa, červená paprika)","100 g","2,90 €") ." 
    ". row("Slovenské prkénko","eidam, šunka, oravská slanina, klobáska, maslo","200 g","5,55 €") ."  
    ". row("Syrový tanier","eidam, encián, romadúr, niva, cibuľa, maslo ","200 g","5,90 €") ."
    ". row("Syrové guľky v paprike","eidam, bambino, natierkové maslo, petržlenová vňať, paprika","200 g","5,55 €") ."    
    ". row("Pečená klobása, horčica","","200 g","2,50 €") ." 
    ". row("MC Dedo hranolky","","250 g	","1,80 €") ."      
    ". row("Pivné zemiakové dolky - 3ks ","po 15.00 hod, ak stihneme spravíme to aj hneď","100 g","1,35 €") ." 
    ". row("Mastný chlieb s cibuľou","","80 g","0,90 €") ."
    ". row("Tataráčik z lososa s chrumkavým toastíkom","","125 g","4,95 €") ." 
    ". row("Štrkáčsky tatarák","Po 15hod, mletá hovädzia sviečková tepelne upravená na žiadosť zákazníka, Pokiaľ si prajete zamiešať tatarák sami, informujte o tom čašníka.","200g","11,10 €") ."
  </table> 
</div>   

	

<div class='hide' id='14'>
                      <h1>Menu >  Jedálny lístok</h1>  
  <table cellpadding='0' cellspacing='0'>
    ". row("Grécky šalát","paradajka, paprika, cibuľa, uhorka, slaný syr, olivy, olivoví olej","400 g	","4,55 €") ."
    ". row("Malý 'MIEŠANÝ' šalát prílohový","paradajka, paprika, kapusta, uhorka, francúzsky dressing","200 g","1,80 €") ."  
    ". row("Mrkvový šalát","med, citrón šťava","150 g	","1,80 €") ."  
    ". row("Paradajkový s cibuľou","soľ, korenie, olivový olej","200 g","1,80 €") ."  
    ". row("Uhorkový šalát","sladkokyslý nálev, cesnak, mletá paprika","200 g","1,80 €") ."  
    ". row("Kompót podľa ponuky","","150 g","1,20 €") ."  
  </table> 
 
</div>  




<div class='hide' id='15'>
                      <h1>Menu > Jedálny lístok</h1>
  <table cellpadding='0' cellspacing='0'>
    ". row("Zeleninový šalát s tuniakom, vajíčkom a syrom","zelenina, tuniak, vajce, dressing, syr","400 g","4,70 €") ."  
    ". row("Šalát 'CÉZAR'","ľadový šalát, kuracie prsia, ančovičkový dressing, parmezán, krutóny","300 g","4,35 €") ."
    ". row("Miešaný šalát s kuracím mäsom	","paradajka, paprika, uhorka, kuracie mäso, francúzsky dressing","300 g","4,35 €") ."
    ". row("Zeleninový šalát s kuracím gyrosom, toast","ľadový šalát, špenát, mrkva, uhorka, kukurica, paradajka","400 g","4,55 €") ."         
    ". row("Ľadový šalát s kozím syrom","paradajka, ľadový šalát, uhorka, kozí syr, mrkva, hruška, vlašské orechy","300 g","4,70 €") ."
  </table>  
</div>  


<div class='hide' id='16'>
                      <h1>Menu > Jedálny lístok</h1>  
 <table cellpadding='0' cellspacing='0'>
    ". row("Gaštanko","gaštanové pyré, šľahačka, čokoládový toping","80 g","1,95 €") ."  
    ". row("Palacinky s džemom","čokoládová poleva","160 g","1,95 €") ."  
    ". row("Palacinky s tvarohom a hrozienkami","čokoládová poleva","160 g","2,05 €") ."  
    ". row("Palacinky s nutellou a vlašskými orechami","čokoládová poleva","160 g	","2,35 €") ."  
    ". row("Zmrzlinová palacinka","čokoládová poleva","160 g","2,30 €") ."  
    ". row("Zmrzlinový pohár","(zmrzlina, ananás, čokoláda, šľahačka)","150 g","2,00 €") ."  
    ". row("Štrúdľa - podľa dennej ponuky	","","100 g","0,95 €") ."  
    ". row("Zákusok - podľa dennej ponuky	","","100 g	","1,25 €") ."  
                             
  </table> 
  
  
</div>  

<div class='hide' id='17'>
                      <h1>Menu > Jedálny lístok</h1>
  <table cellpadding='0' cellspacing='0'>
    ". row("Varené zemiaky","","200 g","0,95 €") ."  
    ". row("Opekané zemiaky","","200 g","1,00 €") ."  
    ". row("Hranolky","","200 g","1,05 €") ."  
    ". row("Zemiakové krokety","","150 g","1,05 €") ."  
    ". row("Šťouchaný brambor","","200 g","1,00 €") ."
    ". row("Dusená ryža","","160 g","0,95 €") ."  
    ". row("Dusená ryža hrášková","","200 g","1,05 €") ."  
    ". row("Anglická zelenina","","200 g","1,90 €") ."  
    ". row("Grilovaná zelenina","","200 g","1,90 €") ."  
    ". row("Grilované fazuľové lúsky","","100 g","1,00 €") ."
    ". row("Knedľa","","40 g","0,20 €") ."  
    ". row("Volské oko","","60 g","0,60 €") ."                          
    ". row("Chlieb","","45 g","0,20 €") ."  
    ". row("Topinka (krajec)","","45 g","0,20 €") ."  
    ". row("Hrianka (krajec)","","45 g","0,20 €") ."  
                       

  </table>  

</div>  


<div class='hide' id='18'>
                      <h1>Menu > Jedálny lístok</h1>
  <table cellpadding='0' cellspacing='0'>
    ". row("Syrová","","100 g","1,45 €") ."  
    ". row("Nivová","","100 g	","1,45 €") ."  
    ". row("Pfeffer (zelené korenie)","","100 g	","1,45 €") ."  
    ". row("Hríbová	","","100 g","1,45 €") ."                                                         
    ". row("Cesnakový dressing","","100 g","1,35 €") ."  
    ". row("Pikantná omáčka studená","","100 g","1,35 €") ."
    ". row("Blue-cheese (smotana, niva)	","","100 g	","1,45 €") ."    
    ". row("BBQ omáčka","","100 g	","1,35 €") ."
    ". row("Buffalo salsa (majonéza s feferónkami)","","100 g","1,70 €") ."  
    ". row("Medovo horčicový dressing","","50 g","0,70 €") ."
    ". row("Tatárska omáčka","","50 g","0,70 €") ."
    ". row("Kečup","","50 g","0,70 €") ."    
    ". row("Horčica","","50 g","0,50 €") ."  
    ". row("Uhorky","","100 g","1,00 €") ."
    ". row("Baranie rohy","","100 g","1,00 €") ."  
    ". row("Alma paprika","","100 g","1,00 €") ."
    ". row("Cvikla","","100 g","1,00 €") ."
    ". row("Konfitovaná červená cibuľa","","50 g","0,80 €") ."  
    ". row("Chren","","50 g","0,80 €") ."    
    ". row("Feferóny","","50 g","0,70 €") ."    
  </table>

</div> 



<div class='hide' id='20'>
                      <h1>Menu > Nápojový lístok</h1>  
  <table cellpadding='0' cellspacing='0'>
    ". row("Gambrinus 10º","svetlé","0,5 l","1,10 €") ."  
    ". row("Gambrinus 10º","svetlé","0,3 l","0,66 €") ."
    ". row("Kozel 10º","svetlé tankové","0,5 l","1,20 €") ."
    ". row("Kozel 10º","svetlé tankové","0,3 l","0,72 €") ."                             
    ". row("Plzeň 12º","svetlé tankové","0,5 l","1,50 €") ."
    ". row("Plzeň 12º","svetlé tankové","0,3 l","0,90 €") ."            
    ". row("Šariš 11º","tmavé","0,5 l","1,10 €") ."
    ". row("Šariš 11º","tmavé","0,3 l","0,66 €") ." 
    ". row("Master 18º","tmavé","0,4 l","1,95 €") ." 
    ". row("Radegast Birell nealko","","0,5 l","1,25 €") ."  
    ". row("Radegast Birell nealko","","0,3 l","0,75 €") ."      
  </table> 
 
</div>  



<div class='hide' id='21'>
                      <h1>Menu > Nápojový lístok</h1>
  <table cellpadding='0' cellspacing='0'>
    ". row("Plzeň 12ºº","svetlé","0,5 l / fl.","1,50 €") ."  
    ". row("Kozel 10º","svetlé","0,5 l / fl.","1,20 €") ."
    ". row("Radegast","nealko","0,33 l / fl.","1,25 €") ."
  </table>  
</div>  


<div class='hide' id='22'>
                      <h1>Menu > Nápojový lístok</h1>
  <table cellpadding='0' cellspacing='0'>
    ". row("VÍNO - CHATEAU KRAKOVANY","","","") ."  
    ". row("Víno biele - Chardonnay","","1 dl","0,60 €") ."  
    ". row("Víno červené - Frankovka modrá","","1 dl","0,70 €") ."
    ". row("Biele vína - akostné, odrodové, suché","","","") ."
    ". row("Veltlínske zelené","","0,75 l / fl.","5,20 €") ."
    ". row("Rizling rýnsky","","0,75 l / fl.","5,60 €") ."
    ". row("Rulandské biele","","0,75 l / fl.","5,60 €") ."
    ". row("Tramín červený","","0,75 l / fl.","5,60 €") ."
    ". row("Červené vína - akostné, suché","","","") ."
    ". row("Frankovka modrá","","0,75 l / fl.","5,80 €") ."
    ". row("Svätovavrinecké","","0,75 l / fl.","5,80 €") ."
    ". row("Ruţové vína - akostné","","","") ."
    ". row("Frankovka modrá, suché","","0,75 l / fl.","5,60 €") ."
    ". row("Biele vína - s prívlastkom","","","") ."
    ". row("Veltlínské zelené","neskorý zber, suché","0,75 l / fl.","9,00 €") ."
    ". row("Rizling vlašský","neskorý zber, suché","0,75 l / fl.","9,00 €") ."
    ". row("Rizling rýnsky","neskorý zber, suché","0,75 l / fl.","10,00 €") ."
    ". row("Sauvignon","výber z hrozna, suché","0,75 l / fl.","12,00 €") ."
    ". row("Rulandské šedé "," výber z hrozna, suché","0,75 l / fl.","12,00 €") ."
    ". row("Tramín červený","výber z hrozna, suché","0,75 l / fl.","14,00 €") ."
    ". row("Rizling rýnsky"," výber z hrozna, polosuché","0,75 l / fl.","14,00 €") ."                                                                        
    ". row("Rulandské biele"," výber z hrozna, suché","0,75 l / fl.","12,00 €") ."  
    ". row("Rulandské šedé"," výber z hrozna, polosuché","0,75 l / fl.","14,00 €") ."  
    ". row("Devín"," výber z hrozna, polosladké","0,75 l / fl.","12,00 €") ."  
    ". row("Červené vína - s prívlastkom","","","") ."  
    ". row("Frankovka modrá","neskorý zber, suché","0,75 l / fl.","10,00 €") ."  
    ". row("Cabernet Sauvignon","výber z hrozna, suché","0,75 l / fl.","12,00 €") ." 
    ". row("Rulandské Modré "," výber z hrozna, suché","0,75 l / fl.","12,00 €") ."                                                                        
    ". row("Merlot"," výber z hrozna, suché","0,75 l / fl.","14,00 €") ."  
    ". row("Cabernet Sauvignon Barrique","neskorý zber, suché","0,75 l / fl.","14,00 €") ."  
    ". row("Ruţové vína - s prívlastkom","","","") ."  
    ". row("Frankovka modrá ","neskorý zber, suché","0,75 l / fl.","10,00 €") ."  
    ". row("Cabernet Sauvignon"," výber z hrozna, suché","0,75 l / fl.","12,00 €") ."  
    ". row("Hubert Club","","0,75 l / fl.","9,30 €") ."                      
    ". row("Hubert De Luxe","","0,75 l / fl.","10,95 €") ."  
       
  </table>  
</div>  





<div class='hide' id='23'>
                      <h1>Menu > Nápojový lístok</h1>
  <table cellpadding='0' cellspacing='0'>
    ". row("Kofola Originál čap.","","0,5 l","1,00 €") ."  
    ". row("Kofola Originál čap.","","0,3 l","0,60 €") ."
    ". row("Bonaqua","sýtená, jemne sýtená, nesýtená","0,25 l/ fl.","1,10 €") ."
    ". row("Römerquelle","","0,33 l / fl.","1,30 €") ."
    ". row("Sóda","","1 dl","0,15 €") ."
    ". row("Coca cola, Coca cola light, Coca cola ZERO","","0,33 l / fl.","1,25 €") ."
    ". row("Tonic Kinley Water","","0,25 l / fl.","1,20 €") ."
    ". row("Sprite, Fanta","","0,20 l / fl.","1,20 €") ."
    ". row("Vinea","biela","0,25 l / fl.","1,20 €") ."
    ". row("Cappy džús","pomaranč, multi, grep, jahoda, ríbezľa, jablko, ananás, hruška","0,20 l/ fl.","1,30 €") ."
    ". row("Nestea","citrón, broskyňa, zelený čaj s jablkom","0,20 l/ fl.","1,30 €") ."
    ". row("Citronáda","","0,10 l/ l.","0,20 €") ."
  </table>  


</div> 


<div class='hide' id='24'>
                      <h1>Menu > Nápojový lístok</h1>
  <table cellpadding='0' cellspacing='0'>
    ". row("Káva presso","","7g/1por.","1,15 €") ."  
    ". row("Káva zalievaná","","7g/1por.","1,15 €") ."
    ". row("Káva viedenská","","7g/1por.","1,45 €") ."
    ". row("Káva bez kofeínu","","7g/1por.","1,25 €") ."
    ". row("Čaj Lipton","čierny, zelený, ovocný, šípkový, mäta","1por.","1,20 €") ."
    ". row("Mlieko do kávy Tatra mlieko","","2 cl/1por.","0,20 €") ."
    ". row("Šľahačka","","7g/1por","0,30 €") ."
    ". row("Med porciovaný","","1 kus","0,20 €") ."
  </table>

</div> 


<div class='hide' id='25'>
                      <h1>Menu > Nápojový lístok</h1>
  <table cellpadding='0' cellspacing='0'>
    ". row("Vodka Stolichnaya","","5 cl","1,60 €") ."
    ". row("Vodka Finlandia","","5 cl","2,00 €") ."
    ". row("Vodka Koskenkova Peach","","5 cl","1,40 €") ."
    ". row("Vodka Nicolaus","","5 cl","1,40 €") ."
    ". row("Borovička Spišiacka","","5 cl","1,40 €") ."
    ". row("Hruška, Marhuľa, Malina Spiš originál","","5 cl","1,40 €") ."
    ". row("Hruškovica JELINEK","","5 cl","2,20 €") ."
    ". row("Slivovica JELINEK zlatá 52%","","5 cl","2,20 €") ."
    ". row("Hruškovica NICOLAUS","","5 cl","2,50 €") ."
    ". row("Slivovica NICOLAUS","","5 cl","2,50 €") ."
    ". row("Višňovica NICOLAUS","","5 cl","2,50 €") ."
    ". row("Wilmos Pear pálenka","","5 cl","2,50 €") ."
    ". row("Euro UM","","5 cl","1,40 €") ."
    ". row("Rum C.Morgen","","5 cl","2,20 €") ."
    ". row("Rum C.Morgen Stock","","5 cl","3,40 €") ."
    ". row("Rum Baccardi","","5 cl","2,00 €") ."
    ". row("Rum Centario","","5 cl","7,10 €") ."
    ". row("Rum Havana club 3r","","5 cl","2,20 €") ."
    ". row("Rum Diplomatico","","5 cl","5,10 €") ."
    ". row("Gin Seagrams","","5 cl","2,00 €") ."
    ". row("Gin Beefeather","","5 cl","2,00 €") ."
    ". row("Tequila Olmeca Silver","","5 cl","3,30 €") ."
    ". row("Tequila Olmeca Gold	","","5 cl","3,50 €") ."
    ". row("Karpatské Brendy, Cézar","","5 cl","1,40 €") ."
    ". row("Karpatské Brandy Špeciál","","5 cl","3,50 €") ."
    ". row("Metaxa * * * * *","","5 cl","2,00 €") ."
    ". row("Martel","","5 cl","4,65 €") ."    
    ". row("Remy Martin","","5 cl","4,65 €") ."                                
    ". row("Johnie Walker RED","","5 cl","2,50 €") ."  
    ". row("Ballantines","","5 cl","2,50 €") ."    
    ". row("Jim Beam","","5 cl","2,50 €") ."  
    ". row("Jameson","","5 cl","2,70 €") ."  
    ". row("Tullamore Dew","","5 cl","3,00 €") ."    
    ". row("Jack Daniels","","5 cl","3,30 €") ."
    ". row("Absinth","","5 cl","3,30 €") ."
    ". row("Fernet Stock, Fernet Stock Citrus, Fernet Stock Z","","5 cl","1,50 €") ."    
    ". row("Chivas Regal 12 r.","","5 cl","4,70 €") ."  
  </table>   
    
</div> 


<div class='hide' id='26'>
                      <h1>Menu > Nápojový lístok</h1>
  <table cellpadding='0' cellspacing='0'>
    ". row("Vaječný likér","","5 cl","0,85 €") ."  
    ". row("Demänovka horká, Demänovka likér","","5 cl","1,40 €") ."        
    ". row("Becherovka","","5 cl","1,60 €") ."        
    ". row("Jagermeister","","5 cl","2,35 €") ."  
    ". row("Baileys Cream","","5 cl","2,70 €") ."        
    ". row("Cinzano","","1 dcl","1,60 €") ."        
  </table> 

</div> 



<div class='hide' id='27'>
                      <h1>Menu > Nápojový lístok</h1>
  <table cellpadding='0' cellspacing='0'>
    ". row("CHUŤOVKY","","","") ."  
    ". row("Arašidy","","1 bal./90g","1,00 €") ."  
    ". row("Pražené mandle","","1 bal./100g","2,40 €") ."  
    ". row("Lupienky","","1 bal./75g","1,10 €") ."  
    ". row("Žuvačky","","1 bal./10 ks","0,95 €") ."  
    ". row("ENERGY DRINK","","","") ."  
    ". row("Red Bull","","0,25l/plech.","2,50 €") ."  
    ". row("Red Bull Light","","0,25l/plech.","2,50 €") ."  
    ". row("CIGARETY","podľa ponuky","","") ."  
    ". row("Cohiba club","","1 ks.","2,50 €") ."
    ". row("Romeo and Julieta","","1 ks.","2,10 €") ."    
    ". row("Zápalky","","1 kr.","0,10 €") ."                              
    ". row("Zapaľovač","","1 kus","0,70 €") ."     
  
  </table> 

</div> 



<div class='hide' id='28'>                      
                    <h1>Menu > Denné menu</h1>  ";


                          $sql = mysql_query("SELECT a.content
                  															FROM cms_content AS a
                  															WHERE a.id_menu = 3 AND a.id_lang = 1 
                                                ORDER BY a.id DESC
                                                LIMIT 0,1");
                              
                      		$row = mysql_fetch_row($sql); 

                                        $content .= "<p>".$row[0]."</p>";




$content .= "
</div>


<div class='hide' id='29'>
                      <h1>Menu > Aktuálna ponuka</h1>
  <table cellpadding='0' cellspacing='0'>";
  
@$vycuc = MySQL_Query("SELECT * FROM cms_ponuka ORDER BY priorita");
while ($zaznam = MySQL_Fetch_Array($vycuc)) {
	$content .= row($zaznam["nazov"], $zaznam["popis"], $zaznam["vaha"], $zaznam["cena"]) ."  ";
}
/*
  row("Predjedlá","","","") ."
  ". row("Divinová terinka, kukuričný chlieb","","100 g","4,60 €") ."
  ". row("Domáce nátierky, kukuričný chlieb","bryndzová, oškvarková, vajíčková","120 g","3,20 €") ."
  ". row("Špeciality","","","") ."       
  ". row("Jelení chrbát s červenou vinnou kapustou, tirolská knedľa","","200 g","18,00 €") ."
  ". row("Panenka z diviaka s omáčkou z lesného ovocia, opekané zemiakové spätzle","","200 g","16,50 €") ."
  ". row("Vykostené vypráţané kačacie prsia, thajská ryža","mandle, pór, mrkva, sójová omáčka, listový šalát","180 g","7,80 €") ."
  ". row("Brav. kotlet s omáčkou z grilovaných paprík","karé s kosťou","250 g","7,20 €") ."
  ". row("Panenské medajlónky s les. ovocím a slivovicou","bračová panenka","150 g","6,20 €") ."
  ". row("Fazuľový šalát s jogurtom","grilované kur. medajlóniky, baby špenát, veľká biela fazuľa","350 g","6,50 €") ."
  ". row("Rukolový šalát","rukola, slanina, cherry rajčinky, parmezán","250 g","4,80 €") ."
  ". row("Šalát 'Beluga'","šošovica, grilované kač. prsia, listový šalát","350 g","7,40 €") ."
  ". row("Tofu špíz","tofu, cherry rajčinky, šampióny, cuketa","200 g","4,80 €") ."
  ". row("Zeleninové lasagne","cuketa, paradajka, paprika, cibuľa, parmezán","400 g","4,80 €") ."
  ". row("Meč z grilu","panenka, roštenka, klobása, cibuľa, slanina","220 g","8,50 €") 
*/  
$content .= "<tr>
			<td class='popiska2' colspan='4'>Pri nepredložení účtu z registračnej pokladne NEPLAŤTE !!!</td>
		</tr>
  </table>

</div>


<div class='hide' id='30'>                      
                    <h1>Menu > Denné menu</h1>  ";


                              
                                        $content .= "<p>".$row[0]."</p>";




$content .= "
</div>
<p>&nbsp;</p>
";
 
?>

