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

         $cfg_cc_SubDomain_Name               = "http://bookings.tnt.ru";
         $cfg_cc_SubDomain_Name_SSL           = "https://bookings.tnt.ru";   //If certificate SSL installed then https
         
         $cfg_Sender_Country_Name             = "Russian Federation";
         $cfg_Sender_Country_Code             = "ru";       //Low case country code
         $cfg_Sender_Country_Code_big         = mb_strtoupper($cfg_Sender_Country_Code);
         
         $cfg_links_myTNT                     = "https://my.tnt.com/myTNT/login/LoginInitial.do?respLang=ru&respCountry=ru";
         
         $cfg_links_Top                       = array("http://www.tnt.com/express/ru_ru/site/home.html",
                                                      "http://www.tnt.com/express/ru_ru/site/home/applications/tracking.html", 
                                                      "http://www.tnt.com/express/ru_ru/site/home/how-to-ship-parcel.html",
                                                      "http://www.tnt.com/express/ru_ru/site/home/help-center.html",
                                                      "http://www.tnt.com/express/ru_ru/site/home/the-company.html");
         $cfg_links_Bottom                    = array("http://www.tnt.com/express/ru_ru/site/home/terms-use.html",
                                                      "http://www.tnt.com/express/ru_ru/site/home/privacy-policy.html",
                                                      "http://www.tnt.com/express/ru_ru/site/home/terms-conditions.html");


         $cfg_csfl_subject                    = "Номер заказа: ";
         $cfg_csfl_email                      = "TNT <customerservice.ru@tnt.com>";
         $cfg_csfl_email_bounce               = "customerservice.ru@tnt.com";
         $cfg_csfl_email_personal             = "N"; //If Y then email address will be taken from DB CSFL user, If N then above generic details
         $cfg_csfl_message                    =  array("Добрый день,", 
                                                       "информацию об отправлении вы сможете увидеть, пройдя по ссылке: ", 
                                                       $cfg_cc_SubDomain_Name_SSL, 
                                                       "Или вы можете перейти по ".$cfg_cc_SubDomain_Name." и войти, используя следующие данные:  ",
                                                       "Номер заказа",
                                                       "Клиентский номер",
                                                       "После проверки и внесения недостающей информации, вы сможете распечатать документы, касающиеся отправки.",
													                             "При возникновении трудностей в заполнении или распечатке, обратитесь к видео или текстовой инструкции, ссылки на которые расположены ниже: ",
													                             "видео-инструкция: ",
                                                       "https://www.youtube.com/watch?v=fkF7REhYp6w&feature=youtu.be",
													                             "текстовая инструкция в формате pdf: ",
                                                       "https://www.tnt.com/content/dam/tnt_express_media/ru_ru/Home2/download_documents/manuals/instruction_CooperativeConnote.pdf", 
                                                       "Благодарим за использование наших услуг",                                                      
                                                       "TNT, Customer Services, 8 800 100 2777, ",
                                                       "---------------------------------------------------------------------------------",
                                                       "Хотите управлять всеми последующими отправками?",
                                                       "Тогда зарегистрируйтесь, пройдя по ссылке, и используйте наш бесплатный онлайн сервис myTNT, получая при этом различные преимущества.",
                                                       "https://my.tnt.com/myTNT/login/LoginInitial.do?respLang=ru&respCountry=ru",
                                                       ""
                                                      );                      
                                                      
                                                    
         $cfg_csfl_eu                         =  array("KZ","AM","BY","KG","RU"); // Receiver countries without customs clearance

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
                                                           
        $cfg_con_national_chars               =  array("ľ" => "l",
                                                       "ł" => "l",
                                                       "š" => "s",
                                                       "ś" => "s",
                                                       "č" => "c",
                                                       "ć" => "c",
                                                       "ť" => "t",
                                                       "ž" => "z",
                                                       "ż" => "z",
                                                       "ź" => "z",
                                                       "á" => "a",
                                                       "ą" => "a",
                                                       "í" => "i",
                                                       "é" => "e",
                                                       "ě" => "e",
                                                       "ę" => "e",
                                                       "ú" => "u",
                                                       "ü" => "u",              
                                                       "ä" => "a",
                                                       "ô" => "o",
                                                       "ó" => "o",
                                                       "ö" => "o",            
                                                       "ň" => "n",          
                                                       "ń" => "n",
                                                       "ß" => "ss",
                                                       "ř" => "r",        
                                                       "ý" => "y",
                                                       "Ľ" => "L",
                                                       "Ł" => "L",
                                                       "Š" => "S",
                                                       "Ś" => "S",
                                                       "Č" => "C",
                                                       "Ć" => "C",
                                                       "Ť" => "T",
                                                       "Ý" => "Y",
                                                       "Ž" => "Z",
                                                       "Ź" => "Z",
                                                       "Ż" => "Z",
                                                       "Ą" => "A",
                                                       "Á" => "A",
                                                       "Ä" => "A",
                                                       "Í" => "I",
                                                       "Ë" => "E",
                                                       "É" => "E",
                                                       "Ę" => "E",
                                                       "Ú" => "U",
                                                       "Ň" => "N",
                                                       "Ń" => "N",
                                                       "Ó" => "O",
                                                       "Ó" => "O",
                                                       "Ü" => "U",
                                                       "Ö" => "O", 
                                                       "а" => "a",
                                                       "б" => "b",
                                                       "в" => "v",
                                                       "г" => "g",
                                                       "д" => "d",
                                                       "е" => "e",
                                                       "ё" => "yo",
                                                       "ж" => "zh",
                                                       "з" => "z",
                                                       "и" => "i",  
                                                       "й" => "y",
                                                       "к" => "k",
                                                       "л" => "l",
                                                       "м" => "m",
                                                       "н" => "n",
                                                       "о" => "o",
                                                       "п" => "p",
                                                       "р" => "r",
                                                       "с" => "s",              
                                                       "т" => "t",
                                                       "у" => "u",
                                                       "ф" => "f",
                                                       "х" => "h",            
                                                       "ц" => "ts",            
                                                       "ч" => "ch",        
                                                       "ш" => "sh",      
                                                       "щ" => "sch",
                                                       "ь" => "",
                                                       "ы" => "y",        
                                                       "ъ" => "",
                                                       "э" => "e",
                                                       "ю" => "yu",
                                                       "я" => "ya",
                                                       "А" => "A",
                                                       "Б" => "B",
                                                       "В" => "V",
                                                       "Г" => "G",
                                                       "Д" => "D",
                                                       "Е" => "E",
                                                       "Ё" => "YO",
                                                       "Ж" => "ZH",
                                                       "З" => "Z",
                                                       "И" => "I",   
                                                       "Й" => "Y",
                                                       "К" => "K",
                                                       "Л" => "L",
                                                       "М" => "M",
                                                       "Н" => "N",
                                                       "О" => "O",
                                                       "П" => "P",
                                                       "Р" => "R",
                                                       "С" => "S",
                                                       "Т" => "T",
                                                       "У" => "U",
                                                       "Ф" => "F",
                                                       "Х" => "H",
                                                       "Ц" => "TS",  
                                                       "Ч" => "CH",   
                                                       "Ш" => "SH",
                                                       "Щ" => "SCH",
                                                       "Ь" => "",
                                                       "Ы" => "Y",
                                                       "Ъ" => "",
                                                       "Э" => "E",
                                                       "Ю" => "YU",
                                                       "№" => "No",
                                                       "Я" => "YA"              
                                                       );




         //Consignment notification
         $cfg_con_subject                    = "Номер накладной:";
         $cfg_con_email                      = "TNT <customerservice.ru@tnt.com>";
         $cfg_con_email_bounce               = "customerservice.ru@tnt.com";         
         $cfg_con_email_personal             = "N"; //If Y then email address will be taken from DB CSFL user, If N then above generic details
         $cfg_con_message                    =  array("Добрый день,", 
                                                      "используя данную ссылку, вы можете отслеживать ваше отправление по номеру накладной: ", 
                                                      "", 
                                                      "http://www.tnt.com/content/express/ru_ru/site/home/applications/app_panel_tracking_main.html?navigation=0&searchType=CON&respLang=".$cfg_Sender_Country_Code."&respCountry=".$cfg_Sender_Country_Code."&genericSiteIdent=.&cons=", 
                                                      "Адрес забора отправления",
                                                      "Адрес доставки",
                                                      "Описание заказа",
                                                      "Количество мест",
                                                      "Вес",
                                                      "Отметки отправителя",
                                                      "Благодарим за использование наших услуг",                                                      
                                                      "TNT, Customer Services, 8 800 100 2777, ",                                                      "---------------------------------------------------------------------------------",
                                                      "Хотите управлять всеми последующими отправками?",
                                                      "Тогда зарегистрируйтесь, пройдя по ссылке, и используйте наш бесплатный онлайн сервис myTNT, получая при этом различные преимущества.",
                                                      "https://my.tnt.com/myTNT/login/LoginInitial.do?respLang=ru&respCountry=ru",
                                                      ""
                                                      );                      
                                                      
 
         $cfg_con_mkt_detailedmanifest_media    = ""; // 450px X 150px        
         $cfg_con_mkt_detailedmanifest_start    = ""; // format: 20160704
         $cfg_con_mkt_detailedmanifest_end      = ""; // format: 20160704

         
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
		//  External code in html header
		// **************************************************

        // If you have own country service like google analytics or chat service you can paste code here. It will be shown in header of html page
        $cfg_header_code = ""; 
                   
    // **************************************************
		//  Security Settings
		// **************************************************

        $restrict_ip = "Y"; // If Y then upload and list of bookings restricted to below IPs
        $allow_ip = array("100.100.100.100"); // IP address allowed to see & upload CSFL data
       
?>