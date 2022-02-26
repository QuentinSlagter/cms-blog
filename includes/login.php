<?php ob_start(); ?>
<?php include "db.php"; ?>
<?php session_start(); ?>

<?php 

if(isset($_POST['login'])) {
  $username = escape($_POST['user_username']);
  $password = escape($_POST['user_password']);

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
    $db_id = escape($row['user_id']);
    $db_user_username = escape($row['user_username']);
    $db_user_password = escape($row['user_password']);
    $db_user_firstName = escape($row['user_firstName']);
    $db_user_lastName = escape($row['user_lastName']);
    $db_user_role = escape($row['user_role']);
  }

  // Reversing the crypt function to recognize the initial password before being encrypted. It compares the orginial password and the encrypted password.
  $password = crypt($password, $db_user_password);

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