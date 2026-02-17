
<div class="swiper-slide">
    <div class="single-testimonial slider_item">
        <div class="rt-between mb--50">
            <?php 
            if(!empty($settings['quote_icon']['value'])) : ?>
                <div class="rt-icon rts__single--testimonial--quote">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>		
                </div>
                <?php 
            endif; ?>
            <div class="rt-review">
                <div class="rating-star mb--10">
                    <?php
                        if (!empty($item['rating_unmber'])) {
                            $rating = intval($item['rating_unmber']);
                            for ($i = 1; $i <= 5; $i++) {
                                $star_class = ($i <= $rating) ? 'fas fa-star' : '';
                                echo '<i class="rating ' . $star_class . '"></i>';
                            }
                        }
                    if(!empty($item['rating_text'])) : ?>
                        <p class="des rt-secondary rt-medium --p-s"><?php echo wp_kses_post($item['rating_text']);?></p>
                        <?php 
                    endif; ?>
                </div>
            </div>
        </div>
        <?php 
        if(!empty($description)) : ?>
            <p class="des testimonial-text">
                <?php echo wp_kses_post($description); ?>
            </p>
            <?php 
        endif; ?>
        <div class="rt-testimonial-author mt--50">
            <div class="rt-author-meta rt-flex rt-gap-20">
                <?php 
                if (!empty($image)) :   ?>
                    <div class="rt-author-img rts__author--img">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr('image') ?>">
                    </div>
                    <?php 
                endif;                 
                if (!empty($item['name'] || $item['sub-name'])) :   ?>
                    <div class="info">
                        <?php if (!empty($item['name'])) :   ?>
                            <h5 class="title mb-1"><?php echo esc_html($item['name']) ?></h5>
                        <?php endif;
                        if (!empty($item['sub-name'])) :   ?>
                            <p class="designation"><?php echo esc_html($item['sub-name']) ?></p>
                        <?php endif; ?>
                    </div>
                    <?php 
                endif; ?>
            </div>
        </div>
    </div>  
</div>

