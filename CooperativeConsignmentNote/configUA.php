<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  S*E*T*U*P
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // **************************************************
		//  Error configuration settings
		// **************************************************
		
          ini_set('error_reporting', E_ALL);
          ini_set('display_errors',1);

    // **************************************************
		//  Main application settings
		// **************************************************

         $cfg_cc_SubDomain_Name               = "http://www.tntzakaz.com.ua";
         $cfg_cc_SubDomain_Name_SSL           = "https://www.tntzakaz.com.ua";   //If certificate SSL installed then https
         
         $cfg_Sender_Country_Name             = "Ukraine";
         $cfg_Sender_Country_Code             = "ua";       //Low case country code
         $cfg_Sender_Country_Code_big         = mb_strtoupper($cfg_Sender_Country_Code);
         
         $cfg_links_myTNT                     = "https://my.tnt.com/myTNT/login/LoginInitial.do?respLang=ru&respCountry=ua";
         
         $cfg_links_Top                       = array("http://www.tnt.com/express/uk_ua/site/home.html",
                                                      "http://www.tnt.com/express/uk_ua/site/home/applications/tracking.html", 
                                                      "http://www.tnt.com/express/uk_ua/site/home/how-to-ship-parcel.html",
                                                      "http://www.tnt.com/express/uk_ua/site/home/help-center.html",
                                                      "http://www.tnt.com/express/uk_ua/site/home/the-company.html");
         $cfg_links_Bottom                    = array("http://www.tnt.com/express/uk_ua/site/home/terms-use.html",
                                                      "http://www.tnt.com/express/uk_ua/site/home/privacy-policy.html",
                                                      "http://www.tnt.com/express/uk_ua/site/home/terms-conditions.html");


  $cfg_csfl_subject                           = "?????????? ????????????????????: ";
         $cfg_csfl_email                      = "TNT <tnt.ua@tnt.com>";
         $cfg_csfl_email_bounce               = "tnt.ua@tnt.com";
         $cfg_csfl_email_personal             = "N"; //If Y then email address will be taken from DB CSFL user, If N then above generic details
         $cfg_csfl_message                    =  array("???????????? ????????,", 
                                                       "???????????????? ???? ????????????????????, ?????? ???????????????????? ???????????????????? ?????? ????????????????????????: ", 
                                                       $cfg_cc_SubDomain_Name_SSL, 
                                                       "?????? ???? ???????????? ?????????????? ????  ".$cfg_cc_SubDomain_Name." ?? ?????? ???????? ?????? ??????????????, ???????????????????????? ???????????????? ??????????:  ",
                                                       "?????????? ????????????????????",
                                                       "?????????????????????? ??????????",
                                                       "?????????? ?????????????????? ?? ???????????????? ???????????????????????? ????????????????????, ???? ???????????? ???????????????????????? ??????????????????, ?????? ?????????????????????? ???? ????????????????????????.",
                                                       "??????????????, ???? ???????????????????????? ???????????? ??????????????????",                                                      
                                                       "TNT, Customer Services, 0800 303 335, ",
                                                       "---------------------------------------------------------------------------------",
                                                       "???????????? ?? ???? ???????????????? ?????????? ???????????????????? ?????????????????????????????",
                                                       "???????????????? ???? ????????????????????, ?????? ??????????????????????????????,  ?????????????????????????? ?????????? ???????????????????????? ???????????? ???????????????? myTNT, ???? ?????????????????? ?????? ?????????? ???????????? ??????????????..",
                                                       "https://my.tnt.com/myTNT/registration/Register.do?respLang=uk&respCountry=ua",
                                                       ""
                                                      );  
                                                                 
                                                      
                                                    
         $cfg_csfl_eu                         =  array("XX","XX");

         // Country collection & delivery date format: 
         $cfg_csfl_dateformat                 = "1";  //1 = DD.MM.YYYY or DD.MM.YY / 2 = YYYY.MM.DD or YY.MM.DD
         $cfg_csfl_dateseparator              = ".";
         
         //Database storage of bookings since their collection date
         $cfg_con_history                     = "14"; //number of days. Recommended 14 days according to history of CSFL/MFB system

         //Official TNT names of service options
         $cfg_con_option_names                =  array("LB" => "Partially regulated (excepted) Lithium Batteries",
                                                       "BB" => "Biological Substance, category B",
                                                       "DI" => "Dry Ice",
                                                       "HZ" => "Hazardous Goods",
                                                       "LQ" => "Limited Quantities",
                                                       "EQ" => "Excepted Quantities",
                                                       "GM" => "Genetically Modified Organisms",
                                                       "XP" => "Radioactive Material in Excepted Packages",
                                                       "AU" => "Automotive",
                                                       "IN" => "Insurance",
                                                       "PR" => "Priority",
                                                       "CS" => "Cash Sales",
                                                       "CO" => "Cash On Delivery",
                                                       "SYS" => "System",
                                                       "NDN" => "Neighbour Delivery"
                                                      );
        
        $cfg_con_option_CS                    =  "Y"; //Cash Sales option value is not supported in data sending file (NFF), therefore either
                                                      //"Y" to allow to send CS option and OPS to enter value manually or 
                                                      //"N" to not allow to send Cash Sales option at all
                                                           
        $cfg_con_national_chars               =  array("??" => "l",
                                                       "??" => "l",
                                                       "??" => "s",
                                                       "??" => "s",
                                                       "??" => "c",
                                                       "??" => "c",
                                                       "??" => "t",
                                                       "??" => "z",
                                                       "??" => "z",
                                                       "??" => "z",
                                                       "??" => "a",
                                                       "??" => "a",
                                                       "??" => "i",
                                                       "??" => "e",
                                                       "??" => "e",
                                                       "??" => "e",
                                                       "??" => "u",
                                                       "??" => "u",              
                                                       "??" => "a",
                                                       "??" => "o",
                                                       "??" => "o",
                                                       "??" => "o",            
                                                       "??" => "n",          
                                                       "??" => "n",
                                                       "??" => "ss",
                                                       "??" => "r",        
                                                       "??" => "y",
                                                       "??" => "L",
                                                       "??" => "L",
                                                       "??" => "S",
                                                       "??" => "S",
                                                       "??" => "C",
                                                       "??" => "C",
                                                       "??" => "T",
                                                       "??" => "Y",
                                                       "??" => "Z",
                                                       "??" => "Z",
                                                       "??" => "Z",
                                                       "??" => "A",
                                                       "??" => "A",
                                                       "??" => "A",
                                                       "??" => "I",
                                                       "??" => "E",
                                                       "??" => "E",
                                                       "??" => "E",
                                                       "??" => "U",
                                                       "??" => "N",
                                                       "??" => "N",
                                                       "??" => "O",
                                                       "??" => "O",
                                                       "??" => "U",
                                                       "??" => "O", 
                                                       "??" => "a",
                                                       "??" => "b",
                                                       "??" => "v",
                                                       "??" => "g",
                                                       "??" => "d",
                                                       "??" => "e",
                                                       "??" => "yo",
                                                       "??" => "zh",
                                                       "??" => "z",
                                                       "??" => "i",  
                                                       "??" => "y",
                                                       "??" => "k",
                                                       "??" => "l",
                                                       "??" => "m",
                                                       "??" => "n",
                                                       "??" => "o",
                                                       "??" => "p",
                                                       "??" => "r",
                                                       "??" => "s",              
                                                       "??" => "t",
                                                       "??" => "u",
                                                       "??" => "f",
                                                       "??" => "h",            
                                                       "??" => "ts",            
                                                       "??" => "ch",        
                                                       "??" => "sh",      
                                                       "??" => "sch",
                                                       "??" => "'",
                                                       "??" => "y",        
                                                       "??" => "'",
                                                       "??" => "e",
                                                       "??" => "yu",
                                                       "??" => "ya",
	                                                     "??" => "ye",
                                                       "??" => "i",
                                                       "??" => "yy",												   
                                                       "??" => "A",
                                                       "??" => "B",
                                                       "??" => "V",
                                                       "??" => "G",
                                                       "??" => "D",
                                                       "??" => "E",
                                                       "??" => "YO",
                                                       "??" => "ZH",
                                                       "??" => "Z",
                                                       "??" => "I",   
                                                       "??" => "Y",
                                                       "??" => "K",
                                                       "??" => "L",
                                                       "??" => "M",
                                                       "??" => "N",
                                                       "??" => "O",
                                                       "??" => "P",
                                                       "??" => "R",
                                                       "??" => "S",
                                                       "??" => "T",
                                                       "??" => "U",
                                                       "??" => "F",
                                                       "??" => "H",
                                                       "??" => "TS",  
                                                       "??" => "CH",   
                                                       "??" => "SH",
                                                       "??" => "SCH",
                                                       "??" => "'",
                                                       "??" => "Y",
                                                       "??" => "'",
                                                       "??" => "E",
                                                       "??" => "YU",
                                                       "??" => "YA",
                          													   "??" => "I",
                          													   "??" => "YE",
                          													   "??" => "YY"
                                                       );




         //Consignment notification
         $cfg_con_subject                    = "?????????? ??????????????????";
         $cfg_con_email                      = "TNT <tnt.ua@tnt.com>";
         $cfg_con_email_bounce               = "tnt.ua@tnt.com";         
         $cfg_con_email_personal             = "N"; //If Y then email address will be taken from DB CSFL user, If N then above generic details
         $cfg_con_message                    =  array("???????????? ????????,", 
                                                      "?????? ???????????????????? ???????????????????????? ???? ???????????? ??????????????????, ?????????????????????????? ?????? ????????????????????.: ", 
                                                      "", 
                                                      "https://www.tnt.com/express/uk_ua/site/home/applications/tracking.html?cons=&searchType=CON&source=home_widget", 
                                                      "???????????? ???????????? ??????????????",
                                                      "???????????? ????????????????",
                                                      "???????? ????????????",
                                                      "??????????????????  ??????????",
                                                      "????????",
                                                      "?????????????????? ??????????????????????",
                                                      "??????????????, ???? ???????????????????????? ???????????? ??????????????????",                                             
                                                      "TNT, Customer Services, 0800 303 335, ",
                                                      "---------------------------------------------------------------------------------",
                                                      "???????????? ?? ???? ???????????????? ?????????? ???????????????????? ?????????????????????????????",
                                                      "???????????????? ???? ????????????????????, ?????? ??????????????????????????????,  ?????????????????????????? ?????????? ???????????????????????? ???????????? ???????????????? myTNT, ???? ?????????????????? ?????? ?????????? ???????????? ??????????????..",
                                                      "https://my.tnt.com/myTNT/login/LoginInitial.do?respLang=uk&respCountry=ua",
                                                      ""
                                                      );                                        
                                                      
        
    // **************************************************
		//  MySQL Database usage
		// **************************************************

         $cfg_DB_hostname                     = "xxxxxx";
         $cfg_DB_username                     = "zzzzzz";
         $cfg_DB_password                     = "tttttt";
         $cfg_DB_name		                      = "uuuuuu";


    // **************************************************
		//  CronJob Settings
		// **************************************************

         // FTP account for data upload to ENGIN (via folders per depo!)
         $cfg_ftp_server                      = "ftp3.tnt.com"; // Address of FTP server.
         $cfg_ftp_user_name                   = "XXXXXX"; // Username
         $cfg_ftp_user_pass                   = "YYYYYY"; // Password

         $cfg_email_alerts                    = "cit.sk@tnt.com"; //Email address where all alerts would be sent to
         $cfg_con_threshold                   = "500"; // Number of cons left in consignment range based on which email alert is sent

         $cfg_con_source_EDI                  = "BH"; // Source code of EDI data in TNT system
         $cfg_con_source_PDF                  = "BM"; // Source code of PDF code in TNT system
                  
    // **************************************************
		//  Security Settings
		// **************************************************

        $restrict_ip = "Y"; // If Y then upload and list of bookings restricted to below IPs
        $allow_ip = array("100.100.100.100"); // IP address allowed to see & upload CSFL data
       
?>