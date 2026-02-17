<?php
    get_header();
    global $unipix_option;
	//take metafield value            
   
    $location        = get_post_meta( get_the_ID(), 'location', true );               
    $phone           = get_post_meta( get_the_ID(), 'phone', true );
    $email           = get_post_meta( get_the_ID(), 'email', true );               
    $facebook        = get_post_meta( get_the_ID(), 'facebook', true );
    $twitter         = get_post_meta( get_the_ID(), 'twitter', true );
    $google_plus     = get_post_meta( get_the_ID(), 'google_plus', true );
    $linkedin        = get_post_meta( get_the_ID(), 'linkedin', true );
    $team_desination = get_post_meta( get_the_ID(), 'designation', true );  
    $short_desc      = get_post_meta( get_the_ID(), 'shortbio', true );
    $getin           = get_post_meta( get_the_ID(), 'getin', true );
    $getinurl        = get_post_meta( get_the_ID(), 'getinurl', true );

	while ( have_posts() ) : the_post();
                          
    ?>
<div class="container">
    <div id="content">
        <div class="row btm-row bg-team team-single-p">
            <div class="thunb col-lg-4 col-md-12">
                <div class="inner-images">
                    <div class="ps-image">
                        <?php the_post_thumbnail(); ?>
                    </div>                          
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="team-information">                    
                    <div class="designation-info">
                        <?php echo esc_html($team_desination); ?>
                    </div>

                    <h1 class="team-name"><?php the_title(); ?></h1> 
                                    
                    <?php if(!empty($short_desc)): ?>
                        <div class="short-desc">
                            <?php echo esc_html($short_desc); ?>
                        </div>
                    <?php endif; ?>
                    

                    <div class="team-address-text">
                        <?php if($email):?>
                            <div class="adress-box mt-30">                                
                                <div class="icon-link">
                                    <i class="rt-envelope"></i>
                                </div>
                                <div class="address-content">
                                    <span class="fs-14"><?php echo esc_html__("Email Address",'unipix');?></span>                                  
                                    <p class="fs-20"> <?php echo esc_html($email); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($phone):?>
                            <div class="adress-box mt-30">                                
                                <div class="icon-link">
                                    <i class="rt-phone-volume"></i>
                                </div>
                                <div class="address-content">
                                    <span class="fs-14"><?php echo esc_html__("Phone Number",'unipix');?></span>
                                    <p class="fs-20"> <?php echo esc_html($phone); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($location):?>
                            <div class="adress-box mt-30">                                
                                <div class="icon-link">
                                    <i class="rt-location-dot"></i>
                                </div>
                                <div class="address-content">
                                    <span class="fs-14"><?php echo esc_html__("Location",'unipix');?></span>
                                    <p class="fs-20"><?php echo esc_html( $location );?></p>
                                </div>

                            </div>
                        <?php endif; ?>

                        <?php if(!empty($getin)): ?>
                            <a href="<?php echo esc_url( $getinurl );?>" class="theme_btn"><?php echo esc_html($getin);?></a>
                        <?php endif; ?>
                    </div>
                </div>                
            </div>          
        </div>
    </div>
</div>
    <?php endwhile; ?>

 <?php the_content();?>
<!-- Single Team End -->
<?php
get_footer();