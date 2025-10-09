<?php
get_template_part("components/head");
?>
<body>
    <div class="wrapper">
  
   <?php
   get_template_part("components/header");
    ?>
  <!--     <?php
   echo slider();
    ?> -->
  <?php
    if (is_front_page()){
        if (get_theme_mod("mytheme_enable_slider")=="1"){
            slider();
        }   
    }
    ?>
    <main class="main__container">
        <?php
          // Include Skills & Tools component
          get_template_part('components/SkillsTools');
          ?>
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
   get_template_part("components/footer");
    ?>
   <!--  <?php
/*     adder (5,5); */
    ?> -->
    </div>
</body>
</html>