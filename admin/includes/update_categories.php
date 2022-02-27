<form action="" method="POST">
<div class="form-group">
    <label for="cat_title">Edit Category</label>

    <!-- Editing the Category Title in the Database -->
    <?php

    If(isset($_GET['edit'])) {

    $edit_cat_id = escape($_GET['edit']);
    
    $query = "SELECT * FROM categories WHERE cat_id = {$edit_cat_id}";
    $select_all_categories_id = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_all_categories_id)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    
    ?>

    <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" class= "form-control" name= "cat_title">

    <?php }} ?>

    <!-- Update query -->
    <?php 
    
    if(isset($_POST['update_catergory'])) {
      $edit_cat_title = escape($_POST['cat_title']);
      $query = "UPDATE categories SET cat_title = '{$edit_cat_title}' WHERE cat_id = {$edit_cat_id}";

      $update_query = mysqli_query($connection,$query);
        if(!$update_query) {
          die("Query FAILED" . mysqli_error($connection));
        }
    }
    
    ?>
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_catergory" value="Update Category">
</div>
</form>