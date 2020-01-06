<?php

//////////////// For redirecting ///////////////////////
    function redirect($location) {
        header("Location: ". $location);
        exit;
    }

    ////////////////  ///////////////////////
    function ifItIsMethod($method = null) {
        if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
            return true;
        }
        return false;
    }

    ///////////////////// ///////////////////////
    function isLoggedIn(){
        if(isset($_SESSION['user_role'])) {
            return true;
        }
        return false; 
    }

    ///////////////////  ///////////////////////
    function checkIfUserIsLoggedInAndRedirect($redirectLocation = null) {
        if(isLoggedIn()) {
            redirect($redirectLocation);
        }
    }

////////////////////// Security //////////////////////////
    function escape($string){
        global $connection;
        mysqli_real_escape_string($connection, trim($string));
    }

//////////// Checking if everything is working fine or not /////////////
    function check_query($result){
        global $connection;
        if(!$result){
            die("QUERY FAILED!" . mysqli_error($connection));
        }
    }

///////////////////////// No. of Online Users/////////////////////////////

    function users_online() {
        global $connection;  
        $session = session_id();    //creating a session for the user
        $time = time();
        $time_out_in_seconds = 30;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection,$query);

        $count = mysqli_num_rows($send_query);

        if($count == NULL) {
            mysqli_query($connection,"INSERT INTO users_online(session, time) VALUES ('$session','$time')");
        } else {
            mysqli_query($connection,"UPDATE users_online SET time = '$time' WHERE session = '$session'");
        }

        $users_online_query = mysqli_query($connection,"SELECT * FROM users_online WHERE time > '$time_out'");
        return $count_user = mysqli_num_rows($users_online_query);                   
    }

    ///////////////////////// INSERT FUNCTION /////////////////////////////
    function insert_category(){
        global $connection;
        if(isset($_POST['submit'])){
            $cat_title = $_POST['cat_title'];
            if($cat_title == "" || empty($cat_title)){
                echo "This field should not be empty!";
            } else {
                $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?)");
                mysqli_stmt_bind_param($stmt, 's', $cat_title);
                mysqli_stmt_execute($stmt);
                //$create_category_query = mysqli_query($connection, $stmt);
                //function
                check_query($stmt);
            }
        }
    }

    //////////////////////////// UPDATE FUNCTION ////////////////////////////
    function update_category(){
        if(isset($_GET['edit'])){
            global $connection;
            //$cat_id = $_GET['edit'];
            //Including the file 'update_categories.php'
            include "includes/update_categories.php";
        }
    }

    /////////////////////////// DELETE FUNCTION //////////////////////////////
    function delete_category(){
        global $connection;
        if(isset($_GET['delete'])){
            $the_cat_id = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
            $delete_query = mysqli_query($connection, $query);
            /* Here when we click on 'Delete' button for deleting, it deletes the specific item from the database but fails to update the web-page. So the person manually has to refresh the webpage in order to see the changes. To avoid manual refreshing, use header("Location: the_web_page_name") to refresh the web-page */
            check_query($delete_query);
            header("Location: categories.php");
        }
    }

    ////////////////////////// FIND FUNCTION ////////////////////////////////
    function find_category(){
        global $connection;
        //find all categories query
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);
                    
        while($row = mysqli_fetch_assoc($select_categories)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
                                            
            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";

            if(is_admin($_SESSION['username'])){
                //In video 102, how to delete is shown
                echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                //In video 103, how to edit is shown
                echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
            }
            echo "</tr>";
        }
    }

/////////////////////////// for 'admin/index.php' ////////////////////////////
    function recordCount($table) {
        global $connection;

        $query = "SELECT * FROM " . $table;
        $select_all_table = mysqli_query($connection, $query);
        $result = mysqli_num_rows($select_all_table);

        check_query($result);

        return $result;
    }

/////////////////////////// Status in 'admin/index.php' /////////////////////
    function checkStatus($table, $column, $status) {
        global $connection;
        
        $query = "SELECT * FROM $table WHERE $column = '$status'";
        $select_all_published_table = mysqli_query($connection, $query);

        $result = mysqli_num_rows($select_all_published_table);

        check_query($result);

        return $result;
    }    

///////////////////////// User role in 'admin/index.php' //////////////////////
    function checkUserRole($table, $column, $role) {
        global $connection;
        $query = "SELECT * FROM $table WHERE $column = '$role'";
        $select_all_role_table = mysqli_query($connection, $query);
        
        $result = mysqli_num_rows($select_all_role_table);

        check_query($result);

        return $result;
    }

    /// Does'nt allow subscriber to enter the 'users.php' file ///
    function is_admin($username = ''){
        global $connection;

        $query = "SELECT user_role FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);

        check_query($result);

        $row = mysqli_fetch_array($result);

        if($row['user_role'] == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    //////////////////// For registration page to check if username exists or not ///////////////////////////
    function username_exists($username){
        global $connection;

        $query = "SELECT username FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);
        
        check_query($result);

        if(mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    ////////////////////// For registration page to check if user_email exists or not ////////////////////
    function email_exists($email){
        global $connection;

        $query = "SELECT user_email FROM users WHERE user_email = '$email'";
        $result = mysqli_query($connection, $query);
        
        check_query($result);

        if(mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

?>