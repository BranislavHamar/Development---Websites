<?php

////// 
/////  1. b-list.detail.php
/////  2. b-list.listing.php


function list_function() {

    global $wpdb;
    
		ob_start();

    function test_input($data) {
            $test_input = trim($data);
            $test_input = stripslashes($data);
            $test_input = htmlspecialchars($data);
            return $test_input;
            }

             
    function removeqsvar($url, $varname) {
            list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
            parse_str($qspart, $qsvars);
            unset($qsvars[$varname]);
            $newqs = http_build_query($qsvars);
            return $urlpart . '?' . $newqs . '&';
            }  

    $url_string = removeqsvar("?".$_SERVER['QUERY_STRING'], "strana");
                                                 
    if ( isset($_GET['id']) ) {
    
            // Detail brownfield
            include 'b-list.detail.php';
     
    } else {

            // List brownfields    
            include 'b-list.listing.php';
 
    } 

    return ob_get_clean();
}   
?>