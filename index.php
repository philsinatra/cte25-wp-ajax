<?php
// the loop
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<div class="post">
			<h2>
			        <?php
        			$nonce = wp_create_nonce('my_custom_nonce');
        			$link = admin_url('admin-ajax.php?action=my_launch_action&post_id='.$post->ID.'&nonce='.$nonce);
        			$title = get_the_title();
        			echo '<a class="post-launcher" data-nonce="' . $nonce . '" data-post-id="' . $post->ID . '" href="' . $link . '">' . $title . '</a>';
         			?>
			</h2>
		</div>
		<?php
	} // end while
} // end if
?>

<!-- A container for the dynamically loaded content -->

<div id="popup">
  <div id="popup-title"></div>
  <div id="popup-content"></div>
</div>

<!-- The magic -->
<script>
jQuery(document).ready(function($) {
  $('.post-launcher').click(function(e) {
    e.preventDefault();
    var postID = $(this).attr('data-post-id');
    console.log('postID = ' + postID);
    $.ajax({
      url: ajaxurl,
      data: {
        'action':'example_ajax_request',
        'post_id': postID
      },
      dataType : 'json',
      success : function(data) {
        console.log(data);
       $('#popup-title').html(data[0]);
       $('#popup-content').html(data[1]);
      },
      error : function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
      }
    });
  });
});
</script>
