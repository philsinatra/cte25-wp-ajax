<?php
// the loop
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<div class="post">
			<h2>
				<a href="<?php the_ID(); ?>" class="post-launcher"><?php the_title(); ?></a>
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
jQuery(function($) {
  $('.post-launcher').click(function(e) {
    e.preventDefault();
    var postID = $(this).attr('href');
    var $content = $('#popup');
    console.log('load post please');
    $.ajax({
      type : "GET",
      data : { "id" : postID },
      dataType : "json",
      url : "ABSOLUTE_PATH_TO_YOUR_FILE/loop_handler.php",
      success : function(data) {
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
