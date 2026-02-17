   <?php
/*
     Footer Social
*/
     global $unipix_option;
?>

<ul class="footer_social">  
      <?php
       if(!empty($unipix_option['facebook'])) { ?>
       <li> 
            <a href="<?php echo esc_url($unipix_option['facebook'])?>" target="_blank"><span><i class="fa fa-facebook"></i></span></a> 
       </li>
      <?php } ?>
      <?php if(!empty($unipix_option['twitter'])) { ?>
      <li> 
            <a href="<?php echo esc_url($unipix_option['twitter']);?> " target="_blank"><span><i class="fa fa-twitter"></i></span></a> 
      </li>
      <?php } ?>
      <?php if(!empty($unipix_option['rss'])) { ?>
      <li> 
            <a href="<?php  echo esc_url($unipix_option['rss']);?> " target="_blank"><span><i class="fa fa-rss"></i></span></a> 
      </li>
      <?php } ?>
      <?php if (!empty($unipix_option['pinterest'])) { ?>
      <li> 
            <a href="<?php  echo esc_url($unipix_option['pinterest']);?> " target="_blank"><span><i class="fa fa-pinterest-p"></i></span></a> 
      </li>
      <?php } ?>
      <?php if (!empty($unipix_option['linkedin'])) { ?>
      <li> 
            <a href="<?php  echo esc_url($unipix_option['linkedin']);?> " target="_blank"><span><i class="fa fa-linkedin"></i></span></a> 
      </li>
      <?php } ?>
      <?php if (!empty($unipix_option['google'])) { ?>
      <li> 
            <a href="<?php  echo esc_url($unipix_option['google']);?> " target="_blank"><span><i class="fa fa-google-plus-square"></i></span></a> 
      </li>
      <?php } ?>
      <?php if (!empty($unipix_option['instagram'])) { ?>
      <li> 
            <a href="<?php  echo esc_url($unipix_option['instagram']);?> " target="_blank"><span><i class="fa fa-instagram"></i></span></a> 
      </li>
      <?php } ?>
      <?php if(!empty($unipix_option['vimeo'])) { ?>
      <li> 
            <a href="<?php  echo esc_url($unipix_option['vimeo'])?> " target="_blank"><span><i class="fa fa-vimeo"></i></span></a> 
      </li>
      <?php } ?>
      <?php if (!empty($unipix_option['tumblr'])) { ?>
      <li> 
            <a href="<?php  echo esc_url($unipix_option['tumblr'])?> " target="_blank"><span><i class="fa fa-tumblr"></i></span></a> 
      </li>
      <?php } ?>
      <?php if (!empty($unipix_option['youtube'])) { ?>
      <li> 
            <a href="<?php  echo esc_url($unipix_option['youtube'])?> " target="_blank"><span><i class="fa fa-youtube"></i></span></a> 
      </li>
      <?php } ?>     
</ul>
