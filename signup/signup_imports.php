

<?php

/*Get all departments*/
function getDepartments(){
    require_once('../db/database.php');
    //get departments
    $stm=$db->prepare('select * from department ' );
    $stm->execute();
    $departments=$stm->fetchAll();
    return $departments;
}

function addUser($uname, $email, $pass, $fname, $lname, $role, $dept, $gender){
    try{
    require_once('../db/database.php');
    //Add user to DB
    $sql = "INSERT INTO `users`( `userName`, `email`, `password`, `firstName`, `lastName`, `role`, `deptID`, `gender`)";
    $sql.= " VALUES ( '".$uname."', '".$email."', '".$pass."', '".$fname."', '".$lname."', '".$role."', ".(int)$dept.",'".$gender."');";
    
    $usr_con=$db->prepare($sql);
    //$stm->bindParam(':userName', $_POST['uname'] );
    $usr_con->execute();
    return true;
    }
    catch(SQLException $e){
        return false;
    }
}

?>

