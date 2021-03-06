<?php
/**
 * Template Name: Review page
 */
get_header();
$author_id = get_post_field( 'post_author', get_the_ID() );
?>
<div class="container-fluid gx-0">
    <div class="row mb-5">
        <aside class="col-md-3" id="review-left-sidebar">
            <?php dynamic_sidebar('sidebar-2'); ?>
        </aside>
        <article class="col-md-6 col-sm-12">
            <h1 class="fs-2 raleway-semibold"><?php the_field('title'); ?></h1>
            <p class="post-author"><?php echo 'BY ' . esc_html( get_the_author_meta('display_name', $author_id) ); ?></p>
            <?php the_content(); ?>
            <?php include_once 'inc/authorbox1.php'; ?>
            
        </article>
        <aside class="col-md-3" id="review-right-sidebar">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside>
    </div>
</div>
<?php
get_footer();
