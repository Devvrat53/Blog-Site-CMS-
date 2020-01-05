<?php include "db.php"; ?>
<?php session_start(); ?>

<?php
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        /* This is done in order to safeguard our database with various malicious escape string characters that hackers use to harm our database */
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        
        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_user_query = mysqli_query($connection, $query);
        
        //Checking if connection is established or not!
        if(!$select_user_query) {
            die("QUERY FAILED!" . mysqli_error($connection));
        }
        
        while($row = mysqli_fetch_array($select_user_query)) {
            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
        }
        
        /* Decrypting the password while logging into our system */
        //$password = crypt($password, $db_user_password);

        //if($username === $db_username && $password === $db_user_password) {
        if(password_verify($password, $db_user_password)) {
            // Setting up the session  
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            //Redirecting to admin page
            header("Location: ../admin");
        } else {
            header("Location: ../index.php"); //refreshing the page
        }
    }
?>