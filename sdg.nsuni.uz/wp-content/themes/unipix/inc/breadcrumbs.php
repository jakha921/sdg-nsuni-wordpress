<div class="reactheme-breadcrumbs">
	<div class="container">
		<div class="breadcrumbs-inner "> 
			<h1>
			<?php
				if ( is_page() ) {
					the_title();
				} elseif ( is_404() ) {
					the_title();
				} elseif ( is_archive() ) {
					the_title();
				} elseif ( is_search() ) {
					if ( have_posts() ) {
						echo sprintf( esc_html__( 'Search Results for: %s', 'unipix' ), get_search_query() );
					} else {
						echo esc_html__( 'No Results Found', 'unipix' );
					}
				} else {
					the_title();
				}
			?>
			</h1>  
		</div>
	</div>
</div> 