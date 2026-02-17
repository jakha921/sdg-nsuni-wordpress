<?php
/*
Department single page template
*/
get_header();
global $unipix_option;
?>

<!-- Department Detail Start -->
<div class="reactheme-porfolio-details"> 
	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-md-12">
                    
					<?php	
						while ( have_posts() ) : the_post(); ?> 
							<div class="project-desc"> 							      
								<?php  
									the_content(); 
								?>
							</div>  
							<?php 
						endwhile; wp_reset_query();
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Department Details End -->

<?php
get_footer();