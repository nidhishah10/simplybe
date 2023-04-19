    <?php
//Exit if Directly accessed
if (!defined('ABSPATH')) {
	exit;
}

/**
 * The Template Used For Displaying Home page Content
 *
 * @package WordPress
 * @subpackage Simply Be
 * @since Simply Be 1.0
 */
?>
<div class="banner-sec">
        <div class="wrap">
            <div class="banner-row">
                <div class="more-banner-details">
                    <div class="banner-info">
                        <?php $banner_img = get_field('banner_img');?>
                <?php if (isset($banner_img) && !empty($banner_img)): ?>
                <figure><img src="<?php echo $banner_img; ?>" alt="Be"></figure>
                <?php endif;?>
                <?php $banner_title = get_field('banner_title');?>
                <?php if (isset($banner_title) && !empty($banner_title)): ?>
                <h1><?php echo $banner_title; ?></h1>
                <?php endif;?>
                    </div>
                     <?php $video_desktop = get_field('video_desktop');
$video_mobile = get_field('video_mobile');
?>
                    <div class="banner-fig">
                        <?php
if (wp_is_mobile()) {?>
    <video autoplay muted loop playsinline>
                            <source src="<?php echo $video_mobile['url']; ?>" type="video/webm">
                        </video>
<?php } else {?>
  <video autoplay muted loop playsinline>
                            <source src="<?php echo $video_desktop['url']; ?>" type="video/webm">
                        </video>
<?php }?>
                    </div>
                </div>
            </div>
        </div><!--/.wrap-->
    </div><!--/.banner-sec-->
<div id="main">
    <div class="wrap">
        <div id="primary" class="content-area one-column">
            <div id="content" class="site-content">
                <div class="procedere-sec">
                    <div class="proce-info">
                        <?php $traject_title = get_field('traject_title');?>
                        <?php if (isset($traject_title) && !empty($traject_title)): ?>
                        <h2><?php echo $traject_title; ?></h2>
                        <?php endif;?>

                        <?php $traject_info = get_field('traject_info');?>
                        <?php if (isset($traject_info) && !empty($traject_info)): ?>
                        <p><?php echo $traject_info; ?></p>
                        <?php endif;?>
                    </div>
                    <div class="proce-fig">
                        <?php $proce_fig_img = get_field('proce_fig_img');?>
                        <?php if (isset($proce_fig_img) && !empty($proce_fig_img)): ?>
                        <figure><img src="<?php echo $proce_fig_img; ?>" alt="Procedure"></figure>
                        <?php endif;?>
                    </div>
                </div><!--/.procedere-sec-->
                <div class="reference-sec">
                    <div class="ref-info">
                        <?php $referenties_title = get_field('referenties_title');?>
                        <?php if (isset($referenties_title) && !empty($referenties_title)): ?>
                        <h2><?php echo $referenties_title; ?></h2>
                        <?php endif;?>
                        <?php $referenties_info = get_field('referenties_info');?>
                        <?php if (isset($referenties_info) && !empty($referenties_info)): ?>
                        <p><?php echo $referenties_info; ?></p>
                        <?php endif;?>
                    </div>
                    <div class="ref-fig">
                        <?php $ref_fig_img = get_field('ref_fig_img');?>
                        <?php if (isset($ref_fig_img) && !empty($ref_fig_img)): ?>
                        <figure><img src="<?php echo $ref_fig_img; ?>" alt="Reference"></figure>
                    <?php endif;?>
                    </div>
                </div><!--/.reference-sec-->
                <div class="blog-sec">
                    <div class="main-title">
                        <h2>Blogs</h2>
                    </div>
                    <div class="blog-sec-row owl-carousel blog-post-slider">
                        <?php
$args = array('post_type' => 'post', 'order' => 'ASC');
$the_query = new WP_Query($args);
?>
<?php if ($the_query->have_posts()): ?>
                        <?php while ($the_query->have_posts()): $the_query->the_post();?>
															    <div class="item">
																            <div class="blog-box">
																                <div class="blog-fig">
															                        <a href="<?php echo the_permalink(); ?>">
																                    <figure><img src="<?php echo get_field('blog_img'); ?>" alt="Blog"></figure>
															                    </a>
																                </div>
																                <div class="blog-info">
															                    <a href="<?php echo the_permalink(); ?>"><h3><?php the_title();?></h3></a>
																                    <?php $article_data = substr(get_the_content(), 0, 100);?>
																                                    <p>
																                                        <?php echo $article_data; ?>
																                                    </p>
																                    <a href="<?php echo the_permalink(); ?>" class="read-more" data-hover="Lees meer"><?php echo get_field('lees_meer'); ?></a>
																                </div>
																            </div>
															            </div>
																        <?php endwhile;?>
                    <?php endif;?>
                    <?php wp_reset_postdata();?>
                    </div>
                </div><!--/.blog-sec-->
