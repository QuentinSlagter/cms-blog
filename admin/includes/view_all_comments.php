<?php
include("delete_modal.php");
?>

<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th class='text-center'>ID</th>
      <th class='text-center'>Author</th>
      <th class='text-center'>Comment</th>
      <th class='text-center'>Email</th>
      <th class='text-center'>Status</th>
      <th class='text-center'>In Response to</th>
      <th class='text-center'>Date</th>
      <th class='text-center'>Approve</th>
      <th class='text-center'>Unapprove</th>
      <th class='text-center'>Delete</th>
    </tr>
  </thead>
<tbody>

<!-- Collect and Display All Comments in a Table -->
<?php 

$query = "SELECT * FROM comments";
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
  echo "<td class='text-center'>$comment_id</td>";
  echo "<td class='text-center'>$comment_author</td>";
  echo "<td class='text-center'>$comment_content</td>";
  echo "<td class='text-center'>$comment_email</td>";
  echo "<td class='text-center'>$comment_status</td>";
  
  // Creating a Link to take you to the Post where the Comment was made
  $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
  $select_post_id_query = mysqli_query($connection,$query);

  while($row = mysqli_fetch_assoc($select_post_id_query)) {
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];

    echo "<td class='text-center'><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
  }

  echo "<td class='text-center'>$comment_date</td>";
  echo "<td class='text-center'><a class='btn btn-success' href='comments.php?approved={$comment_id}'>Approve</a></td>";
  echo "<td class='text-center'><a class='btn btn-warning' href='comments.php?unapproved={$comment_id}'>Unapprove</a></td>";
  // Javascript confirmation popup asking user if they are sure they want to delete the item
  echo "<td class='text-center'><a class='btn btn-danger' rel='$comment_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
  // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='comments.php?delete={$comment_id}'>Delete</a></td>";
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

<script>

  $(document).ready(function() {
    $(".delete_link").on('click', function() {
      const id = $(this).attr("rel");
      const delete_url = "comments.php?delete=" + comment_id + "";
      $(".modal_delete_link").attr("href", delete_url);
      $("#myModal").modal('show');
    });
  });

</script>