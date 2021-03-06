<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4 class="text-center">Blog Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form> <!-- Search form -->
    <!-- /.input-group -->
</div>

<!-- Login -->
<div class="well">

    <!-- Allowing Admin to logout on the homepage -->
    <?php if(isset($_SESSION['user_role'])): ?>
        <h4 class="text-center">Currently logged in as: </h4>
        <h1 class="text-center"><?php echo $_SESSION['username'] ?></h1>
        <div class="text-center">
        <a href="includes/logout.php" class="btn btn-primary">Logout</a>
        </div>
    <?php else: ?>
        
        <!-- Normal Login page -->
        <h4 class="text-center">Login</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input name="user_username" type="text" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <input name="user_password" type="password" class="form-control" placeholder="Enter Password">
            </div>
                <div class="form-group">
                    <span class="input-group-btn">
                        <button class="btn btn-primary form-control" name="login" type="submit">Login</button>
                    </span>
                </div>
                <div class="form-group text-center">
                    <a href="forgot_password.php?forgot=<?php echo uniqid(true); ?>">Forgot Password</a>
                </div>
        </form>
        <!-- /.input-group -->

    <?php endif; ?>
    </div>


<!-- Blog Categories Well -->
<div class="well">

    <?php 
    
    $query = "SELECT * FROM categories" ;
    $select_all_categories_sidebar = mysqli_query($connection,$query);
    
    ?>

    <h4 class="text-center">Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">

            <?php 
            while($row = mysqli_fetch_assoc($select_all_categories_sidebar)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
            }
            ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
        <!-- <div class="col-lg-6">
            <ul class="list-unstyled">
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
            </ul>
        </div> -->
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "widget.php"; ?>

</div>
