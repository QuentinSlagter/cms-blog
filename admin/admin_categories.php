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
                        <div class="col-xs-6">
                          <!-- Adding Category Form -->

                          <!-- Category Validation and Submission into the Database -->
                          <?php insert_categories(); ?>

                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="cat_title">Category Title</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                          <!-- Update and include edit category input onto the page -->
                          <?php 
                          
                            if(isset($_GET['edit'])) {
                              $cat_id = $_GET['edit'];
                              include "includes/update_categories.php";
                            }
                          
                          ?>

                        </div>
                        <!-- Category Table -->

                        <div class="col-xs-6">
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                              </tr>
                            </thead>
                            <tbody>

                            <!-- Updating the ID and Category Title in the Table -->
                            <?php find_all_categories(); ?>

                            <!-- Deleting Category from the Database -->
                            <?php delete_categories(); ?>

                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>
