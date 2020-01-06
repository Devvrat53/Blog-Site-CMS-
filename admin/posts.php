<!-- Includes the header part of the HTML code -->
<?php include "includes/admin_header.php"; ?>
<!-- Includes the Database code which resides in parent directory -->
<?php include "../includes/db.php"; ?>

<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome <small><?php echo $_SESSION['firstname']; ?></small> <!--session code in 'login.php' file -->
                    </h1>
                        <?php
                            
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            } else {
                                $source = '';
                            }
                            switch($source){
                               case '1': echo "Nice 1";
                                        break;
                                case 'add_post': include "includes/add_post.php";
                                        break;
                                case 'edit_post': include "includes/edit_post.php";
                                        break;
                                default: include "includes/view_all_posts.php"; 
                                        break;
                                }
                            
                        ?>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>