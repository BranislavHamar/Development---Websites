<?
// This file is for DB pages, in case they have same layout

function getimages($go,$i) {


                          
                         $sql = "SELECT a.id, a.img, a.des
                                                FROM cms_content_gallery AS a
                                                WHERE a.id_menu = ".$go."
                                                ORDER BY a.id DESC";
                             if ($i == 1) {                   
                          $sql .= " LIMIT 0,3";
                          }
                          
                          $sql = mysql_query($sql);
                          
                                  $getimages = "";
                                  $x=0;
                                  		while ($row = mysql_fetch_row($sql)) 
                                  				{
                                        
                                      if ($i == 1) {
                                        $getimages .= "<a rel='lightbox[roadtrip]' target='_blank' href='images/img_content_gallery/".$row[1].".jpg'><img style='margin-left:10px;' height='110' src='images/img_content_gallery/".$row[1]."_small.jpg'></a>";
                                      } else {
                                        $getimages .= "<div style='width:170px;height:150px;float:left;margin-top:15px;margin-left:5px;'><strong>".$row[2]."</strong><br>";
                                        $getimages .= "<a rel='lightbox[roadtrip]' target='_blank' href='images/img_content_gallery/".$row[1].".jpg'><img height='110' src='images/img_content_gallery/".$row[1]."_small.jpg'></a></div>";
                                        }


                                          $x++;
                                          
                                          If ($x==3) {
                                          $getimages .= "<br>";
                                          $x=0;
                                          }
                                          
                                          }


return $getimages;
}


              
                         $content = "<h1>Galéria</h1>";


If ($subgo==0) {

            $content .= "<div id='galeria'>

                <div class='galeria-topic'>
                    <div style='height: 60px; text-align: left;'><br><strong><a href='?go=5&subgo=19#menu5'>U nás, O U<br><span class='viac'>(viac...)</span></a></strong></div>
                      <a href='?go=".$go."&subgo=19#menu5'><img src='images/img_content_gallery/id_92_small.jpg' height='113px'></a>
                </div>
                <div class='galeria-topic'>
                    <div style='height: 60px; text-align: left;'><br><strong><a href='?go=5&subgo=18#menu5'>Maškarné Plesy<br><span class='viac'>(viac...)</span></a></strong></div>
                      <a href='?go=".$go."&subgo=18#menu5'><img src='images/img_content_gallery/id_79_small.jpg' height='113px'></a>
                </div>
                <div class='galeria-topic'>
                    <div style='height: 60px; text-align: left;'><br><strong><a href='?go=5&subgo=17#menu5'>Akcie<br><span class='viac'>(viac...)</span></a></strong></div>
                      <a href='?go=".$go."&subgo=17#menu5'><img src='images/img_content_gallery/id_93_small.jpg' height='113px'></a>
                </div>
              
             
                       </div>";


} elseif ($subgo==17 OR $subgo==18 OR $subgo==19 ) {




                          $sql = mysql_query("SELECT a.id, b.word
                                                FROM cms_menu AS a, cms_menu_words b
                                                WHERE a.id_parent = ".$subgo."
                                                AND a.id_word = b.id
                                                ORDER BY a.id DESC
                                                ");
                              $i=0;
                              $content .= "<div class='gallery-catlist'>";
                      		while ($row = mysql_fetch_row($sql)) 
				                    {

                                            
                              
                                  if ($i==0) {
                                            $content .= "<a href='?go=".$go."&subgo=".$row[0]."#menu5'><h2>".$row[1]."</h2></a>";
                                            $content .= "<a href='?go=".$go."&subgo=".$row[0]."#menu5'>".getimages($row[0],1)."</a>";
                                            $content .= "<br><a href='?go=".$go."&subgo=".$row[0]."#menu5'><span class='viac'>Viac fotiek z akcie</span> </a><br><br>";
                                      $i=1;
                              } else {
                                      $i++;
                                            if ($i==2) { $content .= "<h2>Archív akcií:</h2>";};
                                            $content .= "<a href='?go=".$go."&subgo=".$row[0]."#menu5'>".$row[1]." </a><br>";
                              }
                              

                            }
                              $content .= "</div>";      
                              
                              $content .= "<div style='text-align:left;clear:both;padding-left:100px;'><br><a class='viac' href='?go=5#menu5'>Späť na výber</a></div>";
                              

} elseif (!$subgo==17 OR !$subgo==18 OR !$subgo==19 OR !$subgo==0) {







                                      $sql = "SELECT a.id, b.word
                                                FROM cms_menu AS a, cms_menu_words b
                                                WHERE a.id = ".$subgo."
                                                AND a.id_word = b.id
                                                ORDER BY a.id DESC
                                                ";
                                                
                                $sql = mysql_query($sql);
                              
                                $row = mysql_fetch_row($sql);

                              $content .= "<div class='gallery-catlist'>
                                            <h2>".$row[1]."</h2>  ";
                               if ($subgo==21) {
                                $content .= " <div >
                                    <iframe  width='400' height='325'  src='http://www.youtube.com/embed/4vdGfG0VjTo' frameborder='0' allowfullscreen></iframe>
                                    </div>
                                ";
                               };             
                              $content .= " <div style='margin-left:80px;'>".getimages($subgo,0)."</div>
                                          </div>";
                                $content .= "<div style='text-align:left;clear:both;padding-left:100px;'><br><a class='viac' href='javascript:history.go(-1)'>Späť na výber</a></div>";


}



                     
 ?>

