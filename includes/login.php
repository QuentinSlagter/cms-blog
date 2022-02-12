<?php ob_start(); ?>
<?php include "db.php"; ?>
<?php session_start(); ?>

<?php 

if(isset($_POST['login'])) {
  $username = $_POST['user_username'];
  $password = $_POST['user_password'];

  // Protecting Input Fields from Hackers
  $username = mysqli_real_escape_string($connection, $username );
  $password = mysqli_real_escape_string($connection, $password );

  // Checking if the User is in the Database
  $query = "SELECT * FROM users WHERE user_username = '{$username}' ";
  $select_user_query = mysqli_query($connection, $query);
  if(!$select_user_query) {
    die("QUERY FAILED" . mysqli_error($connection));
  }
  
  while($row = mysqli_fetch_array($select_user_query)) {
    $db_id = $row['user_id'];
    $db_user_username = $row['user_username'];
    $db_user_password = $row['user_password'];
    $db_user_firstName = $row['user_firstName'];
    $db_user_lastName = $row['user_lastName'];
    $db_user_role = $row['user_role'];
  }

  // Checking if Username and Password are correct to Login into Admin, otherwise it keeps the person on the Index page
  if($username === $db_user_username && $password === $db_user_password) {
    $_SESSION['username'] = $db_user_username;
    $_SESSION['firstName'] = $db_user_firstName;
    $_SESSION['lastName'] = $db_user_lastName;
    $_SESSION['user_role'] = $db_user_role;

    header("Location: ../admin/admin_index.php ");

  } else {
    header("Location: ../index.php ");
  }
}

?>