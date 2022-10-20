<?
                                  require_once 'SMTPMailer/SMTPMailer.php';
                                
                                	$from = "Udeda <udeda@mail.t-com.sk>";
                                	$to  = "";
                                  $bcc = array();
                                	
                                        //$sql= mysql_query("SELECT content FROM cms_content_emails2 WHERE id_menu = 9");
                                        $sql= mysql_query("SELECT content FROM cms_content WHERE id_menu = 9");
                                                                                
                                          while ($row = mysql_fetch_array($sql)){
      
                                            $bcc[] = $row[0];
                                          
                                          }
                                    
                                    
                                     //   $to = array("bhamar@centrum.sk", "aenima@pobox.sk", "branoivka@googlemail.com");
                                	   //   $bcc = array("bhamar@centrum.sk", "aenima@pobox.sk", "branoivka@googlemail.com");
                                  
                                  $subject = "O U - Tyzdenne menu";
                                	$message = @$_POST['content'];
                                
                                	$mailer = new SMTPMailer();
                                  
                                	$response = $mailer->sendMail($from, $to, $bcc, $subject, $message);
                                	
?>
