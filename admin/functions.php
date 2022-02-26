<?php 

// Cleaning up data so hackers cannot delete or modify any data
// function escape($string) {
//   global $connection;
//   return mysqli_real_escape_string($connection, trim($string));
// }

function confirm_query($result) {
  global $connection;
  if(!$result) {
    die("QUERY FAILED" . mysqli_error($connection));
  }
}

function insert_categories() {
  global $connection;
  if(isset($_POST['submit'])) {
    $cat_title = escape($_POST['cat_title']);

    if($cat_title == "" || empty($cat_title)) {
      echo "Category title cannot be blank";
    } else {
      $query = "INSERT INTO categories(cat_title)";
      $query .= "VALUE('{$cat_title}')";

      $create_category_query = mysqli_query($connection, $query);

      if(!$create_category_query) {
        die('QUERY FAILED' . mysqli_error($connection));
      }

    }
  }

}

function find_all_categories() {
  global $connection;
  $query = "SELECT * FROM categories" ;
    $select_all_categories = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_all_categories)) {
    $cat_id = escape($row['cat_id']);
    $cat_title = escape($row['cat_title']);

    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    // Javascript confirmation popup asking user if they are sure they want to delete the item
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='admin_categories.php?delete={$cat_id}'>Delete</a></td>";
    echo "<td><a href='admin_categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "</tr>";
    }
}

function delete_categories() {
  global $connection;
  if(isset($_GET['delete'])) {
    $delete_cat_id = escape($_GET['delete']);
    $query = "DELETE FROM categories WHERE cat_id = {$delete_cat_id}";

    $delete_query = mysqli_query($connection,$query);
    header("location: admin_categories.php");
  }
}

?>