<?php
get_header();
$author_name = get_the_author_meta('display_name');
$author_email = get_the_author_meta('user_email');
$author_facebook = get_the_author_meta('facebook');
$author_instagram = get_the_author_meta('instagram');
$author_twitter = get_the_author_meta('twitter');

$author_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$author_post_args = array(
    'post_type'      => array( 'review' ),
    'author'         => get_the_author_meta('ID'),
    'posts_per_page' => 3,
    'paged'          => $author_paged,
);
$author_posts = new WP_Query( $author_post_args );
?>
<div class="container-fluid mt-4 px-0">
    <h3 class="fw-bold text-center text-primary"><?php echo esc_html( sprintf( 'About %s', $author_name ) ); ?></h3>
    <?php include_once 'inc/authorbox2.php'; ?>
    <?php include_once 'inc/authorposts.php'; ?>
    <?php
    $pagination_args = array(
        'prev_text'          => '<i class="fas fa-angle-double-left"></i>',
        'next_text'          => '<i class="fas fa-angle-double-right"></i>',
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'theme-domain' ) . ' </span>'
    );
	the_posts_pagination( $pagination_args );
    wp_reset_postdata();
    ?>
</div>
<?php
get_footer();