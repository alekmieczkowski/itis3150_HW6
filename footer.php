<aside></aside>
<section>
<?php if($greeting_file == "student_courses.php" || $greeting_file == "listDepartment.php"){?>
    <div><a href="?disconnect=TRUE"><p>Logout!</p></a></div>
<?php }else{?>
    <div style="position:relative; margin-left:150px;"><a href="?disconnect=TRUE"><p>Logout!</p></a></div>
<?php }?>
</section>

</body>
</html>