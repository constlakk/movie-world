    <?php require_once("session.php") ?>
    
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/movie-world">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <?php if(!$session->is_signed_in()) : ?>

                    <li>
                        <a href="login.php">Login</a>
                    </li>
                    <li>
                        <a href="signup.php">Sign Up</a>
                    </li>

                    <?php endif; ?>

                    <?php if($session->is_signed_in()) : ?>

                    <li>
                        <a href="logout.php">Logout</a>
                    </li>

                    <?php endif; ?>
                    

                </ul>

                <?php if($session->is_signed_in()) : ?>

                <div class="nav navbar-right top-nav">
                    <ul class="nav navbar-nav">
                    <li>
                    <a href="post-movie.php">Howdy, <?php $logged_user = User::get_by_id($session->get_logged_user_id()); echo $logged_user->username; ?>! Click here to post a movie.</a>
                    </li>
                </div>

                <?php endif; ?>
                
                
            </div>
            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>