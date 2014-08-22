<?php
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

$post_id = $_GET['id'];

query_posts('p=' . $post_id);
global $more;
$more = 0;

while (have_posts()): the_post();
  $my_title = get_the_title(); // get the contents, but don't display them
  $my_content = get_the_content(); // get the contents, but don't display them
endwhile;

// Set each piece of content up as a unique array item
$arr = array();
$arr[0] = $my_title;
$arr[1] = $my_content;

// Encode the array as a string and echo 
echo json_encode($arr);

wp_reset_query();

exit();
 ?>
