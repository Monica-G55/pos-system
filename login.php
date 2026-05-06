<?php include('includes/header.php'); 

 if(isset($_SESSION['loggedIn'])){
    ?>
    <script>window.location.href='index.php';</script>
    <?php

 }



?>

<div class="py-5">
    <div class="container mt-5">
                    <?php alertMessage(); ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <div class="card shadow rounded-4">
                   
                    <div class="p-5">
                        <h4 class="text-dark mb-3">Admin Login</h4>
                        <form action="login-code.php" method="post">
                            <div class="mb-3">
                                <label for="">Enter Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Enter Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="my-3">
                                <button type="submit" name="loginBtn"class="btn btn-primary">Log In</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>









<?php include('includes/footer.php'); ?>