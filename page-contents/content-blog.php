    <?php
//Exit if Directly accessed
if (!defined('ABSPATH')) {
	exit;
}

/**
 * The Template Used For Displaying Blog page Content
 *
 * @package WordPress
 * @subpackage Simply Be
 * @since Simply Be 1.0
 */
?>
    <div id="main">
    	<div class="wrap">
    		<div id="primary" class="content-area one-column">
    			<div id="content" class="site-content">
    				<div class="inner-title-block">
    					<h1>Blogs</h1>
    				</div>
    				<div class="blog-inner-sec">
    					<div class="blog-category-row">
<?php $categories = get_categories();?>

    						<ul class="megaCat">
                                <?php
$cat = $_GET['category'];

$wsubcats = get_categories($wsubargs);
foreach ($wsubcats as $wsc):
?>
	    <li><a class="list" href="#<?php echo $cat; ?>" data-slug="<?php echo $wsc->slug; ?>"><?php echo $wsc->name; ?></a></li>
	<?php endforeach;?>
    						</ul>

					</div>
                    <div class="blog-sec">
    					<div class="blog-sec-row inner-page">
    						<?php
$cat = $_GET['category'];
if ($cat == '') {
	$args = array('post_type' => 'post', 'posts_per_page' => -1, 'order' => 'ASC');

} else {
	$args = array('post_type' => 'post', 'posts_per_page' => -1, 'order' => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => $cat,
			),
		));
}

$the_query = new WP_Query($args);

?>
<?php if ($the_query->have_posts()): ?>
              <?php while ($the_query->have_posts()): $the_query->the_post();?>
											<div class="blog-box">
											<div class="blog-fig">
											<a href="#">
											<figure><img src="<?php echo get_field('blog_img'); ?>" alt="Blog"></figure>
											</a>
											</div>
											<div class="blog-info">
											<a href="#">
											<h3><?php the_title();?></h3>
											</a>
											<?php $article_data = substr(get_the_content(), 0, 100);?>
											<p>
											<?php echo $article_data; ?>
											</p>
											<a href="<?php echo the_permalink(); ?>" class="read-more" data-hover="Lees meer"><?php echo get_field('lees_meer'); ?></a>
											</div>
											</div>
											<?php endwhile;?>

    					</div>
    					<!--/.blog-sec-row-->
                        <?php else: ?>
                  <p class="not-found">No Blogs Found</p>
              </div>
              <?php endif;?>
<?php wp_reset_postdata();?>
    				</div>
    				<!--/.blog-inner-sec-->
