<?php
/**
 * Pull data from form
 * put data in arr
 *  - add to error arr?
 *      - convert {1=>"err",...} + {inp1,inp2,...} ===> {1 => arr(inp1,"err"),....}
 */
require_once('signup_db.php');

#Connection Array {(array of fields that need to be tested), function to run, error}
$error_msg = array(
    1=> array(array("username"), "uniqueName", "Username already used, please use another username."),
    2=> array(array("username"),"unameCheck","Username should contain 4-10 alphanumeric characters."),
    3=> array(array("password","confirmpassword"),"passCheck","Should be at least 8 charaters, 1 upper case letter [A-Z], one special character !,#,@."),
    4=> array(array("password","confirmpassword"),"cpassCheck","Password and confirm password should match."),
    5=> array(array("gender"),"genderCheck","Please select a gender."),
    6=> array(array("dept"),"roleCheck","Please select a role."),
    7=> array(array("email"),"emailCheck","Please enter the correct email format."),
    8=> array(array("terms"),"termsCheck","Please accept the terms."),
    9=> array(array("firstname","lastname"),"flnameCheck","Firstname and Lastname should only contain characters [A-Z] or [a-z]")

);

#pull in user input as associative array { "field" => value} 
$user_input = form_input();

#if something goes wrong, trip flag
$error_flag = false;

#loop through rest of  inputs
for($x = 1; $x <= count($error_msg); $x++){

    #loop through fields that need to be RE tested
    foreach($error_msg[$x][0] as $name){
            
        #send arr of data for check callback (RE function pointer, array(user input value, error flag))
        call_user_func_array($error_msg[$x][1], array($user_input[$name], &$error_flag));

        #test
        #printf("flag:".$error_flag."  |  x: ".$x." | User Input: ".$user_input[$name]."\n");

        #check if error flag is not pulled
        if($error_flag)
            error_return($error_msg[$x][2]);
    }
        
}

/*all checks passed*/

//delete confirm password and termsfrom arr
unset($user_input["confirmpassword"],$user_input["terms"]);

//create user
if(call_user_func_array('addUser', $user_input)){

    //redirect
    forward_user();
    
}

/********************/


/*Forward to signupHandler*/
function forward_user(){
    header("Location: signupHandler.php");
}

/*Send back with error*/
function error_return($err){
    header("Location: user_signup_form.php?error_msg=".$err);
}


/**
 * Collects data from form and puts it in arr
 * */
function form_input(){
    #array of fields to pull from post MUST BE IN THIS ORDER FOR DB
    $fields = array('username','email','password','firstname','lastname','role','dept','gender','confirmpassword','terms');
    #create associative array
    foreach($fields as $field)
        $form_data[$field] = $_POST[$field];
    return $form_data;
}


/**
 * 
 * Regular Expression checking here (Bare bones template for early testing)
 * 
 */

 /**
 * TEMPLATE FOR TESTING
 */
function regExp1($input, &$error_flag){
    //run check on input
    
    //if somethings wrong, trip flag
    $error_flag = false;
}

/**
 * test: Username already used, please use another username.
 */
function uniqueName($input, &$error_flag){
    //run check on input
    
    //if somethings wrong, trip flag
    $error_flag = false;
}

 /**
 * test: Username should contain 4-10 alphanumeric characters.
 */
function unameCheck($input, &$error_flag){
    //run check on input
    
    //if somethings wrong, trip flag
    $error_flag = false;
}

  /**
 * test: Should be at least 8 charaters, 1 upper case letter [A-Z], one special character !,#,@.
 */
function passCheck($input, &$error_flag){
    //run check on input
    
    //if somethings wrong, trip flag
    $error_flag = true;
}

 /**
 * test: Password and confirm password should match.
 */
function cpassCheck($input, &$error_flag){
    //run check on input
    
    //if somethings wrong, trip flag
    $error_flag = false;
}

 /**
 * test: Please select a gender.
 */
function genderCheck($input, &$error_flag){
    //run check on input
    
    //if somethings wrong, trip flag
    $error_flag = false;
}

 /**
 * test: Please select a role.
 */
function roleCheck($input, &$error_flag){
    //run check on input
    
    //if somethings wrong, trip flag
    $error_flag = false;
}

 /**
 * test: Please enter the correct email format.
 */
function emailCheck($input, &$error_flag){
    //run check on input
    
    //if somethings wrong, trip flag
    $error_flag = false;
}

 /**
 * test: Please accept the terms.
 */
function termsCheck($input, &$error_flag){
    //run input is null or not selected
    if($input)
        return $error_flag = false;
    else
        return $error_flag = true;  
}

 /**
 * test: Firstname and Lastname should only contain characters [A-Z] or [a-z]
 */
function flnameCheck($input, &$error_flag){

    //if somethings wrong, trip flag
    $error_flag = false;
}

?>