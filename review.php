<?php
/**
 * Template Name: Review page
 */
get_header();
?>
<div class="container-fluid gx-0">
    <div class="row mb-4">
        <aside class="col-md-3 d-sm-none d-md-block" id="review-left-sidebar">
            <?php dynamic_sidebar('sidebar-2'); ?>
        </aside>
        <article class="col-md-6 col-sm-12">
            <h1 class="fs-2 raleway-semibold"><?php the_field('title'); ?></h1>
            <p class="post-author"><?php echo 'BY ' . esc_html( get_the_author_meta('display_name') ); ?></p>
            <?php the_field('description'); ?>
            <?php 
            $current_post_author_id = get_the_author_meta('id');
            // $get_avatar = get_avatar($current_post_author_id);
            ?>
            <div class="row border p-4">
                <div class="col-3"><?php echo get_avatar($current_post_author_id); ?></div>
                <div class="col-9">
                    <p><?php echo esc_html( get_the_author_meta('user_description') ); ?></p>
                    <ul class="ps-0 m-0 d-flex list-unstyled justify-content-end">
                        <li class="me-1 text-dark"><a href="#" class="fs-2"><i class="fab fa-instagram-square text-dark"></i></a></li>
                        <li><a href="#" class="fs-2"><i class="fab fa-twitter-square text-dark"></i></a></li>
                    </ul>
                </div>
            </div>
        </article>
        <aside class="col-md-3 d-sm-none d-md-block">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside>
    </div>
</div>
<?php
get_footer();
