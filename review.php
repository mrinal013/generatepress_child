<?php
/**
 * Template Name: Review page
 */
get_header();
?>
<div class="container-fluid">
    <div class="row">
        <aside class="col-md-3 bg-success">
            <span id="review-lef-sidebar" class="position-fixed">
            <?php dynamic_sidebar('sidebar-2'); ?>
            </span>
        </aside>
        <article class="col-md-6 bg-info">
            <h1><?php the_field('title'); ?></h1>
            <?php the_field('description'); ?>
        </article>
        <aside class="col-md-3 bg-danger">Right sidebar</aside>
    </div>
</div>
<?php
get_footer();