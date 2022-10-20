<?
// This file is for DB pages, in case they have same layout
// standard content pages
//1 list
//2 view (html area)
//3 update
//4 insert
//5 delete
//6 activate

      switch ($action) {
//*************************************************************
         case 0:  //LIST 
      
              global $HTTP_SESSION_VARS, $result, $lang,$typ;
              
              
              
           
    
        								$sql = mysql_query("SELECT a.id, a.id_menu, a.name, a.email, a.content 
        															FROM cms_content_guestbook AS a
        															WHERE a.id_menu = 6 
                                      ORDER BY a.id DESC" );
           
                                          
                      $no = 1;
                  

                        											
        		      while ($row = mysql_fetch_row($sql)) 
        		      	{
                            
                            
                         @$content .= "<div id='no'>".$no.".</div>
                                          <div id='subject'><a title='Editovať' href='?go=".$go."&lang=".$lang."&action=1&id=".$row[0]."&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&typ=".$row[3]."'>";
                            
                            
                                                           
                                      @$content .= SUBSTR(strip_tags($row[4]),0,73);
                                  
                          
                         @$content .= " ...</a>
                                          </div>
                                          <div id='button'>
                                            <a href='#' onClick='confirm_delete(\"?go=".$go."&lang=".$lang."&action=4&id=".$row[0]."&image=1&PHPSESSID=".$HTTP_SESSION_VARS['sid']."\");'><img title='Vymazať' height='26' border='0' src='images/delete.gif'></a>
                                          </div>";
                                          
                                       
                $no++;
                    }


            break;
//*************************************************************
         case 1:  //VIEW 

              global $HTTP_SESSION_VARS, $id, $typ, $lang;
              
              
        								$sql = mysql_query("SELECT a.id, a.id_menu, a.name, a.email, a.content, a.stamp 
															FROM cms_content_guestbook AS a
															WHERE a.id_menu = ".$go." AND a.id = ".$id);
              				
									$row = mysql_fetch_row($sql);
									


                        If ($id==0) {
                        
                            $content .= "<form enctype='multipart/form-data' method='post' action='?go=".$go."&lang=".$lang."&action=3&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&typ=".$typ."'>";
                        } else {
                            $content .= "<form enctype='multipart/form-data' method='post' action='?go=".$go."&lang=".$lang."&action=2&id=".$id."&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&typ=".$typ."'>";
                        } 
                  
                  
                   
                        $content .= "Meno: <input name='name' size='50' type='text' value='".$row[2]."'><br>";
                        $content .= "Email: <input name='email' size='50' type='text' value='".$row[3]."'><br>";
                        $content .= "<textarea id='textarea' name='content'>".$row[4]."</textarea>";                      
                                     
                    $content .= "<br>Dátum a čas poslednej aktualizácie: <i>".$row[5]."</i>";
                    $content .= "<br><br><input type='submit' name='Submit' value='- Vložiť | Aktualizovať -'> </form>";


               
            break;
//*************************************************************
         case 2:  //UPDATE 

                global $HTTP_POST_VARS,$id,$go,$lang,$typ;

                $content = "";
               
               

                $result = mysql_query("UPDATE cms_content_guestbook AS a SET a.content ='".@$_POST['content']."', a.name ='".@$_POST['name']."', a.email ='".@$_POST['email']."', a.id_menu='".@$go."'  WHERE a.id='".$id."'") 
                              or die(mysql_error());  
               

                  ob_start();
                    header("Location: ?go=".@$go."&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&result=1");
                  ob_flush();



                               
            break;
//*************************************************************
         case 3:  //INSERT 

                global $HTTP_POST_VARS,$go,$typ,$lang;
                
                   
                            $sql= mysql_query("SELECT id FROM cms_content_guestbook ORDER BY id DESC limit 1");
                            
                            $row = mysql_fetch_row($sql);
                            
                            $id = $row[0] + 1;
                   
                   
                       $result = mysql_query("INSERT INTO cms_content_guestbook (id,id_menu,content,name,email) VALUES ('".$id."','".$go."','".@$_POST['content']."','".@$_POST['name']."','".@$_POST['email']."')") 
                                  or die(mysql_error()); 
                

                  ob_start();
                    header("Location: ?go=".$go."&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&result=2");
                  ob_flush();

                
                
            break;
//*************************************************************
         case 4:  //DELETE 
                
                global $HTTP_POST_VARS,$id,$go,$typ,$lang;
                
                 
                $result = mysql_query("DELETE FROM cms_content_guestbook WHERE id = ".$id) 
                          or die(mysql_error());  


                  ob_start();
                    header("Location: ?go=".$go."&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&result=3");
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
                $content = "Vitajte v administratívnom prostredí stránky";
          }


?>

