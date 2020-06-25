<?php
include 'inc.php';
header("Content-Type: application/json");

mysql_connect($DBHOST,$DBUSER,$DBPASSWORD,$DBNAME) or die(mysql_error());
mysql_select_db($DBNAME) or die(mysql_error());
$varjson=array();

$query="select 
        artikel.id,
        artikel.judul,
        artikel.tgl
   from artikel
   where 
       artikel.publikasi='1'
   order by
       artikel.tgl desc
   ";
$res=mysql_query($query) or die(mysql_error());
$jum=mysql_num_rows($res);

if ($jum > 0) {
 while($row=mysql_fetch_array($res)){
   
    $row_array->id=$row["id"]; 
    $row_array->judul=cleantext($row["judul"]); 
    $row_array->tgl=cleantext($row["tgl"]); 
  
    
    array_push($varjson,json_decode(json_encode($row_array)));
    }
    echo json_encode($varjson);
} else {
    echo "0 results";
}
mysql_close();
?>