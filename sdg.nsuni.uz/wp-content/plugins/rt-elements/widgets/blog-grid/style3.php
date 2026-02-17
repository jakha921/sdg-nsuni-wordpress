<div class="grid-item rts-blog-post <?php echo esc_html($col); ?>">
    <div class="blog__single--item blog-item">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>" class="blog__single--item--link">
                <div class="blog__single--item--thumb">
                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                </div>
            </a>
        <?php endif; ?>
        
        <div class="blog__single--item--meta">
            <?php if ($settings['blog_category_show_hide'] == 'yes') :
               
                $categories = get_the_category();
                if (!empty($categories)) {
                    foreach ($categories as $category) {
                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="rt_cat">' . esc_html($category->name) . '</a> ';
                    }
                }                
            endif; ?>
            <h5 class="blog__single--item--title post-title">
                <a href="<?php the_permalink(); ?>">
                    <?php
                        $length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : '10';
                        echo wp_trim_words( get_the_title(), $length, '');
                    ?>
                </a>
            </h5>
            <p class="blog__single--item--excerpt post-des">
                <?php echo wp_trim_words( get_the_excerpt(), 8, '...'); ?>
            </p>

            <div class="blog__single--item--info">
                <?php if ($settings['blog_avatar_show_hide'] == 'yes') : ?>
                    <div class="rt-author">
                        <span><i class="rt-user-1"></i></span>
                        <a href="<?php the_permalink(); ?>"><?php echo get_the_author(); ?></a>
                    </div>
                <?php endif; ?>

                <?php if ($settings['blog_date_show_hide'] == 'yes') : ?>
                    <div class="rt-date">
                        <span><i class="rt-calendar-days"></i></span>
                        <?php echo get_the_date(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
