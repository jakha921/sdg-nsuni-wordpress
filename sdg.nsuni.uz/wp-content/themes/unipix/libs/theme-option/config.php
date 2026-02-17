<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('Redux')) {
    return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "unipix_option";

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters('unipix/opt_name', $opt_name);

/*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    'page_priority'        => 8,
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__('unipix Options', 'unipix'),
    'page_title'           => esc_html__('unipix Options', 'unipix'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => false,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 20,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    'forced_dev_mode_off' => true,
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    'compiler' => true,

    // OPTIONAL -> Give you extra features
    'page_priority'        => 20,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    'force_output' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    )
);

// Panel Intro text -> before the form
if (!isset($args['global_variable']) || $args['global_variable'] !== false) {
    if (!empty($args['global_variable'])) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace('-', '_', $args['opt_name']);
    }
    $args['intro_text'] = sprintf(esc_html__('unipix Theme', 'unipix'), $v);
} else {
    $args['intro_text'] = esc_html__('unipix Theme', 'unipix');
}

Redux::setArgs($opt_name, $args);

/*
     * ---> END ARGUMENTSunipix
      
     */
// -> START General Settings
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('General Settings', 'unipix'),
        'id'               => 'basic-checkbox',
        'customizer_width' => '450px',
        'fields'           => array(

            array(
                'id'       => 'enable_global',
                'type'     => 'switch',
                'title'    => esc_html__('Enable Global Settings', 'unipix'),
                'subtitle' => esc_html__('If you enable global settings all option will be work only theme option', 'unipix'),
                'default'  => false,
            ),

            array(
                'id'       => 'container_size',
                'title'    => esc_html__('Container Size', 'unipix'),
                'subtitle' => esc_html__('Container Size example(1200px)', 'unipix'),
                'type'     => 'text',
                'default'  => '1320px',
            ),

            array(
                'id'       => 'rs_siteicon',
                'type'     => 'media',
                'title'    => esc_html__('Upload Favicon', 'unipix'),
                'subtitle' => esc_html__('Upload your faviocn here', 'unipix'),
                'url' => true
            ),  
            array(
                'id'       => 'show_top_bottom',
                'type'     => 'switch', 
                'title'    => esc_html__('Scroll to Top', 'unipix'),
                'subtitle' => esc_html__('You can show or hide here', 'unipix'),
                'default'  => false,
            ),         
        )
    )
);
// -> START Style Section
Redux::setSection($opt_name, array(
    'title'            => esc_html__('Style', 'unipix'),
    'id'               => 'stle',
    'customizer_width' => '450px',
    'icon' => 'el el-brush',
));

Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Global Style', 'unipix'),
        'desc'   => esc_html__('Style your theme', 'unipix'),
        'subsection' => true,
        'fields' => array(
            array(
                'id'        => 'body_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Body Backgroud Color', 'unipix'),
                'subtitle'  => esc_html__('Pick body background color', 'unipix'),
                'validate'  => 'color',
            ),
            array(
                'id'        => 'body_text_color',
                'type'      => 'color',
                'title'     => esc_html__('Text Color', 'unipix'),
                'subtitle'  => esc_html__('Pick text color', 'unipix'),
                'default'   => '#737477',
                'validate'  => 'color',
            ),
            array(
                'id'        => 'primary_color',
                'type'      => 'color',
                'title'     => esc_html__('Primary Color', 'unipix'),
                'subtitle'  => esc_html__('Select Primary Color.', 'unipix'),
                'default'   => '#890c25',
                'validate'  => 'color',
            ),
            array(
                'id'        => 'secondary_color',
                'type'      => 'color',
                'title'     => esc_html__('Secondary Color', 'unipix'),
                'subtitle'  => esc_html__('Select Secondary Color.', 'unipix'),
                'validate'  => 'color',
                'default'   => '#110c2d'
            ),
            array(
                'id'        => 'title_color',
                'type'      => 'color',
                'title'     => esc_html__('Title Color', 'unipix'),
                'subtitle'  => esc_html__('Select Title Color.', 'unipix'),
                'validate'  => 'color',
                'default'   => '#110c2d'
            )
        )
    )
);

