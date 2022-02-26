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

$query = "SELECT * FROM comments" ;
$select_comments = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($select_comments)) {
  $comment_id = escape($row['comment_id']);
  $comment_post_id = escape($row['comment_post_id']);
  $comment_author = escape($row['comment_author']);
  $comment_content = escape($row['comment_content']);
  $comment_email = escape($row['comment_email']);
  $comment_status = escape($row['comment_status']);
  $comment_date = escape($row['comment_date']);


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
    $post_id = escape($row['post_id']);
    $post_title = escape($row['post_title']);

    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
  }

  echo "<td>$comment_date</td>";
  echo "<td><a href='comments.php?approved={$comment_id}'>Approve</a></td>";
  echo "<td><a href='comments.php?unapproved={$comment_id}'>Unapprove</a></td>";
  // Javascript confirmation popup asking user if they are sure they want to delete the item
  echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='comments.php?delete={$comment_id}'>Delete</a></td>";
echo "</tr>";
}

?>

<?php 

// Approving Comments added to a Post
if(isset($_GET['approved'])) {
  $approve_comment_id = escape($_GET['approved']);
  $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approve_comment_id ";
  $approve_query = mysqli_query($connection, $query);
  header("Location: comments.php");
}

// Unapproving Comments added to a Post
if(isset($_GET['unapproved'])) {
  $unapprove_comment_id = escape($_GET['unapproved']);
  $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $unapprove_comment_id ";
  $unapprove_query = mysqli_query($connection, $query);
  header("Location: comments.php");
}

// Deleting Comments from the View All Comments Table
if(isset($_GET['delete'])) {
  $delete_comment_id = escape($_GET['delete']);
  $query = "DELETE FROM comments WHERE comment_id = $delete_comment_id";
  $delete_query = mysqli_query($connection, $query);
  header("Location: comments.php");
}

?>


</tbody>
</table>