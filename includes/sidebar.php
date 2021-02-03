<div class="col-md-4">


<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input name ="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form> <!--search form -->
    <!-- /.input-group -->
</div>





<div class="well">


   <?php if (isset($_SESSION['user_role'])): ?>
            <h4>Logged in as <?php echo $_SESSION['username'] ?></h4>
            <a href="includes/logout.php" class="btn btn-primary">Logout</a>
   <?php else: ?>
    <h4>Login form</h4>
    <form action="includes/login.php" method="post">
    <div class="form-group">
        <input name ="user_name" type="text" class="form-control" placeholder ="Enter Username" required>
    
    </div>
    <div class="input-group">
        <input name ="user_password" type="password" class="form-control" placeholder ="Enter password" required>
        <span class="input-group-btn">
            <button name="login" class="btn btn-primary" type="submit">Submit
        </button>
        </span> 
    </div>
   <?php endif; ?>




    </form> <!--search form -->
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">

    <?php
    

$query = "Select * FROM categories Limit 10";
$categories_selection_querry = mysqli_query($connection, $query);


    ?>
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">

            <?php
while($row = mysqli_fetch_assoc($categories_selection_querry))
{
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];
    
  echo "<li> <a href='category.php?category=$cat_id'>$cat_title </a></li>";
}
            ?>

            </ul>
        </div>

        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "widget.php"; ?>

</div>
