<?php session_start(); ?>
<?php ob_start(); ?>

<?php
    // Cancelling their session whenever they log out
    $_SESSION['username'] = null;
    $_SESSION['firstname'] = null;
    $_SESSION['lastname'] = null;
    $_SESSION['user_role'] = null;

    // Redirecting the users to index.php page
    header("Location: ../index.php");
?>