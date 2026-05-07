<?php


require '../config/function.php';

if(isset($_GET['id'])){

    $id = validate($_GET['id']);

    $query = "DELETE FROM product WHERE id='$id'";
    $result = mysqli_query($con, $query);

    if($result){
        redirect('product.php', 'Product Deleted Successfully!');
    } else {
        redirect('product.php', 'Something went wrong!');
    }

} else {
    redirect('product.php', 'Invalid Request!');
}


?>