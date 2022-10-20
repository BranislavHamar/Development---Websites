<?
// This file is for DB pages, in case they have same layout
// gallery
//1 list
//2 view (html area)
//3 update
//4 insert
//5 delete
//6 activate
//7 insert Gallery cat
//8 update Gallery cat
//9 delete Gallery cat


      switch ($action) {
//*************************************************************
         case 0:  //LIST 
      
              global $HTTP_SESSION_VARS, $result, $lang, $go, $id, $subgo;
  

                                      $sql = mysql_query("SELECT a.id, b.word
															                         FROM cms_menu AS a, cms_menu_words AS b
															                         WHERE a.id_word = b.id AND a.id = ".$subgo);
                                                            
                  $num_rows = mysql_num_rows($sql);                                                            
									$row = mysql_fetch_row($sql);
									
                          @$content .="<div>";
                            If ($subgo==17 OR $subgo==18 OR $subgo==19) {
                              $content .= "<form onSubmit='submitonce(this)' enctype='multipart/form-data' method='post' action='?go=".$go."&subgo=".$subgo."&lang=".$lang."&action=7&PHPSESSID=".$HTTP_SESSION_VARS['sid']."'>";
                              $content .= "Podkategória: <input name='des' size='30' type='text' value=''>";
                              $content .= "&nbsp;&nbsp;<input type='submit' name='Submit' value='- Vytvoriť | Premenovať -'> </form>";
                            } elseif (!$subgo==0){
                              $content .= "<form onSubmit='submitonce(this)' enctype='multipart/form-data' method='post' action='?go=".$go."&subgo=".$subgo."&lang=".$lang."&action=8&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&id=".$row[0]."'>";
                              $content .= "Podkategória: <input name='des' size='30' type='text' value='".$row[1]."'>";
                              $content .= "&nbsp;&nbsp;<input type='submit' name='Submit' value='- Vytvoriť | Premenovať -'> </form>";
                            }
                            $content .= "</form><br>";
                          @$content .="</div>";  

  
If ($subgo==0) {

          $sql = mysql_query("SELECT a.id, b.word
															FROM cms_menu AS a, cms_menu_words AS b
															WHERE a.id_word = b.id 
                                    AND (a.id_parent = ".$go." AND a.id_parent <> 0)
                                    AND b.lang = 1  
                              ORDER BY a.id DESC");

															//if (!$HTTP_SESSION_VARS['username'] == "admin") {
                              //          $sql .= " AND a.admin = 1 ";
                                //          }; 	

											                       
                                        
                      $no = 1;
                  

                        											
        		      while ($row = mysql_fetch_row($sql)) 
        		      	{
                            
                            
                         @$content .= "<div id='no'>".$no.".</div>
                                          <div id='subject'><a title='Editovať' href='?go=".$go."&subgo=".$row[0]."&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&typ=".$row[3]."'>";
                                                           
                                      @$content .= SUBSTR(strip_tags($row[1]),0,73);
                          
                         @$content .= " ...</a>
                                          </div>
                                          <div id='button'>
                                            <a href='#' onClick='confirm_delete(\"?go=".$go."&subgo=".$subgo."&lang=".$lang."&action=9&id=".$row[0]."&image=1&PHPSESSID=".$HTTP_SESSION_VARS['sid']."\");'><img title='Vymazať' height='26' border='0' src='images/delete.gif'></a>
                                          </div>";
                                          
                                       
                $no++;
                    }
                        			


} elseif ($subgo==17 OR $subgo==18 OR $subgo==19 ) {


                  $sql = mysql_query("SELECT a.id, b.word
															FROM cms_menu AS a, cms_menu_words AS b
															WHERE a.id_word = b.id 
                                    AND (a.id_parent = ".$subgo." AND a.id_parent <> 0)
                                    AND b.lang = 1  
                              ORDER BY a.id DESC");

															//if (!$HTTP_SESSION_VARS['username'] == "admin") {
                              //          $sql .= " AND a.admin = 1 ";
                                //          }; 	

											                       
                                        
                      $no = 1;
                  

                        											
        		      while ($row = mysql_fetch_row($sql)) 
        		      	{
                            
                            
                         @$content .= "<div id='no'>".$no.".</div>
                                          <div id='subject'><a title='Editovať' href='?go=".$go."&subgo=".$row[0]."&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&typ=".$row[3]."'>";
                                                           
                                      @$content .= SUBSTR(strip_tags($row[1]),0,73);
                          
                         @$content .= " ...</a>
                                          </div>
                                          <div id='button'>
                                            <a href='#' onClick='confirm_delete(\"?go=".$go."&subgo=".$subgo."&lang=".$lang."&action=9&id=".$row[0]."&image=1&PHPSESSID=".$HTTP_SESSION_VARS['sid']."\");'><img title='Vymazať' height='26' border='0' src='images/delete.gif'></a>
                                          </div>";
                                          
                                       
                $no++;
                    }

} else {




                $sql = mysql_query("SELECT a.id, a.des, a.img, a.typ
															FROM cms_content_gallery AS a
															WHERE a.id_menu = ".$subgo." ORDER BY a.id DESC");
				
        						
                  @$content .= "<div id='list'>";

// $num = count($imglist)-1;
//display image
$content .= "<table id='list-table' BORDER=0 CELLPADDING=10 CELLSPACING=15><tr>";

 $y = 0;         						
                		      while ($row = mysql_fetch_row($sql)) 
                		      	{

                             $content .=  "<td><a href='#' onClick='confirm_delete(\"?go=5&subgo=".$subgo."&lang=".$lang."&action=4&id=".$row[0]."&typ=2&PHPSESSID=".$HTTP_SESSION_VARS['sid']."\");'><img title='Vymazať' height='26' border='0' src='images/delete.gif'></a><br><a title='Editovať' href='?go=5&subgo=".$subgo."&lang=".$lang."&action=1&id=".$row[0]."&typ=".$row[3]."&PHPSESSID=".$HTTP_SESSION_VARS['sid']."'><img width='110' src='../images/img_content_gallery/".$row[2]."_small.jpg' border='0'><br>".$row[1]."</a></td>";
                                  $y++;
                                  if ($y == 3){
                                  $content .=  "</tr><tr>";
                                  $y = 0;
                                  }
                            
                            }
                            
$content .=  "</tr></table>";
            
                                                 @$content .= "</div>";

}  
            break;
//*************************************************************
         case 1:  //VIEW 

              global $HTTP_SESSION_VARS, $id, $typ, $lang, $subgo;

              	$sql = mysql_query("SELECT a.id, a.img, a.id_menu, a.typ, a.des, a.stamp
															FROM cms_content_gallery AS a
															WHERE a.id_menu = ".$subgo." AND a.id = ".$id);
              				
									$row = mysql_fetch_row($sql);
									
                  @$content .= "<div id='list'>";

                        If ($id==0) {
                        
                            $content .= "<form enctype='multipart/form-data' method='post' action='?go=".$go."&lang=".$lang."&action=3&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&typ=".$typ."'>";
                        } else {
                            $content .= "<form enctype='multipart/form-data' method='post' action='?go=".$go."&lang=".$lang."&action=2&id=".$id."&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&typ=".$typ."'>";
                        } 
                  
                        
                            $content .= "<input name='des' size='50' type='text' value='".$row[4]."'><br><br>";
                            
                              If (!$row=="") {
                                $content .= "<a target='_blank' href='../images/img_content_gallery/".$row[1].".jpg''><img src='../images/img_content_gallery/".$row[1]."_small.jpg' ></a><br><br>";
                              }
                              
                            $content .= "Obrázok (JPG): <input name='img' type='file'><br>"; 
                            $content .= "<br>Dátum a čas poslednej aktualizácie: <i>".$row[5]."</i><br>";             
                  

                                      $sql = mysql_query("SELECT a.id, b.word, a.id_parent
															                         FROM cms_menu AS a, cms_menu_words AS b
															                         WHERE a.id_word = b.id AND a.id_parent =
                                                             (SELECT a.id_parent
															                                 FROM cms_menu AS a
															                                   WHERE a.id = ".$subgo.") AND a.typ = 1
                                                            AND b.lang = ".$lang."
                                                        ORDER BY a.id DESC");



                                    $content .= "<br><select name='cat'>";
                                      		        while ($row = mysql_fetch_row($sql)) 
                                      		      	{
                                                          If ($subgo==$row[0]) {
                                                            $content .= "<option SELECTED value='".$row[0]."'>".$row[1]."</option>";
                                                          } else {
                                                            $content .= "<option value='".$row[0]."'>".$row[1]."</option>";
                                                          };
                                                  };
                                    $content .= "</select>";
                            
           

                    $content .= "<br><br><input type='submit' name='Submit' value='- Vložiť | Aktualizovať -'> </form>";
                @$content .= "</div>";
            
                
            break;
//*************************************************************
         case 2:  //UPDATE 

                global $HTTP_SESSION_VARS, $HTTP_POST_VARS,$id,$go,$subgo,$lang,$typ;

                $content = "";
               
                                                $filename = "../images/img_content_gallery/id_".$id.".jpg";
                        
                                                move_uploaded_file($_FILES['img']['tmp_name'], $filename);
                                   
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
                                                        ImageJpeg ($resized_img,"../images/img_content_gallery/id_".$id."_small.jpg");
                                                        ImageDestroy ($resized_img);
                                                        ImageDestroy ($new_img);                          
                          
                          
                         
                                                        
                          
                          $result = mysql_query("UPDATE cms_content_gallery AS a SET a.des ='".@$_POST['des']."', a.id_menu ='".@$_POST['cat']."', a.img ='id_".$id."'  WHERE a.id='".$id."'") 
                              or die(mysql_error());  


                  ob_start();
                    header("Location: ?go=5&subgo=".@$_POST['cat']."&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&result=1");
                  ob_flush();



                               
            break;
//*************************************************************
         case 3:  //INSERT 

                global $HTTP_SESSION_VARS, $HTTP_POST_VARS,$go,$typ,$lang, $subgo;
                
                            $sql= mysql_query("SELECT id FROM cms_content_gallery ORDER BY id DESC limit 1");
                            
                            $row = mysql_fetch_row($sql);
                            
                            $id = $row[0] + 1;
                             
                             
                           $filename = "../images/img_content_gallery/temp.jpg";
                             
                                     
                            move_uploaded_file($_FILES['img']['tmp_name'],$filename);
                            
                            // PICTURE 1024width    
                                // Get new sizes
                                list($width, $height) = getimagesize($filename);
                                

                                
                                      if ($width>1024) {
                                      
                                          $ratio=$height/$width;
                                          $newwidth=1024;
                                          $newheight=$newwidth*$ratio;
                                          
                                          if ($newheight>768) {
                                                  $ratio=$height/$width;
                                                  $newheight=768;
                                                  $newwidth=$newheight/$ratio;
                                          }
                                          
                                      } else if ($height>768) {
                                                  $ratio=$height/$width;
                                                  $newheight=768;
                                                  $newwidth=$newheight/$ratio;
                                      
                                      } else {
                                      
                                          $newwidth=$width;
                                          $newheight=$height;
                                      
                                      } 
        
                                  $resized_img = imagecreatetruecolor($newwidth,$newheight);
                                  $new_img = imagecreatefromjpeg($filename);
                                  //the resizing is going on here!
                                  imagecopyresampled($resized_img, $new_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                                  
                                  //finally, save the image
                                  ImageJpeg ($resized_img,"../images/img_content_gallery/id_".$id.".jpg");
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
                                  ImageJpeg ($resized_img,"../images/img_content_gallery/id_".$id."_small.jpg");
                                  ImageDestroy ($resized_img);
                                  ImageDestroy ($new_img);    
                            




                                  
                                  
                                  
                                  unlink($filename);


                            $result = mysql_query("INSERT INTO cms_content_gallery 
                                                  (id,id_menu,img,typ,des) VALUES
                                                  ('".$id."','".@$_POST['cat']."','id_".$id."','".$typ."','".@$_POST['des']."')") or die(mysql_error());                            


                  ob_start();
                    header("Location: ?go=5&subgo=".@$_POST['cat']."&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&result=2");
                  ob_flush();

                
                
            break;
//*************************************************************
         case 4:  //DELETE IMAGE
                
                global $HTTP_SESSION_VARS, $HTTP_POST_VARS,$id,$go,$typ,$lang;
                
              
                      //===========================================================//
                        $file = "../images/img_content_gallery/id_".$id.".jpg";
                        unlink($file);
                      //===========================================================//
                        $file = "../images/img_content_gallery/id_".$id."_small.jpg";
                        unlink($file) or die ( 'Could not DELETE the image file. _small' );
                      //===========================================================//
                      
                      

                
                $result = mysql_query("DELETE FROM cms_content_gallery WHERE id = ".$id) 
                          or die(mysql_error());  


                  ob_start();
                    header("Location: ?go=5&subgo=".$subgo."&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&result=3");
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
         case 7:  //INSERT SUBCATEGORY 

                global $HTTP_SESSION_VARS, $HTTP_POST_VARS,$go,$typ,$lang, $subgo;
                

                            $result = mysql_query("INSERT INTO cms_menu_words 
                                                  (lang, word) VALUES
                                                  ('1','".@$_POST['des']."')") or die(mysql_error());                            



                            $sql= mysql_query("SELECT id FROM cms_menu_words ORDER BY id DESC limit 1");
                            
                            $row = mysql_fetch_row($sql);
                            
                            $id_word = $row[0]; 








                            $sql= mysql_query("SELECT id FROM cms_menu ORDER BY id DESC limit 1");
                            
                            $row = mysql_fetch_row($sql);
                            
                            $id = $row[0] + 1;
                             

                            
 
                            $result = mysql_query("INSERT INTO cms_menu 
                                                  (id, id_parent,id_word,typ,admin) VALUES
                                                  ('".$id."','".$subgo."','".$id_word."','1','1')") or die(mysql_error());                            


                  ob_start();
                    header("Location: ?go=5&subgo=".$subgo."&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&result=2");
                  ob_flush();

                
                
            break;



//*************************************************************
         case 8:  //UPDATE CATEGORY NAME

                global $HTTP_SESSION_VARS, $HTTP_POST_VARS,$id,$go,$subgo,$lang,$typ;

                $content = "";
               
                            $sql= mysql_query("SELECT id_word FROM cms_menu WHERE id = ".$id);
                            
                            $row = mysql_fetch_row($sql);
                            
                            $id_word = $row[0];
                                                        
                          
                          $result = mysql_query("UPDATE cms_menu_words AS a SET a.word ='".@$_POST['des']."'  WHERE a.id='".$id_word."'") 
                              or die(mysql_error());  


                  ob_start();
                    header("Location: ?go=5&subgo=".$subgo."&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&result=1");
                  ob_flush();



                               
            break;

//*************************************************************
         case 9:  //DELETE CATEGORY
                
                global $HTTP_SESSION_VARS, $HTTP_POST_VARS,$id,$go,$typ,$lang,$subgo;
                

                $sql = mysql_query("SELECT a.id, a.img
															FROM cms_content_gallery AS a
															WHERE a.id_menu = ".$id." ORDER BY a.id DESC");


        		      while ($row = mysql_fetch_row($sql)) 
        		      	{
                                                                   
                      //===========================================================//
                        $file = "../images/img_content_gallery/id_".$row[0].".jpg";

                        chmod($file,0777) or die ( 'Could not SET UP the image file.' ); 
                        unlink($file) or die ( 'Could not DELETE the image file.' );
                      //===========================================================//


                      //===========================================================//
                        $file = "../images/img_content_gallery/id_".$row[0]."_small.jpg";

                        chmod($file,0777) or die ( 'Could not SET UP the image file.' ); 
                        unlink($file) or die ( 'Could not DELETE the image file.' );
                      //===========================================================//
                      
                                            
                    }

                
                $result = mysql_query("DELETE FROM cms_content_gallery WHERE id_menu = ".$id) 
                          or die(mysql_error());  

                $sql = mysql_query("SELECT a.id_word
															FROM cms_menu AS a
															WHERE a.id = ".$id);
								$row = mysql_fetch_row($sql);
															
                $result = mysql_query("DELETE FROM cms_menu_words WHERE id = ".$row[0]) 
                          or die(mysql_error());  

                $result = mysql_query("DELETE FROM cms_menu WHERE id = ".$id) 
                          or die(mysql_error());                            
                          
                  ob_start();
                    header("Location: ?go=5&subgo=".$subgo."&lang=".$lang."&action=0&PHPSESSID=".$HTTP_SESSION_VARS['sid']."&result=3");
                  ob_flush();
                  
            break;
         
         
         default: 
                $content = "Vitajte v administratívnom prostredí stránky";
          }
?>

