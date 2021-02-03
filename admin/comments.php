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

                        <?php

                            if(isset($_GET['source']))
                            {
                                  $source = $_GET['source'];



                            }
                            else{

                                $source = '';
                            }
                                  switch($source) {

                                    case 'add_post';
                                    include ("includes/add_post.php");
                                    break;
                                    case 'edit_post';
                                    include ("includes/edit_post.php");
                                    break;


                                    default: include("includes/view_all_comments.php");
                                    break;

                                  }
                                  



                               

                        ?>
                       <?php 


if(isset($_GET['unapprove']))
{
    global $connection;

    $the_comment_id = $_GET['unapprove'];
    

    $query = "Update comments Set comment_status = 'unapproved' Where comment_id = '$the_comment_id' ";

    $unapprove_post_query = mysqli_query($connection, $query);
    header("Location: comments.php");


}
if(isset($_GET['approve']))
{
    global $connection;

    $the_comment_id = $_GET['approve'];

    $query = "Update comments Set comment_status = 'approved' Where comment_id = '$the_comment_id' ";

    $approve_post_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    if(!$approve_post_query)
    {
        die('Query Failed' . mysqli_error($connection));
    } 



}








                               if(isset($_GET['delete_comment']))
                               {
                                   global $connection;
                      
                                   $delete_comment = $_GET['delete_comment'];
                       
                                   $query = "DELETE FROM comments where
                                   comment_id =  ('$delete_comment')";
                       
                                   $delete_post_query = mysqli_query($connection, $query);
                                
                                  
                                    
                                   header("Location: comments.php");
                              
                       
                               }
                       
                       
                           
                       ?>




                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include ("includes/footer.php"); ?>
