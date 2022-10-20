<?
// This file is for DB pages, in case they have same layout
              
             
                
                $sql = mysql_query("SELECT a.content, a.id_menu, c.word, b.id_parent
															FROM cms_content AS a, cms_menu AS b, cms_menu_words AS c
															WHERE a.id_menu = ".$go." AND a.id_lang = 1 AND a.id_menu = b.id AND b.id_word = c.id
                              ");
				
        //ORDER BY a.id DESC
        						
        						
        						
//                    If (!mysql_num_rows($sql)==0) {	
        						
                                        	                  
                		      while ($row = mysql_fetch_row($sql)) 
                		      	{
                              $content = "<h1>".$row[2]."</h1>";

                              $content .= "<p>".$row[0]."</p>";
            
                             }
//                      } else {
                      
//                            @$content .= "<p>&nbsp;</p>";                  
//                      }
?>
