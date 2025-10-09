<header class="Header__container navbar">
    <?php
    // Include darkmode toggle button
    if (function_exists('mytheme_darkmode_toggle')) {
        mytheme_darkmode_toggle();
    }
    ?>
        <a href="<?php echo get_home_url(); ?>" class="Header__logo">
            <?php
             the_custom_logo();
            ?>
        </a>
        <?php
        wp_nav_menu(["main-menu"]);
        ?>
        <?php
        echo get_search_form();
        ?>
        <!--Vi kan også lave en selv-->
    <!--      <form action="">
            <input type="text" name="s" id="" placeholder="Søg på siden">
            <input type="submit" value="Søg">
        </form>  -->

    </header>