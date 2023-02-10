<?php if(!isset($_GET['id'])) { header("Location: index.php"); } ?>

<?php include("includes/header.php"); ?>

<?php $movie = Movie::get_by_id($_GET['id']); ?>

<?php $the_user = User::get_by_id($movie->user_id); $username = $the_user->username; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $movie->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    Posted by <a href='movies_by.php?id=<?php echo $movie->user_id; ?>'><?php echo $username; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $movie->publication_date; ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="<?php echo UPLOADS . $movie->image_filename; ?>" alt="" width="560" height="560">

                <p><span>Likes: <?php echo count($movie->get_likes(0)); ?></span><span> Dislikes: <?php echo count($movie->get_likes(1))?></span></p><br>

                <?php if($session->is_signed_in()) : ?>
                <?php if($movie->user_id != $session->get_logged_user_id()) : ?>

                <h4><?php if(isset($_SESSION['like'])){ echo $_SESSION['like']; unset($_SESSION['like']); }?></h4>

                <p><a href="like.php?user_id=<?php echo $session->get_logged_user_id() ;?>&movie_id=<?php echo $movie->id; ?>&like=0">Thumbs up!</a></p>
                <p><a href="like.php?user_id=<?php echo $session->get_logged_user_id() ;?>&movie_id=<?php echo $movie->id; ?>&like=1">Thumbs down.</a></p>

                <?php endif; ?>
                <?php endif; ?>

                <hr>

                <!-- Post Content -->
                <p><?php echo $movie->description ?></p>


                <!-- Posted Comments -->

               

                <!-- Comment -->


            </div>

            <!-- Blog Sidebar Widgets Column -->
            

        </div>
        <!-- /.row -->

        <!-- Footer -->
        <?php include("includes/footer.php"); ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