//-> START Typography
Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('Typography', 'unipix'),
        'id'     => 'typography',
        'desc'   => esc_html__('You can specify your body and heading font here', 'unipix'),
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'       => 'opt-typography-body',
                'type'     => 'typography',
                'title'    => esc_html__('Body Font', 'unipix'),
                'subtitle' => esc_html__('Specify the body font properties.', 'unipix'),
                'google'   => true,
                'font-style' => false,
                'default'  => array(
                    'font-size'   => '16px',
                    'font-family' => 'Jost',
                    'font-weight' => '400',
                ),
            ),
            array(
                'id'       => 'opt-typography-menu',
                'type'     => 'typography',
                'title'    => esc_html__('Navigation Font', 'unipix'),
                'subtitle' => esc_html__('Specify the menu font properties.', 'unipix'),
                'google'   => true,
                'font-backup' => true,
                'all_styles'  => true,
                'default'  => array(
                    'color'       => '',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '15px',
                    'font-weight' => '500',
                ),
            ),
            array(
                'id'          => 'opt-typography-h1',   
                'type'        => 'typography',
                'title'       => esc_html__('Heading H1', 'unipix'),
                'font-backup' => true,
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'unipix'),
                'default'     => array(
                    'color'       => '#110c2d',
                    'font-style'  => '700',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '46px',
                    'line-height' => '56px'

                ),
            ),
            array(
                'id'          => 'opt-typography-h2',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H2', 'unipix'),
                'font-backup' => true,
                'all_styles'  => true,
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'unipix'),
                'default'     => array(
                    'color'       => '#110c2d',
                    'font-style'  => '700',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '36px',
                    'line-height' => '46px'

                ),
            ),
            array(
                'id'          => 'opt-typography-h3',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H3', 'unipix'),
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'unipix'),
                'default'     => array(
                    'color'       => '#110c2d',
                    'font-style'  => '700',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '28px',
                    'line-height' => '32px'

                ),
            ),
            array(
                'id'          => 'opt-typography-h4',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H4', 'unipix'),
                'font-backup' => false,
                'all_styles'  => true,
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'unipix'),
                'default'     => array(
                    'color'       => '#110c2d',
                    'font-style'  => '700',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '20px',
                    'line-height' => '28px'
                ),
            ),
            array(
                'id'          => 'opt-typography-h5',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H5', 'unipix'),
                'font-backup' => false,
                'all_styles'  => true,
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'unipix'),
                'default'     => array(
                    'color'       => '#110c2d',
                    'font-style'  => '700',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '18px',
                    'line-height' => '26px'
                ),
            ),
            array(
                'id'          => 'opt-typography-6',
                'type'        => 'typography',
                'title'       => esc_html__('Heading H6', 'unipix'),

                'font-backup' => false,
                'all_styles'  => true,
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'unipix'),
                'default'     => array(
                    'color'       => '#110c2d',
                    'font-style'  => '700',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '16px',
                    'line-height' => '20px'
                ),
            ),

        )
    )
);

/*Team Sections*/
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Professors Section', 'unipix' ),
    'id'               => 'team',
    'customizer_width' => '450px',
    'icon' => 'el el-user',
    'fields'           => array(       
        array(
            'id'       => 'team_slug',                               
            'title'    => esc_html__( 'Team Slug', 'unipix' ),
            'subtitle' => esc_html__( 'Enter Team Slug Here', 'unipix' ),
            'type'     => 'text',
            'default'  => esc_html__('teams', 'unipix'),
            
        ),  
        array(
            'id'       => 'team_category_slug',                               
            'title'    => esc_html__( 'Team Category Slug', 'unipix' ),
            'subtitle' => esc_html__( 'Enter Team Category Slug Here', 'unipix' ),
            'type'     => 'text',
            'default'  => esc_html__('team-category', 'unipix'),
        ),               
    )
) );

