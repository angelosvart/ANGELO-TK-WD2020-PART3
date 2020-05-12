<section>

<?php
	if (have_posts()) {
		//Show the individual post with full content instead of excerpt
		while (have_posts()) {
			the_post();
			echo '<h2>' . get_the_title() . '</h2>';
			echo the_post_thumbnail('medium');
			echo '<p>' . get_the_date() . '</p>';
			echo '<p>' . get_the_content() . '</p>';
		}
	}
?>

</section>
