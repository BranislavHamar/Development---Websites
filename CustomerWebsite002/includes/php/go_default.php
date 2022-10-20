<?
// This file is for DB pages, in case they have same layout
              
              If (!$go==0){
								$sql = mysql_query("SELECT a.id, b.word
															FROM cms_menu AS a, cms_menu_words AS b
															WHERE a.id_word = b.id AND a.id= ".$go." AND b.lang = ".$lang );
                
                $row = mysql_fetch_row($sql);
                
                  @$content .= "<h1>".$row[1]."</h1>";
                
                }
                
                
                $sql = mysql_query("SELECT a.content
															FROM cms_content AS a
															WHERE a.id_menu = ".$go." AND a.id_lang = ".$lang."
                              ");
				
        //ORDER BY a.id DESC
        							
        		      while ($row = mysql_fetch_row($sql)) 
        		      	{
                  @$content .= $row[0];
//                  @$content .= "<p>&nbsp;</p>";
                  }
?>
