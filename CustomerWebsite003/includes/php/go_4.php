<?
// This file is for DB pages, in case they have same layout
              
                         $content = "</a><h1>Akcie</h1>";
 
If ($doc==0) { 



                          $sql = mysql_query("SELECT a.id, a.nadpis, a.img, a.content
                  															FROM cms_content_akcie AS a
                  															WHERE a.id_menu = 4 AND a.id_lang = 1 
                                                ORDER BY a.id DESC
                                                ");
                              $content .= "<div id='akcie'>";
                      		while ($row = mysql_fetch_row($sql)) 
				                    {
                              $content .= "<div class='akcie-topic'>";
                                            

                                $content .= "<div style='height:60px;text-align:left;'><strong><a href='?go=4&doc=".$row[0]."'>".$row[1]."<br><span class='viac'>(viac...)</span></a></strong></div>";
                                $content .= "<a href='?go=4&doc=".$row[0]."'><img height='113px' src='images/img_content_akcie/id_".$row[0]."_small.jpg'></a>";

                              $content .= "</div>";
                            }
                            
                          $content .= "</div>";

 
} else if ($doc>0) {




                          $sql = mysql_query("SELECT a.id, a.nadpis, a.podnadpis, a.content, a.img, a.attach
                  															FROM cms_content_akcie AS a
                  															WHERE a.id = ".$doc);
                              
                      		$row = mysql_fetch_row($sql);

                              $content .= "
                                            <h2>".$row[1]."</h2>
                                            <p>".$row[2]."</p>";
                                            If (!$row[4]=="") {
                                              $content .= "<a rel='lightbox[roadtrip]' target='_blank' href='images/img_content_akcie/id_".$row[0].".jpg'><img width='150px' src='images/img_content_akcie/id_".$row[0]."_small.jpg'></a>";
                                            }
                              $content .= "<p>".$row[3]."<br><br>";
                                           
                                            If (!$row[5]=="") {
                                              $content .= "Pre viac informácií kliknite <a class='viac' target='_blank' href='downloads/".$row[5]."'>SEM</a><br><br>";
                                            } 
                              
                              $content .= "<a class='viac' href='?go=4'>Naspäť do akcií</a></p>";
         



} 


                         
 ?>

