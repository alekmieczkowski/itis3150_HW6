<?php
/**
 * Pull data from form
 * put data in arr
 *  - add to error arr?
 *      - convert {1=>"err",...} + {inp1,inp2,...} ===> {1 => arr(inp1,"err"),....}
 */

#Connection Array {(array of fields that need to be tested), function to run, error}
$error_msg = array(
    1=> array(array("username"), "regExp1", "Username already used, please use another username."),
    2=> array(array("username"),"regExp1","Username should contain 4-10 alphanumeric characters."),
    3=> array(array("password","confirmpassword"),"regExp1","Should be at least 8 charaters, 1 upper case letter [A-Z], one special character !,#,@."),
    4=> array(array("password","confirmpassword"),"regExp1","Password and confirm password should match."),
    5=> array(array("gender"),"regExp1","Please select a gender."),
    6=> array(array("dept"),"regExp1","Please select a role."),
    7=> array(array("email"),"regExp1","Please enter the correct email format."),
    8=> array(array("username"),"regExp1","Please accept the terms."),
    9=> array(array("firstname","lastname"),"regExp1","Firstname and Lastname should only contain characters [A-Z] or [a-z]")

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

        #check if error flag is not pulled
        if($error_flag)
            error_return($error_msg[$x][2]);
    }
        
}
//if all checks are passed redirect
header("Location: signupHandler.php");


/*Send back with error*/
function error_return($error_num){
    header("Location: user_signup_form.php?error_msg=".$error[$error_num]);
}


/**
 * Collects data from form and puts it in arr
 * */
function form_input(){
    #array of fields to pull from post MUST BE IN ORDER OF ERRORS
    $fields = array('username','password','confirmpassword','firstname','email','lastname','gender','dept');
    #create associative array
    foreach($fields as $field)
        $form_data[$field] = $_POST[$field];
    return $form_data;
}


/**
 * Regular Expression checking here (Bare bones template for early testing)
 */
function regExp1($input, &$error_flag){
    //run check on input

    //if somethings wrong, trip flag
    $error_flag = false;
}


?>