<?php

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "secret_messanger";

foreach($db as $key => $value){
define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME);

if(!$connection){
    echo 'not connected';
}


$secret_chanell_db  = null;
$secret_chanell  = null;

function secret_chanell_validate($secret_chanell){
    global $connection;
    $secret_chanell_db  = null;
    
    
    $secret_chanell = mysqli_real_escape_string($connection, $secret_chanell);
    
    // set up the query
    $query = "SELECT * FROM secret_chanells WHERE secret_chanell = '{$secret_chanell}' ";
    $get_chanell_query = mysqli_query($connection, $query);
    
    // if there's an error :
    if(!$get_chanell_query){
        die("QUERY FAILED" . mysqli_error($connection));
    }
    
    while($row = mysqli_fetch_array($get_chanell_query)){
        $secret_chanell_db = $row['secret_chanell'];
    }
    
    if($secret_chanell == ''){
        return false;
    }else if($secret_chanell == $secret_chanell_db){
        return true;
    }else{
        return false;
    }
}

?>