<?php
/**
 * Pull data from form
 * put data in arr
 *  - add to error arr?
 *      - convert {1=>"err",...} + {inp1,inp2,...} ===> {1 => arr(inp1,"err"),....}
 */
#Error array
$error = array(
    1=> "Username already used, please use another username.",
    2=> "Username should contain 4-10 alphanumeric characters.",
    3=> "Should be at least 8 charaters, 1 upper case letter [A-Z], one special character !,#,@.",
    4=> "Password and confirm password should match.",
    5=> "Please select a gender.",
    6=>  "Please select a role.",
    7=> "Please enter the correct email format.",
    8=> "Please accept the terms.",
    9=> "Firstname and Lastname should only contain characters [A-Z] or [a-z]"
);

/*Send back with error*/
function error_return($error_num){
    header("Location: user_signup_form.php?error_msg=".$error[$error_num]);
}

/*Regular Expression checking here */

/*Run Checks
--calls regular expression checking functions
    - if they return true, continue down the chain
    - if false then run error_return with the correct error num

*/
if($one)
?>