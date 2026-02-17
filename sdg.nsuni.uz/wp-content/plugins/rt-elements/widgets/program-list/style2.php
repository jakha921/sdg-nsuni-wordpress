<?php 
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $cat = isset($settings['rt-program-category']) ? $settings['rt-program-category'] : '';

    // Define query arguments
    $query_args = array(
        'post_type'      => 'rt-program',
        'posts_per_page' => $settings['per_page'],
        'paged'          => $paged,
    );

    // Add category filter if category is set
    if (!empty($cat)) {
        $query_args['tax_query'] = array(
            array(
                'taxonomy' => 'rt-program-category',
                'field'    => 'slug', // can be set to 'term_id' if you use term IDs
                'terms'    => $cat,
            ),
        );
    }

    // Create new WP_Query
    $best_wp = new WP_Query($query_args);

    // Loop through posts
    if ($best_wp->have_posts()):
        while ($best_wp->have_posts()): $best_wp->the_post();
            $termsArray = get_the_terms(get_the_ID(), 'rt-program-category'); // Get the terms for this item
            $termsString = ''; // Initialize string to contain the terms
            $termsSlug = '';

            // If terms are not empty, build terms string and slug
            if (!empty($termsArray)) {
                foreach ($termsArray as $term) { 
                    $termsString .= 'filter_' . $term->slug . ' '; 
                    $termsSlug .= $term->name . ' ';
                }
            }
            
            $content = get_the_content(); 
            $post_thumbnail = get_the_post_thumbnail_url(); 
            $excerpt_text = get_the_excerpt();
            ?>
            <div class="rts__program--item v__2 p_item" style="background-image: url('<?php echo esc_url($post_thumbnail); ?>');">
                <h5 class="rts__program--item--title"><?php the_title(); ?></h5>
                <p class="rts__program--item--description"><?php echo esc_html($excerpt_text); ?></p>
                <a href="<?php the_permalink(); ?>" class="rts-nbg-btn btn-arrow"><?php echo wp_kses_post($settings['program_btn']); ?>
                    <span>
                        <?php if (!empty($settings['program_icon']['value'])) : ?>
                            <span><?php \Elementor\Icons_Manager::render_icon($settings['program_icon'], ['aria-hidden' => 'true']); ?></span>
                        <?php else : ?>
                            <i class="rt rt-arrow-right-regular"></i>
                        <?php endif; ?>
                    </span>
                </a>
                <h5 class="rts__program--item--title--show"><?php echo esc_html($termsSlug); ?></h5>
            </div>
        <?php
        endwhile;
        wp_reset_postdata(); 
    endif;
?>
