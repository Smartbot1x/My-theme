<?php /* Template Name: Template with slider */ ?>

<?php
get_template_part("components/head");
?>
<body>
    
    <?php
    get_template_part("components/header");
    ?>

    <?php
            slider();

     
    ?>
    <main class="main__container">
        <?php 
      if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
        the_title('<h1 class="title_heading">', '</h1>');
        the_content();
         echo get_post_meta(get_the_id(), "location", true);
            }
        } 
        else {
            // redirect to 404 page
            echo "<h1>404 error</h1>";
        }
        ?>
    </main>
    <?php
    get_template_part("components/footer");

    ?>
    
</body>
</html>