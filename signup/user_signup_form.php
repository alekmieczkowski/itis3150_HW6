

<!--Import all assets on another page-->
<?php 
require_once('signup_db.php');



echo '<style>';

include '../css/screen.css';
include '../css/print.css';

echo '</style>';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Registration</title>
  </head>
  <body>
    <div class="container">
      <h1>Registration Form</h1>
      <hr>
      <div class="span-3">
      	<br/>
      </div>
      <div class="span-18">
      <!--show error if set-->
      <?php
        if(isset($_GET["error_msg"])){
          echo '<div class="error">';
          echo $_GET["error_msg"];
          echo '</div>';
        }
      ?>
        <form id="user_signup" action="validation_logic.php" method="post" class="inline">
          <fieldset>
            <div class="span-9">
            <p>
              <label for="username">Username</label><br>
              <input required type="text" class="text" id="username" name="username" value="">
            </p>
            <p>
              <label for="password">Password</label><br>
              <input required type="password" class="text" id="password" name="password" value="">
            </p>  
            
            <p>
              <label for="firstname">Firstname</label><br>
              <input required type="text" class="text" id="firstname" name="firstname" value="">
            </p>

            </div>
            
            <div class="span-8 last">
            <p>
              <label for="email">Email</label><br>
              <input  type="text" class="text" id="email" name="email" value="">
            </p>
            
			<p>
              <label for="confirmpassword">Confirm Password</label><br>
              <input required type="password" class="text" id="confirmpassword" name="confirmpassword" value="">
            </p>


            <p>
              <label for="lastname">Lastname</label><br>
              <input required type="text" class="text" id="lastname" name="lastname" value="">
            </p>

          	<p>
          		<label>Gender</label><br>
            	<input  type="radio" name="gender" value="male"> Male
            	<input  type="radio" name="gender" value="female"> Female<br>
          	</p>
                <p>
                    <label>Role</label><br>
                    <input  type="radio" id="role" name="role" value="student"> Student
                    <input  type="radio" id="role" name="role" value="manager"> Manager<br>
                </p>
          	<p>
          		<label for="dept">Department</label><br>
            	<select id="dept" name="dept" required>
                  <?php 
                  $dept = getDepartments();
                  foreach ($dept as $department)
                  {
                    echo '<option value="'.$department['departmentID'].'">'.$department['departmentName'].'</option>';
                  }
                        
                  ?>
              </select>
			</p>
          	
			<p>
				<input type="checkbox" name="terms" id="accepted" value="true"> Please check this checkbox to accept our terms.
            </p>
          	
            <p>
              <input type="submit" value="Submit">
              <input type="reset" value="Reset">
            </p>            	
            	
            </div>

          </fieldset>
        </form>
      </div>
      <div class="span-3 last">
      	<br/>
      </div>
    </div>
  </body>
</html>
