<?php
        if(isset($_GET['u_id']))
        {
            $the_user_id =$_GET['u_id'];
            
     
        }

        $query = "Select * FROM users WHERE user_id = '$the_user_id'";
        $users_select_querry = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($users_select_querry))
        {  
             $user_id = $row['user_id'];
             $user_name = $row['user_name'];
             $user_password = $row['user_password'];
             
             $user_firstname= $row['user_firstname'];
             $user_lastname = $row['user_lastname'];
             $user_email = $row['user_email'];
             $user_image = $row['user_image'];
             $user_role = $row['user_role'];
        }
      

     

if(isset($_POST['edit_user']))
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
    $query="select randSalt from users";
    $select_randsalt_query=mysqli_query($connection, $query);


   $row = mysqli_fetch_array($select_randsalt_query);

   $salt = $row['randSalt'];

   $user_password =crypt($password, $salt);
    

    move_uploaded_file($user_image_temp, "../images/$user_image");


    $query = "UPDATE users SET ";
    $query .="user_name  = '{$user_name}', ";
    $query .="user_password  = '{$user_password}', ";
    $query .="user_email  = '{$user_email}', ";
    $query .="user_firstname  = '{$user_firstname}', ";
    $query .="user_lastname  = '{$user_lastname}', ";
    $query .="user_image  = '{$user_image}', ";
    $query .="user_role  = '{$user_role}' ";
    $query .= "WHERE user_id = {$the_user_id} ";
        $add_users_query =mysqli_query($connection, $query);  

     //   confirmQuery($add_posts_query);

   echo "<p>Registration is successfull </p>";
   header("Location: users.php");
     

    }



?>
    <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="user_name">Username</label>
          <input value ="<?php echo $user_name; ?>"type="text" class="form-control" name="user_name"  >
      </div>
           
      <div class="form-group">
         <label for="user_password">Password</label>
          <input type="password" class="form-control" name="user_password" value ="<?php echo $user_password; ?>">
      </div>
           
      <div class="form-group">
         <label for="user_email">Email</label>
          <input type="email" class="form-control" name="user_email"value ="<?php echo $user_email; ?>">
      </div>
           
      <div class="form-group">
         <label for="user_firstname">firstname</label>
          <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
      </div>
           
      <div class="form-group">
         <label for="user_lastname">Lastname</label>
          <input type="text" class="form-control" name="user_lastname"value="<?php echo $user_lastname; ?>">
      </div>
      <div class="form-group">
     <label for="user_role">role</label>
        <select name="user_role" id=""  required>
            <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
        <?php
         switch($user_role){
              case 'Admin';
              echo "<option value='Subscriber'>Subscriber</option>";
              echo "<option value='Moderator'>Moderator</option>";
              break;

              case 'Moderator';
              echo "<option value='Subscriber'>Subscriber</option>";
              echo "<option value='Admin'>Admin</option>";
              break;
              case 'Subscriber';
              echo "<option value='Moderator'>Moderator</option>";
              echo "<option value='Admin'>Admin</option>";
              break;

         }
         

        ?>
        
     

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
          <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
      </div>


</form>
    