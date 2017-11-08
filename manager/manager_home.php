<?php
#page title
$page_title= "manager home";
$greeting_file = basename(__FILE__);
#imports
include("../header.php");


//check if user is manager or not
if($_SESSION['role'] != 'manager')
{
    header("Location: ../student/student_home.php");
}

$departmentID = filter_input(INPUT_GET, 'department_id', FILTER_VALIDATE_INT);

if ($departmentID == NULL || $departmentID == FALSE)
{
    $departmentID=1;

}

if (isset($_GET['depID']))
{
    $departmentID=$_GET['depID'];


}

//get all department names
$stmt1=$db->prepare('select * from department ');
$stmt1->execute();
$allDepartments=$stmt1->fetchAll();
$stmt1->closeCursor();

//get department name for a selected department

$stmt2=$db->prepare('select departmentName from department  WHERE departmentID = :department_id');
$stmt2->bindValue(':department_id',$departmentID);
$stmt2->execute();
$department=$stmt2->fetch();
$stmt2->closeCursor();

//get all courses for a selected department
$stmt3=$db->prepare('select * from courses WHERE dep_id=:department_id');
$stmt3->bindValue(':department_id', $departmentID);
$stmt3->execute();
$courses=$stmt3->fetchAll();


//header('Location: logIn.html'.$depID);




?>

<body>
<main>


    <aside>


<h2>Course List</h2>
<h2>Departments</h2>
<nav>


<ul>

        <?php foreach ($allDepartments as $departmentName) : ?>

        <li>
            <a href="?department_id=<?php echo $departmentName['departmentID'];?>">
                <?php echo $departmentName['departmentName'];
                ?>
            </a>
        </li>
    <?php endforeach;?>
</ul>
</nav>
    </aside>



    <section>
        <h2>


        <?php echo ($department['departmentName']); ?></h2>



        <table>
            <tr>
                <th>Code</th>
                <th>Title</th>
                <th>Credit</th>
                <th>Description</th>
                <th></th>
                <th></th>
            </tr>

            <?php foreach ($courses as $course) : ?>
            <tr>
                <th><?php echo $course['crs_code']?></th>
                <th><?php echo $course['crs_title']?></th>
                <th><?php echo $course['crs_credits']?></th>
                <th><?php echo $course['crs_description']?></th>




                <th >
                    <form action="deleteCourse.php" method="post">
                        <input type="hidden" value="<?php echo $course['crs_ID']?>" name="id">
                        <input type="hidden" value="<?php echo $course['dep_id']?>" name="depID">

                    <input type="submit" value="Delete">

                    </form>



                </th>

                <th >
                    <form action="updateCourse.php" method="post">


                    <input type="submit" value="Update">
                        <input type="hidden" value="<?php echo $course['crs_ID']?>" name="id">



                        <input type="hidden" value="<?php echo $departmentID?>" name="depID">
                        <input type="hidden" value="<?php echo $course['crs_code']?>" name="code">
                        <input type="hidden" value="<?php echo $course['crs_title']?>" name="title">
                        <input type="hidden" value="<?php echo $course['crs_credits']?>" name="credits">
                        <input type="hidden" value="<?php echo $course['crs_description']?>" name="description">




                    </form>

                </th>



            </tr>
            <?php endforeach; ?>


        </table>



        <br>

        <a href="addCourse.php">Add Course</a><br><br>
        <a href="listDepartment.php">List Department</a>
    </section>









    </main>


<?php include("../footer.php");?>
