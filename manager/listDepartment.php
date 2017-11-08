<?php

#page title
$page_title="Department List";
$greeting_file = basename(__FILE__);
#imports
include("../header.php");

//get all deparments
$stm1=$db->prepare('select * from department');
$stm1->execute();
$departments=$stm1->fetchAll();
$stm1->closeCursor();

if (isset($_POST["dep_name"]))
$name=$_POST["dep_name"];

if (isset($name))
{
//add department
    $stm2=$db->prepare("insert into department ( departmentName) VALUES (?)");
    $stm2->bindValue(1,$name);
    $stm2->execute();
    header('Location: listDepartment.php');

    function show()
    {
        echo "wow";

    }

}



?>


<body>
<main>

    <section>






        <table >
            <tr>
                <th>Name</th>
                <th></th>
                <th></th>

            </tr>

            <?php foreach ($departments as $department) : ?>
                <tr>
                    <th><?php echo $department['departmentName']?></th>
                    <th>

                            <form action="deletDepartment.php" method="post">

                                    <input type="hidden" value="<?php echo $department['departmentID']?> "name="hiddenID">
                                    <input type="submit" value="Delete">

                            </form>

                    </th>
                    <th>

                        <form action="updateDepartment.php" method="post">

                            <input type="hidden" value="<?php echo $department['departmentID']?>" name="hiddenID">
                            <input type="hidden" value="<?php echo $department['departmentName']?>" name="firstName">


                            <input type="submit" value="Update" >
                        </form>

                    </th>


                </tr>
            <?php endforeach; ?>


        </table>


        <br>
        <h2>Add Department</h2>
        <form action=""method="post"  >


        Name: <input type="text" name="dep_name" required>
        <input type="submit" value="Add" name="Add">
        <br>
        <h2><a href="manager_home.php" >List Courses </a> </h2>
        </form>

    </section>

    <?include("../footer.php");?>
