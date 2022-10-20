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

         $cfg_cc_SubDomain_Name               = "http://bookings.tnt.ee";
         $cfg_cc_SubDomain_Name_SSL           = "https://bookings.tnt.ee";   //If certificate SSL installed then https
         
         $cfg_Sender_Country_Name             = "Estonia";
         $cfg_Sender_Country_Code             = "ee";       //Low case country code
         $cfg_Sender_Country_Code_big         = mb_strtoupper($cfg_Sender_Country_Code);
         
         $cfg_links_myTNT                     = "https://my.tnt.com/myTNT/login/LoginInitial.do?respLang=et&respCountry=ee";
         
         $cfg_links_Top                       = array("http://www.tnt.com/express/et_ee/site/home.html",
                                                      "http://www.tnt.com/express/et_ee/site/home/applications/tracking.html", 
                                                      "http://www.tnt.com/express/et_ee/site/home/how-to-ship-parcel.html",
                                                      "http://www.tnt.com/express/et_ee/site/home/help-center.html",
                                                      "http://www.tnt.com/express/et_ee/site/home/the-company.html");
         $cfg_links_Bottom                    = array("http://www.tnt.com/express/et_ee/site/home/terms-use.html",
                                                      "http://www.tnt.com/express/et_ee/site/home/privacy-policy.html",
                                                      "http://www.tnt.com/express/et_ee/site/home/terms-conditions.html");

         $cfg_csfl_subject                    = "Tellimuse number: ";
         $cfg_csfl_email                      = "TNT <info.ee@tnt.com>";
         $cfg_csfl_email_bounce               = "info.ee@tnt.com";
         $cfg_csfl_email_personal             = "N"; //If Y then email address will be taken from DB CSFL user, If N then above generic details
         $cfg_csfl_message                    =  array("Tere,", 
                                                       "infot oma saadetise kohta näete selle lingi abil: ", 
                                                       $cfg_cc_SubDomain_Name_SSL, 
                                                       "või kasutage aadressi ".$cfg_cc_SubDomain_Name." ja logige sisse järgmiste andmetega: ",
                                                       "Tellimuse number",
                                                       "TNT kliendinumber",
                                                       "Peale andmete sisestamist saate kohe saatedokumendid printida.",
                                                       "Täname, et kasutasite meie teenuseid.",
                                                       "TNT klienditeenindus, 627 1900, ",
                                                       "---------------------------------------------------------------------------------",
                                                       "Soovite oma edaspidiseid saadetisi ise hallata?",
                                                       "Registreeruge tasuta iseteeninduskeskuse minuTNT kasutajaks ja Teile avanevad paljud lisavõimalused.",
                                                       "https://my.tnt.com/myTNT/login/LoginInitial.do?respLang=et&respCountry=ee",
                                                       ""
                                                      );                     
                                                      
                                                      //Good day,
                                                      //information about your booking are available to see on the following link
                                                      //http://podpora.tnt.cz/objednavka
                                                      //Or you can visit address http://podpora.tnt.cz/objednavka and log in with following credentials:
                                                      //Booking code:                                          
                                                      //Account number
                                                      //After checking and filling or missing details you can immediatelly print also shipping documentation.
                                                      //Thank you for using our services
                                                      //TNT, Customer Services, 848 000 868, customer.service.prg@tnt.com
                                                      //---------------------------------------------------------------------------------
                                                      //Would you like to organize and manage your next shipments by yourselves?
                                                      //Then register on the following link and use our free service myTNT with another benefits.
                                                      //https://my.tnt.com/myTNT/login/LoginInitial.do?respLang=cs&respCountry=cz	

                                                      
         $cfg_csfl_eu                         =  array("SK", "CZ", "PL", "HU", "GB", "DE", "FR", "ES", 
                                                       "PT", "BE", "NL", "DK", "EE", "LT", "LV", "RO", 
                                                       "BG", "FI", "SE", "IT", "IE", "HR", "SI", "AT", 
                                                       "LU", "CY", "GR", "MT");

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
													                             "õ" => "o",
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
                                                       "Õ" => "O",
                                                       "Ü" => "U",
                                                       "Ö" => "O"
                                                       );




         //Consignment notification
         $cfg_con_subject                    = "Saatelehe number: ";
         $cfg_con_email                      = "TNT <info.ee@tnt.com>";
         $cfg_con_email_bounce               = "info.ee@tnt.com";
         $cfg_con_email_personal             = "N"; //If Y then email address will be taken from DB CSFL user, If N then above generic details
         $cfg_con_message                    =  array("Tere,", 
                                                      "Selle lingi abil saate oma saadetise teekonda jälgida: ", 
                                                      "",
                                                      "http://www.tnt.com/content/express/et_ee/site/home/applications/app_panel_tracking_main.html?navigation=0&searchType=CON&respLang=et&respCountry=".$cfg_Sender_Country_Code."&genericSiteIdent=.&cons=", 
                                                      "Pealevõtu aadress",
                                                      "Kättetoimetuse aadress",
                                                      "Saadetise kirjeldus",
                                                      "Pakkide arv",
                                                      "Kaal",
                                                      "Viide",
                                                      "Täname, et kasutasite meie teenuseid.",                                                      
                                                      "TNT klienditeenindus, 627 1900, ",
                                                      "---------------------------------------------------------------------------------",
                                                      "Soovite oma edaspidiseid saadetisi ise hallata?",
                                                      "Registreeruge tasuta iseteeninduskeskuse minuTNT kasutajaks ja Teile avanevad paljud lisavõimalused.",
                                                      "https://my.tnt.com/myTNT/login/LoginInitial.do?respLang=et&respCountry=ee",
                                                      ""
                                                      );                     
                                                      
                                                      //Good day
                                                      //On the following link you can trace your shipment with number:
                                                      //http://www.tnt.com/....
                                                      //Collection address
                                                      //Delivery address
                                                      //Shipment description
                                                      //Number of items
                                                      //Weight
                                                      //Customer reference                                                      
                                                      //Thank you for using our services
                                                      //TNT, Customer Services, 848 000 868, customer.service.prg@tnt.com
                                                      //---------------------------------------------------------------------------------
                                                      //Would you like to organize and manage your shipments by yourselves?
                                                      //Then register on the following link and use our free service myTNT with another benefits.
                                                      //https://my.tnt.com/myTNT/login/LoginInitial.do?respLang=cs&respCountry=cz


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

        $restrict_ip = "N"; // If Y then upload and list of bookings restricted to below IPs
        $allow_ip = array("100.100.100.100"); // IP address allowed to see & upload CSFL data
       
?>