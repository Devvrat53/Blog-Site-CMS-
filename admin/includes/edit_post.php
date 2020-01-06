<?php
    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];
    }
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $select_posts_by_id = mysqli_query($connection, $query);
                    
    while($row = mysqli_fetch_assoc($select_posts_by_id)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
    }

    /////////// Clicking the Update Button ////////////////
    if(isset($_POST['update_post'])){
        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $select_image = mysqli_query($connection, $query);
            while($row = mysqli_fetch_array($select_image)){
                $post_image = $row['post_image'];
            }
        }
    
        //Updating the query
        $query = "UPDATE posts SET ";
        //Concatinating with '.=' in every line as the query is too big
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_date = now(), ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_image = '{$post_image}' ";
        $query .= "WHERE post_id = {$the_post_id} ";
        
        //Sending query
        $update_post = mysqli_query($connection, $query);
        
        //Checking the query whether it's working properly or not
        check_query($update_post);//code of this function in 'functions.php' file
        
        //javascript to alert the user that the post has been added
        echo "<script> alert('Post Updated!');</script>";
    }
?>

<!-- enctype is added in the form as we're going to upload the image -->
<form action="" method="post" enctype="multipart/form-data">
    <!-- Post Title -->
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>
    <!-- Post Category ID -->
    <div class="form-group">
        <select name="post_category_id" id="post_category_id">
           <option value=""> Select an Option </option>
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
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>
    <!-- Post Status -->
    <div class="form-group">
        <select name="post_status" id="">
            <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
            <?php
                if($post_status == 'published'){
                    echo "<option value='draft'>Draft</option>";
                } else{
                    echo "<option value='published'>Publish</option>";
                }
            
            ?>
        </select>
    </div>
    <!-- Post Image -->
    <div class="form-group">
        <!--<img width="50" src="../images/<?php //echo $post_image; ?>" alt="post_image"> -->
        <input type="file" name="post_image">
    </div>
    <!-- Post Tags -->
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
    <!-- Post Content -->
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10">
            <?php echo $post_content; ?>
        </textarea>
    </div>
    <!-- Submit -->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
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