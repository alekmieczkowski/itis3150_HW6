<?php
#page title
$page_title="Update Course";
$greeting_file = basename(__FILE__);
#imports
include("../header.php");

//get departments
$stm=$db->prepare('select * from department ' );
$stm->execute();
$demaprtments=$stm->fetchAll();





if(isset($_POST['id']))
{
    $firstID= $_POST['id'];


    $firstDepartment=$_POST['depID'];
    $firstCode=$_POST['code'];
    $firstTitle=$_POST['title'];
    $firstCredits=$_POST['credits'];
    $firstDescription=$_POST['description'];

}

if (isset($_POST['code'])&&isset($_POST['title'])&&isset($_POST['credit'])&&isset($_POST['description'])&&isset($_POST['depID'])&&isset($_POST['hiddenID'])) {


    $code=$_POST['code'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $credits=$_POST['credit'];
    $id=$_POST['depID'];
    $courseID=$_POST['hiddenID'];


//update course
    $stm1 = $db->prepare('update courses set crs_code=?, crs_title=?, crs_credits=?, crs_description=?,dep_id=? WHERE crs_ID=?') ;

    $stm1->bindValue(1, $code);
    $stm1->bindValue(2, $title);
    $stm1->bindValue(3, $credits);
    $stm1->bindValue(4,$description);
    $stm1->bindValue(5,$id);
    $stm1->bindValue(6,$courseID);
    $stm1->execute();
    header('Location: manager_home.php?depID='.$id);
}

?>


    <form method="post" action="">

        <?php foreach ($demaprtments as $demaprtment):?>
        <?php endforeach;?>
        Department:
        <select name="depID">

            <?php foreach ($demaprtments as $demaprtment)
            {

                if ($firstDepartment==$demaprtment['departmentID'])



                echo '<option selected value="'.$demaprtment['departmentID'].'">'.$demaprtment['departmentName'].'</option>';
                else
                    echo '<option value="'.$demaprtment['departmentID'].'">'.$demaprtment['departmentName'].'</option>';
            }

            ?>
        </select>
        <br>

        Code:<input name="code" required value="<?php echo $firstCode?>"><br>
        Title:<input name="title" required value="<?php echo $firstTitle?>"><br>
        Credits:<input name="credit" required value="<?php echo $firstCredits?>"><br><br>
        Description:

        <input name="description" value="<?php echo $firstDescription?>" required style="height: 150px; width: 350px  "><br><br>

        <input type="hidden" name="hiddenID" value="<?php echo $firstID?>">

        <input type="submit" value="Update Course"><br><br>

        <a href="manager_home.php">View Course List</a><br><br>
        <hr>

    </form>
</main>
</body>
</html>
