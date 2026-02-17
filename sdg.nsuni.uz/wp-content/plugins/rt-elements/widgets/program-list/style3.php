

<div class="program-list">                          
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
        
            <a href="<?php the_permalink(); ?>" class="program-item"><?php the_title(); ?><span>
                <?php if (!empty($settings['program_icon']['value'])) : ?>
                    <span><?php \Elementor\Icons_Manager::render_icon($settings['program_icon'], ['aria-hidden' => 'true']); ?></span>
                <?php else : ?>
                    <span>
                        <i class="rt-angle-right"></i>                    
                    </span>
                <?php endif; ?>    
            </a>

            <?php
        endwhile;
        wp_reset_query();  
        ?>    
</div>