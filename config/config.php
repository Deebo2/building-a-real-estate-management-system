<?php 
try{
    define("APPURL",'http://localhost/php/homeland'); 
    //host
    define('HOSTNAME','localhost');
    //db name
    define('DBNAME','homeland');
    //user
    define('USER','root');
    //password
    define('PASS','');
    //PDO object
    $conn = new PDO("mysql:host=".HOSTNAME.";dbname=".DBNAME.";",USER,PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("DB connection failed : ".$e->getMessage());
}
?>