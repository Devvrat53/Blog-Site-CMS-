<?php
    if(isset($_GET['edit_user'])){
        $the_user_id = $_GET['edit_user'];
        
        $query = "SELECT * FROM users WHERE user_id = $the_user_id";
        $select_users_query = mysqli_query($connection, $query);
                    
        while($row = mysqli_fetch_assoc($select_users_query)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }
    }

    if(isset($_POST['edit_user'])){
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        ///////////////// IMAGE /////////////////
        //$post_image = $_FILES['post_image']['name'];
        //this variable is created to save images in the temporary location
        //$post_image_temp = $_FILES['post_image']['tmp_name'];
        /////////////////////////////////////////
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        //$post_date = date('d-m-y');
        
        //Used to move image from it's temporary location
        //move_uploaded_file($post_image_temp, "../images/$post_image");
        /* Always go in the file to access the permission of the file using command 'sudo chown username file_name' */
        /*
        $query = "SELECT randSalt FROM users";
        $select_randSalt_query = mysqli_query($connection, $query);
        if(!$select_randSalt_query) {
            die("QUERY FAILED!" . mysqli_error($connection));
        }
        $row = mysqli_fetch_array($select_randSalt_query);
        $salt = $row['randSalt'];
        $hashed_password = crypt($user_password, $salt);
        */

        if(!empty($user_password)) {
            $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
            $get_user_query = mysqli_query($connection, $query);
            check_query($get_user_query);

            $row = mysqli_fetch_array($get_user_query);
            $db_user_password = $row['user_password'];

            if($db_user_password != $user_password) {
                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
            }
    
            //Updating the query
            $query = "UPDATE users SET ";
            //Concatinating with '.=' in every line as the query is too big
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "user_role = '{$user_role}', ";
            $query .= "username = '{$username}', ";
            $query .= "user_email = '{$user_email}', ";
            $query .= "user_password = '{$hashed_password}' ";
            $query .= "WHERE user_id = {$the_user_id} ";
            
            //Sending query
            $edit_user_query = mysqli_query($connection, $query);
            
            //Checking the query whether it's working properly or not
            check_query($edit_user_query);//code of this function in 'functions.php' file

            //javascript alert
            echo "<script> alert('User updated!');</script>";
        }
    }
?>

<!-- enctype is added in the form as we're going to upload the image -->
<form action="" method="post" enctype="multipart/form-data">
    <!-- Firstname -->
    <div class="form-group">
        <label for="user_firstname"> Firstname </label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>
    <!-- Lastname -->
    <div class="form-group">
        <label for="user_lastname"> Lastname </label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>
    <!-- User Role -->
    <div class="form-group">
        <select name="user_role" id="">
           <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
           <?php 
                if($user_role == 'admin'){
                    echo "<option value='subscriber'> Subscriber </option>";
                } else {
                    echo "<option value='admin'> Admin </option>";
                }
           ?>
        </select>
    </div>
    <!-- User Image -->
<!--    <div class="form-group">
        <label for="post_image"> User Image </label>
        <input type="file" name="user_image">
    </div>
-->
    <!-- Username -->
    <div class="form-group">
        <label for="username"> Username </label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>
    <!-- Email -->
    <div class="form-group">
        <label for="user_email"> Email </label>
        <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
    </div>
    <!-- Password -->
    <div class="form-group">
        <label for="user_password"> Password </label>
        <input autocomplete="off" type="password" class="form-control" name="user_password">
    </div>
    <!-- Submit -->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
    </div>
</form>