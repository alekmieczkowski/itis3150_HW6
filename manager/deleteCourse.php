<?php
#page title
$page_title="Courses List";
$greeting_file = basename(__FILE__);
#imports
include("../header.php");

if (isset($_POST['id'])) {

$id=$_POST['id'];

    $depID=$_POST['depID'];
echo $depID;
    $stmt = $db->prepare('delete from courses where crs_ID=:crs_ID');
    $stmt->bindValue(':crs_ID', $id);
$stmt->execute();




    header('Location: manager_home.php?depID='.$depID);


}







?>



