
<div class="swiper-slide">
    <div class="rts__single--testimonial slider_item">
        <div class="rts__rating--star">
            <?php
                if (!empty($item['rating_unmber'])) {
                    $rating = intval($item['rating_unmber']);
                    for ($i = 1; $i <= 5; $i++) {
                        $star_class = ($i <= $rating) ? 'fas fa-star' : '';
                        echo '<i class="rating ' . $star_class . '"></i>';
                    }
                }
            ?>
        </div>
        <?php if (!empty($description)) :   ?>
            <p class="rts__single--testimonial--text des">
                <?php echo wp_kses($description, wp_kses_allowed_html('post'))  ?>
            </p>
            <?php 
        endif; ?>
        <div class="rts__single--testimonial--author">
            <div class="rts__single--testimonial--author--meta">
                <?php if (!empty($image)) : ?>
                    <div class="rts__author--img">
                        <img src="<?php echo esc_url($image); ?>" 
                            alt="<?php echo isset($item['image']['alt']) ? esc_attr($item['image']['alt']) : ''; ?>">
                    </div>
                <?php endif; ?>

                <div class="rts__author--info">
                    <?php if (!empty($item['name'])) : ?>
                        <h5 class="mb-0 title"><?php echo esc_html($item['name']) ?></h5>
                    <?php endif ?>
                    <?php if (!empty($item['sub-name'])) :   ?>
                        <span class="designation"><?php echo esc_html($item['sub-name']) ?></span>
                    <?php endif ?>
                </div>
            </div>
            <?php if(!empty($settings['quote_icon']['value'])) : ?>
                <div class="rts__single--testimonial--quote">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>		
                </div>
                <?php 
            endif; ?>
        </div>
    </div>
</div>