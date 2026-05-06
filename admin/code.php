<?php

include('../config/function.php');

if(isset($_POST['saveAdmin'])){
    $name= validate($_POST['name']);
    $email= validate($_POST['email']);
    $password= validate($_POST['password']);
    $phone= validate($_POST['phone']);
    $is_ban= isset($_POST['is_ban']) == true ? 1:0;

    if($name != '' && $email != '' && $password !=''){
        $emailcheck = mysqli_query($con,"SELECT * FROM admin where email='$email'");
        if($emailcheck){
            if(mysqli_num_rows($emailcheck)>0){
                redirect('admin-create.php','Email is already Exists Use Another Email');
            }

            $bycrypt_password = password_hash($password,PASSWORD_BCRYPT);

            $data =[
                'name'=>$name,
                'email'=>$email,
                'password'=>$bycrypt_password,
                'phone'=>$phone,
                'is_ban'=>$is_ban
            ];

            $result = insert('admin',$data);
            

            if($result){
                redirect('admin.php','Admin Created Successfully!');
            }else{
                redirect('admin-create.php','Somethig Went Wrong!');
            }
        }
    }else{
        redirect('admin-create.php','Please Fill The Required Fields');
    }
}

if(isset($_POST['updateAdmin'])){

  $adminId = validate($_POST['adminId']);

    $adminData = getById('admin',$adminId);

    $name= validate($_POST['name']);
    $email= validate($_POST['email']);
    $password= validate($_POST['password']);
    $phone= validate($_POST['phone']);
    $is_ban= isset($_POST['is_ban']) == true ? 1:0;


     if($password != ''){
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

       if($result){
            redirect('admin.php','Admin Updated Successfully!');
        } else {
            redirect('admin-edit.php?id='.$adminId,'Something went wrong!');
        }
    } else {
        redirect('admin-edit.php?id='.$adminId,'Please fill required fields!');
    }


?>