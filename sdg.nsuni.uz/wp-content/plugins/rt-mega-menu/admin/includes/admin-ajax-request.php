<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.
if ( !class_exists('RTMEGA_MENU_Admin_Ajax')) {
    class RTMEGA_MENU_Admin_Ajax {

        function __construct(){

            add_action( "wp_ajax_rtmega_update_menu_options", array ( $this, 'rtmega_update_menu_options' ) );
            add_action( "wp_ajax_rtmega_get_menu_options", array ( $this, 'rtmega_get_menu_options' ) );
            add_action( "wp_ajax_rtmega_set_menu_item_mega_button", array ( $this, 'rtmega_set_menu_item_mega_button' ) );
            add_action( "wp_ajax_rtmega_delete_menu_options", array ( $this, 'rtmega_delete_menu_options' ) );
            add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'rtmega_menu_item_icon' ), 10, 2 );
        }

        function rtmega_menu_item_icon( $item_id, $item ) {
                ?>
                    <div class="rtmega_saved_icon_wrapper_free" style="clear: both;">
                        <div class="rtmega_saved_icon"><i class=""></i></div>
                        <div class="rtmega_saved_icon_actions">
                            <button type="button" class="rtmega_set_icon_toggle_in_nav_item_free" data-menu_item_id="<?php echo esc_attr($item_id); ?>"><?php echo 'Add Icon'; ?></button>
                        </div>
                    </div>
                <?php
        }

        public function rtmega_update_menu_options() {

            check_ajax_referer('rtmega_templates_import_nonce', 'nonce');
        
            if (!isset($_POST['settings'], $_POST['menu_id'], $_POST['actualAction'])) {
                wp_send_json_error(['message' => esc_html__('Invalid request.', 'rt-mega-menu')]);
                wp_die();
            }
        
            $actual_action = sanitize_text_field(wp_unslash($_POST['actualAction']));
            $menu_id = absint($_POST['menu_id']); // No need to sanitize twice
        
            if ($actual_action === 'saveMenuOptions') {
        
                $menu = wp_get_nav_menu_object($menu_id);

                if ($menu) {

                    $menu_slug = $menu->slug;

                    $settings = isset($_POST['settings']) ? array_map('sanitize_text_field', (array)wp_unslash($_POST['settings'])) : [];
                    update_option("rtmega_menu_settings_$menu_slug", $settings);
                }
        
            } else {
                if (!isset($_POST['menu_item_id'])) {
                    wp_send_json_error(['message' => esc_html__('Menu item ID is missing.', 'rt-mega-menu')]);
                    wp_die();
                }
        
                $menu_item_id = absint($_POST['menu_item_id']); // Ensure it's a valid integer
        
                $settings = !empty($_POST['settings']) ? array_map('sanitize_text_field', (array) wp_unslash($_POST['settings'])) : [];
                $css = !empty($_POST['css']) ? array_map('sanitize_text_field', (array)  wp_unslash($_POST['css'])) : [];
        
                update_post_meta($menu_item_id, 'rtmega_menu_settings', ['switch' => 'on', 'content' => $settings, 'css' => $css]);
            }
        
            wp_send_json_success(['message' => esc_html__('Successfully saved data.', 'rt-mega-menu'), 'settings', $prev_settings, 'actual_action' => $actual_action, 'menu-slug' => $menu_slug, 'menu_id' => $menu_id]);
            wp_die();
        }
        

        public function rtmega_set_menu_item_mega_button() {
            check_ajax_referer('rtmega_templates_import_nonce', 'nonce');
            if(isset($_POST['menu_item_id'])){

                $menu_item_id = sanitize_text_field(wp_unslash($_POST['menu_item_id']));
                $rtmega_menu_item_settings = get_post_meta( $menu_item_id, 'rtmega_menu_settings', true );

                wp_send_json_success( $rtmega_menu_item_settings ) ;


            }
            wp_die();
        }

        public function rtmega_delete_menu_options() {
            check_ajax_referer('rtmega_templates_import_nonce', 'nonce');
            if(isset($_POST['menu_item_id'])){

                $menu_item_id = sanitize_text_field(wp_unslash($_POST['menu_item_id']));
                $rtmega_menu_item_settings = get_post_meta( $menu_item_id, 'rtmega_menu_settings', true );

                if(isset($rtmega_menu_item_settings)){
                    delete_post_meta( $menu_item_id, 'rtmega_menu_settings' );
                    wp_send_json_success( $rtmega_menu_item_settings, 200 );
                }else{
                    wp_send_json_success( $rtmega_menu_item_settings, 404 );
                }
            }
            wp_die();
        }

        public function rtmega_get_menu_options() {

            check_ajax_referer('rtmega_templates_import_nonce', 'nonce');

            if(isset($_POST['menu_item_id'])){

                $menu_item_id = sanitize_text_field(wp_unslash($_POST['menu_item_id']));

                $RTMEGA_menupos_left = $RTMEGA_menupos_left = $RTMEGA_menupos_top = $RTMEGA_menuwidth = $rtmega_menu_item_css = '';

                
                $rtmega_menu_item_settings = get_post_meta($menu_item_id, 'rtmega_menu_settings', true);

                if (isset($rtmega_menu_item_settings['css'])) {
                    $css = $rtmega_menu_item_settings['css'];

                    $RTMEGA_menupos_left = $css['left'] ?? null;
                    $RTMEGA_menupos_right = $css['right'] ?? null;
                    $RTMEGA_menupos_top = $css['top'] ?? null;
                    $RTMEGA_menuwidth = $css['width'] ?? null;
                    $RTMEGA_menu_full_width = $css['full_width'] ?? null;
                }


                

                ?>
                    <div id="tabs-content">
                        <div id="tab1" class="tab-content">
                            <h2>Select a template</h2>
                            <!-- elementor_library -->
                            <?php 

                                $activeKitId = get_option( 'elementor_active_kit' );

                                $elementor_library_query_args = array(
                                    'post_type' => 'elementor_library',
                                    'posts_per_page' => -1,
                                    'orderby' => 'id',
                                    'order' => 'DESC'
                                );

                                $elementor_library_query = new WP_Query($elementor_library_query_args);
                                

                                
                                $content_tempalte = '';
                                if(isset($rtmega_menu_item_settings['content']['rtmega_template'])){
                                    $content_tempalte = $rtmega_menu_item_settings['content']['rtmega_template'];
                                }

                            ?>
                            <form action="" onsubmit="return false" id='rtmega_menu_items_settings'>    
                                <div class="rtmega-menu-option-inputs">
                                    <ul class="rtmega-menu-option-input-list"> 
                                        <li>
                                            <?php 
                                                if($elementor_library_query->have_posts()){
                                                    $current_id = get_the_ID();

                                                    if($activeKitId !== $current_id) {
                                                        ?>
                                                        <select name="rtmega_template" id="rtmega-template-select">
                                                            <option value="">Select Template</option>
                                                            <?php 
                                                                
                                                                while ($elementor_library_query->have_posts()) {
                                                                    $elementor_library_query->the_post();
                                                                        ?>
                                                                            <option value="<?php echo esc_attr(get_the_ID());?>" <?php echo esc_attr($content_tempalte == get_the_ID() ? 'selected' : ''); ?> ><?php the_title( );?></option>
                                                                        <?php
                                                                }
                                                                
                                                            ?>
                                                        </select>
                                                    <?php } 
                                                 }else{
                                                ?>
                                                <strong class="rtmega-text-danger ">Ops! Templates not found. <a href="<?php echo esc_url(admin_url('edit.php?post_type=elementor_library&tabs_group=library')) ?>" title="Click here to create a template.">Create</a> a new template.</strong>
                                                <?php
                                            } ?>
                                            <?php 
                                            if($elementor_library_query->have_posts()){ ?>
                                                <a href="<?php echo esc_url(admin_url('post.php?post='.$content_tempalte.'&action=elementor')) ?>" id="edit-remega-selected-template" class="button" target="_blank">Edit Template</a>
                                            <?php } ?>
                                        </li>
                                       
                                                <li class="pro-features-placeholders">
                                                    <div class="option-label">Badge : </div>
                                                    <div class="option-inputs">
                                                        
                                                        <img src="<?php echo esc_url(RTMEGA_MENU_PL_URL.'admin/assets/img/badge_pro_condition.png'); ?>" class="rtmega_pro_warning_img" alt="badge_pro_condition">
                                                        <p class="rtmega-pro-notice rtmega-text-danger">Please activate plugin license to use this advanced features</p>
                                                            
                                                    </div>
                                                </li>
                                                <li class="pro-features-placeholders">   
                                                    <div class="option-label">Icon : </div>
                                                    <div class="option-inputs">
                                                        <img src="<?php echo esc_url(RTMEGA_MENU_PL_URL.'admin/assets/img/icon_pro_condition.png'); ?>" class="rtmega_pro_warning_img" alt="icon_pro_condition">
                                                        <p class="rtmega-pro-notice rtmega-text-danger">Please activate plugin license to use this advanced features</p>
                                                    </div>
                                                </li>
                                            
                                        
                                    
                                        
                                        <?php do_action( 'after_content_options_rt_mega_menu' ); ?>
                                    </ul>
                                </div>
                            </form>
                            
                        </div>
                        <div id="tab2" class="tab-content" style="display: none;">
                            <form action="" onsubmit="return false" id='rtmega_menu_items_css'>          
                                <div class="rtmega-menu-option-inputs">
                                    <ul class="rtmega-menu-option-input-list">
                                        <li>
                                            <div class="option-label">Position : </div>
                                            <div class="option-inputs">
                                                <label>
                                                    <strong>Left (ex: 100px or 100%)</strong>
                                                    <input type="text" name="left" value="<?php echo esc_attr($RTMEGA_menupos_left); ?>">
                                                </label>
                                                <label>
                                                    <strong>Right (ex: 100px or 100%)</strong>
                                                    <input type="text" name="right" value="<?php echo esc_attr($RTMEGA_menupos_right); ?>">
                                                </label>
                                                <label>
                                                    <strong>Top (ex: 100px or 100%)</strong>
                                                    <input type="text" name="top" value="<?php echo esc_attr($RTMEGA_menupos_top); ?>">
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="option-label">Mega Menu Size : </div>
                                            <div class="option-inputs">
                                                <label>
                                                    <strong>Width (ex: 100px or 100%)</strong>
                                                    <input type="text" name="width" value="<?php echo esc_attr($RTMEGA_menuwidth); ?>">
                                                </label>
                                                <label>
                                                    <strong>Full Width</strong>
                                                    <input 
                                                    type="checkbox" 
                                                    class="menu-item-checkbox emicons_full_width_switch" 
                                                    name="full_width" 
                                                    value="<?php echo esc_attr( $RTMEGA_menu_full_width == 'on' ? 'on' : '' ) ?>" <?php echo esc_attr( $RTMEGA_menu_full_width == 'on' ? 'checked' : '' ) ?>>
                                                </label>
                                            </div>
                                        </li>
                                        <?php do_action( 'after_style_options_rt_mega_menu' ); ?>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div> <!-- END tabs-content -->

                    <script>
                        (function($){

                            $(".rt_mega_menu_full_width_switch").change(function() {
                                if($(this).prop('checked')) {
                                   $(this).val('on');
                                } else {
                                   $(this).val('off');
                                }
                            });

                        })(jQuery);
                    </script>
                <?php

            }
            
            wp_die();
        }


    }

    $RTMEGA_MENU_Admin_Ajax = new RTMEGA_MENU_Admin_Ajax();
}