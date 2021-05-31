<?php
/**
 * Template Name: Review page
 */
get_header();
?>
<div class="container-fluid gx-0">
    <div class="row mb-5">
        <aside class="col-md-3" id="review-left-sidebar">
            <?php dynamic_sidebar('sidebar-2'); ?>
        </aside>
        <article class="col-md-6 col-sm-12">
            <h1 class="fs-2 raleway-semibold"><?php the_field('title'); ?></h1>
            <p class="post-author"><?php echo 'BY ' . esc_html( get_the_author_meta('display_name') ); ?></p>
            <?php the_content(); ?>
            <div class="row border border-2 px-4 py-5 mx-0 mt-5">
                <div class="col-3"><?php echo get_avatar( get_the_author_meta('ID') ); ?></div>
                <div class="col-9">
                    <p class="fw-bold fs-5"><?php echo esc_html( get_the_author_meta('display_name') ); ?></p>
                    <p class="text-muted description"><?php echo esc_html( get_the_author_meta('user_description') ); ?></p>
                    <ul class="m-0 ps-0 d-flex justify-content-end list-unstyled">
                        <li class="me-3"><a href="#" class="fs-2"><i class="fab fa-instagram-square text-dark"></i></a></li>
                        <li><a href="#" class="fs-2"><i class="fab fa-twitter-square text-dark"></i></a></li>
                    </ul>
                </div>
            </div>
        </article>
        <aside class="col-md-3" id="review-right-sidebar">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside>
    </div>
</div>
<?php
get_footer();
