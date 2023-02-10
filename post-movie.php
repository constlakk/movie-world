<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>


<?php 

$msg = "";

if(isset($_POST['submit'])){

    $movie = new Movie();
    $movie->title = $_POST['title'];
    $movie->description = $_POST['description'];

    if(isset($_FILES['file'])) { 

        $movie->set_file($_FILES['file']);

    } else {

        $movie->image_filename = "placeholder.jpg";

    }

    $movie->publication_date = date("Y/m/d");
    $movie->user_id = $session->get_logged_user_id();

    if($movie->save()) {

        $msg = "Movie uploaded successfully.";

    } else {

        $msg = join("<br>", $movie->errors);

    }

}

?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->

        <?php include("includes/navigation.php") ?>


            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
           

    
        <?php //include("includes/side_nav.php"); ?>




            <!-- /.navbar-collapse -->
        </nav>




        <div id="page-wrapper">


            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            UPLOAD NEW MOVIE
                            <small></small>
                        </h1>

                        <div class="row">
                        <div class="col-md-6">

                        <?php if(isset($msg)) { echo $msg; }; ?>
                        <form action="post-movie.php" method="post" enctype="multipart/form-data">
                            
                            <div class="form-group">

                                <label for="title">Title</label><br>
                                <input type="text" name="title" class="form-control"><br>
                                <label for="description">Description</label><br>
                                <textarea name="description" class="form-control"></textarea>
                                
                            </div>

                            <div class="form-group">

                                <input type="file" name="file" >
                                
                            </div>

                            <input type="submit" name="submit" >

                        </form>

                        </div>

                    </div><!--End of Row-->


                    </div>

                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>