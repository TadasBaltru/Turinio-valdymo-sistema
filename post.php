<?php 
include "includes/db.php";
include "includes/header.php";


?> 

<body>

    <!-- Navigation -->
    
    <?php include "includes/navigation.php";?> 
    <!-- Page Content -->
    <div class="container">

        <div class="row">
 
            <!-- Blog Entries Column -->
            <div class="col-md-8">

            

            <?php
                                if(isset($_GET['p_id']))
                                {
                                    $the_post_id = $_GET['p_id'];
                                 
                                    
                                }
                
                    $query = "UPDATE posts SET post_views_count = post_views_count + 1 ";
                    $query .= "Where post_id = '$the_post_id' ";
                    $view_count_query = mysqli_query($connection, $query);
                    
                    $query = "Select * FROM posts WHERE post_id = $the_post_id ";
                    $categories_Posts_filter = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($categories_Posts_filter))
                        {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];                            
                            $post_date = $row['post_date'];
                            $post_image= $row['post_image'];
                            $post_content= $row['post_content'];
                            $post_tags = $row['post_tags'];
                            $post_comment_count= $row['post_comment_count'];
                            //$;
                             ?>
  
                 <h2>
                    <a href="#"><?php echo $post_title; ?> </a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img width = "400" height="400"  class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                

                <hr>


                         
                   <?php     } ?>


                <!-- Blog Comments -->


                    <?php
                    
                            if(isset($_POST['create_comment']))
                            {
                              $the_post_id = $_GET['p_id'];

                                $comment_author = $_POST['comment_author'];
                                $comment_email = $_POST['comment_email'];
                                $comment_content = $_POST['comment_content'];



                                if(!empty($comment_author) && !empty($comment_email))
                                {


                                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status,comment_date)";

                                $query .= "VALUES ($the_post_id ,'{$comment_author}', '{$comment_email}', '{$comment_content }', 'unapproved',now())";
                                $create_comment_query = mysqli_query($connection, $query);
                                if(!$create_comment_query)
                                {
                                    die('Query failed' . mysqli_error($connection));
                                }


                                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                                $query .= "Where post_id = '$the_post_id' ";
                               
                                   

                                $comment_count_query =mysqli_query($connection, $query);
                               
                                if(!$comment_count_query)
                                {
                                    die('Query Failed' . mysqli_error($connection));
                                } 

                                }
                                else{

                                    echo "<script>alert('Fields cannot be empty') </script>";

                                }



  

                            }

                    ?>







                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">

                    <div class="form-group">
                    <label for="comment_author"> Name</label>
                            <input class="form-control" type="text" name="comment_author">
                        </div>
                        <div class="form-group">
                        <label for="comment_email">Email</label>
                            <input  class="form-control" type="email" name="comment_email">
                        </div>
                        <div class="form-group">
                        <label for="comment_content">Your Comment</label>
                            <textarea class="form-control" name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->                    
                <?php
                  $query = "Select * FROM comments where comment_status = 'approved' AND comment_post_id = '$the_post_id' ";
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

                      

                       echo   "<div class='media'>"                                ;
                       echo      "<a class='pull-left' href='#'>"                                ;
                       echo          "<img class='media-object' src='http://placehold.it/64x64' alt=''>"                                 ;
                       echo        "</a>"                                 ;
                       echo        "<div class='media-body'>"                                  ;
                       echo            "<h4 class='media-heading'>$comment_author "                             ;
                       echo                 "<small>$comment_date</small>"                           ;
                       echo             "</h4>"                            ;
                       echo  $comment_content;                                       ;
                       echo          "</div>"                               ;
                       echo     "</div>"                                    ;

                       

                  }              


                ?>
  

            <!-- Blog Sidebar Widgets Column -->

         

        </div>
        <?php include("includes/sidebar.php"); ?>
        <hr>
       
</div>

    </div>

  <?php include("includes/footer.php"); ?>

</body>

</html>
