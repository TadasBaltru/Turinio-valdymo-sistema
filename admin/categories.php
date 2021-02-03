<!DOCTYPE html>
<html lang="en">

<?php  include ("includes/header.php");  ?>


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
    
                        <div class="col-xs-6">
 
                        <?php insert_categories();  ?>



                        <?php delete_categories();  ?>




                            <form action="categories.php" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title" value ="Add Category">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" >
                            </div>
                            
                             
                           


                            </form>
                        

                        <?php     
                            
                            if(isset($_GET['edit']))
                            {
                                $cat_id = $_GET['edit'];
                                
                                include("includes/update_categories.php");  
                            }
                            
                            
                            ?>
                        
                        
                        </div>
                        <div class="col-xs-6">

                           <table class="table table-bordered table-hover">
                               <thead>
                                   <tr>
                                       <th>ID</th>
                                       <th>Category Title</th>
                                       <th>Delete</th>
                                       <th>Edit</th>
                                   </tr>
                               </thead>
                               <tbody>
                               
                                <?php findAllCategories();  ?>
                          
                              
                               </tbody>
                           </table>

                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include ("includes/footer.php"); ?>
