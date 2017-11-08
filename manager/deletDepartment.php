<?php
#page title
$page_title="Delete Dept";
$greeting_file = basename(__FILE__);
#imports
include("../header.php");

if (isset($_POST['hiddenID']))
{
    $id=$_POST['hiddenID'];
    echo $id;

    $stm1=$db->prepare('delete from department WHERE departmentID=:departmentID');
    $stm1->bindValue(':departmentID',$id);
    $stm1->execute();

    header('Location: listDepartment.php');

}