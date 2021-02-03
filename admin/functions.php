<?php


    function insert_categories(){
    
            global $connection;

        if(isset($_POST['submit']))
        {
            $cat_title = $_POST['cat_title'];

            if($cat_title =="Add Category"
                ||  $cat_title =="" || empty($cat_title))
            {
                echo "This field can't be empty";
            }

            else{

                $query = "Insert INTO categories (cat_title)
                    VALUES ('$cat_title')";
                $add_categories_query =mysqli_query($connection, $query);  
                if(!$add_categories_query)
                {
                    die('Query Failed' . mysqli_error($connection));
                }  
            }
        }
    }
    
    function findAllCategories(){

        global $connection;
        
        $query = "Select * FROM categories";
        $categories_selection_querry = mysqli_query($connection, $query);
        $i = 1;
        while($row = mysqli_fetch_assoc($categories_selection_querry))
        {  
             $cat_id = $row['cat_id'];
             $cat_title = $row['cat_title'];

   echo      "<tr>";
   echo          "<td>{$i}</td>";
   echo          "<td> {$cat_title} </td>";
   echo          "<td> <a href = 'categories.php?delete= $cat_id' > Delete</a> </td>";
   echo          "<td> <a href = 'categories.php?edit= $cat_id' > Edit</a> </td>";
   echo      "</tr>";
   $i++;
    }
}


    function delete_categories(){
        if(isset($_GET['delete']))
        {
            global $connection;

            $delete_category = $_GET['delete'];

            $query = "DELETE FROM categories where
            cat_id =  ('$delete_category')";

            $delete_category_query = mysqli_query($connection, $query);
            header("Location: categories.php");

        }
    }
    function delete_users(){
        if(isset($_GET['delete_user']))
        {
           if(isset($_SESSION['user_role']))
           {
           if($_SESSION['user_role'] == 'Admin')
            {
                            global $connection;

            $delete_users = $_GET['delete_user'];
            $delete_users = mysqli_escape_string($connection,$delete_users);

            $query = "DELETE FROM users where
            user_id =  ('$delete_users')";

            $delete_user_query = mysqli_query($connection, $query);
            if(!$delete_user_query)
            {
                die("QUERY FAILED ." . mysqli_error($connection));
            }

            header("Location: users.php");

        }
            }
           } 


    }

    function findAllPosts(){

        global $connection;





        
      //  $query = "Select * FROM posts ORDER BY post_id desc";

      $query = "Select posts.post_id, posts.post_author,posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, ";
      $query .="posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title ";
      $query .=" From posts ";
      $query .=" LEFT JOIN categories ON posts.post_category_id = categories.cat_id ";

        

        $posts_selection_querry = mysqli_query($connection, $query);

        if(!$posts_selection_querry)
        {
            DIE("querry failed " .mysqli_error($connection));
        }

        $i = 1;
        while($row = mysqli_fetch_assoc($posts_selection_querry))
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
             $post_views_count=$row['post_views_count'];
             $Category_title =$row['cat_title'];
             $Category_id =$row['cat_id'];

             $query = "update posts set post_comment_count = 0 WHERE post_id = '$post_id'";
             $comment_count_query = mysqli_query($connection, $query);




   echo      "<tr>";
   ?>


<td><input type= "checkbox" class="checkBoxes" name ="checkBoxArray[]" value ="<?php echo $post_id;?>"> </td>


   <?php 
   echo          "<td>{$i}</td>";
   echo          "<td> {$post_author} </td>";
   echo          "<td><a href='../post.php?p_id=$post_id'> {$post_title} </a> </td>";

//    $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
//    $select_categories_id = mysqli_query($connection,$query);  


// while($row = mysqli_fetch_assoc($select_categories_id))
// {  
//     $cat_id = $row['cat_id'];
//     $cat_title = $row['cat_title'];    

   echo          "<td> $Category_title </td>";


// }

   echo          "<td> {$post_status} </td>";
   echo          "<td> <img style='width: 150px' src = '../images/$post_image' </td>";
   echo          "<td> {$post_tags} </td>";
  
   echo          "<td> {$post_comment} </td>";
   echo          "<td> {$post_date} </td>";
   echo          "<td> <a onClick=\"javascript: return confirm('Are you sure you want to reset views?');\" href='posts.php?reset=$post_id'>{$post_views_count}</a> </td>";


   
   echo          "<td> <a rel='$post_id' href='javascript:void(0)' class='delete_link' > Delete</a> </td>";
   echo          "<td> <a href = 'posts.php?source=edit_post&p_id= $post_id' > Edit</a> </td>";

   echo      "</tr>";
   $i++;
    }

    function confirm($result)
    {
        global $connection;

        if(!$result ) {
              
              die("QUERY FAILED ." . mysqli_error($connection));
       
              
          }
       
    }




}
function findAllComments(){

    global $connection;
    
    $query = "Select * FROM comments";
    $comments_selection_querry = mysqli_query($connection, $query);
    $i = 1;
    while($row = mysqli_fetch_assoc($comments_selection_querry))
    {  
         $comment_id = $row['comment_id'];
         $comment_post_id = $row['comment_post_id'];
         $comment_author = $row['comment_author'];
         $comment_content = $row['comment_content'];
         $comment_email = $row['comment_email'];
         $comment_status =$row['comment_status'];
         $comment_date =$row['comment_date'];
       
         




echo      "<tr>";
echo          "<td>{$i}</td>";
echo          "<td> {$comment_author} </td>";
echo          "<td> {$comment_content} </td>";
echo          "<td> {$comment_email} </td>";
echo          "<td> {$comment_status} </td>";
 $query ="Select * from posts WHERE post_id = $comment_post_id";
        $select_post_id_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_post_id_query))
        {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];

                echo          "<td><a href ='../post.php?p_id=$post_id'>$post_title</a></td>";

        }



