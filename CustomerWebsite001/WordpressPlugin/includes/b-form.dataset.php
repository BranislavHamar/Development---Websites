<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
function test_input($data) {
  $test_input = trim($data);
  $test_input = stripslashes($data);
  $test_input = htmlspecialchars($data);
  return $test_input;
}

// Database configuration 
$dbHost     = "1111111";  //  your hostname
$dbUsername = "2222222";       //  your table username
$dbPassword = "0000000"; // your table password
$dbName     = "8888888";  // your database name

$searchType = test_input($_GET['extraParams']);
$searchTerm = test_input($_GET['term']);

If ($searchType === "1") {
$sql_query = "dm_br_form_ttt";
}
if ($searchType === "2") {
$sql_query = "dm_br_form_yyyy";
} 
if ($searchType === "3") {
$sql_query = "dm_br_form_rrrr";
}

$mysqli = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
$stmt = $mysqli -> set_charset("utf8");

$output = array();
$query = "SELECT * FROM  ".$sql_query." WHERE name LIKE CONCAT(?,'%') ";

if ($stmt = $mysqli -> prepare($query)){
    $stmt -> bind_param("s", $searchTerm);
    $stmt -> execute();
    $result = $stmt -> get_result();

    while($row = $result -> fetch_assoc()) {
        $output[]= $row['name'];    
    }

    $header = "Content-Type: application/json; charset=utf-8";
    header($header);

    echo json_encode($output);
    $stmt -> close();

} else {
    echo $mysqli->error;
    echo "no entry found";
}

?>