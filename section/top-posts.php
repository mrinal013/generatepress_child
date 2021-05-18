<?php
$args = array(
    'category__in' => get_field('top_post_category'),
);

$top_posts = new WP_Query( $args );

if ( $top_posts->have_posts() ) {
?>
<div class="top-posts">
    <div class="row">
    <?php
    while ( $top_posts->have_posts() ) {
        $top_posts->the_post();
        $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    ?>
        <div class="col-sm-12 col-md-3">
            <img src="<?php echo esc_html( $featured_img_url ); ?>" alt="">
            <h5 class="raleway-semibold top-post-heading"><?php the_title(); ?></h5>
            <p class="top-post-description"><?php the_field('post_description'); ?></p>
            <p class="post-author"><?php echo esc_html__( 'By ', 'generatepress' ) . esc_html( get_the_author_meta( 'display_name' ) ); ?></p>
        </div>
    <?php
    }
    ?>
    </div>
</div>
<?php
}
echo '</div>';
wp_reset_postdata();
