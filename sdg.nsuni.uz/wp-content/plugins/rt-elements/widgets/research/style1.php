<?php 
	$cat = $settings['research_category'];
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	if(empty($cat)){
		$best_wp = new wp_Query(array(
				'post_type'      => 'rt-research',
				'posts_per_page' => $settings['per_page'],								
		));	  
	}   
	else{
		$best_wp = new wp_Query(array(
			'post_type'      => 'rt-research',
			'posts_per_page' => $settings['per_page'],				
			'tax_query'      => array(
				array(
					'taxonomy' => 'rt-research-category',
					'field'    => 'slug', //can be set to ID
					'terms'    => $cat //if field is ID you can reference by cat/term number
				),
			)
		));	  
	}

	$x=1;
	$details_btn_text = !empty($settings['details_btn_text']) ? $settings['details_btn_text'] : 'Case Details';
	while($best_wp->have_posts()): $best_wp->the_post();	
		
		$content       = get_the_content();
		$client        = get_post_meta( get_the_ID(), 'client', true );
		$location      = get_post_meta( get_the_ID(), 'event_location', true );
		$surface_area  = get_post_meta( get_the_ID(), 'surface_area', true );
		$created       = get_post_meta( get_the_ID(), 'created', true );
		$date          = get_post_meta( get_the_ID(), 'event_date', true );
		$project_value = get_post_meta( get_the_ID(), 'project_value', true );

		$cats_show = get_the_term_list( $best_wp->ID, 'rt-research-category', ' ', '<span class="separator">,</span> ');
		$termsArray  = get_the_terms( $best_wp->ID, "rt-research-category" );  //Get the terms for this particular item
		$termsString = ""; //initialize the string that will contain the terms
		$termsSlug   = "";

		foreach ( $termsArray as $term ) { 
			$termsString .= 'filter_'.$term->slug.' '; 
			$termsSlug .= $term->name;
		}							
	?>
	<div class="col-lg-<?php echo esc_html($settings['research_columns']);?> col-md-6 col-xs-1 grid-item <?php echo $termsString;?>">				
		<div class="rts__research--single">
			<div class="rts__research--single--thumb">
				<?php if(has_post_thumbnail()): ?>
					<a aria-label="research thumb" href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail($settings['thumbnail_size']); ?>
					</a>
					<?php 
				endif ?>
			</div>
			<div class="rts__research--single--meta">
				<a aria-label="research title" class="rts__research--single--meta--title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<p class="rts__research--single--meta--excerpt">
					<?php echo get_the_excerpt(); ?>
				</p>
			</div>
		</div>				
	</div>					
		
	<?php
	$x++;	
	endwhile;
	wp_reset_query();  
?>