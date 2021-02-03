

<?php

    if(isset($_POST['checkBoxArray']))
    {$bulk_options = $_POST['bulk_options'];

        foreach ($_POST['checkBoxArray'] as $checkBoxValue ){
         

            switch($bulk_options){
                case 'published';
                    $query= "Update posts SET post_status = '$bulk_options' Where post_id = '$checkBoxValue'";
                    $publish_status_query = mysqli_query($connection, $query);
              

                    break;
                case 'draft';
                    $query= "Update posts SET post_status = '$bulk_options' Where post_id = '$checkBoxValue'";
                    $draft_status_query = mysqli_query($connection, $query);
                    break;
                case 'delete';
                    $query= "delete from posts Where post_id = '$checkBoxValue'";
                    $delete_query = mysqli_query($connection, $query);
                    break;

                case 'clone';
                $query= "Select * from posts where post_id = '$checkBoxValue'";
                $detect_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($detect_query))
                {
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status =$row['post_status'];
                    $post_image =$row['post_image'];
                    $post_tags =$row['post_tags'];
                    $post_comment =$row['post_comment_count'];
                    $post_date =$row['post_date'];
                    $post_content = $row['post_content'];
                }
                $query = "Insert INTO posts (post_title, post_category_id, post_author, post_status, post_image, post_tags, post_content, post_date)
                VALUES ('$post_title','$post_category_id','$post_author','$post_status','$post_image','$post_tags','$post_content', now()) ";
                $add_posts_query =mysqli_query($connection, $query);
                
                break;




            }

            
        }
    }

?>



<form action ="" method='post'>

<table class="table table-bordered table-hover">

    <div id="bulOptionsContainer" class="col-xs-4">
    
    
        <select name="bulk_options" id="" class="form-control">

                <option value="">Select options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
              

        </select>
 </div>
    <div class="col-xs-4">
        <input type="submit" value="Apply" class="btn btn-succes" name="submit">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add new</a>

    </div>

    
   
            <thead>
                <tr>
                     <th><input type="checkbox" name="" id="selectAllBoxes"></th>
                     <th>ID</th>
                     <th>Author</th>
                     <th>Title</th>
                     <th>Category</th>
                     <th>Status</th>
                     <th>Image</th>
                     <th>Tags</th>
                     <th>Comments</th>
                     <th>Date</th>
                     <th>Views</th>
                     <th>Delete</th>
                     <th>Edit</th>

                </tr>
            </thead>
            <tbody>
    
     <?php
     
     findAllPosts();  
     include("delete_modal.php");
     ?>

   
    </tbody>
</table>
</form>

<script>
$(document).ready(function(){

    $(".delete_link").on('click', function(){
        
        var id = $(this).attr("rel");
        var delete_url = "posts.php?delete_post="+ id +"";

        $(".modal_delete_link").attr("href", delete_url);

        $("#myModal").modal('show');

        

    });

});

</script>