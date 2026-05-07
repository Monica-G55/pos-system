<?php include('includes/header.php'); ?>

  <div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Customers
                <a href="customer-create.php" class="btn btn-primary float-end">Add Customer</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
             <?php 
                    $customer = getAll('customer');
                    if(mysqli_num_rows($customer) > 0)
                        {
                    ?>
             <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                   <tbody>               
                    <?php foreach($customer as $customerItem) : ?>
                    <tr>
                        <td><?= $customerItem['id'] ?></td>
                        <td><?= $customerItem['name'] ?></td>
                        <td><?= $customerItem['email'] ?></td>
                        <td><?= $customerItem['phone'] ?></td>
                        <td>
                            <?php
                               if($customerItem['status']==1){
                                   echo '<span class="badge bg-danger">Hidden</span>';
                               }else{
                                   echo '<span class="badge bg-primary">Visible</span>';

                               }
                            ?>
                        </td>
                        <td>
                            <a href="customer-edit.php?id=<?= $customerItem['id']?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="customer-delete.php?id=<?= $customerItem['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>               
                   </tbody>
                </table>
                 <?php
                    }
                    else
                        {
                        ?>
                        <tr>
                            <td colspan="4">No Record Found</td>
                        </tr>   
                        <?php
                    }
                    ?>
             </div>
        </div>
    </div>
  

  <?php include('includes/footer.php'); ?>