<?php


require '../config/function.php';

if(isset($_GET['id'])){

    $id = validate($_GET['id']);

    $query = "DELETE FROM customer WHERE id='$id'";
    $result = mysqli_query($con, $query);

    if($result){
        redirect('customer.php', 'Customer Deleted Successfully!');
    } else {
        redirect('customer.php', 'Something went wrong!');
    }

} else {
    redirect('customer.php', 'Invalid Request!');
}


?>