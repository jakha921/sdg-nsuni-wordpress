<?php
add_action( 'wp_ajax_getAcademicSearchResult', 'getAcademicSearchResult' );
add_action( 'wp_ajax_nopriv_getAcademicSearchResult', 'getAcademicSearchResult' );
function getAcademicSearchResult(){

            $args = $_POST['args'];
            
            $args = json_decode(stripslashes($args), true);

            $settings = $_POST['settings'];
            
            $settings = json_decode(stripslashes($settings), true);

            $current_page = isset($_POST['currentPage']) && !empty($_POST['currentPage']) ? $_POST['currentPage'] : '' ;

            

            $args['s'] = $_POST['searchKey'];
            $departmentId = isset($_POST['departmentId']) && !empty($_POST['departmentId']) ? $_POST['departmentId'] : '' ;

            if(!empty($departmentId)){
                $args['meta_query'] = array(
                    array(
                        'key' => 'program_select_department',
                        'value' => $departmentId,
                        'compare' => '='
                    )
                );
            }
            

            if(!empty($current_page)){
                $args['paged'] = $current_page;
            }
            

            $best_wp = new WP_Query($args);

            if($best_wp->have_posts()){
                while($best_wp->have_posts()): $best_wp->the_post();					
                    $termsArray  = get_the_terms( $best_wp->ID, "rt-program-category" );  //Get the terms for this particular item
                    $termsString = ""; //initialize the string that will contain the terms
                    $termsSlug   = "";
                    if(!empty($termsArray)): 
                        $x = 0;
                        foreach ( $termsArray as $term ) { 
                            $x++;
                            $termsString .= 'filter_'.$term->slug.' '; 
                            if($x > 1){
                                $termsSlug .= ', ';
                            }
                            $termsSlug .= $term->name;                            
                        }		
                    endif;		
                    $content = get_the_content();	
                ?>
                    <div class="result-col col-lg-3 col-md-4 col-sm-6">
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
            }else{
                wp_send_json_error();
            }
            wp_die();

}