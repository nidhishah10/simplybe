<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.ico">
    <!-- Include google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- End of google fonts -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="wrapper">
        <header id="header">
            <div class="wrap">
                <div class="header-row">
                    <?php $logo = get_field('header_logo', 'option'); ?>
                    <?php if (isset($logo) && !empty($logo)) : //to check site Logo 
                    ?>
                        <a href="<?php bloginfo('url'); ?>" id="logo" title="<?php bloginfo('name'); ?>">
                            <img src="<?php echo $logo; ?>" width="125" height="105" alt="<?php bloginfo('name'); ?>">
                        </a>
                    <?php endif; //endif 
                    ?>
                    <nav id="mainmenu">
                        <?php
                        if (has_nav_menu('main-menu')) : // Check Main Menu Set or Not
                            wp_nav_menu(array('theme_location' => 'main-menu', 'container' => '', 'container_class' => '', 'items_wrap' => '<ul>%3$s</ul>'));
                        endif; //endif
                        ?>
                    </nav>
                    <!--/#mainmenu-->
                </div>
            </div>
            <!--/.wrap-->
        </header>
        <!--/#header-->