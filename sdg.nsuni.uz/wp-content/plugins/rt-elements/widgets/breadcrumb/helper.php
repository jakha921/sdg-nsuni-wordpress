<?php

function get_rt_breadcrumb($custom_title='', $custom_path='', $custom_separator='', $custom_home_title='', $search_custom_title='', $search_result_title=''){    

    if (isset($_GET['tutor_profile'])) {
        // This is the Tutor LMS Profile Page
        return;
    }


    global $post;
    $post = get_queried_object();
    $object_id = get_queried_object_id();
    $title = $custom_title;
    $search_title = $search_custom_title;
    $search_result_title = $search_result_title;

    if(empty($custom_title)){
        $title = get_the_title($object_id);
        if(is_archive()){

            if(empty($title)) $title = $post->label;
    
            if (is_category() || is_tax() || is_tag()) {
                $title = $post->name;
            }
        }elseif(is_search()){
            $title = $search_title;           
        }
    }
    $separator = isset($custom_separator['value']) ? '<span class="breadcrumb-separator ' . $custom_separator['value'] . '"></span>': '<span class="breadcrumb-separator"> / </span>';

    $home_title = !empty($custom_home_title) ? $custom_home_title : 'Home';
    $home_link = '<a href="' . esc_url(home_url('/')) . '">' . __($home_title, 'rtelements') . '</a>';
    $breadcrumb_path = '';
    $breadcrumb_path = !empty($custom_path) ? $custom_path : $breadcrumb_path;
    ?>
    <div class="reactheme-breadcrumb">
        <div class="breadcrumb-inner container">
            <h1 class="page-title"><?php echo esc_html( $title ); ?></h1>
            <div class="breadcrumb-path">
                <?php 
                $output = '';
                $output.= $home_link;            

                if(isset($post->name) && $post->name != null){
                    $post_type = $post->name;
                }else{
                    $post_type = get_post_type();
                }

                if (is_single()) {
                    
                    // Get post type
                    $post_type = get_post_type();
                    
                    // Handle custom post types
                    if ($post_type != 'post') {
                        $post_type_object = get_post_type_object($post_type);
                        if ($post_type_object->has_archive) {
                            $output .= $separator . '<a href="' . esc_url(get_post_type_archive_link($post_type)) . '">' . $post_type_object->labels->name . '</a>';
                        }            
                        // Get custom taxonomy terms
                        $taxonomies = get_object_taxonomies($post_type, 'objects');
                        foreach ($taxonomies as $taxonomy) {
                            if ($taxonomy->hierarchical) {
                                $terms = get_the_terms($post->ID, $taxonomy->name);
                                if ($terms && !is_wp_error($terms)) {
                                    $main_term = $terms[0];
                                    if ($main_term->parent != 0) {
                                        $ancestors = get_ancestors($main_term->term_id, $taxonomy->name);
                                        $ancestors = array_reverse($ancestors);
                                        foreach ($ancestors as $ancestor) {
                                            $ancestor_term = get_term($ancestor, $taxonomy->name);
                                            $output .= $separator . '<a href="' . esc_url(get_term_link($ancestor_term)) . '">' . esc_html($ancestor_term->name) . '</a>';
                                        }
                                    }
                                    $output .= $separator . '<a href="' . esc_url(get_term_link($main_term)) . '">' . esc_html($main_term->name) . '</a>';
                                }
                            }
                        }
                        // Current post title
                        $output .= $separator;
                    } else {
                        $categories = get_the_category();
                        if ($categories) {
                            $category = $categories[0];
                            $output .= $separator . get_category_parents($category, true, $separator);
                        }
                    }
                    // Display the current post title
                    $output .= get_the_title();                    
                } elseif(is_archive()){
                    //if( $show_post_type_name == true ){
                        $post_type_object = get_queried_object();

                            if(!empty($archive_label)){
                                $output .= $separator .  esc_html($archive_label);
                            }else{
                                $output .= $separator . esc_html($post_type_object->label);
                            }                        
                    //}
                    if (is_category() || is_tax() || is_tag()) {
                        $term = get_queried_object();
                        $taxonomy = $term->taxonomy;
                        $taxonomy_obj = get_taxonomy($taxonomy);
                        $taxonomy_base = $taxonomy_obj->label;

                        if ($taxonomy_obj && isset($taxonomy_obj->object_type) && in_array('product', $taxonomy_obj->object_type)) {
                            $output.= __('Shop', 'rt-breadcrumb');
                        } 
                        //else {
                        //     $output.= ucfirst($taxonomy_base);
                        // }
                        // Handle categories and custom taxonomies                       
                        if ($term->parent != 0) {
                            $term_parents = get_ancestors($term->term_id, $term->taxonomy, 'taxonomy');
                            $term_parents = array_reverse($term_parents);
                            foreach ($term_parents as $parent) {
                                $parent_term = get_term($parent, $term->taxonomy);
                                $output .= '<a href="' . esc_url(get_term_link($parent_term)) . '">' . esc_html($parent_term->name) . '</a>';
                            }
                        }
                        $output .= single_term_title('', false);
                    }
                }elseif (is_home() && ! is_front_page() ) {                   
                    if ($post && !empty($post->post_parent)) {
                        $ancestors = get_post_ancestors($post->ID);
                        $ancestors = array_reverse($ancestors);
                        foreach ($ancestors as $ancestor) {
                            $output .= '<a href="' . esc_url(get_permalink($ancestor)) . '">' . get_the_title($ancestor) . '</a>' . $separator;
                        }
                    }
                    if ($post) {
                        $output .= $separator. esc_html(get_the_title($post->ID));
                    }
                    
                } elseif (is_page()) {
                    if ($post && !empty($post->post_parent)) {
                        $ancestors = get_post_ancestors($post->ID);
                        $ancestors = array_reverse($ancestors);
                        foreach ($ancestors as $ancestor) {
                            $output .= '<a href="' . esc_url(get_permalink($ancestor)) . '">' . get_the_title($ancestor) . '</a>';
                        }
                    }
                    $output .= $separator . get_the_title();
                    
                } elseif (is_category() || is_tax()) {                    
                        $term = get_queried_object();
                        $taxonomy = $term->taxonomy;
                        $taxonomy_obj = get_taxonomy($taxonomy);
                        $taxonomy_base = $taxonomy_obj->label;

                        if ($taxonomy_obj && isset($taxonomy_obj->object_type) && in_array('product', $taxonomy_obj->object_type)) {
                            $output.= $separator . __('Shop', 'rt-breadcrumb');
                        } else {
                            $output.= $separator . ucfirst($taxonomy_base);
                        }
                        // Handle categories and custom taxonomies
                        if ($term->parent != 0) {
                            $term_parents = get_ancestors($term->term_id, $term->taxonomy, 'taxonomy');
                            $term_parents = array_reverse($term_parents);
                            foreach ($term_parents as $parent) {
                                $parent_term = get_term($parent, $term->taxonomy);
                                $output .= '<a href="' . esc_url(get_term_link($parent_term)) . '">' . esc_html($parent_term->name) . '</a>' . $separator;
                            }
                        }

                    $output .= $separator . single_term_title('', false);
                    
                } elseif (is_search()) {
                    $output .= $separator . $search_result_title . ' ' . get_search_query();
                    
                } elseif (is_404()) {
                    $output .= $separator . __('404 Error', 'rtelements');
                }
                $breadcrumb_path = $output;
                echo $breadcrumb_path;
                ?>
            </div>
        </div>
    </div>
    <?php 
};