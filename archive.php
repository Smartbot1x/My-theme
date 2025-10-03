<?php
get_template_part("parts/head");
?>
<body>
    <?php
    get_template_part("parts/header");
    ?>
    <main class="niller-main">
        <?php 
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post(); 
                ?>
                <a href="<?php echo get_the_permalink() ?>">

                    <?php
                    the_title("<h2 class='niller-title'>","</h2>");
                    the_post_thumbnail("medium");
                    the_excerpt();
                    ?>
                </a>
                <?php
            }
        } // end if
        ?>
    </main>
    <?php
    get_template_part("parts/footer");

    ?>
    
</body>
</html>