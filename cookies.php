<?php
/**
 * Remember Me Checkbox Logic
 */





/*Create Cookie*/
function cookie_create($cookie_name, $cookie_data){
    #create cookie that lasts 1 year
    $year = time() + 31536000;
    setcookie($cookie_name,$cookie_data, $year);   
}

/*Cookie Kill Function*/
function cookie_kill($cookie_name){
    
    #If a cookie exists
    if(isset($_COOKIE[$cookie_name])) {
        
        #set it to past time and kill it
        $past = time() - 3600;
        setcookie($cookie_name, '', $past);
    }
}
?>

