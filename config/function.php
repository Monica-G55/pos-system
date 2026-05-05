<?php

session_start();


require 'dbcon.php';


function validate($inputData){

    global $con;
    $validatedData = mysqli_real_escape_string($con,$inputData);
    return trim($validatedData);
}


function redirect($url,$status){

   $_SESSION['status'] = $status;
   header('Location:'. $url);
   exit(0);
}


function alertMessage(){

    if(isset($_SESSION['status'])){
     echo   '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.$_SESSION['status'].'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['status']);
    }

}

function insert($tableName, $data){

  global $con;

  $table = validate($tableName);

  $columns = array_keys($data);
  $values = array_values($data);

  $finalColumn= implode(',',$columns);
  $finalValues="'".implode("','",$values)."'";

  $query = "INSERT Into $table ($finalColumn) values ($finalValues)";

  $result=mysqli_query($con,$query);
  return $result;
}

function getAll($tableName,$status = NULL){

 global $con;

 $table = validate($tableName);
 $status = validate($status);

 if($status == 'status'){
    $query="SELECT * from $table where status = '0'";
 }else{
    $query="SELECT * from $table";
 }

 return mysqli_query($con,$query);


}








?>