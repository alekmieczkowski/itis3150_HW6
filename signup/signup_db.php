

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

/*Check if user exists in DB

Returns True if user exists
*/
function existingUser($usr_name){

    require_once('../db/database.php');
    try{
        $sql_eu = "SELECT * FROM users WHERE userName=:uname";
        $usr=$db->prepare($sql_eu);
        $usr->bindValue(':uname',$usr_name);
        $usr->execute();
        $data = $usr->fetchAll();
        

        //check if theres anything that came back
        if($data!=null){
            printf("not empty!");
            return true;
        }
        else{
            printf("empty!: ".implode(",", $data) ."<br/>");
            return false;
        }
        $usr->closeCursor();
    }
    catch(PDOException $e){
        printf("Well shit: ".$e."<br/>");
        return false;
    }

}

?>

