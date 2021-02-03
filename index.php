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
                    if(isset($_GET['page']))
                    {
                        $page = $_GET['page'];
                    }
                    else{
                        $page = 1;
                    }

                    if($page == "" || $page == 1){

                        $page_1=0;
                    }else{

                        $page_1=($page * 5) - 5;
                    }


                    $select_query_count = "Select * from posts where post_status = 'published'";
                    $find_count = mysqli_query($connection, $select_query_count);
                    $number = mysqli_num_rows($find_count);

                    $count = ceil($number / 5);
                   
                    $select_query_all_count = "Select * from posts";
                    $find_all_count = mysqli_query($connection, $select_query_all_count);
                    $number_all = mysqli_num_rows($find_all_count);
                    $count_all = ceil($number_all / 5);




                   if(!isset($_SESSION['user_role'])) {
                    if($number == 0)
                    {
                        echo "<h1>No posts published</h1>";
                    }
                    else{  


                    $query = "Select * FROM posts Where post_status = 'published' order by post_id desc LIMIT $page_1, 5 ";
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


                         
                   <?php   }   
                   } 
                   
                        }
           

    
                        
                else if ($_SESSION['user_role'] == 'Admin'){

                    if($number_all == 0)
                    {
                        echo "<h1>No posts published</h1>";
                    }
               else{   




                $query = "Select * FROM posts order by post_id desc LIMIT $page_1, 5 ";
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


                    
                <?php     }  } 

                    }
                ?>


 

            </div>



            <!-- Blog Sidebar Widgets Column -->
<?php include("includes/sidebar.php"); ?>
           

        </div>
        <!-- /.row -->
        <ul class="pager">
            <li><a href ='index.php?page=1'>first page</a></li>
             <?php

               
                $end_page=$page+3;

                 if($end_page > $count)
                {
                    $end_page=$page;

                }    

                if($end_page <= $count)
                {

                if($page >= 3)
                {
                    $page-=2;
                }

                for($i = $page; $i < $end_page; $i++)
                {
                    echo "<li><a href ='index.php?page=$i'>$i</a></li>";
                }
               
               } 
               
             ?>
             <li><a href ='index.php?page=<?php echo $count; ?>'>last page</a></li>
        </ul>

        <hr>

  <?php include("includes/footer.php"); ?>

</body>

</html>
