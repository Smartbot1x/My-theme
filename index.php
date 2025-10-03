<?php
get_template_part("components/head");
?>
<body>
    <?php
   echo slider();
    ?>
   <?php
   get_template_part("components/header");
    ?>
    <main class="main__container">
        <?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
        the_title('<h1 class="title_heading">', '</h1>');
        the_content();
		
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
    
</body>
</html>