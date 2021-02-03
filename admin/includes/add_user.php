<?php
if(isset($_POST['create_user']))
{
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    
    $user_email = $_POST['user_email'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_role = $_POST['user_role'];


    //$post_date = date('d-m-y');
    

    move_uploaded_file($user_image_temp, "../images/$user_image");

    $query="select randSalt from users";
    $select_randsalt_query=mysqli_query($connection, $query);


   $row = mysqli_fetch_array($select_randsalt_query);

   $salt = $row['randSalt'];

   $user_password =crypt($user_password, $salt);


        $query = "Insert INTO users (user_name, user_password, user_firstname, user_lastname, user_email, user_image , user_role)
            VALUES ('$user_name', '$user_password', '$user_firstname', '$user_lastname', '$user_email', '$user_image', '$user_role') ";
        $add_users_query =mysqli_query($connection, $query);  

     //   confirmQuery($add_posts_query);

    echo "User Created: " . "<a href='users.php'>View Users</a>";
   // header("Location: users.php");

    }



?>
    <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="user_name">Username</label>
          <input type="text" class="form-control" name="user_name" required>
      </div>
           
      <div class="form-group">
         <label for="user_password">Password</label>
          <input type="password" class="form-control" name="user_password"required>
      </div>
           
      <div class="form-group">
         <label for="user_email">Email</label>
          <input type="email" class="form-control" name="user_email"required>
      </div>
           
      <div class="form-group">
         <label for="user_firstname">firstname</label>
          <input type="text" class="form-control" name="user_firstname">
      </div>
           
      <div class="form-group">
         <label for="user_lastname">Lastname</label>
          <input type="text" class="form-control" name="user_lastname">
      </div>
      <div class="form-group">
     <label for="user_role">role</label>
        <select name="user_role" id=""  required>

        <option value="Subscriber">Subscriber</option>
        <option value="Moderator">Moderator</option>
        <option value="Admin">Admin</option>

        </select>

     </div>

   

      
    <div class="form-group">
         <label for="user_image">User Image</label>
          <input type="file"  name="user_image">
      </div>

      <!-- <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div> -->
      
      <!-- <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="" cols="30" rows="10">
         </textarea>
      </div> -->
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
      </div>


</form>
    