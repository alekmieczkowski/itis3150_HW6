<?php

session_start();
require_once('db/database.php');
include("cookies.php");





/**
 * Login User via username password pull. 
 */

$result = $db->prepare("SELECT * FROM Users WHERE userName = :userName AND password= :password");
$result->bindParam(':userName', $_POST['uname'] );
$result->bindParam(':password', $_POST['pwd']);
$result->execute();
$rows= $result->fetch();

if($rows > 0) {
    #Save all needed user data to session
    $_SESSION['userName'] = $rows['userName'];
    $_SESSION['userID'] = $rows['userID'];
    $_SESSION['role'] = $rows['role'];
    $_SESSION['fname'] = $rows['firstName'];
    $_SESSION['deptID'] = $rows['deptID'];

    #check for remember me and set cookie
    if($_POST['remember']) {
        
        #create data string (insecure as hell cause pwd is in plaintext but this isnt cyber security course)
        $data = array($_POST['uname'],$_POST['pwd']);
        $cookie_data = implode('|', $data);
    
        #create cookie
        cookie_create('remember_me', $cookie_data);
    
           
    }

    #redirect based on user type
    if($rows['role'] == 'student')
        header("location: student/student_home.php");
    elseif ($rows['role'] == 'manager')
        header("location: manager/manager_home.php");
    else
        header("location: role_error.html");
}
else{
    $errmsg = 'Username and Password are not found';
}

#error handling
if(isset($errmsg)) {
    $_SESSION['ERRMSG'] = $errmsg;
    session_write_close();
    header("location: login.php?errmsg=".$errmsg);
    exit();
}


?>