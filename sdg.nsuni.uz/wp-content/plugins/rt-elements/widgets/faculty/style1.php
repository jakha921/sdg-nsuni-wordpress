<?php 
	$cat = $settings['faculty_category'];
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$query_args = array(
		'post_type'      => 'rt-faculty',
		'posts_per_page' => $settings['per_page'],
		'paged'          => $paged,
	);

	if(!empty($cat)){
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'rt-faculty-category',
				'field'    => 'slug', // Can be set to ID
				'terms'    => $cat, // If field is ID you can reference by cat/term number
			),
		);
	}

	$best_wp = new WP_Query($query_args);
	$details_btn_text = !empty($settings['read_more_btn']) ? $settings['read_more_btn'] : 'Learn More';
	if ($best_wp->have_posts()):
		while ($best_wp->have_posts()): $best_wp->the_post();	
			$termsArray  = get_the_terms(get_the_ID(), "rt-faculty-category");
			$termsString = ""; // Initialize the string that will contain the terms
			$termsSlug   = "";

			if ($termsArray && !is_wp_error($termsArray)) {
				foreach ($termsArray as $term) { 
					$termsString .= 'filter_' . $term->slug . ' '; 
					$termsSlug .= $term->name . ' ';
				}
			}			
			$thumbnail_url = get_the_post_thumbnail_url() ? esc_url(get_the_post_thumbnail_url()) : '';
		?>
		<div class="col-lg-<?php echo esc_html($settings['faculty_columns']); ?> col-md-6 col-xs-1 grid-item <?php echo esc_attr($termsString); ?>">				
			<div class="rts__program--item" style="background-image: url('<?php echo $thumbnail_url; ?>');">
				<h4 class="rts__program--item--title"><?php the_title(); ?></h4>
				<p class="rts__program--item--description"><?php echo get_the_excerpt(); ?></p>
				<a aria-label="faculty" href="<?php the_permalink(); ?>" class="rts-nbg-btn btn-arrow"><?php echo esc_html($details_btn_text); ?><span><i class="rt rt-arrow-right-regular"></i></span></a>
			</div>
		</div>
		<?php
		endwhile;
		wp_reset_postdata();  
	endif;
?>