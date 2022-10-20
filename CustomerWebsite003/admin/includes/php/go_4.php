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
              
              
              
           
    
        								$sql = mysql_query("SELECT a.id, a.nadpis
        															FROM cms_content_akcie AS a
        															WHERE a.id_menu = ".$go." AND a.id_lang = ".$lang."
                                      ORDER BY a.id DESC" );
           
                                          
                      $no = 1;
                  

                        											
        		      while ($row = mysql_fetch_row($sql)) 
        		      	{
                            
                            
                         @$content .= "<div id='no'>".$no.".</div>
                                          <div id='subject'><a title='Editovať' href='?go=".$go."&lang=".$lang."&action=1&id=".$row[0]."&PHPSESSID=".$HTTP_SESSION_VARS['sid']."'>";
                                          @$content .= $row[1];
                         
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
              
              
              	$sql = mysql_query("SELECT a.id, a.content, a.id_menu, a.nadpis, a.podnadpis, a.img, a.attach, a.stamp
															FROM cms_content_akcie AS a
															WHERE a.id_menu = ".$go." AND a.id = ".$id);
              				
									$row = mysql_fetch_row($sql);
									


                        If ($id==0) {
                        
                            $content .= "<form onSubmit='submitonce(this)' enctype='multipart/form-data' method='post' action='?go=".$go."&lang=".$lang."&action=3&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&typ=".$typ."'>";
                        } else {
                            $content .= "<form onSubmit='submitonce(this)' enctype='multipart/form-data' method='post' action='?go=".$go."&lang=".$lang."&action=2&id=".$id."&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&typ=".$typ."'>";
                        } 
                  
                  
                  
                  
                        
                        $content .= "Nadpis (Max. 38 znakov): <input name='nadpis' maxlength='38' size='40' type='text' value='".$row[3]."'><br>";     
                        $content .= "Podnadpis: <input name='podnadpis' size='50' type='text' value='".$row[4]."'><br>";
                        $content .= "<textarea id='textarea' name='content'>".$row[1]."</textarea>";  
                        
                         
                            If (!$row[5]=="") {
                              $content .= "<br><a title='Zväčšiť' target='_blank' href='../images/img_content_akcie/".$row[5].".jpg'><img src='../images/img_content_akcie/".$row[5]."_small.jpg' ></a><br><br>";
                            
                            }
                            $content .= "<br>Obrázok (JPG): <input name='picture' type='file'><br>"; 

 
                             If (!$row[6]=="") {
                              $content .= "<br>Súbor uložený na servery ako príloha: <a title='Otvoriť' target='_blank' href='../downloads/".$row[6]."'><strong>(".$row[6].")</strong></a><br><br>";
                            
                            }
                            $content .= "&nbsp;Príloha k akcii: <input name='attach' type='file'><br>"; 
                            
                                        
                    $content .= "<br>Dátum a čas poslednej aktualizácie: <i>".$row[7]."</i>";
                    $content .= "<br><br><input type='submit' name='Submit' value='- Vložiť | Aktualizovať -'> </form>";


               
            break;
//*************************************************************
         case 2:  //UPDATE 

                global $HTTP_POST_VARS,$id,$go,$lang,$typ;

                $content = "";
                $idimg="";
                $sql = "";
               
             If (!$_FILES['picture']['name']=="") {
                    
                          $filename = "../images/img_content_akcie/temp.jpg";
                          unlink("../images/img_content_akcie/id_".$id.".jpg");
                          unlink("../images/img_content_akcie/id_".$id."_small.jpg");
                                     
                            move_uploaded_file($_FILES['picture']['tmp_name'],$filename);
                            
                            // PICTURE 1024width    
                                // Get new sizes
                                list($width, $height) = getimagesize($filename);
                                
                                
                                      if ($width>1024) {
                                      
                                          $ratio=$height/$width;
                                          $newwidth=1024;
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
                                  ImageJpeg ($resized_img,"../images/img_content_akcie/id_".$id.".jpg");
                                  ImageDestroy ($resized_img);
                                  ImageDestroy ($new_img);                                
                            
                            // THUMBNAIL    
                                // Get new sizes
                                list($width, $height) = getimagesize($filename);
                                
                                
                                      if ($width>150) {
                                      
                                          $ratio=$height/$width;
                                          $newwidth=150;
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
                                  ImageJpeg ($resized_img,"../images/img_content_akcie/id_".$id."_small.jpg");
                                  ImageDestroy ($resized_img);
                                  ImageDestroy ($new_img);    
                                
                                  
                                  
                                  unlink($filename);
                                  
                                  
                                                
                            $idimg = "id_".$id;
                    
                            $sql .= ", a.img = '".$idimg."'";
                    };               
                          
                        
                        
                      If (!$_FILES['attach']['name']=="") {   
                        
                        $filename2 = "../downloads/att_".$id.".".substr($_FILES['attach']['name'], -3) ;                                    
                            move_uploaded_file($_FILES['attach']['tmp_name'],$filename2);
                        
                        $idatt= "att_".$id.".".substr($_FILES['attach']['name'], -3);
                                                
                                                $sql .= ", a.attach = '".$idatt."' ";
                        }
                        
                        
                        

                        

                          
                          $result = mysql_query("UPDATE cms_content_akcie AS a SET  a.nadpis = '".$_POST['nadpis']."', a.podnadpis = '".$_POST['podnadpis']."', a.content = '".$_POST['content']."' ".$sql." WHERE a.id='".$id."'") 
                              or die(mysql_error());  
                
                

                  ob_start();
                    header("Location: ?go=4&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&result=1");
                  ob_flush();



                               
            break;
//*************************************************************
         case 3:  //INSERT 

                global $HTTP_POST_VARS,$go,$typ,$lang;
                $idimg = "";
                $idatt = "";
                   
                             //$sql= mysql_query("SELECT MAX(id) FROM cms_content");
                            $sql= mysql_query("SELECT id FROM cms_content_akcie ORDER BY id DESC limit 1");
                            
                            $row = mysql_fetch_row($sql);
                            
                            $id = $row[0] + 1;           


//               if (!empty($_FILES['picture'])){
             If (!$_FILES['picture']['name']=="") {
             

 
                            $filename = "../images/img_content_akcie/temp.jpg";
                             
                                     
                            move_uploaded_file($_FILES['picture']['tmp_name'],$filename);
                            
                            // PICTURE 1024width    
                                // Get new sizes
                                list($width, $height) = getimagesize($filename);
                                
                                
                                      if ($width>1024) {
                                      
                                          $ratio=$height/$width;
                                          $newwidth=1024;
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
                                  ImageJpeg ($resized_img,"../images/img_content_akcie/id_".$id.".jpg");
                                  ImageDestroy ($resized_img);
                                  ImageDestroy ($new_img);                                
                            
                            // THUMBNAIL    
                                // Get new sizes
                                list($width, $height) = getimagesize($filename);
                                
                                
                                      if ($width>150) {
                                      
                                          $ratio=$height/$width;
                                          $newwidth=150;
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
                                  ImageJpeg ($resized_img,"../images/img_content_akcie/id_".$id."_small.jpg");
                                  ImageDestroy ($resized_img);
                                  ImageDestroy ($new_img);    
                                
                                  
                                  
                                  unlink($filename);
                                  
                                  
                                                
                            $idimg = "id_".$id;
                    };
                            
                            
                           
                               
                      If (!$_FILES['attach']['name']=="") {   
                        
                        $filename2 = "../downloads/att_".$id.".".substr($_FILES['attach']['name'], -3) ;                                     
                            move_uploaded_file($_FILES['attach']['tmp_name'],$filename2);
                        
                        $idatt= "att_".$id.".".substr($_FILES['attach']['name'], -3);
                        }
                        
                        
                        
                            $result = mysql_query("INSERT INTO cms_content_akcie (id,id_menu,content,id_lang,nadpis,podnadpis,img,attach) VALUES ('".$id."','".$go."','".@$_POST['content']."','".$lang."','".@$_POST['nadpis']."','".@$_POST['podnadpis']."','".$idimg."','".$idatt."')") or die(mysql_error());                            


                  ob_start();
                    header("Location: ?go=4&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&result=2");
                  ob_flush();

                
                
            break;
//*************************************************************
         case 4:  //DELETE 
                
                global $HTTP_POST_VARS,$id,$go,$typ,$lang;
                
              
              
                      //===========================================================//
                        $file = "../images/img_content_akcie/id_".$id.".jpg";
        
                        if (file_exists($file)) {
                          unlink($file);
                        }
                      //===========================================================//
                        $file = "../images/img_content_akcie/id_".$id."_small.jpg";
        
                        if (file_exists($file)) {
                          unlink($file);
                        }
                      //===========================================================//
                      
                      
                 															
                          $sql = mysql_query("SELECT a.attach
                  															FROM cms_content_akcie AS a
                  															WHERE a.id = ".$id);
                              
                      		//$row = mysql_fetch_row($sql);                              
                              
                              
                              If (mysql_num_rows($sql)==0) {	                               
                                           
                                           
                                  $file = "../downloads/".$row[0];
                  
                                  if (file_exists($file)) {
          
                                  unlink($file);                         
                              
                                    }
                              
                              }
                      //===========================================================//
                      
                          

                
                $result = mysql_query("DELETE FROM cms_content_akcie WHERE id = ".$id) 
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

