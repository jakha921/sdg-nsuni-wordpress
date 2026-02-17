
<?php 
	$termsArray  = get_the_terms( $best_wp->ID, "team-category" );  //Get the terms for this particular item
	$termsString = ""; //initialize the string that will contain the terms
	$termsSlug   = "";
	if(!empty($termsArray)): 
		foreach ( $termsArray as $term ) { 
			$termsString .= 'filter_'.$term->slug.' '; 
			$termsSlug .= $term->name;
		}		
	endif;		
	$content = get_the_content();	
	$designation  = !empty(get_post_meta( get_the_ID(), 'designation', true )) ? get_post_meta( get_the_ID(), 'designation', true ):'';			
							
	//retrive social icon values			
	$facebook    = get_post_meta( get_the_ID(), 'facebook', true );
	$twitter     = get_post_meta( get_the_ID(), 'twitter', true );
	$instagram   = get_post_meta( get_the_ID(), 'instagram', true );
	$linkedin    = get_post_meta( get_the_ID(), 'linkedin', true );
	$show_phone  = get_post_meta( get_the_ID(), 'phone', true );
	$show_email  = get_post_meta( get_the_ID(), 'email', true );
	
	$fb   ='';
	$tw   ='';
	$ins  ='';
	$ldin ='';
	
	if($facebook!=''){
		$fb ='<a aria-label="social" href="'.$facebook.'"><i class="rt rt-facebook-f"></i></a>';
	}
	if($twitter!=''){
		$tw='<a aria-label="social" href="'.$twitter.'"><i class="rt rt-twitter"></i></a>';
	}
	if($instagram!=''){
		$ins='<a aria-label="social" href="'.$instagram.'"><i class="rt rt-instagram"></i></a>';
	}
	if($linkedin!=''){
		$ldin ='<a aria-label="social" href="'.$linkedin.'"><i class="rt rt-linkedin-in"></i></a>';
	}
?>

<div class="col-lg-<?php echo esc_html($settings['team_columns']);?> col-md-6 col-xs-1 <?php echo $termsString;?> grid-item">
	<div class="team-item">
		<?php $team_link = (!empty($settings['team_link'])) ? 'link-en' : 'link-dis' ; ?>
		<div class="rts__single--member <?php echo esc_attr($team_link); ?>">
			<div class="rts__single--member--thumb">
				<a aria-label="team thumb" href="<?php the_permalink();?>">
					<?php the_post_thumbnail($settings['thumbnail_size']); ?>
				</a>   
			</div>
			<div class="rts__single--member--meta">
				<h5 class="rts__single--member--meta--title title">
					<a aria-label="team name" href="<?php the_permalink();?>"><?php the_title();?></a>
				</h5>
				<span class="rts__single--member--meta--designation designation">
					<?php echo esc_html( $designation );?>
				</span>
			</div>
		</div>						
	</div>
</div>		

<?php
$x++;