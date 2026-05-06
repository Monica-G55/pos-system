<?php


require '../config/function.php';

if(isset($_GET['id'])){

    $id = validate($_GET['id']);

    $query = "DELETE FROM admin WHERE id='$id'";
    $result = mysqli_query($con, $query);

    if($result){
        redirect('admin.php', 'Admin Deleted Successfully!');
    } else {
        redirect('admin.php', 'Something went wrong!');
    }

} else {
    redirect('admin.php', 'Invalid Request!');
}


?>