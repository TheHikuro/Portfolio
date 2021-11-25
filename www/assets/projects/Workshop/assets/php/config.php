<?php
    define('DB_SERVER', 'loanclerjhwp.mysql.db');
    define('DB_NAME', 'loanclerjhwp');
    define('DB_USERNAME', 'loanclerjhwp');
    define('DB_PASSWORD', 'Jckuro21221');

    try{
        $conn = new PDO("mysql:host=" .DB_SERVER .";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo $e;
    }
    
?>  