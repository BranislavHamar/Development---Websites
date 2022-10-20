<?
// 
// as extra function for go = 1             
 function intro() 	{

                      $intro = "<div id='akcie'>";


                          $sql = mysql_query("SELECT a.id, a.nadpis,  a.img, a.content
                  															FROM cms_content_akcie AS a
                  															WHERE a.id_menu = 4 AND a.id_lang = 1 
                                                ORDER BY a.id DESC
                                                LIMIT 0,3");
                              
                      		while ($row = mysql_fetch_row($sql)) 
				                    {
                             $intro .= "<div class='akcie-topic'>";


                                        //$intro .= "<div style='text-align:left;'><strong><a href='?go=4&doc=".$row[0]."'>".$row[1]."<br><span class='viac'>(viac...)</span></a></strong></div>";
                                        //$intro .= "<img style='padding:0px auto 0px auto;' height='113px' src='images/img_content_akcie/id_".$row[0]."_small.jpg'>";
        
                                $intro .= "<div style='height:60px;text-align:left;'><strong><a href='?go=4&doc=".$row[0]."'>".$row[1]."<br><span class='viac'>(viac...)</span></a></strong></div>";
                                $intro .= "<a href='?go=4&doc=".$row[0]."'><img height='113px' src='images/img_content_akcie/id_".$row[0]."_small.jpg'></a>";
                                
                                 $intro .= "</div>";
                                    }
                            

                             $intro .= "<DIV ID='newsletter'><a title='Facebook' target='_blank' href='http://cccccc?id=100  '></a>
                                <form method='post' action=''>
                                   <input class='email' type='text' name='email' size='15' value='@'><input type='submit' value='Odoslať >' name='odoslat'>
                                </form></DIV>";

                   $intro .= "</div>";
                   
          return $intro;	

}            
                

				

        						
        						
        						
                      $content = "<h1>O U sa cítite ako doma</h1>";        						
                      
                      $content .= "<p class='intend'>Keď vstúpite k nám do Hostinca O U, máte dojem, že ste cez dvere prešli niekoľko desiatok rokov späť a namiesto bratislavského sídliska Ružinov, časť Štrkovec ste sa ocitli na chalupách našich dedov a pradedov.</p>";                  	                  

                      $content .= "<p class='intend'>Hoci okolo Vás zúri typické sídlisko postavené v sedemdesiatych rokoch, vo vnútri sa cítite ako na chalupe, kde atmosféru umocňujú všadeprítomné veci dennej potreby naších predkov.</p>";

                      $content .= "<div id='alert'>Prídite ochutnať ten pocit!</div>";

                       
?>
