<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>

<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Author</th>
      <th>Comment</th>
      <th>Email</th>
      <th>Status</th>
      <th>In Response to</th>
      <th>Date</th>
      <th>Approve</th>
      <th>Unapprove</th>
      <th>Delete</th>
    </tr>
  </thead>
<tbody>

<!-- Collect and Display All Comments in a Table -->
<?php 

$query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connection,$_GET['id'])."";
$select_comments = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($select_comments)) {
  $comment_id = $row['comment_id'];
  $comment_post_id = $row['comment_post_id'];
  $comment_author = $row['comment_author'];
  $comment_content = $row['comment_content'];
  $comment_email = $row['comment_email'];
  $comment_status = $row['comment_status'];
  $comment_date = $row['comment_date'];


echo "<tr>";
  echo "<td>$comment_id</td>";
  echo "<td>$comment_author</td>";
  echo "<td>$comment_content</td>";
  echo "<td>$comment_email</td>";
  echo "<td>$comment_status</td>";
  
  // Creating a Link to take you to the Post where the Comment was made
  $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
  $select_post_id_query = mysqli_query($connection,$query);

  while($row = mysqli_fetch_assoc($select_post_id_query)) {
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];

    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
  }

  echo "<td>$comment_date</td>";
  echo "<td><a href='view_post_comments.php?approved={$comment_id}&id=" . escape($_GET['id']) ."'>Approve</a></td>";
  echo "<td><a href='view_post_comments.php?unapproved={$comment_id}&id=" . escape($_GET['id']) ."'>Unapprove</a></td>";
  // Javascript confirmation popup asking user if they are sure they want to delete the item
  echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='view_post_comments.php?delete={$comment_id}&id=" . escape($_GET['id']) ."'>Delete</a></td>";
echo "</tr>";
}

?>

<?php 

// Approving Comments added to a Post
if(isset($_GET['approved'])) {
  $approve_comment_id = escape($_GET['approved']);
  $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approve_comment_id ";
  $approve_query = mysqli_query($connection, $query);
  header("Location: view_post_comments.php?id=" . escape($_GET['id']). "");
}

// Unapproving Comments added to a Post
if(isset($_GET['unapproved'])) {
  $unapprove_comment_id = escape($_GET['unapproved']);
  $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $unapprove_comment_id ";
  $unapprove_query = mysqli_query($connection, $query);
  header("Location: view_post_comments.php?id=" . escape($_GET['id']). "");
}

// Deleting Comments from the View All Comments Table
if(isset($_GET['delete'])) {
  $delete_comment_id = escape($_GET['delete']);
  $query = "DELETE FROM comments WHERE comment_id = $delete_comment_id";
  $delete_query = mysqli_query($connection, $query);
  header("Location: view_post_comments.php?id=" . escape($_GET['id']). "");
}

?>


</tbody>
</table>

</div>
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>