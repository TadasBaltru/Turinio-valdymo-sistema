</form>
                            <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Update/edit Category</label>
                                
                            
                        <?php
                            if(isset($_GET['edit']))
                            {
                                $cat_id = $_GET['edit'];
                                



    
                                $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
                                $select_categories_id = mysqli_query($connection,$query);  
                            
                           
                            while($row = mysqli_fetch_assoc($select_categories_id))
                            {  
                                 $cat_id = $row['cat_id'];
                                 $cat_title = $row['cat_title'];    
                                    ?>
                                    
                                    <input value="<?php echo $cat_title; ?>" type="text" class="form-control" name="cat_title">


                                 <?php }} ?>
             

                        <?php   
                       
                        if(isset($_POST['update']))
                        {
                            $update_category = $_POST['cat_title'];

                            $query = "UPDATE categories SET cat_title =  '$update_category' Where cat_id = '$cat_id' " ;
                            
                            $Update_category_query = mysqli_query($connection, $query);
                            if(!$Update_category_query)
                            {
                                die('Query Failed' . mysqli_error($connection));
                            }  

                            
                        //    header("Location: categories.php");

                        }
                        
                        ?>

                         </div>  

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update" placeholder="Update Category" >
                            </div>
                            
                            
                            </form>