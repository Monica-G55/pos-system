<?php


require '../config/function.php';

if(isset($_GET['id'])){

    $id = validate($_GET['id']);

    $query = "DELETE FROM category WHERE id='$id'";
    $result = mysqli_query($con, $query);

    if($result){
        redirect('category.php', 'Category Deleted Successfully!');
    } else {
        redirect('category.php', 'Something went wrong!');
    }

} else {
    redirect('category.php', 'Invalid Request!');
}


?>