<?php include("includes/header.php"); ?>

<?php

if(!isset($_GET['user_id']) || !isset($_GET['movie_id']) || !isset($_GET['like']) || $_GET['like'] < 0 || $_GET['like'] > 1) {

    header("Location: index.php");

}

$user_id = $_GET['user_id'];
$movie_id = $_GET['movie_id'];
$is_dislike = $_GET['like'];
$change_vote = $is_dislike == 0 ? 1 : 0;

$movie = Movie::get_by_id($movie_id);

global $db;

$sql_add_vote = "INSERT INTO user_likes (user_id, movie_id, is_dislike) VALUES({$user_id}, {$movie_id}, {$is_dislike})";
$sql_check_vote_same = "SELECT * FROM user_likes WHERE user_id = {$user_id} AND movie_id = {$movie_id} AND is_dislike = {$is_dislike}";
$sql_check_vote_alter = "SELECT * FROM user_likes WHERE user_id = {$user_id} AND movie_id = {$movie_id} AND is_dislike = {$change_vote}";
$sql_change_vote = "UPDATE user_likes SET is_dislike = {$is_dislike} WHERE user_id = {$user_id} AND movie_id = {$movie_id} AND is_dislike = {$change_vote}";

$result_check_vote_same = $db->query($sql_check_vote_same);
$result_check_vote_alter = $db->query($sql_check_vote_alter);

//echo $sql_change_vote . "<br>";
//$db->query($sql_change_vote);

if($result_check_vote_same->num_rows == 1) {

    $_SESSION["like"] = "You cannot apply the same vote for this movie.";
    header('Location: movie.php?id=' .  $movie_id);

} else if ($result_check_vote_alter->num_rows == 1) {

    $db->query($sql_change_vote);
    $likes_count = count($movie->get_likes(0));
    $dislikes_count = count($movie->get_likes(1));

    $db->query("UPDATE movies SET total_likes = {$likes_count} WHERE id = {$movie_id}");
    $db->query("UPDATE movies SET total_dislikes = {$dislikes_count} WHERE id = {$movie_id}");

    $_SESSION["like"] = "Your vote has been changed.";
    header('Location: movie.php?id=' .  $movie_id);

} else {

    $db->query($sql_add_vote);
    $likes_count = count($movie->get_likes(0));
    $dislikes_count = count($movie->get_likes(1));

    $db->query("UPDATE movies SET total_likes = {$likes_count} WHERE id = {$movie_id}");
    $db->query("UPDATE movies SET total_dislikes = {$dislikes_count} WHERE id = {$movie_id}");
    $_SESSION["like"] = "Your vote has been uploaded.";
    header('Location: movie.php?id=' .  $movie_id);

}

?>