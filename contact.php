<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
///////////////// REQUIREMENT ////////////////////
    /*
    For the mail functions to be available, PHP requires an installed and working email system.
    Eg: hosting site like GoDaddy.com, etc.. 
    The program to be used is defined by the configuration settings in the php.ini file.

    */
    if(isset($_POST['submit'])) {
        $to = "devvratmungekar53@outlook.com";

        //use wordwrap() if lines are longer than 70 characters
        $subject = wordwrap($_POST['subject'], 70);
        $body = wordwrap($_POST['body'], 70);

        // User's email
        $header = "FROM: " . $_POST['user_email'];

        //send email
        mail($to, $subject, $body, $header);
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
                        <h1> Contact </h1>
                        <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                            <!--- EMAIL ---> 
                            <div class="form-group">
                                <label for="user_email" class="sr-only">Email</label>
                                <input type="email" name="user_email" id="email" class="form-control" placeholder="Enter your email - somebody@example.com" required>
                            </div>
                            <!-- Subject -->
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                            </div>
                           <!--- Textarea --->
                            <textarea name="body" class="form-control" id="body" cols="50" rows="10" placeholder="Enter the text"></textarea>
                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                        </form>
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
    <hr>

<script>
    //// CKEditor ////
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        }); 
</script>

<?php include "includes/footer.php";?>