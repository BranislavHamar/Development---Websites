<?php                                                                          

////// 
/////  1. b-admin.detail.php
/////  2. b-admin.listing.php


ini_set('display_errors',1);
error_reporting(E_ALL);
 
set_time_limit(30);
   
function admin_function(){
    add_menu_page( 'Brownfields - administrator', 'Brownfields', 'manage_options', 'b-plugin', 'brownfields_init' );
}

//////////////////////////////
// Register style sheet.
//////////////////////////////
function wpdocs_register_plugin_styles() {
    wp_register_style( 'brownfields', plugins_url( 'xxxxx.css' ) );
    wp_enqueue_style( 'brownfields' );
}

add_action( 'admin_enqueue_scripts', 'wpdocs_register_plugin_styles' );

 
function brownfields_init(){

    global $wpdb;

   
     if ( isset($_GET['id']) ) {
     
            include 'b-admin.detail.php';
    
    
     } else {
    
            include 'b-admin.listing.php';
    
     }

}
?>