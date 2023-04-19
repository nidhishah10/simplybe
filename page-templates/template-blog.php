<?php

//Exit if Directly accessed

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Template Name: Blog Page Template
 *
 * Handles to show blog Page Content
 * @since Aluvisie
 **/

get_header();
// Loop Start Here
while (have_posts()): the_post();
	// Include the Blog Page Content template.
	get_template_part('page-contents/content', 'blog');
endwhile; //end of while
get_footer();?>