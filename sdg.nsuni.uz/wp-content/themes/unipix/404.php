<?php
wp_head();
global $unipix_option;?>
<div class="page-error">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="container">
                <section class="error-404 not-found">
                    <div class="page-content">
                        <?php if (!empty($unipix_option['404_bg']['url'])) {?>
                            <img class="error-image"  src="<?php echo esc_url($unipix_option['404_bg']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                        <?php }
                        else{ ?>
                            <h2>
                            <span>
                                <?php
                                    if (!empty($unipix_option['title_404'])) {
                                        echo esc_html($unipix_option['title_404']);
                                    } else {  
                                        echo esc_html__('404', 'unipix');
                                    }
                                ?>
                            </span>                           
                        </h2>                 
                       <?php } 
                        ?>

                        <h2 class="opps-nothing">
                            
                            <?php
                                if (!empty($unipix_option['text_404'])) {
                                    echo esc_html($unipix_option['text_404']);
                                } else {
                                    echo esc_html__('Oops! Nothing Was Found', 'unipix');
                                }
                            ?>
                        </h2>            
                        <p class="error-msg">
                            <?php echo esc_html__("Sorry, we couldn't find the page you where looking for. We suggest that you return to homepage.", 'unipix'); ?>
                            </p>
                        <a class="reacbutton" href="<?php echo esc_url(home_url('/')); ?>">
                            <?php
                                if (!empty($unipix_option['back_home'])) {
                                    echo esc_html($unipix_option['back_home']);
                                } else {
                                    esc_html_e('Or back to homepage', 'unipix');
                                }
                            ?>
                        </a>
                    </div><!-- .page-content -->
                </section><!-- .error-404 -->
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
</div> <!-- .page-error -->
<?php
wp_footer();
