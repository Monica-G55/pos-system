<?php include('includes/header.php'); ?>


  <div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Category
                <a href="category.php" class="btn btn-primary float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
             <form action="code.php" method="post">
                <?php
                 $categoryId = $_GET['id'];
                 $categoryData = getById('category',$categoryId);
                ?>
                <input type="hidden" name="categoryId" value="<?= $categoryData['data']['id']; ?>">
                   <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name" required  value="<?= $categoryData['data']['name'];?>" class="form-control">
                    </div>
                     <div class="col-md-12 mb-3">
                        <label for="">Description *</label>
                        <textarea name="description"class="form-control" rows="3"><?= $categoryData['data']['description'];?></textarea>
                    </div>
                      <div class="col-md-6">
                        <label>Status (Unchecked = Visible,Checked = Hidden)</label></br>
                        <input type="checkbox" name="status" <?= $categoryData['data']['status'] == 1 ? 'checked': '';?> class="form-check-input" style="width:30px; height:30px;">
                    </div>
                      <div class="col-md-6 mb-3 text-end">
                       <button type="submit" name="updateCategory" class="btn btn-primary">Update</button>
                    </div>
                   </div>
             </form>
        </div>
    </div>
  </div>

  <?php include('includes/footer.php'); ?>