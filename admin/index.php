<!DOCTYPE html>
<html lang="en">

<?php  include ("includes/header.php"); ?>


<body>

    <div id="wrapper">

        <!-- Navigation -->
       <?php include ("includes/navigation.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin page
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>
                        
    
                    </div>
               <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
              
                  <div class='huge'><?php echo $post_count = recordCount('posts'); ?></div>


                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                     <div class='huge'><?php echo $comment_count =recordCount('comments'); ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <div class='huge'><?php echo $user_count =recordCount('users'); ?></div>
                        <div>Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
     
                        <div class='huge'><?php echo $category_count =recordCount('categories'); ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
                <a href="categories.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
        </div>
    </div>
</div>                 
                </div>
                <!-- /.row -->


                <?php
     
                        $subscriber_count = recordCount('users WHERE user_role ="Subscriber" ');

                        $draft_post_count = recordCount('posts WHERE post_status = "draft"');

       
                        $published_post_count = recordCount('posts WHERE post_status = "published"');

                      
                        $approved_comment_count = recordCount('comments WHERE comment_status = "approved"');

                      
                        $unapproved_comment_count = $approved_comment_count = recordCount('comments WHERE comment_status = "unapproved"');;
                    
                    ?> 


    

                <div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Count'],

            <?php
                $element_text = ['Active Posts', 'Draft posts','Published posts','Categories', 'Users', 'Subscribers','Comments','Approved comments','Unapproved comments'  ];
                $element_count = [$post_count, $draft_post_count,$published_post_count,$category_count, $user_count,$subscriber_count, $comment_count,$approved_comment_count,$unapproved_comment_count ];

                for($i = 0; $i < sizeof($element_count); $i++)
                {
                    echo "['$element_text[$i]'" . "," . "$element_count[$i]],";
                }

            ?>



        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include ("includes/footer.php"); ?>
