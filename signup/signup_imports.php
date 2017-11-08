<?php
require_once('../db/database.php');
//get departments
$stm=$db->prepare('select * from department ' );
$stm->execute();
$departments=$stm->fetchAll();


?>
<style>
<?php
include '../css/screen.css';
include '../css/print.css';
require_once('../db/database.php');
?>
</style>