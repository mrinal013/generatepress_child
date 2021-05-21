<?php
/**
 * Template Name: Review page
 */
get_header();
?>
<div class="container-fluid gx-0">
    <div class="row">
        <aside class="col-md-3" id="review-left-sidebar">
            <?php dynamic_sidebar('sidebar-2'); ?>
        </aside>
        <article class="col-md-6">
            <h1 class="fs-2 raleway-semibold"><?php the_field('title'); ?></h1>
            <p class="post-author"><?php echo 'BY ' . esc_html( get_the_author_meta('display_name') ); ?></p>
            <?php the_field('description'); ?>
        </article>
        <aside class="col-md-3">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside>
    </div>
</div>
<?php
get_footer();
