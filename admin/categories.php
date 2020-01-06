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
                        Welcome 
                        <small><?php echo $_SESSION['firstname']; ?></small> <!--session code in 'login.php' file --> 
                    </h1>

                    <!-- Form -->
                    <div class="col-xs-6">

                        <?php
                            //Also functions.php is included in 'admin_header.php' file so no need to import it here again.
                            insert_category(); //code in 'functions.php' file
                        ?>

                        <!-- Adding Categories -->
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="Cat-title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                        <?php
                            //Note: This code does not executes as edit function in update_categories.php file doesn't run and cannot detect the edit command
                            update_category(); //code in 'functions.php'
                            //include "includes/update_categories.php";
                        ?>

                    </div>

                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Category Title </th>
                                    <?php
                                        if(is_admin($_SESSION['username'])){
                                            echo "<th> Delete </th>";
                                            echo "<th> Edit </th>";
                                        }
                                    ?>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    //find all categories query
                                    find_category(); //code written in 'functions.php'
                                ?>

                                <?php
                                   delete_category(); //code in 'functions.php'
                                ?>
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
</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>