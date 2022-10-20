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
              
              
              
           
    
        								$sql = mysql_query("SELECT a.id, a.content, a.id_menu, a.typ
        															FROM cms_content AS a
        															WHERE a.id_menu = ".$go." AND a.id_lang = ".$lang."
                                      ORDER BY a.id DESC" );
           
                                          
                      $no = 1;
                  

                        											
        		      while ($row = mysql_fetch_row($sql)) 
        		      	{
                            
                            
                         @$content .= "<div id='no'>".$no.".</div>
                                          <div id='subject'><a title='Editovať' href='?go=".$go."&lang=".$lang."&action=1&id=".$row[0]."&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&typ=".$row[3]."'>";
                            
                            
                            
                            
                                  If ($row[3]==2) {
                                    
                                      @$content .= "<img width='225px' src='../images/img_content/".$row[1]."_small.jpg' >"; 
                                  
                                  } else if ($row[3] == 1 OR $row[3] ==3) {
             
                                                           
                                      @$content .= SUBSTR(strip_tags($row[1]),0,73);
                                  
                                  };
                          
                         @$content .= " ...</a>
                                          </div>
                                          <div id='button'>
                                            <a href='#' onClick='confirm_delete(\"?go=".$go."&lang=".$lang."&action=4&id=".$row[0]."&image=1&PHPSESSID=".$HTTP_SESSION_VARS['sid']."\");'><img title='Vymazať' height='26' border='0' src='images/delete.gif'></a>
                                          </div>";
                                          
                                       
                $no++;
                    }

If ($go==9) {

        								$sql = mysql_query("SELECT a.id, a.content
        															FROM cms_content AS a
        															WHERE a.id_menu = 9 AND a.id_lang = 1
                                      ORDER BY a.id DESC" );
           
                            @$content .= "<div id='no'>&nbsp;</div><div id='subject'>";
                       											
        		      while ($row = mysql_fetch_row($sql)) 
        		      	{
                            

                        @$content .= $row[1]."; ";

                    }

                        @$content .= "</div><div id='button'>&nbsp;</div>";


}
            break;
//*************************************************************
         case 1:  //VIEW 

              global $HTTP_SESSION_VARS, $id, $typ, $go, $lang;
              
              
              	$sql = mysql_query("SELECT a.id, a.content, a.id_menu, a.typ, a.stamp 
															FROM cms_content AS a
															WHERE a.id_menu = ".$go." AND a.id = ".$id);
              				
									$row = mysql_fetch_row($sql);
									


                        If ($id==0) {
                        
                            $content .= "<form enctype='multipart/form-data' method='post' action='?go=".$go."&lang=".$lang."&action=3&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&typ=".$typ."'>";
                        } else {
                            $content .= "<form enctype='multipart/form-data' method='post' action='?go=".$go."&lang=".$lang."&action=2&id=".$id."&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&typ=".$typ."'>";
                        } 
                  
                  
                 
                  if ($row[3] == 1 OR $typ == 1) {
                  
                      if ($go == 9) {
                        
                        $content .= "<input name='content' size='50' type='text' value='".$row[1]."'><br>";
                      
                      } else {      
   
                        $content .= "<textarea id='textarea' name='content'>".$row[1]."</textarea>";                      
                  
                      }
                      
                   } else if($row[3] == 3 OR $typ == 3) {
                   
                        $content .= "<input name='content' size='50' type='text' value='".$row[1]."'><br>";
                        $content .= "Email (napr. nieco@nieco.sk)<br>";
                        $content .= "Web (napr. http://www.kupele-skleneteplice.sk)<br>";                        
                                     
                   } else if($row[3] == 2 OR $typ == 2) {
                        
                            If (!$row=="") {
                              $content .= "<a target='_blank' href='../images/img_content/".$row[1].".jpg' ><img width='225px' src='../images/img_content/".$row[1]."_small.jpg' ></a><br><br>";
                            }
                            
                            $content .= "Obrázok (JPG): <input name='content' type='file'><br>"; 
                                   
                    }; 
                  

                    If ($go == 3 ) {
                    $content .= "<br>Massmail: <input type='checkbox' name='massmail' value='yes'><br>";
                            }
                    
                    $content .= "<br>Dátum a čas poslednej aktualizácie: <i>".$row[4]."</i>";
                    $content .= "<input type='hidden' name='typ' value='".$typ."'>";
                    $content .= "<br><br><input type='submit' name='Submit' value='- Vložiť | Aktualizovať -'> </form>";


               
            break;
//*************************************************************
         case 2:  //UPDATE 

                global $HTTP_POST_VARS,$id,$go,$lang,$typ;

                $content = "";
               
               
               
               If ($typ==1 OR $typ==3) {
               
               
                $result = mysql_query("UPDATE cms_content AS a SET a.content ='".@$_POST['content']."',  a.id_lang ='".$lang."', a.id_menu='".$go."'   WHERE a.id='".$id."'") 
                              or die(mysql_error());  
               
               
                      If ($_POST['massmail']=="yes") {
                        
                            include("send.php");
                     
                            }
               
               }
                 
               else if ($typ == 2) {

                                $filename = "../images/img_content/id_".$id."_big.jpg";
                                move_uploaded_file($_FILES['content']['tmp_name'], $filename);
     

                                // Get new sizes
                                list($width, $height) = getimagesize($filename);
                                
                                
                                      if ($width>225) {
                                      
                                          $ratio=$height/$width;
                                          $newwidth=225;
                                          $newheight=$newwidth*$ratio;
                                      
                                      } else {
                                      
                                          $newwidth=$width;
                                          $newheight=$height;
                                      
                                      } 
        
                                  $resized_img = imagecreatetruecolor($newwidth,$newheight);
                                  $new_img = imagecreatefromjpeg($filename);
                                  //the resizing is going on here!
                                  imagecopyresampled($resized_img, $new_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                                  
                                  //finally, save the image
                                  ImageJpeg ($resized_img,"../images/img_content/id_".$id."_small.jpg");
                                  ImageDestroy ($resized_img);
                                  ImageDestroy ($new_img);                         
                          
                          
                          $result = mysql_query("UPDATE cms_content AS a SET a.id_lang ='".$lang."'  WHERE a.id='".$id."'") 
                              or die(mysql_error());  
                
                } 

                  ob_start();
                    header("Location: ?go=".@$go."&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&result=1");
                  ob_flush();



                               
            break;
//*************************************************************
         case 3:  //INSERT 

                global $HTTP_POST_VARS,$go,$typ,$lang;
                
                If ($typ==1 OR $typ==3) {
                   
                            $sql= mysql_query("SELECT id FROM cms_content ORDER BY id DESC limit 1");
                            
                            $row = mysql_fetch_row($sql);
                            
                            $id = $row[0] + 1;
                   
                   
                       $result = mysql_query("INSERT INTO cms_content (id,id_menu,content,typ,id_lang) VALUES ('".$id."','".$go."','".@$_POST['content']."','".$typ."','".$lang."')") 
                                  or die(mysql_error()); 


                      If ($_POST['massmail']=="yes") {
                        
                            include("send.php");
                     
                            }

                
                } Else If ($typ==2) {
                    
                    
                            //$sql= mysql_query("SELECT MAX(id) FROM cms_content");
                            $sql= mysql_query("SELECT id FROM cms_content ORDER BY id DESC limit 1");
                            
                            $row = mysql_fetch_row($sql);
                            
                            $id = $row[0] + 1;

                            $filename = "../images/img_content/id_".$id.".jpg";                                     
                            move_uploaded_file($_FILES['content']['tmp_name'],$filename);
                            
                             
                            

                                // Get new sizes
                                list($width, $height) = getimagesize($filename);
                                
                                
                                      if ($width>225) {
                                      
                                          $ratio=$height/$width;
                                          $newwidth=225;
                                          $newheight=$newwidth*$ratio;
                                      
                                      } else {
                                      
                                          $newwidth=$width;
                                          $newheight=$height;
                                      
                                      } 
        
                                  $resized_img = imagecreatetruecolor($newwidth,$newheight);
                                  $new_img = imagecreatefromjpeg($filename);
                                  //the resizing is going on here!
                                  imagecopyresampled($resized_img, $new_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                                  
                                  //finally, save the image
                                  ImageJpeg ($resized_img,"../images/img_content/id_".$id."_small.jpg");
                                  ImageDestroy ($resized_img);
                                  ImageDestroy ($new_img);   
                            
                            $result = mysql_query("INSERT INTO cms_content (id,id_menu,content,id_lang,typ) VALUES ('".$id."','".$go."','id_".$id."','".$lang."','".$typ."')") or die(mysql_error());                            
                            
                    
                    
                
                 } 

                  ob_start();
                    header("Location: ?go=".$go."&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&result=2");
                  ob_flush();

                
                
            break;
//*************************************************************
         case 4:  //DELETE 
                
                global $HTTP_POST_VARS,$id,$go,$typ,$lang;
                
                If ($typ == 2) {
              
                      //===========================================================//
                        $file = "../images/img_content/id_".$id."_small.jpg";
        
                        if(is_file($file)) {

                        chmod($file,0777) or die ( 'Could not SET UP the image file. _small' ); 
                        unlink($file) or die ( 'Could not DELETE the image file. _small' );
        
        
                        } else die ( 'Could not FIND the image file -->'."../images/go_".$go."/go_".$go."_".$id.".jpg" );
                      //===========================================================//
                        $file = "../images/img_content/id_".$id.".jpg";
        
                        if(is_file($file)) {

                        chmod($file,0777) or die ( 'Could not SET UP the image file. ' ); 
                        unlink($file) or die ( 'Could not DELETE the image file. ' );
        
        
                        } else die ( 'Could not FIND the image file -->'."../images/go_".$go."/go_".$go."_".$id."_big.jpg"  );
                      //===========================================================//
                      
                      
                      
                      

                };
                
                $result = mysql_query("DELETE FROM cms_content WHERE id = ".$id) 
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

