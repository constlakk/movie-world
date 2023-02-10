<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

define('SITE_ROOT', DS . 'XAMPP' . DS . 'htdocs' . DS . 'movie-world' );

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'includes');

defined('UPLOADS_PATH') ? null : define('UPLOADS_PATH', SITE_ROOT . DS . 'uploads');

define('UPLOADS', 'uploads/');

?>

<?php require_once('configuration.php'); ?>
<?php require_once('db_object.php'); ?>
<?php require_once('database.php'); ?>
<?php require_once('user.php'); ?>
<?php require_once('session.php'); ?>
<?php require_once('movie.php'); ?>