/*Reserach Sections*/
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Research', 'unipix' ),
    'id'               => 'research',
    'customizer_width' => '450px',
    'icon' => 'el el-align-right',
    'fields'           => array(    
        array(
            'id'       => 'research_slug',                               
            'title'    => esc_html__( 'Research Slug', 'unipix' ),
            'subtitle' => esc_html__( 'Enter Research Slug Here', 'unipix' ),
            'type'     => 'text',
            'default'  => 'rt-research',    
        ),
        array(
            'id'       => 'cat_research_slug',                               
            'title'    => esc_html__( 'Research Category Slug', 'unipix' ),
            'subtitle' => esc_html__( 'Enter Research Category Slug Here', 'unipix' ),
            'type'     => 'text',
            'default'  => 'rt-research-category',  
        )
    ) 
) );
/*Faculty Sections*/
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Faculty', 'unipix' ),
    'id'               => 'faculty',
    'customizer_width' => '450px',
    'icon' => 'el el-align-right',
    'fields'           => array( 
        array(
            'id'       => 'faculty_slug',                               
            'title'    => esc_html__( 'Faculty Slug', 'unipix' ),
            'subtitle' => esc_html__( 'Enter Faculty Slug Here', 'unipix' ),
            'type'     => 'text',
            'default'  => 'rt-faculty',                
        ), 
        array(
            'id'       => 'faculty_cat_slug',                               
            'title'    => esc_html__( 'Faculty Category Slug', 'unipix' ),
            'subtitle' => esc_html__( 'Enter Faculty Category Slug Here', 'unipix' ),
            'type'     => 'text',
            'default'  => 'rt-faculty-category',                
        ), 
    )
) );
/*Department Sections*/
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Department', 'unipix' ),
    'id'               => 'department',
    'customizer_width' => '450px',
    'icon' => 'el el-align-right',
    'fields'           => array(     
        array(
            'id'       => 'department_slug',                               
            'title'    => esc_html__( 'Department Slug', 'unipix' ),
            'subtitle' => esc_html__( 'Enter Department Slug Here', 'unipix' ),
            'type'     => 'text',
            'default'  => 'rt-department',                
        ), 
        array(
            'id'       => 'department_cat_slug',                               
            'title'    => esc_html__( 'Department Category Slug', 'unipix' ),
            'subtitle' => esc_html__( 'Enter Department Category Slug Here', 'unipix' ),
            'type'     => 'text',
            'default'  => 'rt-department-category',                
        ),
    )
) );
// programs section
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Programs', 'unipix' ),
    'id'               => 'program',
    'customizer_width' => '450px',
    'subsection' => true,
    'icon' => 'el el-align-right',
    'fields'           => array(
         array(
            'id'       => 'rt_program_slug',                               
            'title'    => esc_html__( 'Programs', 'unipix' ),
            'subtitle' => esc_html__( 'Enter Program Slug Here', 'unipix' ),
            'type'     => 'text',
            'default'  => 'rt-program',                
        ), 
        array(
            'id'       => 'program_cat_slug',                               
            'title'    => esc_html__( 'Program Category Slug', 'unipix' ),
            'subtitle' => esc_html__( 'Enter Program Cat Slug Here', 'unipix' ),
            'type'     => 'text',
            'default'  => 'rt-program-category',                    
        ), 
        )
     ) 
);
// Notics Section
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Notice', 'unipix' ),
    'id'               => 'notice',
    'customizer_width' => '450px',
    'icon' => 'el el-align-right',
    'fields'           => array(
         array(
            'id'       => 'notice_slug',                               
            'title'    => esc_html__( 'Notice', 'unipix' ),
            'subtitle' => esc_html__( 'Enter Notice Slug Here', 'unipix' ),
            'type'     => 'text',
            'default'  => 'rt-notice',                
        ), 
        array(
            'id'       => 'notice_cat_slug',                               
            'title'    => esc_html__( 'Notice Category Slug', 'unipix' ),
            'subtitle' => esc_html__( 'Enter Notice Cat Slug Here', 'unipix' ),
            'type'     => 'text',
            'default'  => 'rt-notice-category',                    
        ), 
        )
     ) 
);
/*Blog Sections*/
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Blog', 'unipix'),
        'id'               => 'blog',
        'customizer_width' => '450px',
        'icon' => 'el el-comment',
    )
);

Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Blog Settings', 'unipix'),
        'id'               => 'blog-settings',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'    => 'blog_banner_main',
                'url'   => true,
                'title' => esc_html__('Blog Page Banner', 'unipix'),
                'type'  => 'media',
            ),

            array(
                'id'        => 'blog_bg_color',
                'type'      => 'color',
                'title'     => esc_html__('Body Backgroud Color', 'unipix'),
                'subtitle'  => esc_html__('Pick body background color', 'unipix'),
                'default'   => '#fbfbfb',
                'validate'  => 'color',
            ),

            array(
                'id'       => 'blog_title',
                'title'    => esc_html__('Blog  Title', 'unipix'),
                'subtitle' => esc_html__('Enter Blog  Title Here', 'unipix'),
                'type'     => 'text',
            ),          

            array(
                'id'               => 'blog-layout',
                'type'             => 'image_select',
                'title'            => esc_html__('Select Blog Layout', 'unipix'),
                'subtitle'         => esc_html__('Select your blog layout', 'unipix'),
                'options'          => array(
                    'full'             => array(
                        'alt'              => esc_html__('Blog Style 1', 'unipix'),
                        'img'              => get_template_directory_uri() . '/libs/img/1c.png'
                    ),
                    '2right'           => array(
                        'alt'              => esc_html__('Blog Style 2', 'unipix'),
                        'img'              => get_template_directory_uri() . '/libs/img/2cr.png'
                    ),
                    '2left'            => array(
                        'alt'              => esc_html__('Blog Style 3', 'unipix'),
                        'img'              => get_template_directory_uri() . '/libs/img/2cl.png'
                    ),
                ),
                'default'          => '2right'
            ),

            array(
                'id'               => 'blog-grid',
                'type'             => 'select',
                'title'            => esc_html__('Select Blog Gird', 'unipix'),
                'desc'             => esc_html__('Select your blog gird layout', 'unipix'),
                //Must provide key => value pairs for select options
                'options'          => array(
                    '12'               => esc_html__('1 Column', 'unipix'),
                    '6'                => esc_html__('2 Column', 'unipix'),
                    '4'                => esc_html__('3 Column', 'unipix'),
                    '3'                => esc_html__('4 Column', 'unipix'),
                ),
                'default'          => '12',
            ),

            array(
                'id'               => 'blog-author-post',
                'type'             => 'select',
                'title'            => esc_html__('Show Author Info ', 'unipix'),
                'desc'             => esc_html__('Select author info show or hide', 'unipix'),
                //Must provide key => value pairs for select options
                'options'          => array(
                    'show'             => esc_html__('Show', 'unipix'),
                    'hide'             => esc_html__('Hide', 'unipix'),
                ),
                'default'          => 'show',

            ),



            array(
                'id'               => 'blog-category',
                'type'             => 'select',
                'title'            => esc_html__('Show Category', 'unipix'),

                //Must provide key => value pairs for select options
                'options'          => array(
                    'show'             => esc_html__('Show', 'unipix'),
                    'hide'             => esc_html__('Hide', 'unipix'),
                ),
                'default'          => 'show',

            ),

            array(
                'id'               => 'blog-date',
                'type'             => 'switch',
                'title'            => esc_html__('Show Date', 'unipix'),
                'desc'             => esc_html__('You can show/hide date at blog page', 'unipix'),

                'default'          => true,
            ),
            array(
                'id'               => 'blog_readmore',
                'title'            => esc_html__('Blog  ReadMore Text', 'unipix'),
                'subtitle'         => esc_html__('Enter Blog  ReadMore Here', 'unipix'),
                'type'             => 'text',
            ),

        )
    )

);


