// Register jQuery
function register_jquery() {
    wp_enqueue_script( 'jquery' );
}
add_action('wp_enqueue_scripts', 'register_jquery');


// Setup ajaxurl variable 
function pluginname_ajaxurl() {
  echo '<script type="text/javascript">';
  echo 'var ajaxurl = "' . admin_url('admin-ajax.php') . '";';
  echo '</script>';
}
add_action('wp_head','pluginname_ajaxurl');


// Example ajax request
// http://www.jackreichert.com/2013/03/24/using-ajax-in-wordpress-development-the-quickstart-guide/
function example_ajax_request() {
  $post_id = $_REQUEST['post_id'];
  query_posts('p=' . $post_id);
  while (have_posts()): the_post();
    $my_title = get_the_title();
    $my_content = get_the_content();
  endwhile;
  $arr = array();
  $arr[0] = $my_title;
  $arr[1] = $my_content;

  echo json_encode($arr);

  wp_reset_query();
  die();
}

// Register the ajax requests
add_action( 'wp_ajax_example_ajax_request', 'example_ajax_request' );
/* This second registration handles the ajax request for users that are
 * not logged into the wp blog and normally would not have privileges 
 * to get the data this way.
*/
add_action( 'wp_ajax_nopriv_example_ajax_request', 'example_ajax_request' );
