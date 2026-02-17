<div class="gridarea coursearea style<?php echo esc_attr( $style )?>">
    <div class="cousre-area-tutor">
        <?php if ($settings['show_filter_option'] == 'yes') : ?>            
                <div class="row grid__row">
                    <div class="col-xl-12">
                        <div class="gridfilter_nav grid__filter__2 gridFilter portfolio-filter">
                            <button class="active" data-filter="*"><?php echo esc_html($settings['filter_style_one_title']) ?></button>
                            <?php 
                            if (!empty($settings['cat'])) {
                                    $select_cat = $settings['cat'];
                                    foreach ($select_cat as $catid) {
                                        $term = get_term_by('slug', $catid, 'course-category');
                                        if($term){
                                            $category_slug  =  $term->slug;
                                            $category_name  =  $term->name;    
                                            ?>
                                            <button data-filter=".<?php echo $category_slug; ?>" class=""><?php echo $category_name; ?></button>
                                            <?php
                                        }                                                
                                    }
                                } else {
                                    $categories = get_terms(array(
                                        'taxonomy' => $taxonomy,
                                        'hide_empty' => true,
                                    ));
                                    foreach ($categories as $category) {
                                        $category_slug = $category->slug;
                                        $category_name = $category->name;
                                    ?>
                                    <button data-filter=".<?php echo $category_slug; ?>" class=""><?php echo $category_name; ?></button>
                                    <?php
                                } 
                            } ?>
                        </div>
                    </div>
                </div>
        <?php endif; ?>

        <div class="row grid portfolio-filter course_grid">
            <?php
            if ($best_wp->have_posts()) :
                while ($best_wp->have_posts()) : $best_wp->the_post();                    
                    $taxonomy        = "course-category";
                    $cats_show       = get_the_term_list($best_wp->ID, $taxonomy, ' ', '<span class="separator">,</span> ');
                    $excerpt         = get_the_excerpt();
                    $the_link        = get_permalink();
                    $course_id       = get_the_ID();
                    $course_duration = get_tutor_course_duration_context();
                    $course_students = tutor_utils()->count_enrolled_users_by_course();
                    $tutor_lesson_count    = tutor_utils()->get_lesson_count_by_course();
                    $tutor_course_duration = get_tutor_course_duration_context();
                    $course_students = !empty($course_students) ? $course_students : 0;
                    $terms = get_the_terms($best_wp->ID, "course-category");
                    $termsString = "";
                    $termsSlug   = "";
                    global $post, $authordata;
                    $profile_url        = tutor_utils()->profile_url($authordata->ID, true);
                    foreach ($terms as $term) {
                        $termsString .= 'filter_' . $term->slug . ' ';
                        $termsSlug .= $term->name;
                    }
                    // Retrieve the categories for each course
                    $course_categories = get_the_terms(get_the_ID(), 'course-category');
                    $category_classes = '';
                    if ($course_categories && !is_wp_error($course_categories)) {
                        $category_classes = array_map(function ($cat) {
                            return $cat->slug;
                        }, $course_categories);
                        $category_classes = implode(' ', $category_classes);
                    }
                    ?>
                    <div class="col-xl-<?php echo $settings['course_col'] ?> col-lg-4 col-md-6 col-sm-6 col-12 grid-item <?php echo $category_classes; ?>">
                        <div class="gridarea__wraper">
                            <div class="gridarea__img">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                                <?php endif ?>
                                
                                <?php if ($settings['show_heart'] == 'yes') : ?>
                                    <div class="tutor-course-bookmark gridarea__small__icon">
                                        <?php
                                            $course_id      = get_the_ID();
                                            $is_wish_listed = tutor_utils()->is_wishlisted($course_id);
                                            $login_url_attr = '';
                                            $action_class   = '';
                                            if (is_user_logged_in()) {
                                                $action_class = apply_filters('tutor_wishlist_btn_class', 'tutor-course-wishlist-btn');
                                            } else {
                                                $action_class = apply_filters('tutor_popup_login_class', 'tutor-open-login-modal');

                                                if (!tutor_utils()->get_option('enable_tutor_native_login', null, true, true)) {
                                                    $login_url_attr = 'data-login_url="' . esc_url(wp_login_url()) . '"';
                                                }
                                            }
                                            echo '<a href="javascript:;" ' . $login_url_attr . ' class="' . esc_attr($action_class) . ' save-bookmark-btn tutor-iconic-btn tutor-iconic-btn-secondary" data-course-id="' . esc_attr($course_id) . '">
                                                <i class="' . ($is_wish_listed ? 'tutor-icon-bookmark-bold' : 'tutor-icon-bookmark-line') . '"></i>
                                            </a>';
                                                    ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="gridarea__content">
                                <div class="categories">
                                    <?php
                                            $color_classes = ['blue__color', 'pink__color', 'green__color', 'orange__color', 'yellow__color'];
                                            $color_value = $color_classes[$best_wp->current_post % count($color_classes)];
                                            ?>

                                    <?php if ($settings['show_cates'] == 'yes') : ?>
                                        <div class="grid__badge"><?php echo esc_html($course_categories[0]->name) ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="gridarea__list">
                                    <ul>
                                        <?php if ($settings['show_lesson'] == 'yes') : ?>
                                            <li class="lesson">
                                            <?php 
                                            if (!empty($tutor_lesson_count)) {  ?>
                                                    <i class="rt-book"></i><?php echo $tutor_lesson_count; ?> 
                                                    <?php if($tutor_lesson_count > 1) { ?>
                                                        <?php echo esc_html($settings['lesson_text'].'s', 'rtelements');
                                                    } else { 
                                                     echo esc_html($settings['lesson_text'], 'rtelements');
                                                    }
                                                }
                                              ?>                                                
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($settings['show_course_time'] == 'yes') : ?>
                                            <li class="clock">
                                                <?php if (!empty($tutor_course_duration)) :   ?>
                                                    <i class="rt-clock-regular"></i> <?php echo $tutor_course_duration; ?>
                                                <?php endif ?>
                                            </li>
                                        <?php endif; ?>

                                        <?php if ($settings['show_enrolled_count'] == 'yes') : ?>
                                            <?php 
                                                $total_enrolled = tutor_utils()->get_option( 'enable_course_total_enrolled' );
                                            ?>
                                            <li class="user">
                                                <?php if (!empty($total_enrolled)) :   ?>
                                                    <i class="rt-user"></i>
                                                    <?php echo $total_enrolled; ?>
                                                    <?php echo $total_enrolled > 1 ? esc_html__($settings['student_text'].'s', 'studyhub') : esc_html__($settings['student_text'], 'studyhub') ?>
                                                <?php endif ?>
                                            </li>
                                        <?php endif; ?>

                                    </ul>
                                </div>
                                <div class="gridarea__heading">
                                    <h3><a href="<?php the_permalink() ?>"><?php echo wp_trim_words( get_the_title(), $limit, 7); ?></a></h3>
                                </div>
                                <?php if ($settings['show_admin'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($profile_url) ?>">
                                        <div class="gridarea__small__img">
                                            <div class="gridarea__small__content">
                                                <h6><?php echo get_the_author() ?></h6>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>
                                
                                <div class="gridarea__bottom">
                                    <?php if ($settings['show_rating'] == 'yes') : ?>

                                        <div class="tutor-ratings gridarea__star">
                                            <div class="tutor-ratings-stars">
                                                <?php
                                                    $course_rating = tutor_utils()->get_course_rating();
                                                    tutor_utils()->star_rating_generator_course($course_rating->rating_avg);
                                                ?>
                                            </div>
                                                <?php if ($course_rating->rating_avg > 0) : ?>
                                                    <div class="tutor-ratings-average">
                                                        <?php echo esc_html(apply_filters('tutor_course_rating_average', $course_rating->rating_avg)); ?>
                                                    </div>
                                                    <div class="tutor-ratings-count">
                                                        (<?php echo esc_html($course_rating->rating_count > 0 ? $course_rating->rating_count : 0); ?>)
                                                    </div>
                                                <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="gridarea__price green__color">
                                        <?php
                                            $course_id = get_the_ID();
                                            $price_html = '<span class="price-tutor">' . __('Free', 'rtelements') . '</span>';
                                            if (tutor_utils()->is_course_purchasable()) {
                                                $product_id = tutor_utils()->get_course_product_id($course_id);
                                                $price    = apply_filters('get_tutor_course_price', null, get_the_ID());
                                                if ($price) {
                                                    $price_html = '<span class="price-tutor"> ' . $price . '</span> ';
                                                }
                                            }
                                            echo $price_html;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo 'No courses found.';
            endif;
            ?>
        </div>
    </div>    
</div>