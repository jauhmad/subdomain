<?php
include 'inc.php';
header("Content-Type: application/json");

mysql_connect($DBHOST,$DBUSER,$DBPASSWORD,$DBNAME) or die(mysql_error());
mysql_select_db($DBNAME) or die(mysql_error());
$varjson=array();

$query="select * from jmlonline";
$res=mysql_query($query) or die(mysql_error());
$jum=mysql_num_rows($res);

if ($jum > 0) {
 while($row=mysql_fetch_array($res)){
   
    $row_array->counter=$row["counter"]; 
    $row_array->online=cleantext($row["online"]); 
    $row_array->day=cleantext($row["day"]); 
    $row_array->month=cleantext($row["month"]); 
  
    
    array_push($varjson,json_decode(json_encode($row_array)));
    }
    echo json_encode($varjson);
} else {
    echo "0 results";
}

mysql_close();
?>