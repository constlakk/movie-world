<?php include("includes/header.php"); ?>

<?php

if($session->is_signed_in()) {

    header('Location: index.php');

}

if(isset($_POST['submit'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    $user_found = User::verify_user($username, $password);

    if($user_found) {

        $session->login($user_found);
        header('Location: index.php');

    } else {

        $msg = "The combination of username and password you provided was not found.";

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
	<label for="password">Password</label>
	<input type="password" class="form-control" name="password" value="" required>
	
</div>


<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>


</form>


</div>