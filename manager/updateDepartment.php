<?php

#page title
$page_title="Update Department";
$greeting_file = basename(__FILE__);
#imports
include("../header.php");


if (isset($_POST['hiddenID'])) {
    $id = $_POST['hiddenID'];
    $firstName = $_POST['firstName'];
}


    if (isset($_POST['name'])) {


        $finalID=$_POST['hidden_id'];

        $name = $_POST['name'];

        $st1 = $db->prepare('update department set departmentName=:departmentName WHERE departmentID=:departmentID');
        $st1->bindValue(':departmentName', $name);
        $st1->bindValue(':departmentID',$finalID);
        $st1->execute();
        header('Location: listDepartment.php');
    }


?>

<html>
<header>
    <title>Update Department</title>
    <link rel="stylesheet" type="text/css" href="main.css">

</header>
<body>
<main>
    <h1>University Courses Manager</h1>
    <hr>
    <form action="" method="post">


    <h2>Update Department</h2>
    Department Name:<input name="name" value="<?php echo $firstName?>">
    <br><br>
        <input type="hidden" value="<?php echo $id?> "name="hidden_id">
    <input type="submit" value="Update Department"><br><br>
        <a href="listDepartment.php" >View Department List</a>
        <hr>
    </form>
</main>
</body>
</html>

