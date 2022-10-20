<?
// This file is for DB pages, in case they have same layout
//1 list
//2 view (html area)
//3 update
//4 insert
//5 delete
//6 activate

      switch ($action) {
//*************************************************************
         case 0:  //LIST 
      
              global $SESSION, $result;
              
              
              If ($result == 1) {
                      @$content .= "<h3>Váš záznam bol aktualizovaný</h3>";
              } Elseif ($result == 2) {
                      @$content .= "<h3>Váš záznam bol pridaný</h3>";
              }Elseif ($result == 3) {
                      @$content .= "<h3>Váš záznam bol vymazaný</h3>";
              }
        
        								$sql = mysql_query("SELECT a.id, a.content
        															FROM cms_content AS a
        															WHERE a.id_menu = ".$go." AND a.id_lang = 1
                                      " );
                                      
                                      //ORDER BY a.id DESC
                      $no = 1;
                        											
        		      while ($row = mysql_fetch_row($sql)) 
        		      	{
                            
                           $string = SUBSTR(strip_tags($row[1]),0,73);
                

        
                          @$content .= "<div id='list'>
                                            <table width='600'><tr><td><a class='link' title='Editovať' href='?go=".$go."&action=1&id=".$row[0]."&PHPSESSID=".$_SESSION['sid']."'>
                                                  ".$no.". ".$string." ...
                                            </a>
                                            </td><td width='50'>&nbsp;&nbsp;&nbsp;<a href='#'' onClick='confirm_delete(\"?go=".$go."&action=4&id=".$row[0]."&PHPSESSID=".$_SESSION['sid']."\");'><img title='Vymazať' height='26' border='0' src='images/delete.png'></a>
                                            </td></tr></table></div>";

                $no++;
                    }

            break;
//*************************************************************
         case 1:  //VIEW 

              global $_SESSION, $id;
              
								$sql = mysql_query("SELECT a.id, a.content
															FROM cms_content AS a
															WHERE a.id_menu = ".$go." AND a.id_lang = 1 AND a.id = ".$id);
											
									$row = mysql_fetch_row($sql);

                  If ($id==0) {
                  
                      $content = "<form method='post' action='?go=".$go."&action=3&PHPSESSID=".$_SESSION['sid']."'>";
                  } else {
                      $content = "<form method='post' action='?go=".$go."&action=2&id=".$id."&PHPSESSID=".$_SESSION['sid']."'>";
                  } 
                  
                  $content .= "<textarea id='textarea' name='textarea'>".$row[1]."</textarea>
                                    <input type='submit' name='Submit' value='- Vložiť | Aktualizovať -'>
                              </form>";
                  
               
            break;
//*************************************************************
         case 2:  //UPDATE 

                global $HTTP_POST_VARS,$id,$go;
                
                $result = mysql_query("UPDATE cms_content AS a SET a.content ='".@$_POST['textarea']."' WHERE a.id='".$id."'") 
                          or die(mysql_error());  


                  ob_start();
                    header("Location: ?go=".$go."&action=0&PHPSESSID=".$_SESSION['sid']."&result=1");
                  ob_flush();



                               
            break;
//*************************************************************
         case 3:  //INSERT 

                global $HTTP_POST_VARS,$id,$go;
                
                $result = mysql_query("INSERT INTO cms_content (id_menu,content) VALUES ('".$go."','".@$_POST['textarea']."')") 
                          or die(mysql_error());  


                  ob_start();
                    header("Location: ?go=".$go."&action=0&PHPSESSID=".$_SESSION['sid']."&result=2");
                  ob_flush();

                
                
            break;
//*************************************************************
         case 4:  //DELETE 
                
                global $HTTP_POST_VARS,$id,$go;
                
                
                $result = mysql_query("DELETE FROM cms_content WHERE id = ".$id) 
                          or die(mysql_error());  


                  ob_start();
                    header("Location: ?go=".$go."&action=0&PHPSESSID=".$_SESSION['sid']."&result=3");
                  ob_flush();
                  
            break;
//*************************************************************
         case 5:  //ACTIVATE 
                $content = "ACTIVATE";
            break;

//*************************************************************
         case 6:  //LOGOUT 

                    session_unset();
                    session_destroy(); 
                    header("Location: ../");

            break;            
//*************************************************************

         default: 
                $content = "Vitajte v administratívnom prostredí stránky<br>
                a.sk";
          }


?>

