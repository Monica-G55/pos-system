<?php

include('../config/function.php');

if(!isset($_SESSION['productItems'])){
    $_SESSION['productItems'] = [];
}

if(!isset($_SESSION['productItemsId'])){
    $_SESSION['productItemsId'] = [];
}

if(isset($_POST['addItem'])){

    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);

    $checkProduct = mysqli_query($con, "SELECT * FROM product WHERE id='$productId' LIMIT 1");

    if($checkProduct){

        if(mysqli_num_rows($checkProduct) > 0){

            $row = mysqli_fetch_assoc($checkProduct);

            if($row['quantity'] < $quantity){

                redirect('order-create.php', 'Only '.$row['quantity'].' quantity available!');
            }

            $productData = [
                'product_id' => $row['id'],
                'name'       => $row['name'],
                'image'      => $row['image'],
                'price'      => $row['price'],
                'quantity'   => $quantity 
            ];

            // First time add
            if(!in_array($row['id'], $_SESSION['productItemsId'])){

                array_push($_SESSION['productItemsId'], $row['id']);
                array_push($_SESSION['productItems'], $productData);

            }else{

                // Already exists in session
                foreach($_SESSION['productItems'] as $key => $prodSessionItem){

                    if($prodSessionItem['product_id'] == $row['id']){

                        $newQuantity = $prodSessionItem['quantity'] + $quantity;

                        if($newQuantity > $row['quantity']){

                            redirect(
                                'order-create.php',
                                'Only '.$row['quantity'].' quantity available!'
                            );
                        }

                        $productData = [
                            'product_id' => $row['id'],
                            'name'       => $row['name'],
                            'image'      => $row['image'],
                            'price'      => $row['price'],
                            'quantity'   => $newQuantity
                        ];

                        $_SESSION['productItems'][$key] = $productData;
                    }
                }
            }

            redirect('order-create.php', 'Item Added '.$row['name']);

        }else{

            redirect('order-create.php', 'No Such Product Found');
        }

    }else{

        redirect('order-create.php', 'Something Went Wrong');
    }

}else{

    redirect('order-create.php', 'Invalid Request');
}

?>