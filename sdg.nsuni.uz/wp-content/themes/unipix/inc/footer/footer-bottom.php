<?php
    global $unipix_option;  
?>
<div class="footer-bottom" <?php if(!empty( $copyright_bg)): ?> style="background: <?php echo esc_attr($copyright_bg); ?> !important;" <?php elseif(!empty( $copy_trans)): ?> style="background: <?php echo esc_attr($copy_trans); ?> !important;" <?php endif; ?>>
    <div>
        <div class="copyright_border">            
            <div class="copyright text-center" <?php if(!empty( $copy_space)): ?> style="padding: <?php echo esc_attr($copy_space); ?>" <?php endif; ?> >
                <?php if(!empty($unipix_option['copyright'])){?>
                <p><?php echo wp_kses($unipix_option['copyright'], 'unipix'); ?></p>
                <?php }
                 else{
                    ?>
                <p><?php echo esc_html('&copy;')?> <?php echo date("Y");?>. <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> 
                </p>
                <?php
                 }   
                ?>
            </div>
        </div>
    </div>
</div>


