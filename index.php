<?php
get_template_part("components/head");
?>
<body>
    <div class="wrapper">
  
   <?php
   get_template_part("components/header");
    ?>
     <!--  <?php
   echo slider();
    ?>  -->
  
    <main class="main__container">
        <?php
        
        if (is_front_page()) {
            hero();
        }
        ?>
        <!-- <?php
        if (is_front_page()){
            if (get_theme_mod("mytheme_enable_slider")=="1"){
                  skills_tools();
            }   
        }
        ?> -->
     
        
        <?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
        the_title('<h1 class="title_heading">', '</h1>');
        the_content();
         echo get_post_meta(get_the_id(), "location", true);
		
	} 
} // end if
?>
    </main>
       <?php
        // Contact form on front page
        if (is_front_page()) {
            get_template_part('components/contactform');
        }
        ?>
     
      <!--   <?php
        
          if (is_front_page()) {
              echo do_shortcode('[projects count="6" orderby="date" order="DESC"]');
          }
          ?>
 -->
    
    <?php
    if (is_front_page()){
      
        if (get_theme_mod("mytheme_enable_slider")=="1"){
          
            slider();
        }   
    }
    ?> 
    <?php
   get_template_part("components/footer");
    ?>
   <!--  <?php
/*     adder (5,5); */
    ?> -->
    </div>
</body>
</html>