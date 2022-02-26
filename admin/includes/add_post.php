<?php 

// Posting Data from the Form to the Database
if(isset($_POST['create_post'])) {
  $post_title = escape($_POST['post_title']);
  $post_author = escape($_POST['post_author']);
  $post_category_id = escape($_POST['post_category']);
  $post_status = escape($_POST['post_status']);

  $post_image = escape($_FILES['image']['name']);
  $post_image_temp = escape($_FILES['image']['tmp_name']);
  
  $post_content = escape($_POST['post_content']);
  $post_tags = escape($_POST['post_tags']);
  $post_id = escape($_POST['post_id']);
  $post_date = escape(date('d-m-y'));

  move_uploaded_file($post_image_temp, "../images/$post_image");

  $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) VALUES($post_category_id,'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' ) ";

  $create_post_query = mysqli_query($connection, $query);

  confirm_query($create_post_query);

  // echo "Post Created: " . " " . "<a href='posts.php'>View Posts</a>";

  // Allowing user to see the post was created and to allow them to navigate to that post or view all other posts
  echo "<p class='bg-success'>Post Created! <a href='../post.php?p_id={$post_id}'>View Post</a> or <a href='posts.php'>View All Posts</a></p>";
}

?>

<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Post Title</label>
    <input class="form-control" type="text" name="post_title">
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
    <input class="form-control" type="text" name="post_author">
  </div>
  <label for="post_status">Post Status</label>
  <div class="form-group">
    <select name="post_status" id="">
      <option value="draft">Select Options</option>
      <option value="draft">Draft</option>
      <option value="published">Publish Post</option>
    </select>
  </div>
  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input class="form-control" type="file" name="image">
  </div>
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input class="form-control" type="text" name="post_tags">
  </div>
  <div class="form-group">
    <label for="summernote">Post Content</label>
    <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
  </div>
</form>