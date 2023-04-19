<div class="contact-detail-sec">
    <div class="contact-info">
        <?php $contact_title = get_field('contact_title', 'option');?>
        <?php if (isset($contact_title) && !empty($contact_title)): ?>
            <h2><?php echo $contact_title; ?></h2>
        <?php endif;?>
        <?php $person_name = get_field('person_name', 'option');?>
        <?php if (isset($person_name) && !empty($person_name)): ?>
            <h4 class="name"><?php echo $person_name; ?></h4>
        <?php endif;?>
        <ul class="contact-links">
            <?php $mail_id = get_field('mail_id', 'option');?>
            <?php if (isset($mail_id) && !empty($mail_id)): ?>
                <li><a href="mailto:peter@boshuis.eu" target="_blank" data-hover="peter@boshuis.eu"><?php echo $mail_id; ?></a></li>
            <?php endif;?>
            <?php $contact_num = get_field('contact_num', 'option');?>
            <?php if (isset($contact_num) && !empty($contact_num)): ?>
                <li><a href="tel:+31(0)611081597" target="_blank" data-hover="+31 (0)6 110 815 97"><?php echo $contact_num; ?></a></li>
            <?php endif;?>
        </ul>
    </div>
    <div class="contact-fig">
        <?php $contact_profile_img = get_field('contact_profile_img', 'option');?>
        <?php if (isset($contact_profile_img) && !empty($contact_profile_img)): ?>
            <figure><img src="<?php echo $contact_profile_img; ?>" alt="Profile"></figure>
        <?php endif;?>
    </div>
</div>
<!--/.contact-detail-sec-->
</div>
<!--/#content-->
</div>
<!--/#primary-->
</div>
<!--/.wrap-->
</div>
<!--/#main -->

<footer id="footer">
    <div class="footer-top">
        <div class="wrap">
            <div class="footer-top-row">
                <div class="footer-info">
                    <?php $menu_title = get_field('menu_title', 'option');?>
                    <?php if (isset($menu_title) && !empty($menu_title)): ?>
                        <h5><?php echo $menu_title; ?></h5>
                    <?php endif;?>
                    <ul class="fmenu">
                        <?php if (has_nav_menu('footer-menu')): // Check Main Menu Set or Not
	wp_nav_menu(array('theme_location' => 'footer-menu', 'container' => '', 'container_class' => '', 'items_wrap' => '%3$s'));
endif;?>
                    </ul>
                    <!--/.fmenu -->
                </div>
                <div class="footer-info">
                    <?php $footer_title = get_field('footer_title', 'option');?>
                    <?php if (isset($footer_title) && !empty($footer_title)): ?>
                        <h5><?php echo $footer_title; ?></h5>
                    <?php endif;?>
                    <ul class="fsocial">
                        <?php $footer_social = get_field('footer_social', 'option');?>
                        <?php foreach ($footer_social as $key => $menu) {?>
                            <li><a href="<?php echo $menu['fsocial_url']; ?>" target="_blank" class="<?php echo $menu['fsocial_name']; ?>"><i class="<?php echo $menu['fsocial_class_name']; ?>"></i></a></li>
                        <?php }?>
                    </ul>
                </div>
                <div class="footer-info">
                    <div class="f-quote">
                        <?php $footer_info = get_field('footer_info', 'option');?>
                        <?php if (isset($footer_info) && !empty($footer_info)): ?>
                            <h2><?php echo $footer_info; ?></h2>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
        <!--/.wrap -->
    </div>
    <!--/.footer-top -->
    <div class="footer-bottom">
        <div class="wrap">
            <?php $copyright_info = get_field('copyright_info', 'option');?>
            <?php if (isset($copyright_info) && !empty($copyright_info)): ?>
                <p class="copyright"><?php echo $copyright_info; ?></p>
                <!--/.copyright -->
            <?php endif;?>
        </div>
        <!--/.wrap -->
    </div>
    <!--/.footer-bottom -->
</footer>
<!--/#footer -->

<?php wp_footer();?>
</body>
<script>
jQuery(function($){
    $('.megaCat .list').each(function(){

        $(this).on('click', function() {
            //alert('hii' + $(this).text());
            //$('.blog-category-row').html($(this).text()); // Top heading
            //$('.blog-box').html($(this).text()); // Content

            $.ajax({
                type: 'POST',
                url: ajaxurl,
               dataType :'json',
                data: {
                    action: 'filter_projects',
                    category: $(this).data('slug'),
                },

                success: function(res) {
                   // $('.assortment-products').html(res);
                   //$('.assortment-filters').html()
                   console.log(res);
                   var html = `<div class="blog-box">
                   <div class="blog-fig">
                  <figure><img src="`+res.image+`" alt="Blog"></figure>
                  </div>
                  <div class="blog-info">
                  <h3>`+res.title+`</h3>
                  <p>`+res.content+`</p>
                  <a href="`+res.permalink+`" class="read-more" data-hover="Lees meer">`+res.button+`</a>
                  </div>
                </div>`;
                if(res == ''){
                    $('.blog-sec').html('<p class="not-found">No Blogs Found</p>');
                } else{
                    $('.blog-sec-row').html(html);
                }
                }

            });
            return false;
        });

    });
});
</script>
</html>