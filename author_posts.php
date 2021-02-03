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
                                    $the_post_author = $_GET['author'];
                                 
                                    
                                }
                

                    $query = "Select * FROM posts WHERE post_author = '$the_post_author' ORDER BY post_id desc";
                    $categories_Posts_filter = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($categories_Posts_filter))
                        {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];                            
                            $post_date = $row['post_date'];
                            $post_image= $row['post_image'];
                            $post_content=  substr($row['post_content'], 0, 100);
                            $post_tags = $row['post_tags'];
                            $post_comment_count= $row['post_comment_count'];
                            //$;
                             ?>

                             <h1>All posts by <?php echo $post_author; ?></h1>
  
                 <h2>
                    
                    <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?> </a>
                </h2>
         
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img width = "400" height="400"  class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                

                <hr>


                         
                   <?php     } ?>


                <!-- Blog Comments -->


                  
  

            <!-- Blog Sidebar Widgets Column -->

         

        </div>
        <?php include("includes/sidebar.php"); ?>
        <hr>
       
</div>

    </div>

  <?php include("includes/footer.php"); ?>

</body>

</html>
