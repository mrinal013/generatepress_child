<?php
/**
 * Template Name: Review page
 */
get_header();
?>
<div class="container-fluid gx-0">
    <div class="row">
        <aside class="col-md-3">
            <span id="review-lef-sidebar">
            <?php dynamic_sidebar('sidebar-2'); ?>
            </span>
        </aside>
        <article class="col-md-6">
            <h1 class="fs-2 raleway-semibold"><?php the_field('title'); ?></h1>
            <?php the_field('description'); ?>
        </article>
        <aside class="col-md-3">
            <span id="review-lef-sidebar">
                <?php dynamic_sidebar('sidebar-1'); ?>
            </span>
        </aside>
    </div>
</div>
<?php
get_footer();
