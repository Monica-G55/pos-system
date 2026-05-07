<?php

include('../config/function.php');

if (isset($_POST['saveAdmin'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;

    if ($name != '' && $email != '' && $password != '') {
        $emailcheck = mysqli_query($con, "SELECT * FROM admin where email='$email'");
        if ($emailcheck) {
            if (mysqli_num_rows($emailcheck) > 0) {
                redirect('admin-create.php', 'Email is already Exists Use Another Email');
            }

            $bycrypt_password = password_hash($password, PASSWORD_BCRYPT);

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $bycrypt_password,
                'phone' => $phone,
                'is_ban' => $is_ban
            ];

            $result = insert('admin', $data);


            if ($result) {
                redirect('admin.php', 'Admin Created Successfully!');
            } else {
                redirect('admin-create.php', 'Somethig Went Wrong!');
            }
        }
    } else {
        redirect('admin-create.php', 'Please Fill The Required Fields');
    }
}

if (isset($_POST['updateAdmin'])) {

    $adminId = validate($_POST['adminId']);

    $adminData = getById('admin', $adminId);

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;


    if ($password != '') {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $passwordQuery = "password='$hashedPassword',";
    } else {
        $passwordQuery = "";
    }

    $query = "UPDATE admin SET 
                    name='$name',
                    email='$email',
                    $passwordQuery
                    phone='$phone',
                    is_ban='$is_ban'
                  WHERE id='$adminId'";

    $result = mysqli_query($con, $query);

    if ($result) {
        redirect('admin.php', 'Admin Updated Successfully!');
    } else {
        redirect('admin-edit.php?id=' . $adminId, 'Something went wrong!');
    }
}

if (isset($_POST['saveCategory'])) {
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    $data = [
        'name' => $name,
        'description' => $description,
        'status' => $status
    ];

    $result = insert('category', $data);

    if ($result) {
        redirect('category.php', "Category Created Successfully");
    } else {
        redirect('category.php', 'Something Went Wrong!');
    }
}

if (isset($_POST['updateCategory'])) {

    $categoryId = validate($_POST['categoryId']);

    $categoryData = getById('category', $categoryId);

    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) ? 1 : 0;

    $query = "UPDATE category SET 
                    name='$name',
                    description='$description',
                    status='$status'
                    WHERE id='$categoryId'";

    $result = mysqli_query($con, $query);

    if ($result) {
        redirect('category.php', 'Category Updated Successfully!');
    } else {
        redirect('edit-category.php?id=' . $categoryId, 'Something went wrong!');
    }
}

if (isset($_POST['saveProduct'])) {

    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    $status = isset($_POST['status']) == true ? 1 : 0;


    if ($_FILES['image']['size'] > 0) {

        $path = '../assets/uploads/products/';

        $img_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $filename = time() . '.' . $img_extension;

        move_uploaded_file($_FILES['image']['tmp_name'], $path . $filename);

        $finalImage = 'assets/uploads/products/' . $filename;
    } else {
        $finalImage = '';
    }
    $data = [
        'category_id' => $category_id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'image' => $finalImage,
        'status' => $status
    ];

    $result = insert('product', $data);

    if ($result) {
        redirect('product.php', "Product Created Successfully");
    } else {
        redirect('product.php', 'Something Went Wrong!');
    }
}

if (isset($_POST['updateProduct'])) {

    $productId = validate($_POST['productId']);

    $productData = getById('product', $productId);

    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    $status = isset($_POST['status']) == true ? 1 : 0;


    if ($_FILES['image']['size'] > 0) {

        $path = '../assets/uploads/products/';

        $img_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $filename = time() . '.' . $img_extension;

        move_uploaded_file($_FILES['image']['tmp_name'], $path . $filename);

        $finalImage = 'assets/uploads/products/' . $filename;
    } else {
        $finalImage = '';
    }
    $query = "UPDATE product SET 
                    category_id='$category_id',
                    name='$name',
                    description='$description',
                    price='$price',
                    quantity='$quantity',
                    status='$status',
                    image='$finalImage'
                    WHERE id='$productId'";

    $result = mysqli_query($con, $query);

    if ($result) {
        redirect('product.php', 'Product Updated Successfully!');
    } else {
        redirect('product-edit.php?id=' . $productId, 'Something went wrong!');
    }
}
if (isset($_POST['saveCustomer'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $status = isset($_POST['status']) == true ? 1 : 0;

  $emailcheck = mysqli_query($con, "SELECT * FROM customer where email='$email'");
        if ($emailcheck) {
            if (mysqli_num_rows($emailcheck) > 0) {
                redirect('customer-create.php', 'Email is already Exists Use Another Email');
            }
        }
    $data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'status' => $status
    ];

    $result = insert('customer', $data);

    if ($result) {
        redirect('customer.php', "Customer Created Successfully");
    } else {
        redirect('customer.php', 'Something Went Wrong!');
    }
}

if (isset($_POST['updateCustomer'])) {

    $customerId = validate($_POST['customerId']);

    $customerData = getById('customer', $customerId);

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    $query = "UPDATE customer SET 
                    name='$name',
                    email='$email',
                    phone='$phone',
                    status='$status'
                  WHERE id='$customerId'";

    $result = mysqli_query($con, $query);

    if ($result) {
        redirect('customer.php', 'Admin Updated Successfully!');
    } else {
        redirect('customer-edit.php?id=' . $customerId, 'Something went wrong!');
    }
}
