<?php
    if(isset($_POST['create_user'])){
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
        
        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

        //In VALUES, '{}' is written when it's a string. As $post_category_id is a number, no '' are put there
        $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) VALUES('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$username}', '{$user_email}','{$user_password}')";
      
        //making the query
        $create_user_query = mysqli_query($connection, $query);
        
        //calling the function to check if everything is working or not
        check_query($create_user_query);
        //javascript to alert the user that the user has been added
        echo "<script> alert('User Created!');</script>";
    }
?>

<!-- enctype is added in the form as we're going to upload the image -->
<form action="" method="post" enctype="multipart/form-data">
    <!-- Firstname -->
    <div class="form-group">
        <label for="user_firstname"> Firstname </label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <!-- Lastname -->
    <div class="form-group">
        <label for="user_lastname"> Lastname </label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <!-- User Role -->
    <div class="form-group">
        <select name="user_role" id="">
           <option value="subscriber"> Select Options </option>
            <option value="admin"> Admin </option>
            <option value="subscriber"> Subscriber </option>
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
        <input type="text" class="form-control" name="username">
    </div>
    <!-- Email -->
    <div class="form-group">
        <label for="user_email"> Email </label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <!-- Password -->
    <div class="form-group">
        <label for="user_password"> Password </label>
        <input type="password" class="form-control" name="user_password">
    </div>
    <!-- Submit -->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>