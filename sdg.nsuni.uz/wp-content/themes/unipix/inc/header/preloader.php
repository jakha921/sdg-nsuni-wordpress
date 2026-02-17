<?php 
global $unipix_option;
$preloader_img = "";
if(!empty($unipix_option['show_preloader']))
  {
    $loading = $unipix_option['show_preloader'];
    
    if(!empty($unipix_option['preloader_img'])){
        $preloader_img = $unipix_option['preloader_img'];
    }

    if($loading == 1){
      if(empty($preloader_img['url'])):
      ?>
      <div id="unipix-load">  
        <div class="loader-wrapper">
        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div> 
      </div>  
        
        <?php else: ?>
            <div id="unipix-load">                
                <div class="loader-container">
                    <div class='loader-icon'><img src="<?php echo esc_url($preloader_img['url']);?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></div>
                </div>                            
            </div>
        <?php endif; ?>
  <?php }
}?>

<?php 
    if(!empty($unipix_option['off_sticky'])):   
        $sticky = $unipix_option['off_sticky'];         
        if($sticky == 1):
            $sticky_menu ='menu-sticky';        
        endif;
        else:
            $sticky_menu ='';
    endif;

    if( is_page() ){

        $post_meta_header = get_post_meta($post->ID, 'trans_header', true);  

        if($post_meta_header == 'Default Header'){       
            $header_style = 'default_header';             
        }
        else{
            $header_style = 'transparent_header';
        }
    }
    else{
        $header_style = 'transparent_header';
    }
 ?>   