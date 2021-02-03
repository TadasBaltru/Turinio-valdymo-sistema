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


            if($_GET['category'])
            {

                $this_cat_id = $_GET['category'];
            }
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin')
            {
                    $query = "Select * FROM posts where post_category_id = $this_cat_id";
                    $categories_Posts_querry = mysqli_query($connection, $query);
                    $number = mysqli_num_rows($categories_Posts_querry);
            }
            else
            {
                $query = "Select * FROM posts where post_category_id = $this_cat_id";
                $categories_Posts_querry = mysqli_query($connection, $query);
                $number = mysqli_num_rows($categories_Posts_querry);
            }

                    if($number == 0)
                    {
                        echo "<h1>No posts published</h1>";
                    }

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
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img width = "400" height="400"  class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                

                <hr>


                         
                   <?php     } ?>

               


                <!-- First Blog Post -->
 

            </div>



            <!-- Blog Sidebar Widgets Column -->

           <?php include("includes/sidebar.php"); ?>

        </div>
        <!-- /.row -->

        <hr>

  <?php include("includes/footer.php"); ?>

</body>

</html>
