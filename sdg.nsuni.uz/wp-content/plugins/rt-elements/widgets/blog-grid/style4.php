<div class="grid-item rts-blog-post <?php echo esc_html($col); ?>">
    <div class="single-blog blog-item">
        <div class="blog single-blog__content">
            <?php if (has_post_thumbnail()) : ?>
                <div class="blog__thumb">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                    </a>
                </div>
            <?php endif; ?>
            <div class="blog__meta">
                <div class="blog__meta--da">
                    <?php if ($settings['blog_date_show_hide'] == 'yes') : ?>
                        <div class="rt-date">
                            <span><i class="rt-calendar-days"></i></span>
                            <span><?php echo get_the_date(); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($settings['blog_avatar_show_hide'] == 'yes') : ?>
                        <div class="rt-author">
                            <span><i class="rt-user-1"></i></span>
                            <span><a href="<?php the_permalink(); ?>"><?php echo get_the_author(); ?></a></span>
                        </div>
                        <?php 
                    endif; ?>
                </div>
                <h5 class="blog__title">
                    <a href="<?php the_permalink(); ?>" class="post-title">
                        <?php
                            $length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : '10';
                            echo wp_trim_words( get_the_title(), $length, '');
                        ?>
                    </a>
                </h5>
                <?php if (!empty($settings['button_text'])) : ?>
                    <a href="<?php the_permalink(); ?>" class="react_button">
                        <?php echo wp_kses_post($settings['button_text']); ?>
                        <?php if (!empty($settings['button_icon']['value'])) : ?>
                            <span><?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?></span>
                        <?php else : ?>
                            <span><i class="rt rt-arrow-right-regular"></i></span>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>



