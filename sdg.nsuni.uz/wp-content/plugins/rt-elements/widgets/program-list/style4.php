

<div class="program-list row">                          
    <?php 
        $x=1;
        $cat = $settings['rt-program-category'];		      
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        if(empty($cat)){
            $best_wp = new wp_Query(array(
                'post_type'      => 'rt-program',
                'posts_per_page' => $settings['per_page'],
                'paged'          => $paged,
                'order'          => 'ASC'			
            ));	  
        }   
        else{
            $best_wp = new wp_Query(array(
                'post_type'      => 'rt-program',
                'posts_per_page' => $settings['per_page'],
                'paged'          => $paged,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'rt-program-category',
                        'field'    => 'slug', //can be set to ID
                        'terms'    => $cat //if field is ID you can reference by cat/term number
                    ),
                )
            ));	  
        }
        while($best_wp->have_posts()): $best_wp->the_post();					
            $termsArray  = get_the_terms( $best_wp->ID, "rt-program-category" );  //Get the terms for this particular item
            $termsString = ""; //initialize the string that will contain the terms
            $termsSlug   = "";
            if(!empty($termsArray)): 
                foreach ( $termsArray as $term ) { 
                    $termsString .= 'filter_'.$term->slug.' '; 
                    $termsSlug .= $term->name;
                }		
            endif;		
            $content = get_the_content();	
        ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="single-cat-item">
                    <div class="cat-thumb">
                        <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                        <a href="<?php the_permalink(); ?>" class="cat-link-btn"><?php echo $termsSlug; ?></a>
                    </div>
                    <div class="cat-meta">
                        <div class="cat-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </div>
                        <div class="cat-link">
                            <a href="<?php the_permalink(); ?>" class="cat-link-arrow"><i class="rt-arrow-right"></i></a>
                        </div>
                    </div>

                </div>
            </div>

            <?php
        endwhile;
        wp_reset_query();  
        ?>    
</div>