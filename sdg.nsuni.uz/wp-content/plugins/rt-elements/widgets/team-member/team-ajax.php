<?php
add_action( 'wp_ajax_load_more_team', 'load_more_team' );
add_action( 'wp_ajax_nopriv_load_more_team', 'load_more_team' );

function load_more_team (){

	if( isset($_POST['args']) ){

      $args = $_POST['args'];
      
      $args = json_decode(stripslashes($args), true);

      $settings = $_POST['settings'];
      
      $settings = json_decode(stripslashes($settings), true);

      $current_page = $_POST['currentPage'];

      $posts_per_page = $args['posts_per_page'];

      $offset = $posts_per_page;

      $args['paged'] = $current_page;

      $best_wp = new wp_Query($args);	      

        if($best_wp->have_posts()){
            if($settings['team_grid_source'] == 'dynamic'){
                while($best_wp->have_posts()): $best_wp->the_post();
                    if('style1' == $settings['team_grid_style']){
                        require plugin_dir_path(__FILE__)."/style1.php";
                    }elseif ('style2' == $settings['team_grid_style']){
                        require plugin_dir_path(__FILE__)."/style2.php";
                    }			
                endwhile;
            }
        }else{
            wp_send_json_error();
        }

    }

    wp_die();
}