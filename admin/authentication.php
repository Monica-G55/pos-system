<?php

if(isset($_SESSION['loggedIn'])){

  $email = validate($_SESSION['loggedIn']['email']);

  $query = "SELECT * FROM admin where email='$email' LIMIT 1";
  $result= mysqli_query($con,$query);

}else{
    redirect('../login.php','Login to continue');
}















?>