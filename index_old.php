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



                    $query = "Select * FROM posts Where post_status = 'published'";
                    $categories_Posts_querry = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($categories_Posts_querry))
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
      

                 <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?> </a>
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

               


 

            </div>



            <!-- Blog Sidebar Widgets Column -->
<?php include("includes/sidebar.php"); ?>
           

        </div>
        <!-- /.row -->

        <hr>

  <?php include("includes/footer.php"); ?>

</body>

</html>
