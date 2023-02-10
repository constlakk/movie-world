<?php include("includes/header.php"); ?>

<?php

$session->logout();

header('Location: login.php');

?>