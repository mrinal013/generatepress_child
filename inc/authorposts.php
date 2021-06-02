<?php
$author_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$author_post_args = array(
    'post_type' => array( 'review', 'post' ),
    'author'    => get_the_author_meta('ID'),
    'posts_per_page' => 3,
    'paged'     => $author_paged,
);
$author_posts = new WP_Query( $author_post_args );
?>
<h2 class="text-center"><?php echo esc_html( sprintf( 'See All Of %s\'s Article', $author_name ) ); ?></h2>
<?php
if ( ! empty( $author_posts->posts ) ) :
?>
<div class="row authorposts mb-5">
<?php
foreach ( $author_posts->posts as $key => $author_post ) :
$current_id = $author_post->ID;
?>
    <div class="col-md-4 my-4">
        <div class="row mx-0 shadow">
            <div class="col-12 px-0">
                <div class="post-thumbnail" style="background-image: url(<?php echo esc_attr( get_the_post_thumbnail_url( $current_id ) ); ?>);"></div>
            </div>
            <div class="col-12 text-center px-0">
                <div class="link-wrapper py-3">
                    <a href="<?php echo esc_attr( get_permalink( $current_id ) ); ?>" class="text-uppercase text-decoration-none"><?php echo esc_html( get_the_title( $current_id ) ); ?></a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- pagination -->
<?php

?>
</div>
<?php
endif;