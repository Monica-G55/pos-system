<?php include('includes/header.php'); ?>


  <div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Customer
                <a href="customer.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
             <form action="code.php" method="post">

            <?php
             if(isset($_GET['id'])){

                 if($_GET['id'] != ''){
                    $customerId = $_GET['id'];
                 }else{
                    echo "<h5>No ID Found</h5>";
                return false;
                 }
            
             }else{
                echo "<h5>No Record Found</h5>";
                return false;
             }
?>
            <?php
            $customerData = getById('customer',$customerId);   
            ?>
            <input type="hidden" name="customerId" value="<?= $customerData['data']['id']; ?>">
                   <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name" required  value="<?= $customerData['data']['name'];?>" class="form-control">
                    </div>
                     <div class="col-md-6 mb-3">
                        <label for="">Email *</label>
                        <input type="email" name="email" required value="<?= $customerData['data']['email'];?>" class="form-control">
                    </div>
                      <div class="col-md-6 mb-3">
                        <label for="">Phone Number *</label>
                        <input type="number" name="phone" required value="<?= $customerData['data']['phone'];?>" class="form-control">
                    </div>
                      <div class="col-md-6">
                        <label>Status (Unchecked = Visible,Checked = Hidden)</label></br>
                        <input type="checkbox" name="status" <?= $customerData['data']['status'] == 1 ? 'checked': '';?> class="form-check-input" style="width:30px; height:30px;">
                    </div>
                      <div class="col-md-12 mb-3 text-end">
                       <button type="submit" name="updateCustomer" class="btn btn-primary">Update</button>
                    </div>
                   </div>
             </form>
        </div>
    </div>
  </div>

  <?php include('includes/footer.php'); ?>