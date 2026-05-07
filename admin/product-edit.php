<?php include('includes/header.php'); ?>


  <div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Product
                <a href="product.php" class="btn btn-primary float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
             <form action="code.php" method="post" enctype="multipart/form-data">
                <?php
                 $productId = $_GET['id'];
                 $productData = getById('product',$productId);
                ?>
                <input type="hidden" name="productId" value="<?= $productData['data']['id']; ?>">
                   <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Select Category *</label>
                        <select name="category_id" class="form-select">
                            <option value="">Select Category</option>
                            <?php
                            $categories = getAll('category');
                            if(mysqli_num_rows($categories) > 0){
                                 foreach($categories as $categoryItem){

                                $selected = $productData['data']['category_id'] == $categoryItem['id'] ? 'selected' : '';

                                  echo'<option value="'.$categoryItem['id'].'"'.$selected.'>'.$categoryItem['name'].'</option>';
                                }
                            }else{
                                echo '<option value="">No Categories Found</option>';
                            }
                            
                            
                            ?>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name" required  value="<?= $productData['data']['name'];?>" class="form-control">
                    </div>
                     <div class="col-md-12 mb-3">
                        <label for="">Description *</label>
                        <textarea name="description"class="form-control" rows="3"><?= $productData['data']['description'];?></textarea>
                    </div>
                        <div class="col-md-4 mb-3">
                        <label for="">Price *</label>
                        <input type="text" name="price"  value="<?= $productData['data']['price'];?>" required class="form-control">
                    </div>
                      <div class="col-md-4 mb-3">
                        <label for="">Quantity *</label>
                        <input type="text" name="quantity" value="<?= $productData['data']['quantity'];?>"  required class="form-control">
                    </div>
                      <div class="col-md-4 mb-3">
                        <label for="">Image *</label>
                        <input type="file" name="image" class="form-control">
                        <img src="../<?= $productData['data']['image'];?>" style="width: 50px; height: 50px;" alt="img">
                    </div>
                      <div class="col-md-6">
                        <label>Status (Unchecked = Visible,Checked = Hidden)</label></br>
                        <input type="checkbox" name="status" <?= $productData['data']['status'] == 1 ? 'checked': '';?> class="form-check-input" style="width:30px; height:30px;">
                    </div>
                      <div class="col-md-6 mb-3 text-end">
                       <button type="submit" name="updateProduct" class="btn btn-primary">Update</button>
                    </div>
                   </div>
             </form>
        </div>
    </div>
  </div>

  <?php include('includes/footer.php'); ?>