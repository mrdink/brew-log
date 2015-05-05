<?php

function beer_log_shortcode_table( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'style' => ''
		), $atts )
	);

	if (!empty($atts['styles'])) {
		$collections = $atts['styles'];
	}

	ob_start();

	// WP_Query arguments
	$args = array (
		'post_type' 			=> 'beers',
		'styles'  		=> $style
	);

	// The Query
	$query = new WP_Query( $args );

	// The Loop
	if ( $query->have_posts() ) { ?>
		<table>
		  <thead>
		    <tr>
		      <th>Name</th>
		      <th>Brewed</th>
		      <th>Bottled</th>
		      <th>ABV</th>
		    </tr>
		  </thead>
		  <tbody>
			<?php while ( $query->have_posts() ) {
				$query->the_post();
				$post_id = get_the_ID(); ?>
				<tr>
				  <td class="td-beer-name">
				  	<?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?>
		  	  	<?php
			  	  	// $terms = get_the_terms( $post_id , 'styles' );
			  	  	// 	echo "<small>";
			  		  // 	foreach ( $terms as $term ) {
			  	  	// 		echo $term->name;
			  		  // 	}
			  		  // 	echo "</small>";
		  	  	?>
				  </td>
				  <td class="td-beer-brewed"><?php the_field('brewed'); ?></td>
				  <td class="td-beer-bottled"><?php the_field('bottled'); ?></td>
				  <td class="td-beer-abv"><?php echo get_field('abv'), '%'; ?></td>
				</tr>
			<?php } ?>
		  </tbody>
		</table>
	<?php } else { ?>
		<?php _e( 'Nothing Found', 'beer-log' ); ?>
	<?php }

	// Restore original Post Data
	wp_reset_postdata();

	return ob_get_clean();
}
add_shortcode( 'beer-table', 'beer_log_shortcode_table' );