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
                $the_post_author = escape($_GET['author']);
            }
            
            $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}'";
            $select_all_posts_query = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($select_all_posts_query)) {

                    $post_title = escape($row['post_title']);
                    $post_author = escape($row['post_author']);
                    $post_date = escape($row['post_date']);
                    $post_image = escape($row['post_image']);
                    $post_content = escape($row['post_content']);
                    $post_status = escape($row['post_status']);

                    // Displaying only Posts that have been Published
                    if($post_status == 'published') {
                    ?>

                <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->

                <!-- First Blog Post -->
                <h1 class="page-header">All Posts by <?php echo $post_author ?></h1>
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <?php echo $post_author ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>

                <?php } } ?>

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
                // Updating Comment Count
                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = {$displaying_full_post_with_id} ";

                $update_comment_count = mysqli_query($connection, $query);
                    } else {
                        echo "<script>alert('Fields cannot be empty')</script>";
                    }
                    // Allowing user to see the post was updated and to allow them to navigate to that post or continue editing other posts
                    echo "<p class='bg-success'>Comment Submitted! The comment will be displayed after being reviewed by admin</p>";
                }

            ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>