    <?php
//Exit if Directly accessed
if (!defined('ABSPATH')) {
	exit;
}

/**
 * The Template Used For Displaying Contact page Content
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
              <?php $contact_title = get_field('contact_title');?>
              <?php if (isset($contact_title) && !empty($contact_title)): ?>
                <h1><?php echo $contact_title; ?></h1>
              <?php endif;?>
            </div>
            <div class="contact-form-sec">
              <?php $contact_short_code = get_field('contact_short_code');?>
              <?php if (isset($contact_short_code) && !empty($contact_short_code)): ?>
                <?php echo do_shortcode($contact_short_code); ?>
              <?php endif;?>
            </div>
            <!--/.contact-form-sec-->