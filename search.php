<?php get_header(); ?>
<div class="inner-page-banner">
  <div class="wrap">
    <?php $search_inner_banner = get_field('search_inner_banner', 'option'); ?>
    <?php if (isset($search_inner_banner) && !empty($search_inner_banner)) : ?>
      <div class="inner-banner-bg" style="background-image: url(<?php echo $search_inner_banner; ?>);">
      <?php endif; ?>
      <div class="title-info">
        <?php $search_title = get_field('search_title', 'option'); ?>
        <?php if (isset($search_title) && !empty($search_title)) : ?>
          <h1>Partners van<?php echo $search_title; ?></h1>
        <?php endif; ?>


        <?php $search_info = get_field('search_info', 'option'); ?>
        <?php if (isset($search_info) && !empty($search_info)) : ?>
          <p><?php echo $search_info; ?></p>
        <?php endif; ?>

      </div>
      </div>
  </div>
  <!--/.wrap-->
</div>
<!--/.inner-page-banner-->

<div class="wrap">



  <div class="top-banner-info">

    <h1>Search Results</h1>

  </div>



</div>

</div>

<?php

$s = get_search_query();

$args = array(

  's' => $s,

);

// The Query

$the_query = new WP_Query($args);

?>

<div id="main">

  <div id="primary" class="content-area one-column">

    <div id="content" class="site-content">



      <div class="page-main">

        <div class="wrap">

          <?php

          if ($the_query->have_posts()) {

            _e("<h2 style='font-weight:bold;color:#f3f3f3'>Search Results for: " . get_query_var('s') . "</h2>");

            while ($the_query->have_posts()) {

              $the_query->the_post();

          ?>

              <li>

                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

              </li>

            <?php

            }
          } else {

            ?>

            <h2 style='font-weight:bold;color:#000'>Nothing Found</h2>

            <div class="alert alert-info">

              <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>

            </div>

          <?php } ?>

        </div>

      </div>

    </div>

  </div>

</div>



<?php get_footer(); ?>