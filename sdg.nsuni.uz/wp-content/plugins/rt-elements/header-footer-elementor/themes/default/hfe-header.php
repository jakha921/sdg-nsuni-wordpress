<?php global $unipix_option; 
    $site_defualt_mode = !empty($unipix_option['site_defualt_mode']) ? $unipix_option['site_defualt_mode'] : '';
    $site_mode = ($site_defualt_mode =='dark') ? 'data-theme="dark"' : '';    
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="University Education WordPress Theme">
 <meta name="keywords" content="Elementor, Education, University">
<link rel="profile" href="//gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php do_action( 'wp_body_open' ); ?>    
    <div class="close-button body-close"></div>   
  
    <!--Preloader start here-->
    <?php get_template_part( 'inc/header/preloader' ); ?>
    <!--Preloader area end here-->
    
    <?php
        $gap = ''; 
        if ( is_active_sidebar( 'footer_top' )){
        $gap = 'footer-bottom-gaps';
        
    }    
    $header_id = Rts_Header_Footer_Elementor::get_settings( 'Rts_type_header', '' );   
  
    $fixed_header = get_post_meta($header_id, 'header-position', true);
    $fixed_header = !empty($fixed_header) ? 'fixed-header' : '';?>
    
    <?php        
        $extrapadding       = !empty($unipix_option['show_call_btns']) ? '' : 'lesspadding';  
    ?>
    <div id="page" class="site <?php echo esc_attr( $gap );?> <?php echo esc_attr($extrapadding);?>">
    <?php  get_template_part('inc/header/search'); get_template_part('inc/header/off-canvas'); ?>
    	<header id="reactheme-header" class="header-style-1  mainsmenu <?php echo esc_attr($fixed_header) ;?>">   
	     
	    <div class="header-inner">
       <?php 

		if( is_404() ){
			return;
		} else {
			do_action( 'hfe_header' );
		} ?>
        </div>
    </header>   
    <?php do_action('hfe_header_after__header'); ?>  
        <div class="main-contain offcontents">