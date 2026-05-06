<?php include('includes/header.php'); ?>

  <div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Admins/Staff
                <a href="admin-create.php" class="btn btn-primary float-end">Add Admin</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
             <?php 
                    $admin = getAll('admin');
                    if(mysqli_num_rows($admin) > 0)
                        {
                    ?>
             <div class="table-resposive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                   <tbody>               
                    <?php foreach($admin as $adminItem) : ?>
                    <tr>
                        <td><?= $adminItem['id'] ?></td>
                        <td><?= $adminItem['name'] ?></td>
                        <td><?= $adminItem['email'] ?></td>
                        <td>
                            <a href="admin-edit.php?id=<?= $adminItem['id']?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="admin-delete.php?id=<?= $adminItem['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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
  </div>

  <?php include('includes/footer.php'); ?>