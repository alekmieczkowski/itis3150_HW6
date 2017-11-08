<?php

/*Get all departments*/
function getDepartments(){
    require_once('../db/database.php');
    //get departments
    $stm=$db->prepare('select * from department ' );
    $stm->execute();
    $departments=$stm->fetchAll();
    return $departments;
}



?>
<style>
<?php
include '../css/screen.css';
include '../css/print.css';
?>
</style>