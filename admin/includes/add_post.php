<?php
    if(isset($_POST['create_post'])){
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        ///////////////// IMAGE /////////////////
        $post_image = $_FILES['post_image']['name'];
        //this variable is created to save images in the temporary location
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        /////////////////////////////////////////
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        
        //Used to move image from it's temporary location
        move_uploaded_file($post_image_temp, "../images/$post_image");
        /* Always go in the file to access the permission of the file using command 'sudo chown username file_name' */
        
        //In VALUES, '{}' is written when it's a string. As $post_category_id is a number, no '' are put there
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}','{$post_status}')";
        
        //making the query
        $create_post_query = mysqli_query($connection, $query);
        
        //calling the function to check if everything is working or not
        check_query($create_post_query);
        //javascript to alert the user that the post has been added
        echo "<script> alert('Post Created!');</script>";
    }
?>

<!-- enctype is added in the form as we're going to upload the image -->
<form action="" method="post" enctype="multipart/form-data">
    <!-- Post Title -->
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <!-- Post Category ID -->
    <div class="form-group">
        <select name="post_category_id" id="post_category_id">
           <option value=""> Post Category </option>
            <?php
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query);
                check_query($select_categories); //code in 'functions.php' file
                
                while($row = mysqli_fetch_assoc($select_categories)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>
    <!-- Post Author -->
    <div class="form-group">
        <label for="post_author">Author</label>
        <input value="<?php if(isset($_SESSION['username'])){ echo $_SESSION['username']; } ?>" type="text" class="form-control" name="post_author">
    </div>
    <!-- Post Status -->
    <div class="form-group">
        <select name="post_status" id="">
            <option value="draft"> Post Status </option>
            <option value="published"> Publish </option>
            <option value="draft"> Draft </option>
        </select>
    </div>
    <!-- Post Image -->
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    <!-- Post Tags -->
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <!-- Post Content -->
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>
    <!-- Submit -->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>

<script>
    //// CKEditor ////
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        }); 
</script>
