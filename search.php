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
        ?>
        <a href="<?php echo get_the_permalink() ?> ">
        <?php
        the_title('<h2 class="title_heading">', '</h2>');
        the_excerpt();
        ?>
		</a>
        <?php
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