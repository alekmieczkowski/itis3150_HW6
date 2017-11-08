<?php
#page title
$page_title="Drop Course";
$greeting_file = basename(__FILE__);
#imports
include("../header.php");

$userID=$_SESSION['userID'];


//get registered courses
$stm=$db->prepare('select * from reg_courses JOIN courses ON reg_courses.crs_ID=courses.crs_ID WHERE userID=?');
$stm->bindValue(1,$userID);
$stm->execute();
$courses=$stm->fetchAll();
$stm->closeCursor();

if (isset($_POST['id']))
{
    $regID=$_POST['id'];
    dropCourse($db,$regID);
}


//drop a course
function dropCourse($db,$regID)
{
    $stm1=$db->prepare('delete from reg_courses WHERE regID=?');
    $stm1->bindValue(1,$regID);
    $stm1->execute();

    header('Location: student_courses.php');
}

?>

    <section>
        <h2>

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

                    <th><?php echo $course['crs_code']?>
                    <th><?php echo $course['crs_title']?>
                    <th><?php echo $course['crs_credits']?>
                    <th><?php echo $course['crs_description']?>

                    <th >
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $course['regID']?>" name="id">
                            <input type="submit" value="Drop">
                        </form>
                    </th>
                </tr>
            <?php endforeach; ?>


        </table>



        <br>


        <a href="student_home.php">Back to Registration</a>
    </section>



</main>

<?php include("../footer.php")?>

