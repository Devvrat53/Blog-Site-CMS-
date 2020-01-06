<?php include "delete_modal.php" ?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th> ID </th>
            <th> Author </th>
            <th> Comment </th>
            <th> Email </th>
            <th> Status </th>
            <th> In Response to </th>
            <th> Date </th>
            <th> Approve </th>
            <th> Unapprove </th>
            <th> Delete </th>
        </tr>
    </thead>
    <tbody>
        <?php                   
            $query = "SELECT * FROM comments";
            $select_comments = mysqli_query($connection, $query);
                    
            while($row = mysqli_fetch_assoc($select_comments)){
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];
             
                //printing || echoing
                echo "<tr>";
                echo "<td>{$comment_id}</td>";
                echo "<td>{$comment_author}</td>";
                echo "<td>{$comment_content}</td>";
                
                /*
                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                $select_categories_id = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_categories_id)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                
                    echo "<td>{$cat_title}</td>";
                }
                */
                
                echo "<td>{$comment_email}</td>";
                echo "<td>{$comment_status}</td>";
                //In response to 
                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                $select_post_id_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_post_id_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    
                    echo "<td>$post_title</td>";
                }
                echo "<td>{$comment_date}</td>";
                
                //Approve Comment
                echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                //Unapprove Comment
                echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                //Delete comment
                //echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='comments.php?delete={$comment_id}'>Delete</a></td>";
                echo "<td><a href='javascript:void(0)' rel='$comment_id' class='delete_link'>Delete</a></td>";
                echo "</tr>";
            }                         
        ?>
    </tbody>
</table>

<!------------------- Delete ---------------------->
<?php
    if(isset($_GET['delete'])){
        $the_comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: comments.php"); //Reloading the page
    }
?>

<!------------------- Unapprove ---------------------->
<?php
    if(isset($_GET['unapprove'])) {
        $the_comment_id = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $the_comment_id";
        $unapprove_query = mysqli_query($connection, $query);
        header("Location: comments.php"); //Reloading the page
    }
?>

<!------------------- Approve ---------------------->
<?php
    if(isset($_GET['approve'])) {
        $the_comment_id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $the_comment_id";
        $approve_query = mysqli_query($connection, $query);
        header("Location: comments.php"); //Reloading the page
    }
?>

<script>

    $(document).ready(function(){
        $(".delete_link").on('click', function(){
            var id = $(this).attr("rel");
            var delete_url = "comments.php?delete=" + id + " ";

            $(".modal_delete_link").attr("href", delete_url);

            $("#myModal").modal('show');
        });
    });

</script>