echo          "<td> {$comment_date} </td>";
echo          "<td> <a href = 'comments.php?approve= $comment_id' > Approve</a> </td>";
echo          "<td> <a href = 'comments.php?unapprove= $comment_id' > Unapprove</a> </td>";

echo          "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href = 'comments.php?delete_comment= $comment_id' > Delete</td>";


echo      "</tr>";
$i++;
}}

function findAllUsers(){

    global $connection;
    
    $query = "Select * FROM users";
    $users_selection_querry = mysqli_query($connection, $query);
    $i = 1;
    while($row = mysqli_fetch_assoc($users_selection_querry))
    {  
         $user_id = $row['user_id'];
         $user_name = $row['user_name'];
         $user_password = $row['user_password'];
         $user_firstname= $row['user_firstname'];
         $user_lastname = $row['user_lastname'];
         $user_email = $row['user_email'];
         $user_image = $row['user_image'];
         $user_role = $row['user_role'];
        // $user_date = $row['user_id'];
 
  




echo      "<tr>";
echo          "<td>{$i}</td>";
echo          "<td> {$user_name} </td>";
echo          "<td> {$user_firstname} </td>";
echo          "<td> {$user_lastname} </td>";
echo          "<td> {$user_email} </td>";


echo          "<td> {$user_role} </td>";


echo          "<td><a href = 'users.php?source=edit_user&u_id= $user_id' > Edit</td>";
echo          "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href = 'users.php?delete_user= $user_id' > Delete</td>";


echo      "</tr>";
$i++;
}}
function users_online() {



   // if(isset($_GET['onlineusers'])) {

    global $connection;

   // if(!$connection) {

     //   session_start();

    //    include("../includes/db.php");

        $session = session_id();
        $time = time();
        $time_out_in_seconds = 05;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

            if($count == NULL) {

            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");


            } else {

            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");


            }

        $users_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
        echo $count_user = mysqli_num_rows($users_online_query);


  //  }
      





  //  } // get request isset()
 


}




function recordCount($table){
    global $connection;

    $query = "Select * FROM " . $table;
    $select_all_post = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_all_post);

    return $result;

}

function is_admin($username){

    global $connection;

    $query = "SELECT user_role from users where user_name = '$username'";

    $result= mysqli_query($connection, $query);

    $row= mysqli_fetch_array($result);

    if($row['user_role'] == 'Admin')
    {
        return true;
    }
    else{
        return false;
    }


}

function username_exists($username){

global $connection;

$query ="Select user_name from users where user_name = '$username'";

$result = mysqli_query($connection, $query);
$count = mysqli_num_rows($result);


if($count > 0)
{
    return true;
}
else{
    return false;
}


}
function email_exists($useremail){

    global $connection;
    
    $query ="Select user_email from users where user_email = '$useremail'";
    
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);
    
    
    if($count > 0)
    {
        return true;
    }
    else{
        return false;
    }
    
    
    }

    function redirect($location){

        return header("Location:" . $location);
    }

    function register_user($username, $email, $password)
    {
        global $connection;

 
        $username = mysqli_real_escape_string($connection,$username);
        $email = mysqli_real_escape_string($connection,$email);
        $password = mysqli_real_escape_string($connection,$password);
 
        $query="select randSalt from users";
        $select_randsalt_query=mysqli_query($connection, $query);
 
 
       $row = mysqli_fetch_array($select_randsalt_query);
 
       $salt = $row['randSalt'];
 
       $password =crypt($password, $salt);
 
       $query = "INSERT INTO users (user_name, user_email, user_password, user_role) ";
       $query .= "Values('$username', '$email', '$password', 'Subscriber')";
       $register_user_query = mysqli_query($connection, $query);
 //    $message = "Your registration has been submited";
 
     
    
 
    }

 function login_user($username, $userpassword)
 {
    global $connection;

    $username =trim($username);
    $userpassword=trim($userpassword);

    $username= mysqli_real_escape_string($connection, $username);
    $userpassword = mysqli_real_escape_string($connection, $userpassword);

    $query = "Select * from users where user_name = '$username'";

    $select_user_query = mysqli_query($connection, $query);
    if(!$select_user_query)
    {
        die("query failed". mysqli_error($connection));
    }
    while($row =mysqli_fetch_array($select_user_query))
    {
     $db_user_id = $row['user_id'];
     $db_user_password = $row['user_password'];
     $db_user_name = $row['user_name'];
     $db_user_firstname = $row['user_firstname'];
     $db_user_lastname = $row['user_lastname'];
     $db_user_role = $row['user_role'];
    
    }
    $userpassword = crypt($userpassword, $db_user_password);
    
    
    if($username === $db_user_name && $userpassword === $db_user_password)
    {
        
       $_SESSION['username'] = $db_user_name;
       $_SESSION['firstname'] = $db_user_firstname;
       $_SESSION['lastname'] = $db_user_lastname;
       $_SESSION['user_role'] = $db_user_role;
    
    
        redirect("/portalas/admin");
    }
    
    else{
       
        redirect("/portalas/index.php");
       
    }
    
    
 }   

?>