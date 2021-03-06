<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin_index.php">P.O.P Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <!-- <li><a href="">Users Online: <span class="usersOnline"></span></a></li> -->
                <li><a href="../index.php">Home Page</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="admin_index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-book"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="posts.php">View Posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Add Posts</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Only Admins with full priviledges have access to categories. Categories will not display for regular authors -->
                    <?php 
                    if(isset($_SESSION['user_role'])) {
                        if($_SESSION['user_role'] == 'admin') {
                    
                    echo "
                    <li>
                        <a href='/admin/admin_categories.php'><i class='fa fa-fw fa-folder'></i> Categories</a>
                    </li>
                    
                    "; 
                    } } ?>
                    <li class="">
                        <a href="comments.php"><i class="fa fa-fw fa-comment"></i> Comments</a>
                    </li>
                    <!-- Only Admins with full priviledges have access to users. Users will not display for regular authors -->
                    <?php 
                    if(isset($_SESSION['user_role'])) {
                        if($_SESSION['user_role'] == 'admin') {
                    
                    echo "
                    <li>
                        <a href='javascript:;' data-toggle='collapse' data-target='#demo'><i class='fa fa-fw fa-users'></i> Users <i class='fa fa-fw fa-caret-down'></i></a>
                        <ul id='demo' class='collapse'>
                            <li>
                                <a href='users.php'>View All Users</a>
                            </li>
                            <li>
                                <a href='users.php?source=add_user'>Add User</a>
                            </li>
                        </ul>
                    </li>
                    ";
                    } } ?>
                    <li>
                        <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>