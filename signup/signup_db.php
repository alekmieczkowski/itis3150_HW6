

<?php

/*Get all departments*/
function getDepartments(){
    require('../db/database.php');
    //get departments
    $stm=$db->prepare('select * from department' );
    $stm->execute();
    $departments=$stm->fetchAll();
    $stm->closeCursor();
    return $departments;
}

/*Add user*/
function addUser($uname, $email, $pass, $fname, $lname, $role, $dept, $gender){
    try{
    require('../db/database.php');
    //Add user to DB
    $sql = "INSERT INTO `users`( `userName`, `email`, `password`, `firstName`, `lastName`, `role`, `deptID`, `gender`)";
    $sql.= " VALUES ( '".$uname."', '".$email."', '".$pass."', '".$fname."', '".$lname."', '".$role."', ".(int)$dept.",'".$gender."');";
    #printf($sql);
    $usr_con=$db->prepare($sql);
    $usr_con->execute();
    $usr_con->closeCursor();
    return true;
    }
    catch(PDOException $Exception){
        echo $Exception ->getMessage();
        return false;
    }
}

/*Check if user exists in DB*/
function existingUser($username){
    require('../db/database.php');
    try{
        $sql_eu = "SELECT * FROM `users` WHERE userName=':uname'";
        $usr=$db->prepare($sql_eu);
        $usr->bindValue(':uname',$username);
        $usr->execute();
        $data = $usr->fetchAll();
        $usr->closeCursor();

        //check if theres anything that came back
        if($data!=null)
            return true;
        else
            return false;
    }
    catch(Exception $e){
        return false;
    }

}

?>