/*Single Post Sections*/
Redux::setSection(
    $opt_name,
    array(
        'title'            => esc_html__('Single Post', 'unipix'),
        'id'               => 'spost',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(

            array(
                'id'       => 'single_blog_title',
                'title'    => esc_html__('Single Blog  Title', 'unipix'),
                'subtitle' => esc_html__('Enter Title Here', 'unipix'),
                'type'     => 'text',
            ),
            array(
                'id'       => 'blog_banner',
                'url'      => true,
                'title'    => esc_html__('Blog Single page banner', 'unipix'),
                'type'     => 'media',

            ),

           

            array(
                'id'       => 'blog-comments',
                'type'     => 'select',
                'title'    => esc_html__('Show Comment', 'unipix'),
                'desc'     => esc_html__('Select comments show or hide', 'unipix'),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'show' => esc_html__('Show', 'unipix'),
                    'hide' => esc_html__('Hide', 'unipix'),
                ),
                'default'  => 'show',

            ),

            array(
                'id'       => 'blog-author',
                'type'     => 'select',
                'title'    => esc_html__('Show Ahthor Info', 'unipix'),
                'desc'     => esc_html__('Select author info show or hide', 'unipix'),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'show' => esc_html__('Show', 'unipix'),
                    'hide' => esc_html__('Hide', 'unipix'),
                ),
                'default'  => 'show',

            ),

        )
    )


);


