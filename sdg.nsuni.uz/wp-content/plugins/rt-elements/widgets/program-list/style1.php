<div class="program__single--item p_item active-<?php echo esc_attr($active_bg);?>">
    <?php if(!empty($settings['bg_img']['url'])) : ?>
        <div class="program__single--item--bg">
            <img src="<?php echo esc_url($settings['bg_img']['url']); ?>" alt="<?php echo esc_attr($img_alt); ?>">
        </div>
        <?php 
    endif; ?>
    <h5 class="program__single--item--title"><?php echo wp_kses_post( $settings['program_title'] ); ?></h5>                          
    <ul class="program__single--item--list">            
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
            <li class="program__single--item--list--item">
                <a href="<?php the_permalink(); ?>" class="link__list"><?php the_title(); 
                    if(!empty($settings['program_icon']['value'])) : ?>
                        <span><?php \Elementor\Icons_Manager::render_icon( $settings['program_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                        <?php 
                    else : ?>
                            <i class="rt rt-arrow-right-regular"></i>
                        <?php
                    endif; ?>
                </a>
            </li>

            <?php
        endwhile;
        wp_reset_query();  
        ?>  

    </ul>    
</div>