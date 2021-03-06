<?php 

  if(isset($_GET['p_id'])) {
    $editing_post_id = escape($_GET['p_id']);
  }

  // Selecting Individual Posts from the Database
  $query = "SELECT * FROM posts WHERE post_id = {$editing_post_id}";
  $select_posts_by_id = mysqli_query($connection,$query);

  while($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_views_count = $row['post_views_count'];
  }

  if(isset($_POST['update_post'])) {
    $post_title = escape($_POST['post_title']);
    $post_author = escape($_POST['post_author']);
    $post_category_id = escape($_POST['post_category']);
    $post_status = escape($_POST['post_status']);
    $post_image = escape($_FILES['image']['name']);
    $post_image_temp = escape($_FILES['image']['tmp_name']);
    $post_content = escape($_POST['post_content']);
    $post_tags = escape($_POST['post_tags']);

    // Moving New Image into Images Folder
    move_uploaded_file($post_image_temp, "../images/$post_image");

    // If Image Field is left Blank Reinsert the Image from the Original Post
    if(empty($post_image)) {
      $query = "SELECT * FROM posts WHERE post_id = $editing_post_id";
      $select_image = mysqli_query($connection,$query);
      while($row = mysqli_fetch_array($select_image)) {
        $post_image = $row['post_image'];
      }
    }
    
    
    // Sending Updated Post Information into the Database
    $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = {$post_category_id}, post_date = now(), post_author = '{$post_author}', post_status = '{$post_status}', post_tags = '{$post_tags}', post_content = '{$post_content}', post_image = '{$post_image}' WHERE post_id = {$editing_post_id}";
    
    $update_post_query = mysqli_query($connection, $query);

    confirm_query($update_post_query);

    // $reset_views_query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$editing_post_id}";
    // $update_views_query = mysqli_query($connection, $update_views_query);

    // Allowing user to see the post was updated and to allow them to navigate to that post or continue editing other posts
    echo "<p class='bg-success'>Post Updated! <a href='../post.php?p_id={$editing_post_id}'>View Post</a> or <a href='posts.php'>Edit Other Posts</a></p>";
  }

?>

<!-- Edit Form for Updating Posts in the Database -->
<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Post Title</label>
    <input class="form-control" value="<?php echo $post_title; ?>" type="text" name="post_title">
  </div>
  <label for="post_category">Post Category</label>
  <div class="form-group">
    <select name="post_category" id="post_category">
      <!-- Selecting Categories that have been Created -->
      <?php 
      
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection,$query);

    confirm_query($select_categories);

    while($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<option value='{$cat_id}'>{$cat_title}</option>";
    }
      
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="post_author">Post Author</label>
    <input class="form-control" value="<?php echo $post_author; ?>" type="text" name="post_author">
  </div>
  <label for="post_status">Post Status</label>
  <div class="form-group">
    <select name="post_status" id="">
    
    <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
      
      <!-- Changing the Post Status on the Edit Post Page -->
      <?php 
      
      if($post_status == 'published') {
        echo "<option value='draft'>draft</option>";
      } else {
        echo "<option value='published'>published</option>";
      }

      ?>
    </select>
  </div>
  <label for="post_image">Post Image</label>
  <div class="form-group">
    <!-- Changing the Original Image and Displaying the Updated Image -->
    <img width="100" src="../images/<?php echo $post_image; ?>" alt="image">
    <input class="form-control" value="<?php echo $post_image; ?>" type="file" name="image">
  </div>
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input class="form-control" value="<?php echo $post_tags; ?>" type="text" name="post_tags">
  </div>
  <div class="form-group">
    <label for="post_views_count">Current Post Views: <?php echo $post_views_count; ?></label>
    <br>
    <!-- Button that requires confirmation before resetting views on a post and then updating it in the databse -->
    <?php echo "<button name='resetButton' onClick=\"javascript: return confirm('Are you sure you want to reset the views'); \" >Reset View Count</button>";

    if(isset($_POST['resetButton'])) {

    $reset_views_query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$editing_post_id}";
    $update_views_query = mysqli_query($connection, $reset_views_query);

    // Reload the current URL, so the user sees the updated view count
    header("Refresh:0");
    }
    ?>
  </div>
  <div class="form-group">
    <label for="summernote">Post Content</label>
    <!-- Be careful to not leave any spaces on the textarea, otherwise it will save additional unwanted spaces -->
    <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo $post_content; ?></textarea>
  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
  </div>
</form>