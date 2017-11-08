<?php
#Imports
require_once('db/database.php');
require_once('session.php');

?>
<html>

<!-- the head section -->
<head>
    <title><?php echo $page_title?></title>
    

</head>

<h1 style="color:black"> <!--TODO: IF statement for header based on user page-->University Courses Manager</h1>
<hr/>
<?php
if($greeting_file == 'manager_home.php' || $greeting_file== 'student_home.php'){ #if hello {name} needed in header
echo "<h1>Welcome back, ".$_SESSION['fname']."!</h1>";
}
else{ #standard page names
    echo "<h1>".$page_title."</h1>";
}
?>

<!--include css styling everywhere-->
<style>
<?php

#main styling
include 'css/main.css'; 

#print and screen css depending on page
if($greeting_file == 'signupHandler.php' || $greeting_file == 'user_signup_form.php'){
    include 'css/screen.css';
    include 'css/print.css';
    
    
}



?>


</style>