<?php
$db['default'] = array(
    'dsn'          => '',
    'hostname'     => 'localhost',
    'username'     => 'perdagan_user',
    'password'     => 'Su6A3(f[avQ%',
    'database'     => 'perdagan_db',
    'dbdriver'     => 'mysql',
    'dbprefix'     => '',
    'pconnect'     => FALSE,
    'db_debug'     => (ENVIRONMENT !== 'production'),
    'cache_on'     => FALSE,
    'cachedir'     => '',
    'char_set'     => 'utf8',
    'dbcollat'     => 'utf8_general_ci',
    'swap_pre'     => '',
    'encrypt'      => FALSE,
    'compress'     => FALSE,
    'stricton'     => FALSE,
    'failover'     => array(),
    'save_queries' => TRUE,
);

function cleantext ($text,$html=true) {
        $text = preg_replace( "'<script[^>]*>.*?</script>'si", '', $text );
        $text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $text );
        $text = preg_replace( '/<!--.+?-->/', '', $text );
        $text = preg_replace( '/{.+?}/', '', $text );
        $text = preg_replace( '/&nbsp;/', ' ', $text );
        $text = preg_replace( '/&amp;/', ' ', $text );
        $text = preg_replace( '/&quot;/', ' ', $text );
        $text = strip_tags( $text );
        $text = preg_replace("/\r\n\r\n\r\n+/", " ", $text);
        $text = $html ? htmlspecialchars( $text ) : $text;
        return $text;
}

header("Content-Type: application/json");

$DBHOST= "localhost";
$DBUSER= $db['default']['username'];
$DBPASSWORD= $db['default']['password'];
$DBNAME= $db['default']['database'];

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