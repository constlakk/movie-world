<?php include("includes/header.php"); ?>

<?php

if($session->is_signed_in()) {

    header('Location: index.php');

}

if(isset($_POST['submit'])) {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    $user_exists = User::email_exists($email);

    if($user_exists) {

        $msg = "User email already exists in database.";

    } else {

        $user = new User();

        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];

        if($user->create()) {

            $session->login($user);
            header('Location: index.php');

        } else {

            $msg = "There was a problem with the registration. Please try again later.";

        }

    }
    

}


?>

<div class="col-md-4 col-md-offset-3">

<h4 class="bg-danger"><?php if(isset($msg)) echo $msg; ?></h4>
	
<form id="login-id" action="" method="post">
	
<div class="form-group">
	<label for="username">Username</label>
	<input type="text" class="form-control" name="username" value="" required>

</div>

<div class="form-group">
	<label for="email">Email</label>
	<input type="email" class="form-control" name="email" value="" required>
</div>

<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="password" value="" required>
</div>


<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>


</form>


</div>