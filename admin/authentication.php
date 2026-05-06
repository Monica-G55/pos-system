<?php

if(isset($_SESSION['loggedIn'])){

  $email = validate($_SESSION['loggedInUser']['email']);

  $query = "SELECT * FROM admin where email='$email' LIMIT 1";
  $result= mysqli_query($con, $query);

  if(mysqli_num_rows($result) == 0){
    logoutsession();
    redirect('../login.php','Access Denied');
  }else{
    $row = mysqli_fetch_assoc($result);
    if($row['is_ban'] == 1){
          logoutsession();
      redirect('../login.php','Acc');
    }
  }

}else{
    redirect('../login.php','Login to continue');
}


?>