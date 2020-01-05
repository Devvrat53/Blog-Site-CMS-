<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php

    if(isset($_POST['submit'])) {
        
        $username = $_POST['username'];
        $firstname = $_POST['user_firstname'];
        $lastname = $_POST['user_lastname'];
        $email = $_POST['user_email'];
        $password = $_POST['user_password'];

        /*
        if(username_exists($username)) {
            $message = "User exists!";
        }
        */
        
        /* Checking if fields are empty or not */
        if(!empty($username) && !empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)) {
            // Cleaning up the fields so as the hackers do not destroy our database
            $username = mysqli_real_escape_string($connection, $username);
            $firstname = mysqli_real_escape_string($connection, $firstname);
            $lastname = mysqli_real_escape_string($connection, $lastname);
            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);
            
            // Password hash is a new method to secure your PHP webpage rather than using salt
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

            /* After that go in the database and in 'users' table in the randSalt section, we encrypt our data by providing 22 char '$2y$10$iusesomecrazystrings22' */
            /*$query = "SELECT randSalt FROM users";
            $select_randSalt_query = mysqli_query($connection, $query);
            if(!$select_randSalt_query) {
                die("Query failed" . mysqli_error($connection));
            } */

            /* Encrypting the password */
            /*$row = mysqli_fetch_array($select_randSalt_query);
            $salt = $row['randSalt'];
            $password = crypt($password, $salt);
            */ 

            $query = "INSERT INTO users (username, user_firstname, user_lastname, user_email, user_password, user_role) VALUES('{$username}', '{$firstname}', '{$lastname}', '{$email}', '{$password}', 'subscriber')";
            $register_user_query = mysqli_query($connection, $query);
            if(!$register_user_query) {
                die("QUERY FAILED!" . mysqli_error($connection) . " " . mysqli_errno($connection));
            } else {
                echo "<script> alert('Your Registration is Completed!'); </script>";
            }
        }
       
    }
?>

<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>
<!-- Page Content -->
<div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                            </div>
                            <div class="form-group">
                                <label for="user_firstname" class="sr-only">Firstname</label>
                                <input type="text" name="user_firstname" id="firstname" class="form-control" placeholder="Enter your Firstname" required>
                            </div>
                            <div class="form-group">
                                <label for="user_lastname" class="sr-only">Lastname</label>
                                <input type="text" name="user_lastname" id="lastname" class="form-control" placeholder="Enter your Lastname" required>
                            </div>
                            <div class="form-group">
                                <label for="user_email" class="sr-only">Email</label>
                                <input type="email" name="user_email" id="email" class="form-control" placeholder="Eg : somebody@example.com" required>
                            </div>
                            <div class="form-group">
                                <label for="user_password" class="sr-only">Password</label>
                                <input type="password" name="user_password" id="key" class="form-control" placeholder="Password" required>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

    <hr>

<?php include "includes/footer.php";?>