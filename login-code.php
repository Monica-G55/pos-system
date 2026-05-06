<?php
include('config/function.php');

if(isset($_POST['loginBtn'])){

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if($email != '' && $password != ''){

        $query = "SELECT * FROM admin WHERE email='$email' LIMIT 1";
        $result = mysqli_query($con, $query);
if($result){
        if(mysqli_num_rows($result) == 1){

            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];

            if($row['is_ban']== 1){
                redirect('login.php','Your account has been banned. Contact Your Admin');
            }
            
            if(!password_verify($password, $hashedPassword)){
                redirect('login.php','Invalid Passoword');
            }
            
                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] =[
                    'user_id'=> $row['id'],
                    'name'=>$row['name'],
                    'email'=>$row['email'],
                    'phone'=>$row['phone'],
                ];

                redirect('admin/index.php','Login Successfull');

            } else {
                redirect('login.php','Invalid Email');

            }

        } else {
            redirect('login.php','Invalid Email');
        }

    } else {
        redirect('login.php','Something Went Wrong');
    }
}
?>