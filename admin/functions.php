<?php 

// Grabbing the number of users online from the database
// function users_online() {
  
//   if(isset($_GET['onlineusers'])) {
//     global $connection;
//     if(!$connection) {
//       session_start();
//       include("../includes/db.php");

//     $session = session_id();
//     $time = time();
//     $time_out_in_seconds = 3600;
//     $time_out = $time - $time_out_in_seconds;

//     $query = "SELECT * FROM users_online WHERE session = '$session'";
//     $send_query = mysqli_query($connection,$query);
//     $count = mysqli_num_rows($send_query);

//     if($count == NULL) {
//         mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session','$time')");
//     } else {
//         mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
//     }

//     $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
//     echo $count_user = mysqli_num_rows($users_online_query);
//     }
//   }
// }
// users_online();

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
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<tr>";
    echo "<td class='text-center'>{$cat_id}</td>";
    echo "<td class='text-center'>{$cat_title}</td>";
    // Javascript confirmation popup asking user if they are sure they want to delete the item
    echo "<td class='text-center'><a class='btn btn-info' href='admin_categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "<td class='text-center'><a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='admin_categories.php?delete={$cat_id}'>Delete</a></td>";
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

function username_exists($username) {
  global $connection;

  $query = "SELECT user_username FROM users WHERE user_username = '$username'";
  $results = mysqli_query($connection,$query);
  confirm_query($results);

  if(mysqli_num_rows($results) > 0) {
    return true;
  } else {
    return false;
  }
}

function email_exists($email) {
  global $connection;

  $query = "SELECT user_email FROM users WHERE user_email = '$email'";
  $results = mysqli_query($connection,$query);
  confirm_query($results);

  if(mysqli_num_rows($results) > 0) {
    return true;
  } else {
    return false;
  }
}

?>