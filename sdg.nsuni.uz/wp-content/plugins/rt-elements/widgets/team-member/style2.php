
<?php //******************//

	$termsArray  = get_the_terms( $best_wp->ID, "team-category" );  //Get the terms for this particular item
	$termsString = ""; //initialize the string that will contain the terms
	$termsSlug   = "";
	if(!empty($termsArray)): 
		foreach ( $termsArray as $term ) { 
			$termsString .= 'filter_'.$term->slug.' '; 
			$termsSlug .= $term->name;
		}		
	endif;			

	$designation  = !empty(get_post_meta( get_the_ID(), 'designation', true )) ? get_post_meta( get_the_ID(), 'designation', true ):'';			
	$content = get_the_content();									   
	//retrive social icon values			
	$facebook    = get_post_meta( get_the_ID(), 'facebook', true );
	$twitter     = get_post_meta( get_the_ID(), 'twitter', true );
	$instagram   = get_post_meta( get_the_ID(), 'instagram', true );
	$linkedin    = get_post_meta( get_the_ID(), 'linkedin', true );
	$show_phone  = get_post_meta( get_the_ID(), 'phone', true );
	$show_email  = get_post_meta( get_the_ID(), 'email', true );
	$short_bio  = get_post_meta( get_the_ID(), 'shortbio', true );
	$btn_text  = get_post_meta( get_the_ID(), 'getin', true );					
	$btn_link  = get_post_meta( get_the_ID(), 'getin', true );					
	
	$fb   ='';
	$tw   ='';
	$gp   ='';
	$ins ='';
	$ldin ='';

	if($facebook!=''){
		$fb='<a aria-label="social" href="'.$facebook.'" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a> ';
	}
	if($twitter!=''){
		$tw='<a aria-label="social" href="'.$twitter.'" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>';
	}
	if($instagram!=''){
		$ins='<a aria-label="social" href="'.$instagram.'" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a> ';
	}
	if($linkedin!=''){
		$ldin='<a aria-label="social" href="'.$linkedin.'" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
	}
?>		

	<div class="col-lg-<?php echo esc_html($settings['team_columns']);?> col-md-12 <?php echo $termsString;?> grid-item">	
		<div class="single-staff team-item">
			<div class="single-staff__content">
				<?php 
				if(has_post_thumbnail()) : ?>
					<div class="staf-image">
						<?php the_post_thumbnail($settings['thumbnail_size']); ?>
					</div>
				<?php 
				endif; ?>
				<div class="staf-info">
					<h5 class="title"><?php the_title();?></h5>
					<span class="designation"><?php echo esc_html( $designation );?></span>
					<?php if( $fb || $tw || $ins || $ldin ): ?>
						<div class="staf-info__social">
							<?php echo wp_kses_post($fb);
								echo wp_kses_post($tw);
								echo wp_kses_post($ins);
								echo wp_kses_post($ldin);
							?>
						</div>
					<?php endif; ?>  
					<a aria-label="team mail" href="<?php the_permalink(); ?>" class="email-contact"><span><i class="rt-envelope"></i></span><?php echo wp_kses_post($show_email); ?></a>
					<a aria-label="team phone" href="<?php the_permalink(); ?>" class="phone-contact"><span><i class="rt-phone-flip"></i></span><?php echo wp_kses_post($show_phone); ?></a>
					<div class="staf-info__speciality">
						<p><?php echo wp_trim_words( $short_bio, 5, ''); ?></p>
					</div>
					<?php 
					if(!empty($btn_text)) : ?>
						<a aria-label="team button text" href="<?php the_permalink(); ?>" class="team-btn react_button"><?php echo wp_kses_post($btn_text);?></a>
						<?php 
					endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php	
$x++;