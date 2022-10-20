<?

//********************************	

// WHAT WORDS TO SHOW

//********************************



$word = word("1000,2000,3000,4000,5000,6000,6100,6110,6111,6120,7101,9203,10000,10001,10002,10009,10010,10011,10012");



//********************************	

// CONTENT

//********************************



function content_web() 	{



		global $word, $lang;



					$content_web = "

          

                <div id='topic'> 

                  <h1 class='topic-login'>".$word['6000']."</h1>

                </div>

                  <div id='login'>

                      <h2>

                        ".$word['6100']." 

                      </h2>

                     <table >

                        <tr><th style='text-align:left;width:120px;'>".$word['6110']."</th><th style='width:280px;'>&nbsp;</th><th style='text-align:center;width:25px;' rowspan='5'><hr align='center' style='text-align:center;color:grey;background-color:grey;width:1px;height:175px;border:1px;'></th><th style='text-align:left;width:450px;'>".$word['6120']."</th></tr>

                        <tr><td class='label'>".$word['7101']."*:</td><td><input style='width:280px;' type='text' name='crn' value='' ></td><td rowspan=2>".$word['10000']." <br> ".$word['10001']." <br><br> ".$word['10002']."</td></tr>

                        <tr><td class='label'>".$word['9203']."*:</td><td><input style='width:280px;' type='text' name='senderaccount' value='' ></td></tr>

                        <tr><td> <input type='hidden' name='lang' value='".$lang."' >&nbsp;</td> <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

                        <tr><td colspan='2'> <div id='submit'><input type='submit' class='submit' name='login' value='".$word['6111']."' ></div> <td>&nbsp;</td></tr>

                      </table>          

       

                  

        

                  </div>

          

          

          

          ";









		return $content_web;								

		}



	

?>

