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
    6=> array(array("role"),"roleCheck","Please select a role."),
    7=> array(array("email"),"emailCheck","Please enter the correct email format."),
    8=> array(array("terms"),"termsCheck","Please accept the terms."),
    9=> array(array("firstname","lastname"),"flnameCheck","Firstname and Lastname should only contain characters [A-Z] or [a-z]")

);


/********************/


/*Forward to signupHandler*/
function forward_user(){
    header("Location: signupHandler.php");
}

/*Send back with error*/
function error_return($err){
    printf("made it to error redirect, err: ". $err);
    header("Location: user_signup_form.php?error_msg=".$err);
}

/*Create User*/
function createUser($usr_inp){
    call_user_func_array('addUser', $usr_inp);
}

/********************/

#pull in user input as associative array { "field" => value} 
$user_input = form_input();

#if something goes wrong, trip flag
$error_flag = false;

#cpass stuff
$passwords = array();
$hold = 0;

#loop through rest of  inputs
for($x = 1; $x <= count($error_msg); $x++){

    #loop through fields that need to be RE tested
    foreach($error_msg[$x][0] as $name){
        
        #if current cpassCheck = next cpassCheck
        if($x < 9 && $error_msg[$x][1] == "cpassCheck" && $error_msg[$x][1] === $error_msg[$x+1][1]){
            #set hold to skip one rotation and get next pass
            $hold+=1;
            #add to passwords array
            array_push($passwords, $user_input[$name]);
        }
        if($hold == 2){ #run password check
            #run check
            call_user_func_array($error_msg[$x][1], array($passwords, &$error_flag));
            #reset hold
            $hold = 0;
        }
        else if($hold != 1 && $hold != 2) #if placed in hold, two rotations will be skipped to add next password to arr
            call_user_func_array($error_msg[$x][1], array($user_input[$name], &$error_flag));
       

        #test
        #printf("flag:".$error_flag."  |  x: ".$x." | Function Call: ".$error_msg[$x][1]." | User Input: ".$user_input[$name]."<br/>");

        #check if error flag is not pulled
        if($error_flag){
            printf("Made it to error flag pull");
            error_return($error_msg[$x][2]);
        }
    }
        
}
#printf("flag after check: ".$error_flag);
/*all checks passed*/

//delete confirm password and termsfrom arr
unset($user_input["confirmpassword"]);
unset($user_input["terms"]);
#print_r($user_input);





/**
 * Collects data from form and puts it in arr
 * */
function form_input(){
    #array of fields to pull from post MUST BE IN THIS ORDER FOR DB
    $fields = array('username','email','password','firstname','lastname','role','dept','gender','confirmpassword','terms');
    $form_data;
    #create associative array
    foreach($fields as $field){
        if($_POST[$field]!= null || $_POST[$field]!= "" || $_POST[$field]!= false)
            $form_data[$field] = $_POST[$field];
        else
            $form_data[$field] = false;
    }

    return $form_data;
}


/**
 * 
 * Regular Expression checking here 
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

    //check if username exists in DB trip flag if it does
    if(existingUser($input)){
        $error_flag = true;
    }
    else{ 
        $error_flag = false;
    }

}

 /**
 * test: Username should contain 4-10 alphanumeric characters.
 */
function unameCheck($input, &$error_flag){

    //regex check
    $regex = "/[a-zA-Z0-9]{4,10}/";

    //if regex matches we're good, if not flag is set to true
    if(preg_match($regex, $input))
        $error_flag = false;
    else
        $error_flag = true;
}

  /**
 * test: Should be at least 8 charaters, 1 upper case letter [A-Z], one special character !,#,@.
 */
function passCheck($input, &$error_flag){
    //run check on input
    
    //if somethings wrong, trip flag
    $error_flag = false;
}

 /**
 * test: Password and confirm password should match.
 */
function cpassCheck($input, &$error_flag){

    //if passwords match
    if($input[0] === $input[1])
        $error_flag = false;
    else
        $error_flag = true;
    
}

 /**
 * test: Please select a gender.
 */
function genderCheck($input, &$error_flag){
    //check if boxes were selected
    if($input == null || $input == false)
        $error_flag=true;
    else
        $error_flag = false;
}

 /**
 * test: Please select a role.
 */
function roleCheck($input, &$error_flag){
    #printf("RoleCheck input Before:  ".$input);
    if($input == null || $input == false)
        $error_flag=true;
    else
        $error_flag = false;
    #printf("RoleCheck input After:  ".$input);
}

 /**
 * test: Please enter the correct email format.
 */
function emailCheck($input, &$error_flag){

    //regex string
    $regex = "/^\S+@\S+\.\S+$/";

    //if regex matches we're good, if not flag is set to true
    if(preg_match($regex, $input))
        $error_flag = false;
    else
        $error_flag = true;
    
    
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

    #regex string
    $regex = "/[a-zA-Z]/";

    //if regex matches we're good, if not flag is set to true
    if(preg_match($regex, $input))
        $error_flag = false;
    else
        $error_flag = true;
}

?>