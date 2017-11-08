<?php

#start session
if (!isset($_SESSION))
{
  session_start();
}

#cookie tools
include("cookies.php");

#redirect off session 
if(isset($_SESSION['fname']) && !empty($_SESSION['fname'])){} #if session exists, is not empty, and you are not on the Signup page
#else if($greeting_file =='singupHandler.php' || $greeting_file =='user_signup_form.php'){} #stay on signup form page
else #Redirect to login
    header("Location: ../login.php");


    
#session disconnect
function session_disconnect(){
    session_destroy();

    #Delete Remember Me Cookie if exists
    cookie_kill('remember_me');

    header("Location: ../login.php");
}

#run disconnect
if(isset($_GET['disconnect'])){
    session_disconnect();
}


