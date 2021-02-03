<?php
if(isset($_POST['create_post']))
{
    
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    $post_date = date('y-m-d');
    

    move_uploaded_file($post_image_temp, "../images/$post_image");


        $query = "Insert INTO posts (post_title, post_category_id, post_author, post_status, post_image, post_tags, post_content, post_date)
            VALUES ('$post_title','$post_category_id','$post_author','$post_status','$post_image','$post_tags','$post_content', '$post_date') ";
        $add_posts_query =mysqli_query($connection, $query);
        
        $the_post_id = mysqli_insert_id($connection);

        echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'> View Post</a> or  <a href='posts.php?source=add_post'>Create more posts</a></p>";

    }



?>
    <form action="" method="post" enctype="multipart/form-data">    
     
   
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="post_title">
      </div>
      <div class="form-group">
     <label for="post_category">Post category</label>
        <select name="post_category_id" id="">
        
        
        <?php


        
$query = "Select * FROM categories";
$categories_selection_querry = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($categories_selection_querry))
{  
     $cat_title = $row['cat_title'];
     $cat_id = $row['cat_id'];
     echo "<option value='$cat_id'> $cat_title </option> ";
   



}

        ?>
        
        
        
        </select>

     </div>

      <div class="form-group">
         <label for="author">Post Author</label>
          <input value = "<?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?>" type="text" class="form-control" name="post_author" readonly>
      </div>




       <div class="form-group">
         <select name="post_status" id="">
             <option value="" disabled>Post Status</option>
             <option value="draft">Draft</option>
             <option value="published">Published</option>
             
         </select>
      </div>
      
      
      
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div>
      
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="post_content" cols="30" rows="10">
         </textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>


</form>
   
