<?php

#page title
$page_title="Courses List";
$greeting_file = basename(__FILE__);
#imports
include("../header.php");

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

if (isset($_POST['crsID']))
{
    $crsID=$_POST['crsID'];
    register($db,$crsID);
}


//register for a class then direct user to my courses
function register($db,$crsID)
{
    $stm1 = $db->prepare('insert into reg_courses(crs_ID,userID) VALUES (?,?)');

    $stm1->bindValue(1, $crsID);
    $stm1->bindValue(2, $_SESSION['userID']);

    $stm1->execute();

    header('Location: student_courses.php');

}

//get registered courses
$stm5=$db->prepare('select * from reg_courses WHERE userID=?');
$stm5->bindValue(1,$_SESSION['userID']);
$stm5->execute();
$regCourses=$stm5->fetchAll();
$stm5->closeCursor();


//list()=$mine;

//array_push($mine($regCourses));








?>


    
    <aside>


        <h2>Course List</h2>
        <h2>Departments</h2>
        <nav>


            <ul>

                <?php foreach ($allDepartments as $departmentName) : ?>

                    <li>
                        <a href="?department_id=<?phpphp echo $departmentName['departmentID'];?>">
                            <?phpphp echo $departmentName['departmentName'];
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

            </tr>

            <?php foreach ($courses as $course) : ?>
                <tr>
                    <th><?php echo $course['crs_code']?></th>
                    <th><?php echo $course['crs_title']?></th>
                    <th><?php echo $course['crs_credits']?></th>
                    <th><?php echo $course['crs_description']?></th>






                    <th >
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $course['crs_ID']?>" name="crsID">

                            <input type="hidden" value="1" name="userID">

                            
                            <?php #disable register button if course already registered 
                            $cutoff = 0;
                            #check thru registered courses
                            foreach ($regCourses as $cc):

                                    #if course ID matches a registered course then disable button
                                    if ($course['crs_ID'] == $cc['crs_ID']) {
                                        echo "<input type='submit' value='Register' disabled>";
                                        $cutoff = 1;
                                    }
                                    #if course is found, break from foreach to conserve processing
                                    if($cutoff == 1)
                                        break;

                                endforeach;

                                #if no match is found and cutoff stays at 0, print a register button
                                if($cutoff == 0) {
                                    echo "<input type='submit' value='Register' >";
                                }
                                ?>
                        </form>
                    </th>
                </tr>
            <?php endforeach; ?>
        </table>



        <br>
        <form action="student_courses.php" method="post">
            <a href="student_courses.php" type="submit">See Registered Courses</a>
        </form>
    </section>
</main>

<?php include("../footer.php");?>
