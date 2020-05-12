<section>

<h1>Popular Posts</h1>

<?php
	//Set filters for the popular posts query
	$args_popular = array(
		'posts_per_page' => 6,
		'category_name' => 'popular'
	);
	//Send the query for popular posts
	$popular_posts = new WP_Query($args_popular);
	//Create empty array to save IDs of the shown posts so they are not shown again in the latest posts
	$popular_posts_ids = array();

	if ($popular_posts->have_posts()) {
		//Loop to show each post from the query with title, thumbnail, date, excerpt and link. Save the ID in the array for the latest posts
		while ($popular_posts->have_posts()) {
			$popular_posts->the_post();
			echo '<div>';
			echo '<h2>' . get_the_title() . '</h2>';
			echo the_post_thumbnail('thumbnail');
			echo '<p>' . get_the_date() . '</p>';
			echo '<p>' . get_the_excerpt() . '</p>';
			echo '<a href="' . get_permalink() . '">Read more</a>';
			echo '</div>';
			array_push($popular_posts_ids, get_the_ID());
		}
	}
	else {
		echo '<h2>No posts found!</h2>';
	};
?>

</section>

<section>

<h1>Latest Posts</h1>

<?php
	//Set filters for latest posts query. Filter the IDs found in the popular posts shown before so they are not shown
	$args_allposts = array(
		'posts_per_page' => 20,
		'post__not_in' => $popular_posts_ids
	);
	//Send the query for latest posts.
	$all_posts = new WP_Query($args_allposts);

	if ($all_posts->have_posts()) {
		//Loop to show all results.
		while ($all_posts->have_posts()) {
			echo '<div>';
			$all_posts->the_post();
			echo '<h2>' . get_the_title() . '</h2>';
			echo the_post_thumbnail('thumbnail');
			echo '<p>' . get_the_date() . '</p>';
			echo '<p>' . get_the_excerpt() . '</p>';
			echo '<a href="' . get_permalink() . '">Read more</a>';
			echo '</div>';
		}
	}
	else {
		echo '<h2>No posts found!</h2>';
	};
?>

</section>
