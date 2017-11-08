<?php 
#cookie tools
include("cookies.php");

#error message
$errmsg = $_GET["errmsg"] ?? null; 


#if remember me is unchecked
if(isset($_POST['clearCookie'])){
    $warn="cookie deleted";
    try{cookie_kill($_POST['clearCookie']);}
    catch(Exception $e){echo $e;}
}

#cookie page rendering
$checkbox="";
$uname = "";
$pwd =  "";
$warn = "";
#if cookie is set
if(isset($_COOKIE['remember_me'])) {
    //get cookie data
    $cookie = explode('|', $_COOKIE['remember_me']);
    $checkbox = 'checked="checked"';
    $uname = 'value="'.$cookie[0].'"';
    $pwd = 'value="'.$cookie[1].'"';

    //testing
    $warn = "cookie detected";
}



?>


<!DOCTYPE html>
<html>
<style>
    form {
        border: 3px solid #f1f1f1;
    }

    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }

    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
    }

    img.avatar {
        width: 20%;
        border-radius: 50%;
    }

    .container {
        padding: 16px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }
        .cancelbtn {
            width: 100%;
        }
    }
</style>
<body>

<h2>Login Form</h2>
<h3><?php #echo $warn ?></h3>
<!--Error Message-->
<div class="container" style="background-color:#f1f1f1;color:red;font-size:16px;">
        <h3><?php echo $errmsg ?></h3>
    </div>
<form action="login_action.php" method="post">
    <div class="imgcontainer">
        <img src="img/img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required <?php if($uname!=""){echo $uname;}?>>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="pwd" required <?php if($pwd!=""){echo $pwd;}?>>

        <button type="submit">Login</button>
        <!--cookie stuff for remember me-->
        <input type="checkbox" id="remember_me" name="remember" <?php if($checkbox!=""){echo $checkbox;}?>>Remember me
    </div>
    


    <div class="container" style="background-color:#f1f1f1">
        <button type="button" class="cancelbtn">Cancel</button>
        <span class="psw"><a href="signup/user_signup_form.php">New User?</a></span>
    </div>
</form>



<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>

<script>
//jquery woo
$(document).ready(function(){

    /*sends ajax call to php to delete cookie*/
    function cookie_del(cookieName){

        //ajax call
        $.ajax({
            data: 'clearCookie=' + cookieName, //set data for post
            url: 'login.php',
            method: 'POST', // or GET
            success: function(msg) {
                location.reload(true);
            }
        });
    }

    //on checkbox uncheck
    $("input:checkbox#remember_me ").change(function() {
        //if checkbox is unchecked
        if(!$(this).is(':checked')){
            //delete cookie
            cookie_del('remember_me');
        }
    }); 


});


</script>


</body>
</html>

