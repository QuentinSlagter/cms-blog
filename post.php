<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php  

            // Clicking on Post Title and Opening up the Full Post with catching the ID in the Database
            if(isset($_GET['p_id'])) {
                $displaying_full_post_with_id = escape($_GET['p_id']);
            
            // Adding a view counter on posts
            $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $displaying_full_post_with_id ";
            $send_query = mysqli_query($connection,$view_query);
            
            $query = "SELECT * FROM posts WHERE post_id = $displaying_full_post_with_id";
            $select_all_posts_query = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($select_all_posts_query)) {

                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

                    ?>

                <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>

                <?php }

                } else {
                    header("Location: index.php");
                }
                
                ?>

            <!-- Blog Comments -->

            <?php 
            
            if(isset($_POST['create_comment'])) {

                $displaying_full_post_with_id = escape($_GET['p_id']);
                $comment_author = escape($_POST['comment_author']);
                $comment_email = escape($_POST['comment_email']);
                $comment_content = escape($_POST['comment_content']);

                // Alerting user that fields cannot be blank
                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES($displaying_full_post_with_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                $create_comment_query = mysqli_query($connection, $query);
                    if(!$create_comment_query) {
                        die('QUERY FAILED' . mysqli_error($connection));
                    }

                $update_comment_count = mysqli_query($connection, $query);
                    } else {
                        echo "<script>alert('Fields cannot be empty')</script>";
                    }
                    // Allowing user to see the post was updated and to allow them to navigate to that post or continue editing other posts
                    echo "<p class='bg-success'>Comment Submitted! The comment will be displayed after being reviewed by admin</p>";
                }

            ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                            <label for="comment_author">Name</label>
                            <input class="form-control" type="text" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input class="form-control" type="email" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php 
                
                // Grabbing the ID in the URL
                if(isset($_GET['p_id'])) {
                    $p_id = escape($_GET['p_id']);
                }

                // Only Show Comments that have been Approved
                $query = "SELECT * FROM comments WHERE comment_post_id = {$p_id} AND comment_status = 'approved' ORDER BY comment_id DESC ";
                $select_comment_query = mysqli_query($connection,$query);
                if(!$select_comment_query) {
                    die('Query Failed' . mysqli_error($connection));   
                }

                while($row = mysqli_fetch_array($select_comment_query)) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];

                ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
            
                <?php } ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>