Redux::setSection(
    $opt_name,
    array(
        'title'  => esc_html__('404 Error Page', 'unipix'),
        'desc'   => esc_html__('404 details  here', 'unipix'),
        'icon'   => 'el el-error-alt',
        'fields' => array(

            array(
                'id'       => 'title_404',
                'type'     => 'text',
                'title'    => esc_html__('Title', 'unipix'),
                'subtitle' => esc_html__('Enter title for 404 page', 'unipix'),
                'default'  => esc_html__('404', 'unipix')
            ),

            array(
                'id'       => 'text_404',
                'type'     => 'text',
                'title'    => esc_html__('Text', 'unipix'),
                'subtitle' => esc_html__('Enter text for 404 page', 'unipix'),
                'default'  => esc_html__('Page Not Found', 'unipix')
            ),


            array(
                'id'       => 'back_home',
                'type'     => 'text',
                'title'    => esc_html__('Back to Home Button Label', 'unipix'),
                'subtitle' => esc_html__('Enter label for "Back to Home" button', 'unipix'),
                'default'  => esc_html__('Back to Homepage', 'unipix')

            ),
            array(
                'id'       => '404_bg',
                'type'     => 'media',
                'title'    => esc_html__('404 page Image', 'unipix'),
                'subtitle' => esc_html__('Upload your image', 'unipix'),
                'url' => true
            ),


        )
    )
);

if (!function_exists('compiler_action')) {
    function compiler_action($options, $css, $changed_values)
    {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r($changed_values); // Values that have changed since the last save
        echo "</pre>";
    }
}

/**
 * Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')) {
    function redux_validate_callback_function($field, $value, $existing_value)
    {
        $error   = false;
        $warning = false;

        //do your validation
        if ($value == 1) {
            $error = true;
            $value = $existing_value;
        } elseif ($value == 2) {
            $warning = true;
            $value   = $existing_value;
        }

        $return['value'] = $value;

        if ($error == true) {
            $field['msg']    = 'your custom error message';
            $return['error'] = $field;
        }

        if ($warning == true) {
            $field['msg']      = 'your custom warning message';
            $return['warning'] = $field;
        }

        return $return;
    }
}

/**
 * Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')) {
    function redux_my_custom_field($field, $value)
    {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
}

/**
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.     
 * */
if (!function_exists('dynamic_section')) {
    function dynamic_section($sections)
    {
        //$sections = array();
        $sections[] = array(
            'title'  => esc_html__('Section via hook', 'unipix'),
            'desc'   => esc_html__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'unipix'),
            'icon'   => 'el el-paper-clip',
            'fields' => array()
        );
        return $sections;
    }
}

/**
 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
 * */
if (!function_exists('change_arguments')) {
    function change_arguments($args)
    {
        return $args;
    }
}

/**
 * Filter hook for filtering the default value of any given field. Very useful in development mode.
 * */
if (!function_exists('change_defaults')) {
    function change_defaults($defaults)
    {
        $defaults['str_replace'] = 'Testing filter hook!';
        return $defaults;
    }
}

/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 */
if (!function_exists('remove_demo')) {
    function remove_demo()
    {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_action('plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2);
            remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
        }
    }
}
