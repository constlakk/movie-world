<?php if(!isset($_GET['id'])) { header("Location: index.php"); } ?>

<?php include("includes/header.php"); ?>


        <div class="row">

        <?php $movies = Movie::get_by_user_id($_GET['id']); ?>
        <?php foreach($movies as $movie): ?>
        <?php $the_user = User::get_by_id($movie->user_id); $username = $the_user->username; ?>

            <!-- Blog Entries Column -->
            <div class="col-md-4">

            <a href="movie.php?id=<?php echo $movie->id ?>"><h2><?php echo $movie->title; ?></h2></a><br>

            <a href="movie.php?id=<?php echo $movie->id ?>"><img class="img-responsive" src="<?php echo UPLOADS . $movie->image_filename; ?>" alt="" width="300" height="300"></a><br><br>

            <p><?php echo $movie->description; ?></p>

            <p><?php echo "Posted by <a href='movies_by.php?id={$movie->user_id}'>{$username}</a>";?></p>

            </div>


        <?php endforeach; ?>
        </div>
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>