<?php

session_start();


require 'dbcon.php';


function validate($inputData){

    global $con;
    $validatedData = mysqli_real_query($con,$inputData);
    return trim($validatedData);
}


function redirect($url,$status){

   $_SESSION['status'] = $status;
   header('Location'.$url);
   exit();
}


function alertMessage(){

    if(isset($_SESSION['status'])){
     echo   '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.$_SESSION['status'].'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['status']);
    }


}






?>