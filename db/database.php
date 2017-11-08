<?php
    $dsn = 'mysql:host=localhost:3306;dbname=university_schema';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
        //crash on error
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    } 
?>