<?php 
require "db.php";
$login = $_POST['login'];
$password  = $_POST['password'];
$auto_querry = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
if($auto_querry->num_rows>0){
    foreach($auto_querry as $key => $value) {
    $_SESSION['users']['id'] = $value['id'];
    $_SESSION['users']['isAdmin'] = $value['isAdmin'];
    header('location: ../index.php');   
}
}
else{       
    echo "web-site not working"; 
}

  
 
?>