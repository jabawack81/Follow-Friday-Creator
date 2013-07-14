<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* Get the list of all the User Friends Id's*/
$ids = get_object_vars($connection->get('friends/ids'))['ids'];
if (count($ids)>100){

/* Split the Friends id's in group of 100 to overcome the limit of the twitter API */
 $friendsIds = array_chunk($ids,100,false);

/* Obtain the info about the friends */
 $friends=array();
 foreach ($friendsIds as $key => $value) {
  $friends = array_merge($friends, $connection->get('users/lookup', array('user_id' => implode(",",$value))));
 };
} else {
  $friends = $connection->get('users/lookup', array('user_id' => implode(",",$ids)));
};
$friendsort=array();
usort($friends, function($a,$b)
{
 return strcmp($a->name, $b->name);
});
$content = "<form>\n";
foreach ($friends as $friend){
 $content = $content."<div class='friend'><input type='checkbox' name='friend[]' value='@$friend->screen_name'><img src='$friend->profile_image_url' width='48' hegh='48'> $friend->name </input></div><br>\n";
};
$content = $content."</form>\n";
//$content = $friends;
/* Include HTML to display on the page */
include('html.inc');
