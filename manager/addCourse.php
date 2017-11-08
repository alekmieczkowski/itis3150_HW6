<?php
#page title
$page_title="Add Course";
$greeting_file = basename(__FILE__);
#imports
include("../header.php");

//get departments
$stm=$db->prepare('select * from department ' );
$stm->execute();
$demaprtments=$stm->fetchAll();

if (isset($_POST['code'])&&isset($_POST['title'])&&isset($_POST['credit'])&&isset($_POST['description'])&&isset($_POST['depID'])) {

    $code=$_POST['code'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $credits=$_POST['credit'];
    $id=$_POST['depID'];
    $depID=$id;



//add course
    $stm1 = $db->prepare('insert into courses(crs_code, crs_title, crs_credits, crs_description,dep_id) VALUES (?,?,?,?,?)');



    $stm1->bindValue(1, $code);
    $stm1->bindValue(2, $title);
    $stm1->bindValue(3, $credits);
    $stm1->bindValue(4,$description);
    $stm1->bindValue(5,$id);
    $stm1->execute();
    //header('Location: index.php?id');
    header('Location: manager_home.php?depID='.$depID);

}




?>

<body>
<main>
<br/>

    <form method="post" action="">

        <?php foreach ($demaprtments as $demaprtment):?>
        <?php endforeach;?>
    Department:
        <select name="depID">

            <?php foreach ($demaprtments as $demaprtment)
            {
                echo '<option value="'.$demaprtment['departmentID'].'">'.$demaprtment['departmentName'].'</option>';
            }
            
            ?>
        </select>
<br>

    Code:<input name="code" required><br>
    Title:<input name="title" required><br>
    Credits:<input name="credit" required><br><br>
        Description:



    <input name="description" required style="height: 150px; width: 350px  "><br><br>


        <input type="submit" value="Add Course"><br><br>

        <a href="manager_home.php">View Course List</a><br><br>
        <hr>

    </form>
</main>
</body>
</html>
