<?php

/*portfolio single page template
*/
get_header(); 
?>
<div class="container">
    <div id="content">
        <?php
            require get_parent_theme_file_path('inc/portfolio/single-standard.php');
        ?>
    </div>
</div>
<?php
get_footer();