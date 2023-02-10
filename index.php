<?php include("includes/header.php"); ?>

        
        <h2>Order by</h2>
        <ul>
            <li><a href="index.php">Date</a></li>
            <li><a href="index.php?order_by=total_likes">Likes</a></li>
            <li><a href="index.php?order_by=total_dislikes">Dislikes</a></li>
        </ul>

        <?php
        
            if(isset($_GET['order_by'])) {

                if($_GET['order_by'] == 'total_likes' || $_GET['order_by'] == 'total_dislikes') {

                    $movies = Movie::get_all_order_by($_GET['order_by']);
    
                } else {

                    header("Location: index.php");

                }

            } else {

                $movies = Movie::get_all();

            }


        ?>

        <?php foreach($movies as $movie): ?>
        <?php $the_user = User::get_by_id($movie->user_id); $username = $the_user->username; ?>

            <!-- Blog Entries Column -->
            <div style="width: 33%; display: inline-block;">

            <a href="movie.php?id=<?php echo $movie->id ?>"><h2><?php echo $movie->title; ?></h2></a><br>

            <a href="movie.php?id=<?php echo $movie->id ?>"><img src="<?php echo UPLOADS . $movie->image_filename; ?>" alt="" width="300" height="300"></a><br><br>

            <p><?php echo $movie->description; ?></p>

            <p><?php echo "Posted by <a href='movies_by.php?id={$movie->user_id}'>{$username}</a>";?></p>

            </div>        

        <?php endforeach; ?>

        
        
        

        <?php include("includes/footer.php"); ?>